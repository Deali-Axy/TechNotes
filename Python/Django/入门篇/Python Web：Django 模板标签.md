## if/else 标签
基本语法格式如下：

```html
{% if condition %}
     ... display
{% endif %}
```

或者：

```html
{% if condition1 %}
   ... display 1
{% elif condition2 %}
   ... display 2
{% else %}
   ... display 3
{% endif %}
```
根据条件判断是否输出。if/else 支持嵌套。

`{% if %} `标签接受 and ， or 或者 not 关键字来对多个变量做判断 ，或者对变量取反（ not )，例如：
```html
{% if athlete_list and coach_list %}
     athletes 和 coaches 变量都是可用的。
{% endif %}
```

## for 标签
`{% for %}` 允许我们在一个序列上迭代。

与Python的 for 语句的情形类似，循环语法是 for X in Y ，Y是要迭代的序列而X是在每一个特定的循环中使用的变量名称。

每一次循环中，模板系统会渲染在` {% for %}` 和`{% endfor %} `之间的所有内容。

例如，给定一个运动员列表 athlete_list 变量，我们可以使用下面的代码来显示这个列表：

```html
<ul>
{% for athlete in athlete_list %}
    <li>{{ athlete.name }}</li>
{% endfor %}
</ul>
```

给标签增加一个` reversed` 使得该列表被反向迭代：

```html
{% for athlete in athlete_list reversed %}
...
{% endfor %}
```

可以嵌套使用` {% for %} `标签：

```html
{% for athlete in athlete_list %}
    <h1>{{ athlete.name }}</h1>
    <ul>
    {% for sport in athlete.sports_played %}
        <li>{{ sport }}</li>
    {% endfor %}
    </ul>
{% endfor %}
```

## ifequal/ifnotequal 标签
`{% ifequal %} `标签比较两个值，当他们相等时，显示在` {% ifequal %} `和 `{% endifequal %} `之中所有的值。

下面的例子比较两个模板变量 `user` 和` currentuser` :

```html
{% ifequal user currentuser %}
    <h1>Welcome!</h1>
{% endifequal %}
```

和` {% if %} `类似， `{% ifequal %} `支持可选的` {% else%}` 标签：

```html
{% ifequal section 'sitenews' %}
    <h1>Site News</h1>
{% else %}
    <h1>No News Here</h1>
{% endifequal %}
```

## 注释标签
Django 注释使用 {# #}。

```html
{# 这是一个注释 #}
```

## 过滤器
模板过滤器可以在变量被显示前修改它，过滤器使用管道字符，如下所示：
```html
{{ name|lower }}
```
`{{ name }}` 变量被过滤器 lower 处理后，文档大写转换文本为小写。

过滤管道可以被* 套接* ，既是说，一个过滤器管道的输出又可以作为下一个管道的输入：

```html
{{ my_list|first|upper }}
```

以上实例将第一个元素并将其转化为大写。

有些过滤器有参数。 过滤器的参数跟随冒号之后并且总是以双引号包含。 例如：

```html
{{ bio|truncatewords:"30" }}
```
这个将显示变量 bio 的前30个词。

其他过滤器：

* **addslashes** : 添加反斜杠到任何反斜杠、单引号或者双引号前面。
* **date** : 按指定的格式字符串参数格式化 date 或者 datetime 对象，实例：
```html
 {{ pub_date|date:"F j, Y" }}
```
* **length** : 返回变量的长度。

## include 标签
`{% include %} `标签允许在模板中包含其它的模板的内容。

下面这个例子都包含了 nav.html 模板：
```python
{% include "nav.html" %}
```


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)