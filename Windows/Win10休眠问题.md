## 基础

查看当前电脑支持的睡眠、休眠类型

```powershell
powercfg -a
```

等级说明：

- S0 正常。
- S1 CPU停止工作。唤醒时间：0秒。
- S2 CPU关闭。唤醒时间：0.1秒。
- S3 除了内存外的部件都停止工作。唤醒时间：0.5秒。
- S4 内存信息写入硬盘，所有部件停止工作。唤醒时间：30秒。（休眠状态）
- S5 关闭。

## 命令

查看上次唤醒电脑的设备

```powershell
powercfg -lastwake
```

### 控制唤醒

查看可唤醒设备

```powershell
powercfg /devicequery wake_armed
```

禁用指定设备唤醒权限

```powershell
powercfg /devicedisablewake "设备名"
```

一键禁用所有设备的唤醒权限

```powershell
powercfg /devicequery wake_armed | ForEach{ powercfg /devicedisablewake $_ }
```



## 参考资料

- 如何禁止鼠标唤醒Win10？https://www.zhihu.com/question/48154015/answer/162508741
- 一劳永逸解决WIN10所有睡眠问题：https://zhuanlan.zhihu.com/p/93306740

