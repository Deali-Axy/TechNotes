## 前言
没办法，unity桌面实在是太好用了，Ubuntu18.04上安装了unity桌面毕竟不够完美，所以我昨天就降级到Ubuntu16.04，相守一波原生Unity桌面的快感。
一切都OK，不过Python版本有点低，所以要用万能PPA源升级一下。

## 操作
安装Python3.6
```bash
sudo add-apt-repository ppa:jonathonf/python-3.6
sudo apt-get update
sudo apt-get install python3.6
```

Python版本切换：
```
sudo update-alternatives --install /usr/bin/python3 python3 /usr/bin/python3.5 1
sudo update-alternatives --install /usr/bin/python3 python3 /usr/bin/python3.6 2
sudo update-alternatives --config python3
```

验证
```
python3 -V
```

结果：
![](https://upload-images.jianshu.io/upload_images/8869373-02ce0a366d52aa33.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


ok！

## 安装pip3
```bash
curl https://bootstrap.pypa.io/get-pip.py | sudo python3.6
```


## 终端打不开问题
升级到Python3.6之后自带终端打不开了，这时候可以按`Ctrl+Altt+F1`切换到命令行，执行以下命令：
```bash
cd /usr/lib/python3/dist-packages/gi/
sudo cp _gi.cpython-35m-x86_64-linux-gnu.so _gi.cpython-36m-x86_64-linux-gnu.so
sudo cp _gi_cairo.cpython-35m-x86_64-linux-gnu.so _gi_cairo.cpython-36m-x86_64-linux-gnu.so
```
然后再按`Ctrl+Atl+F7`切换回图形界面就可以了～

![](https://upload-images.jianshu.io/upload_images/8869373-4aab691f90fb1da1.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)