## 前言
之前写了一篇在Win10中安装Linux子系统的文章，虽然Linux子系统既实用又方便，不过有些同学可能会觉得只有命令行挺无聊的，所以今天分享一个运行图形程序的方法，经过试用效果还是不错的。
本文将带领你一步一步在Win10的子系统里安装运行Gimp(*PS：Gimp是Linux上的PS，功能还是灰常强大滴*)，还有其他一些Linux的图形化软件。

## 准备工作
Linux子系统必备的哈，这个不用多说，需要教程的同学可以看看我博客里之前发的文章。
这里我用的是Ubuntu子系统。

然后！还需要一个软件。`Xming`，就叫他小明吧= =。有这个软件才能在Windows上运行Linux的图形程序。

>Xming 是一个在 Microsoft Windows 计算机上运行的开源 X-Windows 终端機仿真器（X 服务器）。Xming 容让 Windows 机器显示在远程 Linux 服务器上执行的图像化 Linux 程序
官网：[sourceforge.net/projects/xming](https://sourceforge.net/projects/xming)。

## 安装XMing
下载完了这玩意长这样：
![图标](http://upload-images.jianshu.io/upload_images/8869373-77c7f7896128e32b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

打开进行安装，一直点下一步就好了。
![安装程序](http://upload-images.jianshu.io/upload_images/8869373-4c7fc427894b9429.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![image.png](http://upload-images.jianshu.io/upload_images/8869373-d426c1dda8ba8cd1.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![image.png](http://upload-images.jianshu.io/upload_images/8869373-5b89bf3c863e6bc1.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![image.png](http://upload-images.jianshu.io/upload_images/8869373-72bb8d1cf29f0935.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![image.png](http://upload-images.jianshu.io/upload_images/8869373-f3b522e2bfab8695.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![安装完成](http://upload-images.jianshu.io/upload_images/8869373-d07618feade25d68.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 启动XMing
在开始界面最近安装的应用里面可以看到`XMing`和`XLaunch`。
![开始界面](http://upload-images.jianshu.io/upload_images/8869373-a27648a6bda6d5bc.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

打开`XLaunch`。  选择Xming以何种形式显示Linux图形程序的窗口（多窗口、单窗口、全屏或是不包含标题栏的单窗口），然后点击下一步按钮；
![XLaunch](http://upload-images.jianshu.io/upload_images/8869373-9f36d115c0260f35.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

保持该选项不变，点击下一步按钮；
![image.png](http://upload-images.jianshu.io/upload_images/8869373-c6667927823fd88c.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

保持该选项不变，点击下一步按钮；
![image.png](http://upload-images.jianshu.io/upload_images/8869373-2c805b1ca2a0d71e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

点击完成按钮；
![配置](http://upload-images.jianshu.io/upload_images/8869373-b9017f392fd92fc9.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

现在`XMing`的配置就已经完成了，接下来要在Linux子系统中安装图形程序了。

## 安装Gimp
首先启动Linux子系统bash：
按Win+R，打开运行窗口，输入`bash`，按回车。
![运行](http://upload-images.jianshu.io/upload_images/8869373-ff19a1e1cf258a4b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

先更新一下软件仓库：
```bash
sudo apt update
```

![更新软件仓库](http://upload-images.jianshu.io/upload_images/8869373-5708e214c8aee296.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

哇好多软件要升级的，那先`sudo apt upgrade`升级一下吧。
升级完成之后，来开始安装Gimp。
```bash
sudo apt install gimp
```

![install gimp](http://upload-images.jianshu.io/upload_images/8869373-0c41b7610e193acf.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

这里他问你要不要继续，我们按`y`继续。好像Gimp还挺大的。不过没事，我现在有100m的网络。

OK~现在已经下载好了，开始在一系列安装操作了，都是全自动的，看他表演就行。
感觉这个过程比下载还慢啊。= =
![安装](http://upload-images.jianshu.io/upload_images/8869373-f90fe22e25b95405.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


## 启动Gimp
经过漫长的等待，终于安装好了，嘿嘿，Linux比起Windows还是快，我要是安装个PS肯定不止这么久。

现在终于可以运行Gimp了，不过！要先做一件事：
```bash
DISPLAY=:0 gimp
```
上面这个命令你不打进去能运行Gimp算我输。
![运行](http://upload-images.jianshu.io/upload_images/8869373-68f80590f6a0f6a9.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

成功启动Gimp！

![Gimp](http://upload-images.jianshu.io/upload_images/8869373-27c933eeb769383c.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![about](http://upload-images.jianshu.io/upload_images/8869373-870e0e3691520d08.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 其他Linux图形工具
感觉其他软件不是依赖与Gnome就是依赖KDE环境，本身是没多大，但是加上这两个桌面环境就很大了。
我120G的硬盘在瑟瑟发抖= =。所以想到了这个超级轻量级的图形化软件
### Leaf Pad
(图片来源于网络，待会安装完可以看看在Windows里面的效果。)
![LeafPad](http://upload-images.jianshu.io/upload_images/8869373-572f66b706986370.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

首先还是通过apt安装
```bash
sudo apt install leafpad
```
![安装LeafPad](http://upload-images.jianshu.io/upload_images/8869373-394e5508365eb300.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

然后输入`leafpad`运行。
啊？怎么回事
![错误](http://upload-images.jianshu.io/upload_images/8869373-688368482b6a6e4d.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

记得我前面运行Gimp时怎么做的吗？
前面要加`DISPLAY=:0`啊！也就是要输入：`DISPLAY=:0 leafpad`

重新来，得嘞，成功了。
![LeafPad截图](http://upload-images.jianshu.io/upload_images/8869373-a33b8f09776ef37b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


## 结束
由于篇幅关系，就只是介绍这两个软件咯，其他软件都大同小异，有兴趣的同学可以自己去安装试一下。
不过我觉得Linux这些软件放到Windows上运行看起来都挺丑的，还是在Linux桌面环境里面，换一套好看的GTK主题好看一些吧，在子系统里运行Linux图形程序确实挺好玩的，虽然就仅限于好玩，实际作用嘛= =。没想出来有啥= =。


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)