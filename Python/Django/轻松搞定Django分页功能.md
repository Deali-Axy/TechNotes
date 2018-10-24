## view代码

```python
from django.core.paginator import Paginator

def announcement(request):
    ctx = {
        'global': GlobalCtx,
        'announcements': models.Announcement.objects.all(),
    }

    paginator = Paginator(ctx['announcements'], Config.admin.paginator_limit)  # Config.admin.paginator_limit 每一页显示数量
    ctx['paginator'] = paginator.page(request.GET.get('page', '1'))
    return render(request, 'announcement.html', ctx)
```

## 网页代码

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">

</head>
<body class="container">
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
    <tr class="danger">
        <th>时间</th>
        <th>发布者</th>
        <th>标题</th>
        <th>内容</th>
    </tr>
    </thead>
    <tbody>
    {% if paginator %}
        {% for a in paginator %}
            <tr class="{% cycle 'active' 'success' 'warning' 'info' %}">
                <td>{{ a.publish|date:'Y-m-d H:i:s' }}</td>
                <td>{{ a.username }}</td>
                <td>{{ a.title }}</td>
                <td>{{ a.content }}</td>
            </tr>
        {% endfor %}
    {% else %}
        <tr>
            <td colspan="4">无数据</td>
        </tr>
    {% endif %}
    </tbody>
</table>

<!-- 分页开始 -->
<div>
    <ul class="pagination">
        <li><a href="/console/announcement?page=1">首页</a></li>
        {% if paginator.has_previous %}
            <li><a href="/console/announcement?page={{ paginator.previous_page_number }}">上一页</a></li>
        {% endif %}

        {% for num in paginator.paginator.page_range %}
            <li><a href="/console/announcement?page={{ num }}">{{ num }}</a></li>
        {% endfor %}

        {% if paginator.has_next %}
            <li><a href="/console/announcement?page={{ paginator.next_page_number }}">下一页</a></li>
        {% endif %}
        <li><a href="/console/announcement?page={{ paginator.paginator.num_pages }}">尾页</a></li>
    </ul>
</div>
<!-- 分页结束 -->

</body>
</html>
```

## 效果
![image.png](https://upload-images.jianshu.io/upload_images/8869373-00cd795c0d3dfbc1.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)



## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)
