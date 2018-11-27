## 安装相关包

```
$ sudo apt-get update # 先更新一下软件源库信息

$ sudo apt-get install \
    apt-transport-https \
    ca-certificates \
    curl \
    software-properties-common
```

## 添加软件仓库
#### 官方仓库
```
# 添加 Docker 官方的 GPG 密钥（为了确认所下载软件包的合法性，需要添加软件源的 GPG 密钥）
$ curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -

# 设置稳定版本的apt仓库地址
$ sudo add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
   $(lsb_release -cs) \
   stable"
```

#### 阿里云仓库
```
$ curl -fsSL https://mirrors.aliyun.com/docker-ce/linux/ubuntu/gpg | sudo apt-key add -

$ sudo add-apt-repository \
     "deb [arch=amd64] https://mirrors.aliyun.com/docker-ce/linux/ubuntu \
     $(lsb_release -cs) \
     stable"
```


## 安装docker
```
$ sudo apt-get update
$ sudo apt-get install docker-ce # 安装最新版的docker
```

如果需要安装指定版本的，使用以下命令：
```
$ apt-cache policy docker-ce # 查看可供安装的所有docker版本
$ sudo apt-get install docker-ce=18.03.0~ce-0~ubuntu # 安装指定版本的docker
``
# 检查docker是否安装成功
$ docker --version # 查看安装的docker版本
```

## 添加访问权限
这个时候运行docker的话，如果不是root用户会报错：
```bash
Got permission denied while trying to connect to the Docker daemon socket at unix:///var/run/docker.sock: Get http://%2Fvar%2Frun%2Fdocker.sock/v1.26/images/json: dial unix /var/run/docker.sock: connect: permission denied
```

看一下权限
```bash
$ cd /var/run
$ ll | grep docker
# 输出如下
drwx------  8 root  root    180 11月 21 16:36 docker
-rw-r--r--  1 root  root      5 11月 21 16:35 docker.pid
srw-rw----  1 root  docker    0 11月 21 16:35 docker.sock
```

可以看到 `docker.sock` 的所有者是 `docker` 这个组。所以我们要把当前用户添加到这个组里。

```bash
$ sudo gpasswd -a ${USER} docker
```

重启docker
```bash
sudo service docker restart
```

切换当前会话到新 group 或者重启 X 会话
```bash
newgrp - docker
```
>注意:最后一步是必须的，否则因为 groups 命令获取到的是缓存的组信息，刚添加的组信息未能生效，所以 docker images 执行时同样有错。

## 运行docker测试
这个时候就可以运行helloworld测试啦～

```
$ docker run hello-world

Hello from Docker!
This message shows that your installation appears to be working correctly.

To generate this message, Docker took the following steps:
 1. The Docker client contacted the Docker daemon.
 2. The Docker daemon pulled the "hello-world" image from the Docker Hub.
    (amd64)
 3. The Docker daemon created a new container from that image which runs the
    executable that produces the output you are currently reading.
 4. The Docker daemon streamed that output to the Docker client, which sent it
    to your terminal.

To try something more ambitious, you can run an Ubuntu container with:
 $ docker run -it ubuntu bash

Share images, automate workflows, and more with a free Docker ID:
 https://hub.docker.com/

For more examples and ideas, visit:
 https://docs.docker.com/get-started/
```
到这里就安装完成了～

## 参考资料
https://docs.docker.com/get-started/#test-docker-version
https://www.jianshu.com/p/a12558da034e
https://www.jianshu.com/p/95e397570896


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)