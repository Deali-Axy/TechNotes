## Whoosh介绍

>Whoosh is a library of classes and functions for indexing text and then searching the index. It allows you to develop custom search engines for your content. For example, if you were creating blogging software, you could use Whoosh to add a search function to allow users to search blog entries.

Whoosh是一个由python实现的全文检索引擎，设计上参照了`Lucene`，配置和使用都比较方便，不过性能就不是很理想了，不过用在小型网站或者是测试场景下还是可以滴~

本文介绍一下whoosh最基本的安装和使用方法，欲了解详情，请访问官方网站哈~

官方文档：https://whoosh.readthedocs.io/en/latest/quickstart.html

## Whoosh安装

### 直接使用pip安装即可：

```  
pip install whoosh
```

### 也可以从源码安装：

详情见项目主页：https://pypi.python.org/pypi/Whoosh/

## 快速入门

看一下官方的快速入门例子：

```bash
>>> from whoosh.index import create_in
>>> from whoosh.fields import *
>>> schema = Schema(title=TEXT(stored=True), path=ID(stored=True), content=TEXT)
>>> ix = create_in("indexdir", schema)
>>> writer = ix.writer()
>>> writer.add_document(title=u"First document", path=u"/a",
...                     content=u"This is the first document we've added!")
>>> writer.add_document(title=u"Second document", path=u"/b",
...                     content=u"The second one is even more interesting!")
>>> writer.commit()
>>> from whoosh.qparser import QueryParser
>>> with ix.searcher() as searcher:
...     query = QueryParser("content", ix.schema).parse("first")
...     results = searcher.search(query)
...     results[0]
...
{"title": u"First document", "path": u"/a"}
```

## 建立索引和模式对象

### 定义索引模式

首先要定义索引模式，以字段的形式列在索引中：

```python
from whoosh.fields import *
schema = Schema(title=TEXT, path=ID, content=TEXT)
```

其中，`title`、`path`、`content`就是字段(field)、每个字段对应索引查找目标文件的一部分信息，上面的代码就是定义索引的模式——索引内容包括`title`、`path`、`content`这三个字段，一个字段建立了索引就能被搜索到，也能被存储。

下面的代码和上面的代码是等价的：

```python
schema = Schema(title=TEXT(stored=True), path=ID(stored=True), content=TEXT)
```

在字段后面添加了参数(stored=True)，意味着将返回该字段的搜索结果。

这样就把索引模式建立好了，只要建立一次就好了，不用重复建立，索引模式一旦建立就会随索引保存。

### 定义索引模式对象

索引模式对象就是一个继承自`SchemaClass`的类，例子如下：

```python
from whoosh.fields import SchemaClass, TEXT, KEYWORD, ID, STORED

class TestSchema(SchemaClass):
    path = ID(stored=True)
    title = TEXT(stored=True)
    content = TEXT
    tags = KEYWORD
```

### 索引字段类型

在上面的例子中，`title = TEXT(stored=True)`，`title`是字段名称，`TEXT`是字段类型。

whoosh有下面这些字段类型，可以在建立索引模式的时候用：

- whoosh.fields.ID：仅能为一个单元值，即不能分割为若干个词，通常用于诸如文件路径，URL，日期，分类。
- whoosh.fields.STORED：该字段随文件保存，但是不能被索引，也不能被查询。常用于显示文件信息。
- whoosh.fields.KEYWORD：用空格或者逗号（半角）分割的关键词，可被索引和搜索。为了节省空间，不支持词汇搜索。
- whoosh.fields.TEXT：文件的文本内容。建立文本的索引并存储，支持词汇搜索。
- whoosh.fields.NUMERIC：数字类型，保存整数或浮点数。
- whoosh.fields.BOOLEAN：布尔类值
- whoosh.fields.DATETIME：时间对象类型

### 官方文档

https://pythonhosted.org/Whoosh/schema.html

### 选择索引存储目录

建立好索引模式之后，要选择一个文件夹来保存搜索引擎建立的索引数据。代码如下：

```python
import os.path
from whoosh.index import create_in
from whoosh.index import open_dir

schema = fields.Schema(title=TEXT(stored=True), path=ID(stored=True), content=TEXT)

if not os.path.exists('index_data'):     #如果目录 index_data 不存在则创建
    os.mkdir('index_data') 
ix = create_in("index_data",schema)      #按照之前创建的schema模式建立索引目录
ix = open_dir("index_data")　            #打开该目录一遍存储索引文件
```

上例中，用`create_in`创建一个具有前述索引模式的索引存储目录对象，所有的索引将被保存在该目录`index_data`中。

之后，用`open_dir`打开这个目录。

## 保存索引数据

代码如下：

```python
writer = ix.writer()
writer.add_document(title=u"my document", content=u"this is my document", path=u"/a", tags=u"firlst short")
writer.add_document(title=u"my second document", content=u"this is my second document", path=u"/b", tags=u"second short")
writer.commit()
```

### 注意事项

- 字段的值必须是unicode
- 不是每个字段都必须赋值

### 官方文档

https://pythonhosted.org/Whoosh/indexing.html

## 开始搜索

- 建立搜索对象

```python
searcher = ix.searcher()
```

- 搜索完了要记得关闭

```python
searcher.close()
```

- 推荐用下面这种写法

```python
withe ix.searcher() as searcher:
    (do somthing)
```

或者

```python
try:
    searcher = ix.searcher()
    (do somthing)
finally:
    searcher.close()
```

- 开始搜索

以搜索content为例子

```python
from whoosh.qparser import QueryParser
with ix.searcher() as searcher:
    query = QueryParser("content",ix.schema).parse("second")
    result = searcher.search(query)
    results[0]
```

返回结果：

```json
{"title":u"my second document","path":u"/a"}
```

## 写在后面

到这里基本就ok啦，但是whoosh，或者说是全文检索引擎的使用和原理还远远不止这些，我会在后面的博客中介绍从零开始编写一个搜索引擎的方法，有兴趣的同学可以继续关注，一起学习哈~

本文的结构和部分内容参考了**老齐**老师的博客，在此表示感谢~

## 欢迎与我交流
- 打代码直播间：[https://live.bilibili.com/11883038](https://live.bilibili.com/11883038)
- 微信公众号：DealiAxy
- 知乎：[https://www.zhihu.com/people/dealiaxy](https://www.zhihu.com/people/dealiaxy)
- 博客：[https://blog.deali.cn](https://blog.deali.cn)
- 简书：[https://www.jianshu.com/u/965b95853b9f](https://www.jianshu.com/u/965b95853b9f)