## 前言
最近笔者把一个django项目部署到一个新的服务器上，而这个服务器给的是CentOS6版本的系统，官方源很旧，还被运维把源搞坏了，没办法通过源安装Python3.6以及pip，所以只好用最原始的方法，编译安装！

## 注意
如果本机安装了python2，尽量不要管他，使用python3运行python脚本就好，因为可能有程序依赖目前的python2环境，不要动现有的python2环境！
官网下载的Python源码包已经附带了pip工具了，如果安装还是没有的话参照文末的方法手动安装pip！

## 安装依赖环境
### 安装依赖
从代码编译也是需要依赖一些库的，这些都是需要安装的。
```
yum -y install zlib-devel bzip2-devel openssl-devel ncurses-devel sqlite-devel readline-devel tk-devel gdbm-devel db4-devel libpcap-devel xz-devel
```

### 下载Python3.6代码包
访问：[https://www.python.org/downloads/](https://www.python.org/downloads/) 查看你需要的安装的版本，我这里是3.6.
```
wget https://www.python.org/ftp/python/3.6.7/Python-3.6.7.tgz
```

### 创建安装目录
我个人习惯安装在/usr/local/python3（具体安装位置看个人喜好）
创建目录：
```
 mkdir -p /usr/local/python3
```

### 解压代码
解压下载好的Python-3.x.x.tgz包
>具体包名因你下载的Python具体版本不不同⽽而不不同，如：我下载的是Python3.6.7.那我这里就是Python-3.6.7.tgz
```
tar -zxvf Python-3.6.7.tgz
```

### 编译代码
进入解压后的目录，编译安装。
```
cd Python-3.6.7
./configure --prefix=/usr/local/python3
make
make install
```

### 建立`python3`的软链接
```
ln -s /usr/local/python3/bin/python3 /usr/bin/python3
```

### 并将`/usr/local/python3/bin`加入PATH
编辑 `.bash_profile` 文件
```
nano ~/.bash_profile
```
修改内容：
```
# Get the aliases and functions
if [ -f ~/.bashrc ]; then
. ~/.bashrc
fi
# User specific environment and startup programs
PATH=$PATH:$HOME/bin:/usr/local/python3/bin
export PATH
```
修改完记得执行行下面的命令，让上一步的修改生效：
```
source ~/.bash_profile
```
检查Python3及pip3是否正常可用：
```
python3 -V
pip3 -V
```

pip访问不到的话在再建一下pip3的软链接
```
ln -s /usr/local/python3/bin/pip3 /usr/bin/pip3
```

## 手动安装pip以及setuptools
### 安装pip前需要前置安装setuptools
具体下载的版本请自行到官网复制最新版的下载链接。
```
wget --no-check-certificate  https://pypi.python.org/packages/source/s/setuptools/setuptools-19.6.tar.gz#md5=c607dd118eae682c44ed146367a17e26
tar -zxvf setuptools-19.6.tar.gz
cd setuptools-19.6
python3 setup.py build
python3 setup.py install
```
如果前面没配置好环境的话，就要苦逼一下了：
报错： RuntimeError: Compression requires the (missing) zlib module
我们需要在linux中安装`zlib-devel`包，进行支持。
```
yum install zlib-devel
```
需要对python3.6进行重新编译安装。
```
cd python3.6.7
make && make install
```
又是漫长的编译安装过程。

重新安装`setuptools`:
```
python3 setup.py build
python3 setup.py install
```

### 安装pip
具体下载链接以及版本以官网上提供的为准。
```
wget --no-check-certificate  https://pypi.python.org/packages/source/p/pip/pip-8.0.2.tar.gz#md5=3a73c4188f8dbad6a1e6f6d44d117eeb
tar -zxvf pip-8.0.2.tar.gz
cd pip-8.0.2
python3 setup.py build
python3 setup.py install
```

如果遇到这个错误：
```
pip is configured with locations that require TLS/SSL, however the ssl module in Python is not available.
```

需要安装依赖：
```
yum install openssl
yum install openssl-devel
```
然后重新编译Python3.6
```
cd python3.6.7
make && make install
```

## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)