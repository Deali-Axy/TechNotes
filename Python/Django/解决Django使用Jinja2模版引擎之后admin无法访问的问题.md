## 需要两个文件

创建`backends.py`文件：
```python
import sys

from django.template.backends import jinja2 as jinja2backend
from django.template.backends.utils import csrf_input_lazy, csrf_token_lazy
from django.template import TemplateDoesNotExist, TemplateSyntaxError
from django.utils.module_loading import import_string
import jinja2
import six


class Jinja2Backend(jinja2backend.Jinja2):
    def __init__(self, params):
        self.context_processors = [
            import_string(p)
            for p in params['OPTIONS'].pop('context_processors', [])
        ]
        super(Jinja2Backend, self).__init__(params)

    def from_string(self, template_code):
        return Template(
            self.env.from_string(template_code), self.context_processors)

    def get_template(self, template_name):
        try:
            return Template(
                self.env.get_template(template_name), self.context_processors)
        except jinja2.TemplateNotFound as exc:
            six.reraise(TemplateDoesNotExist, TemplateDoesNotExist(exc.args),
                        sys.exc_info()[2])
        except jinja2.TemplateSyntaxError as exc:
            six.reraise(TemplateSyntaxError, TemplateSyntaxError(exc.args),
                        sys.exc_info()[2])


class Template(jinja2backend.Template):

    def __init__(self, template, context_processors):
        self.template = template
        self.context_processors = context_processors

    def render(self, context=None, request=None):
        if context is None:
            context = {}
        if request is not None:
            context['request'] = request
            lazy_csrf_input = csrf_input_lazy(request)
            context['csrf'] = lambda: lazy_csrf_input
            context['csrf_input'] = lazy_csrf_input
            context['csrf_token'] = csrf_token_lazy(request)
            for cp in self.context_processors:
                context.update(cp(request))
            # print(context)
        return self.template.render(context)
```

`env.py`文件
```python
from __future__ import absolute_import

from django.contrib.staticfiles.storage import staticfiles_storage
from django.urls import reverse

from jinja2 import Environment


def environment(**options):
    env = Environment(**options)
    env.globals.update({
        'static': staticfiles_storage.url,
        'url': reverse,
    })
    return env
```

## 项目配置

编辑`settings.py`

```python
CONTEXT_PROCESSORS = [
    'django.template.context_processors.debug',
    'django.template.context_processors.request',
    'django.contrib.auth.context_processors.auth',
    'django.contrib.messages.context_processors.messages',
]

TEMPLATES = [
    {
        'BACKEND': 'django.template.backends.django.DjangoTemplates',
        'DIRS': [],
        'APP_DIRS': True,
        'OPTIONS': {'context_processors': CONTEXT_PROCESSORS, },
    },
    {
        'BACKEND': 'django.template.backends.jinja2.Jinja2'
        ,
        'DIRS': [
            os.path.join(BASE_DIR, 'templates'),
        ],
        'APP_DIRS': True,
        'OPTIONS': {'context_processors': CONTEXT_PROCESSORS, },
    },
]
```

![image.png](https://upload-images.jianshu.io/upload_images/8869373-692154a6116f08a9.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)