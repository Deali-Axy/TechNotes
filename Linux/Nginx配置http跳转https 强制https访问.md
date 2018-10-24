## 前言
最近上线了好几个项目，同时也申请了相应的SSL证书，不过发现了一个问题，用户在浏览器直接输入域名的时候，浏览器默认访问的是http站点，然而我们的网站只支持https访问，所以就访问不了咯。
其实可以在nginx全局配置里面把所有访问重定向到https，不过服务器有些站点是提供http服务的，所以只能每个站点分别配置。
根据搜索引擎找到的资料，本文总结了三种配置方法，有需要的朋友可以选择中意的使用。

## nginx的rewrite方法
### 说明
这应该是大家最容易想到的方法，将所有的http请求通过rewrite重写到https上即可。

### 配置
```nginx
server {
	listen	192.168.1.111:80;
	server_name	test.com;
	
	rewrite ^(.*)$	https://$host$1	permanent;
}
```
搭建此虚拟主机完成后，就可以将http://test.com的请求全部重写到https://test.com上了


## nginx的497状态码
### 错误代码497
```
497 - normal request was sent to HTTPS
```

解释：当此虚拟站点只允许https访问时，当用http访问时nginx会报出497错误码

### 说明
利用error_page命令将497状态码的链接重定向到https://test.com这个域名上

### 配置
```nginx
server {
	listen       192.168.1.11:443;	#ssl端口
	listen       192.168.1.11:80;	#用户习惯用http访问，加上80，后面通过497状态码让它自动跳到443端口
	server_name  test.com;
	#为一个server{......}开启ssl支持
	ssl                  on;
	#指定PEM格式的证书文件 
	ssl_certificate      /etc/nginx/test.pem; 
	#指定PEM格式的私钥文件
	ssl_certificate_key  /etc/nginx/test.key;
	
	#让http请求重定向到https请求	
	error_page 497	https://$host$uri?$args;
}
```

## index.html 刷新法
### 说明
上述两种方法都需要服务器做计算处理，均会耗费服务器的资源。网页刷新法是从百度那里学来的。
我们用curl访问baidu.com试一下，看百度的公司是如何实现baidu.com向www.baidu.com的跳转。

![image.png](https://upload-images.jianshu.io/upload_images/8869373-9aac5696234bbbf0.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

可以看到百度很巧妙的利用meta的刷新作用，将baidu.com跳转到www.baidu.com.因此我们可以基于http://test.com的虚拟主机路径下也写一个index.html，内容就是http向https的跳转

### index.html网页内容
```html
<html>
<meta http-equiv="refresh" content="0;url=https://test.com/">
</html>
```

### 站点配置
在服务器的配置里添加一个http站点配置用来提供刚才那个 `index.html` 的访问服务
```nginx
server {
	listen 80;
	server_name	test.com;
	
	location / {
                #index.html放在虚拟主机监听的根目录下
		root /srv/www/http.test.com/;
	}
        #将404的页面重定向到https的首页
	error_page	404	https://test.com/;
}
```

## 参考资料
https://blog.csdn.net/wzy_1988/article/details/8549290


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)
