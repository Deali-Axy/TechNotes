## 前言
Linux下有一个强力工具，dd，用来操作镜像，简直神器，唯一的不足是没有显示操作进度，不过也不是没有办法，下面介绍几个查看写入进度的方法。

## status选项查看进度
如果你使用的是GNU版本的dd，并且coreutils版本高于8.24，那么可以使用status选项。例如：
```
sudo dd if=/dev/sda of=/dev/zero status=progress
```
>上面命令在Mac OS X上执行会出错，因为OS X使用的是BSD版本的命令行，不是GUN。你可以在Mac OS X上安装gun coreutils，或使用下面介绍的pv命令。

## pv命令
```
sudo pv -tpreb /dev/sda | dd of=/dev/zero
sudo pv -tpreb /dev/sda | dd of=/dev/zero bs=4096 conv=notrunc,noerror
```
使用pv配合dialog还可以显示进度条对话框：
```
 (sudo pv -n /dev/sda | dd of=/dev/zero) 2>&1 | dialog --gauge "dd process bar" 10 70 0
```

![image.png](https://upload-images.jianshu.io/upload_images/8869373-e85d9c3e97a2846a.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 使用pkill打印进度
重新打开一个Shell，然后执行如下命令即可每秒输出一次进度信息
```
watch -n 1 pkill -USR1 -x dd
```


## 参考资料
http://blog.topspeedsnail.com/archives/8125
http://blog.topspeedsnail.com/archives/2748
http://blog.topspeedsnail.com/archives/9464
https://www.mobibrw.com/2017/7677

