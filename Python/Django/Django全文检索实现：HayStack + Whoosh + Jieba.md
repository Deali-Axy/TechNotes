## 涉及到的工具
*   [haystack](http://django-haystack.readthedocs.org/)是django的开源搜索框架，该框架支持**[Solr](http://django-haystack.readthedocs.org/en/v2.4.1/tutorial.html#solr)**, **Elasticsearch**, **Whoosh**, ***Xapian*搜索引擎，不用更改代码，直接切换引擎，减少代码量。

*   搜索引擎使用[Whoosh](https://whoosh.readthedocs.org/en/latest/)，这是一个由纯Python实现的全文搜索引擎，没有二进制文件等，比较小巧，配置比较简单，当然性能自然略低。

*   中文分词[Jieba](https://github.com/fxsjy/jieba)，由于**Whoosh**自带的是英文分词，对中文的分词支持不是太好，故用**jieba**替换**whoosh**的分词组件。


## Model配置
```python
class Post(models.Model):
    """post 文章页面"""
    id = models.AutoField(primary_key=True, max_length=20)
    name = models.CharField(max_length=200, help_text="Post文章的URL链接名称")
    post_category = models.ForeignKey(PostCategory, blank=True, null=True, default=None, on_delete=models.SET_NULL)
    post_author = models.ForeignKey(PostAuthor, blank=True, null=True, default=None, on_delete=models.SET_NULL)
    post_date = models.DateTimeField(default=timezone.now, help_text="创建日期")
    post_modified = models.DateTimeField(default=timezone.now, help_text="修改日期")
    post_content = models.TextField(help_text="html格式的页面内容，仅在page类型才可用")
    post_title = models.CharField(max_length=200)
    post_summary = models.TextField(max_length=300, blank=True)
    post_status = models.CharField(choices=(('publish', '已发布'), ('draft', '草稿')), default='publish', max_length=20,
                                   help_text="页面状态")

    # post_slug = models.CharField(max_length=200, help_text="URL链接名称")

    def __str__(self):
        return self.post_title
```

## 安装Python模块
- whoosh
- django-haystack 
- jieba

## 修改 whoosh 的分析器
将文件`whoosh_backend.py`（该文件路径为`python路径/lib/python版本/site-packages/haystack/backends/whoosh_backend.py`）拷贝到app文件夹下面，修改如下
添加`from jieba.analyse import ChineseAnalyzer`

修改为如下
```python
schema_fields[field_class.index_fieldname] =
    TEXT(stored=True, analyzer=ChineseAnalyzer(),
            field_boost=field_class.boost)
```


## 修改settings.py
- 添加 Haystack 到Django的 INSTALLED_APPS

```python
HAYSTACK_CONNECTIONS = {
    'default': {
        'ENGINE': 'Core.whoosh_backend.WhooshEngine',
        'PATH': os.path.join(BASE_DIR, 'Resources', 'index', 'whoosh'),
    },
}
```

注：
- `Core` 是我的App名称，请根据情况替换成你自己的App文件夹名称
- `PATH`为存放Whoosh索引文件的文件夹。
- 其他引擎的配置请查阅官方文档。



## 建立索引
在需要搜索功能的App文件夹下建立`search_indexes.py`文件，用于创建索引。

内容如下：
```python
import datetime
from haystack import indexes
from Core import models


class PostIndex(indexes.SearchIndex, indexes.Indexable):
    text = indexes.CharField(document=True, use_template=True)

    post_author = indexes.CharField(model_attr='post_author')
    post_date = indexes.DateTimeField(model_attr='post_date')

    def get_model(self):
        return models.Post

    def index_queryset(self, using=None):
        """Used when the entire index for model is updated."""
        return self.get_model().objects.filter(post_date__lte=datetime.datetime.now())
```

每个索引里面必须有且只能有一个字段为document=True，这代表haystack 和搜索引擎将使用此字段的内容作为索引进行检索(primary field)。其他的字段只是附属的属性，方便调用，并不作为检索数据。

>注意：如果使用一个字段设置了document=True，则一般约定此字段名为text，这是在SearchIndex类里面一贯的命名，以防止后台混乱，当然名字你也可以随便改，不过不建议改。

并且，haystack提供了use_template=True在text字段，这样就允许我们使用数据模板去建立搜索引擎索引的文件，使用方便（官方推荐，当然还有其他复杂的建立索引文件的方式，目前我还不知道），数据模板的路径为`yourapp/templates/search/indexes/yourapp/classname_text.txt`，例如本例子为`Resources/templates/search/indexes/Core/post_text.txt`
文件名必须为要索引的`类名_text.txt`,其内容为：

```django
{{ object.post_title }}
{{ object.post_author }}
{{ object.post_content }}
{{ object.post_summary }}
```

这个数据模板的作用是对
- Post.post_title
- Post.post_author
- Post.post_content
- Post.post_summary

这四个字段建立索引，当检索的时候会对这三个字段做全文检索匹配。


## 配置URL
在链接配置中加入
```python
    path('search/', include('haystack.urls')),
```

## 编写search.html
在 `templates/search/` 文件夹下添加 `search.html` 文件：
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2>Search</h2>

<form method="get" action=".">
    <table>
        {{ form.as_table }}
        <tr>
            <td> </td>
            <td>
                <input type="submit" value="Search">
            </td>
        </tr>
    </table>

    {% if query %}
        <h3>Results</h3>

        {% for result in page.object_list %}
            <p>
                <a href="{{ result.object.get_absolute_url }}">{{ result.object.post_title }}</a>
            </p>
        {% empty %}
            <p>No results found.</p>
        {% endfor %}

        {% if page.has_previous or page.has_next %}
            <div>
                {% if page.has_previous %}<a href="?q={{ query }}&page={{ page.previous_page_number }}">{% endif %}«
                Previous{% if page.has_previous %}</a>{% endif %}
                |
                {% if page.has_next %}<a href="?q={{ query }}&page={{ page.next_page_number }}">{% endif %}Next »
                {% if page.has_next %}</a>{% endif %}
            </div>
        {% endif %}
    {% else %}
        {# Show some example queries to run, maybe query syntax, something else? #}
    {% endif %}
</form>
</body>
</html>
```

## 建立索引
使用`python manage.py rebuild_index`或者使用`update_index`命令。

在 settings.py 里加入以下配置，实现自动刷新索引。
```python
HAYSTACK_SIGNAL_PROCESSOR = "haystack.signals.RealtimeSignalProcessor"
```

这样就OK啦，可以打开 `网站/search` 试试看搜索功能了～


## SearchQuerySet 初窥
我发现网络上的资料都没有介绍到，于是在官网翻看了一下。
文档地址：https://django-haystack.readthedocs.io/en/v2.8.1/searchqueryset_api.html#ref-searchqueryset-api

这个 `SearchQuerySet` 类似于DjangoORM框架里的 `QuerySet`，熟悉Django的同学应该很快能上手，不过做结果处理的话会比较麻烦。
用到SearchQuerySet一般都是用于Ajax API，我发现之前用于 QuerySet 的序列化器不能用于 SearchQuerySet，要做的话还需要做一些修改。
这个等有时间再继续改。或者我再看看官网文档，研究一下。

用法挺简单的，看一下官方文档就行，已经写得很清楚了～


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)