## 前言
由于 Linux 系统的安全性设置等原因，非 root 用户使用外部设备或者某些硬件接口会受到限制。Google 官方提供的 SDK 并不能直接工作，如找不到设备或者显示一堆问号以及 Permission Denied。


## 方法
记得以前有看过 Google 官方提供的解决方案，即将指定的 USB 设备读写权限赋予普通用户。

首先使用 `lsusb` 命令查看连接到计算机的 usb 设备，找到 Android 手机对应的厂商 ID 和产品 ID，如 `Bus 001 Device 004: ID 0bda:0001`，则 0bda 和 0001 分别对应厂商 ID 和产品 ID。

>小技巧：在连接手机前先查看一次 `lsusb` 的结果，连上手机后找到 `lsusb` 里新增的那行记录即可。
>国内有些小厂的厂商 ID 可能设为 Google 或 HTC 的。其实厂商 ID 设置成什么都无所谓，只是一个标志而已。

第二步，编辑`/etc/udev/rules.d/70-android.rules` 文件。写入以下内容（Ubuntu 下测试通过）：

```
SUBSYSTEM=="usb", ATTRS{idVendor}=="0bda", ATTRS{idProduct}=="0001",MODE="0666"
```

其中` 0bda `和` 0001 `分别替换成对应的厂商 ID 和产品 ID。

第三步，赋予读和执行权限：`chmod a+rx /etc/udev/rules.d/70-android.rules`

最后，拔出手机，重启 adb 并插回手机即可：`adb kill-server`

查看设备列表以验证成功 `adb devices`

其实 Linux 连接 Android 手机比 Windows 方便多了，起码不用满世界找驱动。