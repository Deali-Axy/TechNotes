## 前言
Linux用户很多都是使用双系统的吧，毕竟很多Linux下没有的软件还是需要打开Windows。
但是一直以来有个困扰，Linux下时间显示是正常的，但是回到Windows下时间就会慢了8个小时 = =
这是因为Windows默认使用硬件时钟，而Linux使用网络时间，现在只需要一条命令就能搞定这个问题。

## 解决
在Linux下打开终端，输入命令：
```python
timedatectl set-local-rtc 1
```
然后再输入
```python
timedatectl
```
进行验证。（非必要）

![image.png](https://upload-images.jianshu.io/upload_images/8869373-dcf0f1f5ddfe9ab9.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

这样问题就解决了，超简单有木有！

## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)