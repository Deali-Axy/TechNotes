## 找到模拟器的进程
用tasklist查看进程pid

```py
tasklist
```
![image.png](http://upload-images.jianshu.io/upload_images/8869373-89d5c5ace44baa41.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

找到模拟器进程的PID，然后再使用`netstat`命令。

```py
netstat -ano | findstr 1000
```
*这里的 1000 就是上面查到的进程PID。*

根据获取到的端口号，就可以使用 ADB 连接了。

```py
adb connect 127.0.0.1:端口号
```

当然最好的方法还是去模拟器提供商的网站上查一下，这是最方便的。
例如我是用的网易模拟器官网上说了端口是7555，我就直接拿来用了。

----------
关于 ADB 的用法可以查看：[谷歌官方文档](https://developer.android.com/studio/command-line/adb.html#howadbworks)



## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)