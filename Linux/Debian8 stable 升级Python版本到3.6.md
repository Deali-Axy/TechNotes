## 前言
最近把一个Python项目部署到服务器上，然而服务器上的Python版本实在是太旧了，于是着手进行更新。

互联网上搜索到的方法都是下载Python3.6的代码之后手动编译，然而在服务器上编译安装出了点问题，于是想到了Ubuntu的ppa方式，debian和Ubuntu本属同源，理论上Ubuntu的ppa，debian也是可以用的。

操作步骤如下：

## 添加软件源
```bash
add-apt-repository ppa:deadsnakes/ppa
```
然而debian上并没有这个`add-apt-repository`，所以需要先安装一波。

```bash
apt-get install software-properties-common
```
安装完这个就可以使用上面的命令添加ppa源了。

到这里别着急，因为ppa源本来是Ubuntu用的，debian用起来总是需要做一点小修改的。

打开ppa网站：https://launchpad.net/~jonathonf/+archive/ubuntu/python-3.6

选择Ubuntu版本 14.04
![image.png](https://upload-images.jianshu.io/upload_images/8869373-1775d68b0c1bdcac.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

把这两行代码复制下来。

然后打开软件源的目录
```bash
cd /etc/apt/sources.list.d
```
可以看到里面有这个文件
```bash
-rw-r--r-- 1 root root 290 Jun 19 00:26 jonathonf-python-3_6-jessie.list
```
编辑之：
```bash
deb http://ppa.launchpad.net/jonathonf/python-3.6/ubuntu jessie main
# deb-src http://ppa.launchpad.net/jonathonf/python-3.6/ubuntu jessie main
```
将原来的内容替换成刚才复制下来的内容，保存。


## 更新软件源 & 安装
```bash
apt update
apt install python3.6
```

### 安装对应版本的pip
```bash
su
curl https://bootstrap.pypa.io/get-pip.py | python3.6
(pip -V && pip3 -V && pip3.6 -V) | uniq

# 查看版本
python3.6 -m pip -V
```

## 创建软链接
```bash
cd /usr/bin
rm python3
ln -s python3.6 python3
```

这样就完成了！


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)