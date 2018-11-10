## 前言
最近笔者把一个django项目部署到一个新的服务器上，而这个服务器给的是CentOS6版本的系统，官方源很旧，yum管理器被运维搞坏了，没办法加载epel源，所以想要用nginx就只能自己编译安装咯～


## 下载nginx代码
首先到Nginx的官网下载安装文件。
链接：http://nginx.org/
我用的版本是：nginx-1.12.1.tar.gz


## 安装编译所需环境
### 安装gcc
安装 nginx 需要先将官网下载的源码进行编译，编译依赖 gcc 环境，如果没有 gcc 环境，则需要安装：
```
yum install gcc-c++
```

### 安装PCRE pcre-devel
PCRE(Perl Compatible Regular Expressions) 是一个Perl库，包括 perl 兼容的正则表达式库。nginx 的 http 模块使用 pcre 来解析正则表达式，所以需要在 linux 上安装 pcre 库，pcre-devel 是使用 pcre 开发的一个二次开发库。nginx也需要此库。命令：
```
yum install -y pcre pcre-devel
```

### 安装zlib
zlib 库提供了很多种压缩和解压缩的方式， nginx 使用 zlib 对 http 包的内容进行 gzip ，所以需要在 Centos 上安装 zlib 库。
```
yum install -y zlib zlib-devel
```

### 安装OpenSSL
OpenSSL 是一个强大的安全套接字层密码库，囊括主要的密码算法、常用的密钥和证书封装管理功能及 SSL 协议，并提供丰富的应用程序供测试或其它目的使用。
nginx 不仅支持 http 协议，还支持 https（即在ssl协议上传输http），所以需要在 Centos 安装 OpenSSL 库。
```
yum install -y openssl openssl-devel
```

安装完成以上四项之后才可以执行安装Nginx。

## 安装nginx
### 解压
```
tar zxvf nginx-1.12.1.tar.gz
```

### 编译
```
cd nginx-1.12.1
./configure
make
make install
```

执行完以上命令之后就完成Nginx的安装，但解压目录并不是安装目录，以下通过下面的命令进行查找安装目录，本机执行完成安装目录为：`/usr/local/nginx`
```
whereis nginx
```

### 启动与停止nginx
启动、停止nginx必须进入安装目录的sbin目录中执行，也可以外面执行，但需要写全目录

```
# 启动
/usr/local/nginx/sbin/nginx

# 停止
# 下面命令当于先查出nginx进程id再使用kill命令强制杀掉进程。
/usr/local/nginx/sbin/nginx -s stop
# 下面命令待nginx进程处理任务完毕进行停止
/usr/local/nginx/sbin/nginx -s quit
```

### 重新加载配置文件
重新加载配置文件，当 ngin x的配置文件 nginx.conf 修改后，要想让配置生效需要重启 nginx，使用-s reload不用先停止 ngin x再启动 nginx 即可将配置信息在 nginx 中生效
```
/usr/local/nginx/sbin/nginx -s reload
```

推荐的重启nginx顺序：对 nginx 进行重启相当于先停止再启动，即先执行停止命令再执行启动命令。
```
/usr/local/nginx/sbin/nginx -s quit
/usr/local/nginx/sbin/nginx
```

>PS：推荐把`/usr/local/nginx/sbin/`加入到环境变量里面，这样使用nginx的时候就不用输入整个目录了。

## 设置开机自启动
编辑：`/etc/rc.local`
增加一行：`/usr/local/nginx/sbin/nginx`

设置执行权限：
```
chmod 755 rc.local
```


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)