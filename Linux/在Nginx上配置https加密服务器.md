## 前言
最近开发微信小程序需要使用Https，于是折腾了一番。

## 超简单步骤
### 1. 申请SSL证书
一般云服务器提供商就会提供这种服务，我在腾讯云上申请了，十分钟就完成了。  

### 2. 上传证书
上传到一个文件夹里面

### 3. 配置nginx
网络上的资料都是直接修改 `/etc/nginx/nginx.conf` 这个文件。
不过我的服务器上这个文件里头没有 `server` 这个节点可以配置。
因此需要修改 `/etc/nginx/sites-available` 里头的虚拟站点配置文件。

基础配置：
在原有虚拟站点的基础上添加这部分配置就可以了
```nginx
server {
    #ssl参数
    listen              443 ssl;
    server_name         example.com;
    #证书文件
    ssl_certificate     /path/to/example.com.crt;
    #私钥文件
    ssl_certificate_key /path/to/example.com.key;
    ssl_protocols       TLSv1 TLSv1.1 TLSv1.2;
    ssl_ciphers         HIGH:!aNULL:!MD5;
    #...
}
```

## 参考资料
https://aotu.io/notes/2016/08/16/nginx-https/index.html
https://blog.csdn.net/duyusean/article/details/79348613

![image.png](https://upload-images.jianshu.io/upload_images/8869373-443aa770dd78bd67.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)