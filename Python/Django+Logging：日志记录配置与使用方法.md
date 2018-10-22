## 前言
日志在程序开发中是少不了的，通过日志我们可以分析到错误在什么地方，有什么异常。在生产环境下有很大的用途。在Java开发中通常用log4j,logback等第三方组件。那么在django中是怎么处理日志？django利用的就是Python提供的logging模块，但django中要用logging，还得有一定的配置规则，需要在setting中设置。

## Logging模块
Logging模块为应用程序提供了灵活的手段记录事件、错误、警告和调试信息。对这些信息可以进行收集、筛选、写入文件、发送给系统日志等操作，甚至还可以通过网络发送给远程计算机。

## 首先附上我的Logging配置
```python
LOGGING = {
    'version': 1,
    'disable_existing_loggers': True,
    'formatters': {
        'standard': {
            'format': '%(asctime)s [%(name)s:%(lineno)d] [%(module)s:%(funcName)s] [%(levelname)s] %(message)s'}
        # 日志格式
    },
    'filters': {
    },
    'handlers': {
        'mail_admins': {
            'level': 'ERROR',
            'class': 'django.utils.log.AdminEmailHandler',
            'include_html': True,
        },
        'default': {
            'level': 'DEBUG',
            'class': 'logging.handlers.RotatingFileHandler',
            'filename': '{}/Log/QWebFX_{}.log'.format(BASE_DIR, datetime.datetime.now().date()),  # 日志输出文件
            'maxBytes': 1024 * 1024 * 5,  # 文件大小
            'backupCount': 5,  # 备份份数
            'formatter': 'standard',  # 使用哪种formatters日志格式
        },
        'error': {
            'level': 'ERROR',
            'class': 'logging.handlers.RotatingFileHandler',
            'filename': '{}/Log/Error/QWebFX_Error_{}.log'.format(BASE_DIR, datetime.datetime.now().date()),
            'maxBytes': 1024 * 1024 * 5,
            'backupCount': 5,
            'formatter': 'standard',
        },
        'console': {
            'level': 'DEBUG',
            'class': 'logging.StreamHandler',
            'formatter': 'standard'
        },
        'request_handler': {
            'level': 'DEBUG',
            'class': 'logging.handlers.RotatingFileHandler',
            'filename': '{}/Log/Request/QWebFX_Request_{}.log'.format(BASE_DIR, datetime.datetime.now().date()),
            'maxBytes': 1024 * 1024 * 5,
            'backupCount': 5,
            'formatter': 'standard',
        },
        'scripts_handler': {
            'level': 'DEBUG',
            'class': 'logging.handlers.RotatingFileHandler',
            'filename': '{}/Log/Script/QWebFX_Script_{}.log'.format(BASE_DIR, datetime.datetime.now().date()),
            'maxBytes': 1024 * 1024 * 5,
            'backupCount': 5,
            'formatter': 'standard',
        }
    },
    'loggers': {
        'django': {
            'handlers': ['default'],
            'level': 'DEBUG',
            'propagate': False
        },
        'django.request': {
            'handlers': ['request_handler'],
            'level': 'DEBUG',
            'propagate': False,
        },
        'scripts': {
            'handlers': ['scripts_handler'],
            'level': 'INFO',
            'propagate': False
        },
        'console': {
            'handlers': ['console'],
            'level': 'DEBUG',
            'propagate': True
        },
        # API/Views 模块的日志处理
        'views': {
            'handlers': ['default', 'error'],
            'level': 'DEBUG',
            'propagate': True
        },
        'util': {
            'handlers': ['error'],
            'level': 'ERROR',
            'propagate': True
        },
    }
}
```

**说明：**
1. formatters：配置打印日志格式
2. handler：用来定义具体处理日志的方式，可以定义多种，"default"就是默认方式，"console"就是打印到控制台方式。
3. loggers:用来配置用那种handlers来处理日志，比如你同时需要输出日志到文件、控制台。


**注意：**
1. loggers类型为"django"这将处理所有类型日志。
2. sourceDns.webdns.views 应用的py文件


## 日和记录日志
看代码例子：
```python
import logging

logger = logging.getLogger("console")

def index(request):
    logger.debug("hello")
```

注意：`getLogger`使用的这个名字就是我们上面定义好的`loggers`里面的日志记录器。


接下来对一些参数进行介绍和说明


## 日志记录级别 `Level`
logging模块的重点在于生成和处理日志消息。每条消息由一些文本和指示其严重性的相关级别组成。级别包含符号名称和数字值。

|   级别   | 值  |     描述      |
| -------- | --- | ------------- |
| CRITICAL | 50  | 关键错误/消息 |
| ERROR    | 40  | 错误          |
| WARNING  | 30  | 警告消息      |
| INFO     | 20  | 通知消息      |
| DEBUG    | 10  | 调试          |
| NOTSET   | 0   | 无级别        |


## 记录器 `Logger`
记录器负责管理日志消息的默认行为，包括日志记录级别、输出目标位置、消息格式以及其它基本细节。

**关键字参数**：
- filename	将日志消息附加到指定文件名的文件
- filemode	指定用于打开文件模式
- format	用于生成日志消息的格式字符串
- datefmt	用于输出日期和时间的格式字符串
- level	设置记录器的级别
- stream	提供打开的文件，用于把日志消息发送到文件。


## 日志消息格式 `format`
- %(name)s	记录器的名称
- %(levelno)s	数字形式的日志记录级别
- %(levelname)s	日志记录级别的文本名称
- %(filename)s	执行日志记录调用的源文件的文件名称
- %(pathname)s	执行日志记录调用的源文件的路径名称
- %(funcName)s	执行日志记录调用的函数名称
- %(module)s	执行日志记录调用的模块名称
- %(lineno)s	执行日志记录调用的行号
- %(created)s	执行日志记录的时间
- %(asctime)s	日期和时间
- %(msecs)s	毫秒部分
- %(thread)d	线程ID
- %(threadName)s	线程名称
- %(process)d	进程ID
- %(message)s	记录的消息


## 内置处理器 `handler`
logging模块提供了一些处理器，可以通过各种方式处理日志消息。使用addHandler()方法将这些处理器添加给Logger对象。另外还可以为每个处理器配置它自己的筛选和级别。
- handlers.DatagramHandler(host，port):发送日志消息给位于制定host和port上的UDP服务器。
- handlers.FileHandler(filename):将日志消息写入文件filename。
- handlers.HTTPHandler(host, url):使用HTTP的GET或POST方法将日志消息上传到一台HTTP 服务器。
- handlers.RotatingFileHandler(filename):将日志消息写入文件filename。如果文件的大小超出maxBytes制定的值，那么它将被备份为filename1。

由于内置处理器还有很多，如果想更深入了解。可以查看官方手册。

现在大概了解了logging的使用方法，现在可以结合前面的例子使用。
