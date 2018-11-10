## 环境准备
nginx+uwsgi方式部署顾名思义，需要nginx和uwsgi两个软件包。

nginx不用说，是必备的，关于nginx的安装本文不再赘述，详情可以自行搜索或者参考我以前的文章：
[Debian8搭建LEMP环境](http://blog.deali.cn/33.html)

### 安装uwsgi
```bash
pip install uwsgi
```

### 上传项目代码 & 测试
```bash
# 进入项目目录，具体目录请自行选择
cd /path/to/project

# 建立虚拟环境
virtualenv venv

# 激活虚拟环境
source venv/bin/activate

# 安装依赖
pip install -r requirement.txt

# 开启测试服务器
python manage.py runserver 0.0.0.0:8001
```

## 配置uwsgi
uwsgi支持多种格式的配置文件，本文选择ini格式。

在项目目录中创建`uwsgi.ini`文件，内容如下：

```ini
[uwsgi]
# Django-related settings

socket = :8001

# Virtualenv
home            = /var/www/html/_project/ClassHelperWxApp/venv

# the base directory (full path)
chdir           = /var/www/html/_project/ClassHelperWxApp

# Django s wsgi file
module          = Config.wsgi

# process-related settings
# master
master          = true

# maximum number of worker processes
processes       = 4

# ... with appropriate permissions - may be needed
# chmod-socket    = 664
# clear environment on exit
vacuum          = true
```

### 开启uwsgi测试
```bash
# 进入项目目录
cd /path/to/project

# 开启uwsgi服务器
uwsgi -s --ini uwsgi.ini
```

这个时候还不能访问，因为服务器设置成socket模式，如果想先访问一下试试看，可以把ini配置文件里面的socket改成http，即可访问项目网站，不过静态文件暂时访问不了。


## nginx配置反向代理
在`/etc/nginx/sites-available`目录中新建一个配置文件。
例如：`domain.com.conf`，配置代码如下

附赠了https的配置，如果不需要的话把ssl相关的配置行删除即可。
```nginx
server {
    # the port your site will be served on
    listen 80;
    listen 443 ssl;

    # the domain name it will serve for
    server_name domain.com; # substitute your machine's IP address or FQDN
    charset     utf-8;

    ssl on;
    #证书文件
    ssl_certificate /path/to/keys/1_domain.com_bundle.crt;
    #私钥文件
    ssl_certificate_key /path/to/keys/2_domain.com.key;
    ssl_protocols       TLSv1 TLSv1.1 TLSv1.2;
    ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:ECDHE:ECDH:AES:HIGH:!NULL:!aNULL:!MD5:!ADH:!RC4;
    ssl_prefer_server_ciphers on;


    # max upload size
    client_max_body_size 75M;   # adjust to taste

    # Django media
    location /media  {
        alias /path/to/project/media;  # your Django project's media files - amend as required
    }

    location /static {
        alias /path/to/project/static; # your Django project's static files - amend as required
    }

    # Finally, send all non-media requests to the Django server.
    location / {
        include     uwsgi_params; # the uwsgi_params file you installed
        uwsgi_pass 127.0.0.1:8001;
    }
}
```

然后使用`ln -s`创建一个到`sites-enabled`的软链接，重新加载nginx即可。
```bash
service nginx reload
```

![image.png](https://upload-images.jianshu.io/upload_images/8869373-0322e6a5ce607bbb.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)
