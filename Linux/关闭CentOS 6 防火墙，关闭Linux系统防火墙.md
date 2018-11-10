## 前言
最近部署服务的时候需要临时关闭一下防火墙，所以记个笔记，如何关闭CentOS防火墙。

## 查看系统版本
输入：`cat /etc/issue`   查看版本

## 通过service关闭
service命令开启以及关闭防火墙为即时生效，下次重启机器的时候会自动复原。

查看防火墙状态：
```
service iptables status
```
记得在CentOS6.9中是输入iptables，网上有些教程使用`service iptable status `命令并不可行。

关闭防火墙：`service iptables stop`

打开防火墙：`service iptables start`

## 通过：`/etc/init.d/iptables` 进行操作
查看防火墙状态：`/etc/init.d/iptables/status`

关闭防火墙：`/etc/init.d/iptables stop`（这是临时关闭，关闭的是当前运行的防火墙，重启之后防火墙又会启动，因为它是开机自启动的）

## 关闭防火墙开机自启，使用chkconfig命令
永久开启防火墙：`chkconfig iptables on`

查看状态：`chkconfig --list iptables`

永久关闭防火墙： `chkconfig iptables off`


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)