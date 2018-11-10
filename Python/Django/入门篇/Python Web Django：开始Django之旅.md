## 前言
开源的Web框架Django简单易用，稳定性和灵活性高，因此被广泛应用于商业化环境，它充分利用了Python拥有丰富的库这一优势。

## Django的安装和服务器的搭建
**安装Django库：**
```python
pip install django
```
**新建Web应用：**
```python
django-admin startproject hello_django
```
以上命令会在当前文件夹下建立`hello_django`目录。
目录结构如下：
 - hello_django
    - manage.py  
    - hello_django
        - `__init__.py`
        - settings.py
        - urls.py 
        - wsgi.py

文件说明：
**settings.py**：存储服务器的所有参数设置
**urls.py**：汇总Web应用的所有URL路径以及对应的函数名，这些函数位于views.py里，其作用是渲染模板，生成URL所指向的网页
**wsgi.py**：与Web应用进行服务器通信的模块

## 启动服务器
```python
python manage.py runserver 8080
```
打开浏览器，输入`127.0.0.1:8080`可以看到如下界面就代表服务器成功运行起来了。
![微信截图_20180225102801.png](http://upload-images.jianshu.io/upload_images/8869373-ec428363cdd3baf2.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 创建App
现在我们的服务器还是什么都没有的吗，要使Web服务器能真正发挥作用，就需要创建不同的Web App，使用以下命令来创建App：
```python
python manage.py startapp hello_app
```
这个命令会在服务器的目录(`hello_django`)下自动创建`hello_app`目录。
`hello_app`的目录结构如下：
- hello_app
    - `__init__.py`
    - admin.py
    - apps.py
    - models.py
    - tests.py
    - views.py
    - migrations
        - `__init__.py`

-----------
关于`settings.py`的配置将在下一篇文章中介绍。


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)