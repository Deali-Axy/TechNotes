## 前言：一点题外话
我发现，不更新博客的时候，不是非常忙，就是效率非常低。最近没怎么更新博客，原因是第二种= =。惭愧惭愧。
今天效率出奇的高，一天时间把PassNote后端的接口全部写完了，Django很好用，不过实际项目中还是有些框架不能实现的功能需要解决的，我比较喜欢造轮子，不过为了保证效率，还是尽量用现成的工具，减少不必要的折腾。

## 关于PassNote
之前应该在博客有说过，这是一个密码管理器，用于加密保存各种网站帐号和密码，还可以生成高强度的密码。
项目主页：[https://deali-axy.github.io/PassNote/](https://deali-axy.github.io/PassNote/) 了解一下。
不过这个只是一个桌面版软件，也没有云备份功能，所以一直想找时间开发一个跨平台的版本，一直拖延着，等到今天才开始写。

## Django的session处理
session简单说就是把cookie拿到服务器端去保存，然后客户端通过服务器返回的id作为session标识。
>session框架让你存储和获取访问者的数据信息，这些信息保存在服务器上（默认是数据库中），以 cookies 的方式发送和获取一个包含 session ID的值，并不是用cookies传递数据本身。

## Django中使用session
### 启用session
编辑`settings.py`。
在`MIDDLEWARE_CLASSES`中添加：
```python
'django.contrib.sessions.middleware.SessionMiddleware',
```
在`INSTALLED_APPS`中添加：
```python
'django.contrib.sessions',
```
### 在view中使用
```python
# 创建或修改 session：
request.session[key] = value
# 获取 session：
request.session.get(key,default=None)
# 删除 session
del request.session[key] # 不存在时报错
```
更多session的用法可以参考官方文档：[https://docs.djangoproject.com/en/2.0/topics/http/sessions/](https://docs.djangoproject.com/en/2.0/topics/http/sessions/)

## 关于复杂对象序列化
对于序列化 Django 数据的解决方案已经有以下几种：

### django.core.serializers
Django内建序列化器, 它可以序列化Django model query set 但无法直接序列化单独的Django model数据。如果你的model里含有混合数据 , 这个序列化器同样无法使用(如果你想直接使用序列化数据). 除此之外, 如果你想直接把序列化数据返回给用户,显然它包含了很多敏感及对用户无用对信息。

### QuerySet.values()
和上面一样, QuerySet.values() 同样没法工作如果你的model里有 DateTimeField 或者其他特殊的 Field 以及额外数据。

### django-rest-framework serializers
django-rest-framework 是一个可以帮助你快速构建 REST API 的强力框架。 他拥有完善的序列化器，但在使用之前你需要花费一些时间入门, 并学习 cbv 的开发方式, 对于有时间需求的项目显然这不是最好的解决方案。

简单说就是Django里面的几种现成方案不是功能不够强大就是学习成本高，正当我要自己造轮子的时候，我找到一个方便的解决方案，所以为了节省时间，立刻放弃了自己造轮子的计划。

项目地址：[https://github.com/bluedazzle/django-simple-serializer](https://github.com/bluedazzle/django-simple-serializer) 了解一下。

不过在实际使用的时候又有一个问题，就是序列化`QuerySet`的时候，如果包含`AutoField`的话就报错：`'AutoField' object has no attribute 'rel'`
有点坑啊，好不容易找到个好用的工具不用自己造轮子，突然发现这工具有问题，我还要帮它填坑？？

好吧，没办法，只能出手了，由于代码没有注释，我也没那么多时间去研究具体问题出在哪里，所以就哪里出错改哪里。刚才也在github上给作者发了issue了。

修改了 Serializer 文件的data_inspect函数。
代码如下，加了一个rel属性判断。
```python
def data_inspect(self, data, extra=None):
        if isinstance(data, (QuerySet, Page, list)):
            convert_data = []
            if extra:
                for i, obj in enumerate(data):
                    convert_data.append(self.data_inspect(obj, extra.get(
                        **{self.through_fields[0]: obj, self.through_fields[1]: self.source_field})))
            else:
                for obj in data:
                    convert_data.append(self.data_inspect(obj))
            return convert_data
        elif isinstance(data, models.Model):
            obj_dict = {}
            concrete_model = data._meta.concrete_model
            for field in concrete_model._meta.local_fields:
                # 检查 field 是否存在 rel 这个属性，为'AutoField' object has no attribute 'rel'错误填坑
                if hasattr(field, 'rel'):
                    if field.rel is None:
                        if self.check_attr(field.name) and hasattr(data, field.name):
                            obj_dict[field.name] = self.data_inspect(getattr(data, field.name))
                    else:
                        if self.check_attr(field.name) and self.foreign:
                            obj_dict[field.name] = self.data_inspect(getattr(data, field.name))
                else:
                    if self.check_attr(field.name) and hasattr(data, field.name):
                        obj_dict[field.name] = self.data_inspect(getattr(data, field.name))
            for field in concrete_model._meta.many_to_many:
                if self.check_attr(field.name) and self.many:
                    obj_dict[field.name] = self.data_inspect(getattr(data, field.name))
            for k, v in data.__dict__.items():
                if not str(k).startswith('_') and k not in obj_dict.keys() and self.check_attr(k):
                    obj_dict[k] = self.data_inspect(v)
            if extra:
                for field in extra._meta.concrete_model._meta.local_fields:
                    if field.name not in obj_dict.keys() and field.name not in self.through_fields:
                        if field.rel is None:
                            if self.check_attr(field.name) and hasattr(extra, field.name):
                                obj_dict[field.name] = self.data_inspect(getattr(extra, field.name))
                        else:
                            if self.check_attr(field.name) and self.foreign:
                                obj_dict[field.name] = self.data_inspect(getattr(extra, field.name))
            return obj_dict
        elif isinstance(data, manager.Manager):
            through_list = data.through._meta.concrete_model._meta.local_fields
            through_data = data.through._default_manager
            self.through_fields = [data.target_field.name, data.source_field.name]
            self.source_field = data.instance
            if len(through_list) > 3 and self.through:
                return self.data_inspect(data.all(), through_data)
            else:
                return self.data_inspect(data.all())
        elif isinstance(data, (datetime.datetime, datetime.date, datetime.time)):
            return self.time_func(data)
        elif isinstance(data, (ImageFieldFile, FileField)):
            return data.url if data.url else data.path
        elif isinstance(data, Decimal):
            return float(data)
        elif isinstance(data, dict):
            obj_dict = {}
            if self._dict_check:
                for k, v in data.items():
                    obj_dict[k] = self.data_inspect(v)
            else:
                for k, v in data.items():
                    if self.check_attr(k):
                        obj_dict[k] = self.data_inspect(v)
            return obj_dict
        elif isinstance(data, (str, bool, float, int)):
            return data
        else:
            return None
```

测试了一下，可以正常使用，那就暂时这样吧，虽然有点“hack编程”的感觉，hhh

## End
以上就是项目笔记的全部内容了，新版的PassNote和之前一样，在开发完成之后，会全部开源，这次是准备做移动、桌面、小程序多端跨平台的啦，有兴趣的朋友可以关注一下哈～

国际惯例，附截图一张。
![Screenshot from 2018-06-07 00-43-27.png](https://upload-images.jianshu.io/upload_images/8869373-499d846cbbabe685.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)