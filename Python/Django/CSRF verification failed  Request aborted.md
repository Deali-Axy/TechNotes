## About the CSRF_Token
*(From Django Official Document)*
>The CSRF middleware and template tag provides easy-to-use protection against [Cross Site Request Forgeries](https://www.squarefree.com/securitytips/web-developers.html#CSRF). This type of attack occurs when a malicious website contains a link, a form button or some JavaScript that is intended to perform some action on your website, using the credentials of a logged-in user who visits the malicious site in their browser. A related type of attack, ‘login CSRF’, where an attacking site tricks a user’s browser into logging into a site with someone else’s credentials, is also covered.
>
>The first defense against CSRF attacks is to ensure that GET requests (and other ‘safe’ methods, as defined by [**RFC 7231#section-4.2.1**](https://tools.ietf.org/html/rfc7231.html#section-4.2.1)) are side effect free. Requests via ‘unsafe’ methods, such as POST, PUT, and DELETE, can then be protected by following the steps below.

## 错误
根据官方文档的说明，我在需要使用`POST`提交的表单里添加`csrf_token`即可，然而，还是出现了这个问题，又多看了几遍文档，发现没有错误，然后到谷歌一搜，才发现是模版渲染的问题。
最近看的这本《Django的16堂课》真是害人不浅啊，按照里面的写法问题多多，太坑了。

## 解决
原本的写法是先用`get_template`函数获取一个模版对象，然后在`render`渲染成html，问题就是出在这里，这种方式渲染的html，并不会把加入`csrf_token`！
使用官方文档里介绍的`django.shortcuts.render`就没有这个问题。

## 顺手贴上官方代码
**views.py**
```python
from django.shortcuts import render
from django.http import HttpResponseRedirect

from .forms import NameForm

def get_name(request):
    # if this is a POST request we need to process the form data
    if request.method == 'POST':
        # create a form instance and populate it with data from the request:
        form = NameForm(request.POST)
        # check whether it's valid:
        if form.is_valid():
            # process the data in form.cleaned_data as required
            # ...
            # redirect to a new URL:
            return HttpResponseRedirect('/thanks/')

    # if a GET (or any other method) we'll create a blank form
    else:
        form = NameForm()

    return render(request, 'name.html', {'form': form})
```

**name.html**
```html
<form action="/your-name/" method="post">
    {% csrf_token %}
    {{ form }}
    <input type="submit" value="Submit" />
</form>
```

**再附上官方对于伪造跨站访问请求保护的说明**
**Forms and Cross Site Request Forgery protection**
>Django ships with an easy-to-use [protection against Cross Site Request Forgeries](https://docs.djangoproject.com/en/2.0/ref/csrf/). When submitting a form via `POST` with CSRF protection enabled you must use the [`csrf_token`](https://docs.djangoproject.com/en/2.0/ref/templates/builtins/#std:templatetag-csrf_token) template tag as in the preceding example. However, since CSRF protection is not directly tied to forms in templates, this tag is omitted from the following examples in this document.


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)