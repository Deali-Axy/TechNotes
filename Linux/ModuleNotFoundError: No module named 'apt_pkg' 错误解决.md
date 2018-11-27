## 前言
今天在安装docker的时候遇到这个问题了，通过搜索解决方案解决了，所以记录一下。
猜测原因应该是今天升级了系统的Python版本，然后`python3`的软链接也被我改成指向最新版本了。


## 解决方法
```
sudo apt-get remove --purge python-apt
sudo apt-get install python-apt -f 
cd /usr/lib/python3/dist-packages/ 
sudo cp apt_pkg.cpython-3?m-x86_64-linux-gnu.so apt_pkg.cpython-36m-x86_64-linux-gnu.so 
```

## 参考资料
https://blog.csdn.net/u013427969/article/details/80011355