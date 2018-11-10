模板可以用继承的方式来实现复用。
接下来我们先创建之前项目的 templates 目录中添加 base.html 文件，代码如下：

```html
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>标题</title>
</head>
<body>
    <h1>Hello World!</h1>
    <p>DA Django 测试。</p>
    {% block mainbody %}
       <p>original</p>
    {% endblock %}
</body>
</html>
```

以上代码中，名为 mainbody 的 block 标签是可以被继承者们替换掉的部分。
所有的 {% block %} 标签告诉模板引擎，子模板可以重载这些部分。
hello.html 中继承 base.html，并替换特定 block，hello.html 修改后的代码如下：

```html
{% extends "base.html" %}
 
{% block mainbody %}<p>继承了 base.html 文件</p>
{% endblock %}
```

第一行代码说明 hello.html 继承了 base.html 文件。可以看到，这里相同名字的 block 标签用以替换 base.html 的相应 block。


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)