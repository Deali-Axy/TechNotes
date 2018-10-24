## View视图渲染
编辑App目录下的`views.py`
```python
from django.shortcuts import render
from django.http import HttpResponse

# Create your views here.
def hello(request):
    return HttpResponse("Hello Django!")
```

## URL解析配置
编辑`urls.py`：
在urlpatterns里增加一个URL解析规则`path('', views.hello)`
```python
from django.contrib import admin
from django.urls import path
from hello_app import views

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', views.hello)
]
```

## 打开浏览器测试
![image.png](http://upload-images.jianshu.io/upload_images/8869373-6e5a13cc9d20bbc3.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 通过模板构建
上面使用 django.http.HttpResponse() 来输出 "Hello Django！"。该方式将数据与视图混合在一起，不符合 Django 的 MVC 思想。
接下来使用html模板来构建App。
在前面的文章里面，我们已经在`settings.py`里配置好了模板(`templates`)目录，现在，在`templates`目录下新建`home.html`文件。

### 编写模板文件：
```html
{% block main %}
    <h1>
        {{ home }}
    </h1>
{% endblock main %}
```

### 在`views.py`里定义
```python
def home(request):
    context = {}
    context['home'] = "home"
    return render(request, 'home.html', context)
```

### 在`urls.py`里做URL解析
前面说过了，不再重复

### 浏览器测试
![image.png](http://upload-images.jianshu.io/upload_images/8869373-72ac0689480eb3fe.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)