## 两种方法
- Django 的`django-markdown-deux`模块
- Python模块 `markdown`

## `django-markdown-deux`
**首先需要安装：**
```python
pip install django-markdown-deux
```

**修改`setting.py`**
把`markdown-deux`添加进去
```python
INSTALLED_APPS = [
    'markdown-deux',
]
```

**在模板里添加`tags`**
加载了`markdown-deux-tags`标签之后，在markdown内容加上过滤器就可以解析成html了。
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doc - {{ docname }}</title>
    <link href="/static/css/highlights/github.css"/>
</head>
<body>
{ % load markdown-deux-tags % }
{{ content | markdown }}
</body>
</html>
```


## 使用markdown模块渲染
**首先安装**
```python
pip install markdown
```

**在`views.py`里使用markdown渲染**
```python
import markdown

def doc(request, name):
    template = get_template('doc.html')
    docfile = get_template('doc/{}.md'.format(name))
    content = docfile.render()
    html = template.render({
        'docname': name,
        'content':
            markdown.markdown(content,
                              extensions=[
                                  'markdown.extensions.extra',
                                  'markdown.extensions.codehilite',
                                  'markdown.extensions.toc',
                              ])
    })
    return HttpResponse(html)
```

markdown模块会直接把markdown格式的文档渲染成html格式。
不过django的模板里会对html做转义，所以还需要修改一下模板。

**修改`doc.html`**
给`content`加上`safe`过滤器，表示不需要转义，直接显示原始内容。
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doc - {{ docname }}</title>
    <link href="/static/css/highlights/github.css"/>
</head>
<body>
{{ content | safe }}
</body>
</html>
```

## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)
