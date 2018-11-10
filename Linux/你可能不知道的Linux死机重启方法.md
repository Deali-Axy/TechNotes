## 前言
不管在工作或者学习中，都可能遇到电脑死机的情况，如果直接强制关机或者切断电源可能会带来硬件的损坏，严重的可能导致数据丢失。

在学习中使用Linux经常遇到死机的情况，而且无法通过Alt+Ctrl+F[1-7]登陆，也无法通过ssh登陆。


## 更安全、底层的方法
按下Alt+Ctrl+SysReq(PrintScr键)一秒钟，保持Alt+Ctrl按下状态，松开PrintScr键；
保持按下Alt+Ctrl键的同时，依次按下reisub（也就是busier倒过来），你会发现，当你按下最后一个键的同时，电脑重启了。
这样操作，电脑会帮你杀掉所有进程并将挂在的硬盘卸载掉，然后安全重启。


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)