## 关于Django的缩略图
我在Django的官方文档里看了一下，没有找到有关缩略图的官方库，不过在Django的Wiki里头倒是看到了一篇关于使用缩略图的介绍，请参考：[https://code.djangoproject.com/wiki/ThumbNails](https://code.djangoproject.com/wiki/ThumbNails)

## 关于Problem的描述
The majority of applications that have images, probably use thumbnails in some capacity. There is no standard thumbnail capability in Django but there are a couple of different options out there that people have created. This page is an attempt to gather them in one place and discuss the best strategy for integrating one in Django.

## Current Implementations
**官方推荐的第三方库**
*   [​sorl-thumbnail](https://github.com/sorl/sorl-thumbnail) is excellent.
*   [​SmileyChris's easy-thumbnails](https://github.com/SmileyChris/easy-thumbnails) is also excellent.
*   [​aino-convert](https://github.com/aino/aino-convert/) a versatile solution for the fastidious.
*   [​Nesh's Thumbnail](http://code.google.com/p/django-utils/wiki/Thumbnail)
*   [​image-kit](https://bitbucket.org/jdriscoll/django-imagekit/wiki/Home) a django-ish way of resizing images, with image models
*   Here's a more simple filter from Django snippets - [​Simple filter](http://www.djangosnippets.org/snippets/955/)
*   In Ticket [#4115](https://code.djangoproject.com/ticket/4115 "#4115: contrib.thumbnails (closed: wontfix)") you will find a patch with a contrib.thumbnails package - good documented; read the Google Discussion mentioned above for some thoughts about the implementation.
*   Quick tip for adding thumbnails - [​Blog posting](http://superjared.com/entry/django-quick-tips-2-image-thumbnails/)
*   Yet another approach to adding a thumbnail - [CustomUploadAndFilters](https://code.djangoproject.com/wiki/CustomUploadAndFilters)
*   Snippet that creates thumbnails on-demand using dynamics methods - [​Snippet 619](http://www.djangosnippets.org/snippets/619/)
*   Yet another method to resize image on upload - [​Automatically resizing uploaded images](http://www.codeisart.ru/python-django-automatically-resize-uploaded-images/)
*   Custom field for image resizing on upload - [​http://djangothumbnails.com/](http://djangothumbnails.com/)
*   Template tag for resizing to exact dimensions: [​http://bitbucket.org/winsmith/django-thumbnail/wiki/Home](http://bitbucket.org/winsmith/django-thumbnail/wiki/Home)
*   Easy frontend filter for resizing on the fly (great for mobile and mediaqueries) [​django-imagefit](https://github.com/vinyll/django-imagefit)

## 关于easy_thumbnails
>A powerful, yet easy to implement thumbnailing application for Django 1.8+
>Below is a quick summary of usage. For more comprehensive information, view the [full documentation](http://easy-thumbnails.readthedocs.org/en/latest/index.html) online or the peruse the project's `docs` directory.

了解更多请打开`easy_thumbnails`的项目主页，链接在上面有，公众号推文不能点击链接请访问原文。

## 使用步骤简介
**安装**
```python
pip install easy-thumbnails
```

**配置**
编辑`settings.py`
```python
INSTALLED_APPS = (
    ...
    'easy_thumbnails',
)

THUMBNAIL_ALIASES = {
    '': {
        'avatar': {'size': (50, 50), 'crop': True},
    },
}
```

Run `manage.py migrate easy_thumbnails`.

**在templates中使用**
```html
{% load thumbnail %}
<img src="{{ profile.photo|thumbnail_url:'avatar' }}" alt="" />
```


*更多使用方法请参考官方文档*


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)