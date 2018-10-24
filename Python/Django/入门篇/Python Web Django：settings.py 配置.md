## 安装REST框架
```python
pip install djangorestframework
pip install django-rest-swagger
```
安装了REST Framework之后，之前创建的Django App(`hello_app`)就可以使用REST API进行通信。
我们所有创建的App都要添加到`INSTALLED_APPS`这个字段里面。
```python
INSTALLED_APPS = [
    # REST Framework
    'rest_framework',
    'rest_framework_swagger',
    # Custom App
    'hello_app'
]
```

## 数据库配置
Django支持多种后端数据库(MySQL、Oracle、PostgreSQL等)，我还是先用默认的SQLite比较方便。
```python
DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.sqlite3',
        'NAME': os.path.join(BASE_DIR, 'db.sqlite3'),
    }
}
```

## 网页模板
在Django中渲染网页要先提供模板，在`DIRS`里设置HTML模板的文件夹，这里习惯用`templates`这个文件夹。
```python
TEMPLATES = [
    {
        'BACKEND': 'django.template.backends.django.DjangoTemplates',
        'DIRS': [os.path.join(BASE_DIR, 'templates')],
        'APP_DIRS': True,
        'OPTIONS': {
            'context_processors': [
                'django.template.context_processors.debug',
                'django.template.context_processors.request',
                'django.contrib.auth.context_processors.auth',
                'django.contrib.messages.context_processors.messages',
            ],
        },
    },
]
```

## 静态资源
```python
MEDIA_ROOT = os.path.join(BASE_DIR, 'static')
MEDIA_URL = ''
STATIC_ROOT = ''
STATIC_URL = '/static/'
STATICFILES_DIRS = (os.path.join(BASE_DIR, 'static'),)
```

## 网站URL设置
用于服务器的URL解析配置。
下面代码的`hello_django.urls`表示`hello_django`项目的`urls.py`文件。
```python
ROOT_URLCONF = 'hello_django.urls'
```

## 日志配置
```python
LOGGING = {
    'version': 1,
    'disable_existing_loggers': True,
    'formatters': {
        'standard': {
            'format': '%(asctime)s %(levelname)s %(name)s %(message)s',
        },
    },
    'handlers': {
        'default': {
            'level': 'DEBUG',
            'class': 'logging.handlers.RotatingFileHandler',
            'filename': 'hello_django.log',
            'maxBytes': 1024*1024*10,  # 10 MB
            'backupCount': 5,
            'formatter': 'standard'
        },
    },
    'loggers': {
        '': {
            'handlers': ['default'],
            'level': 'DEBUG',
            'propagate': True
        }
    }
}
```
配置完日志输出之后，使用`logging`库的输出都会记录到`hello_django.log`这个文件里。

---------------
到这里`settings.py`里的配置项就基本都配置完了。


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)