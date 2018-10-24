## 几种方法
- 使用`django-cors-headers`全局控制
- 使用`JsonP`，只能用于Get方法
-  在`views.py`里设置响应头，只能控制单个接口

## django-cors-headers
首先安装
```bash
pip install django-cors-headers
```
然后在`settings.py`里配置一番就可以
```python
INSTALLED_APPS = [
    ...
    'corsheaders'，
    ...
 ] 

MIDDLEWARE_CLASSES = (
    ...
    'corsheaders.middleware.CorsMiddleware',
    'django.middleware.common.CommonMiddleware', # 注意顺序
    ...
)
#跨域增加忽略
CORS_ALLOW_CREDENTIALS = True
CORS_ORIGIN_ALLOW_ALL = True
CORS_ORIGIN_WHITELIST = (
    '*'
)

CORS_ALLOW_METHODS = (
    'DELETE',
    'GET',
    'OPTIONS',
    'PATCH',
    'POST',
    'PUT',
    'VIEW',
)

CORS_ALLOW_HEADERS = (
    'XMLHttpRequest',
    'X_FILENAME',
    'accept-encoding',
    'authorization',
    'content-type',
    'dnt',
    'origin',
    'user-agent',
    'x-csrftoken',
    'x-requested-with',
    'Pragma',
)
```
大功告成了。


## JsonP
使用Ajax获取json数据时，存在跨域的限制。不过，在Web页面上调用js的script脚本文件时却不受跨域的影响，JSONP就是利用这个来实现跨域的传输。因此，我们需要将Ajax调用中的dataType从JSON改为JSONP（相应的API也需要支持JSONP）格式。 
JSONP只能用于GET请求。
本文不介绍该方法，需要的同学请自行搜索


## Views.py配置响应头
修改views.py中对应API的实现函数，允许其他域通过Ajax请求数据： 
```python
def myview(request): 
    response = HttpResponse(json.dumps({“key”: “value”, “key2”: “value”})) 
    response[“Access-Control-Allow-Origin”] = “*”   
    response[“Access-Control-Allow-Methods”] = “POST, GET, OPTIONS” 
    response[“Access-Control-Max-Age”] = “1000” 
    response[“Access-Control-Allow-Headers”] = “*” 
    return response
```

## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)
