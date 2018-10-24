## 前言
最近用VMware的时候是使用桥接方式，不知道是路由的问题还是其他，路由器里面没有显示虚拟机的连接，虽然虚拟机和主机都在路由器里分配了不同的IP地址，但是每次resume之后虚拟机的IP地址总是变，很麻烦。

## VMware设置
把下面这个勾去掉。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-d8cac28b5141f32e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

然后点击`Nat Settings`。
记录网关。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-70d6d0c4bb6bb3c2.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

虚拟机设置。把网络改成这个`VMnet8`。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-077a4fd77bf4ad95.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## Linux系统中配置静态IP
### Debian
```py
nano /etc/network/interfaces
```
修改文件内容：
```py
auto lo 
iface lo inet loopback

auto ens33 
iface ens33 inet static 
address 192.168.8.100 
netmask 255.255.255.0 
gateway 192.168.8.2
```

### CentOS
修改` /etc/sysconfig/network`
```py
NETWORKING=yes
HOSTNAME=localhost.localdomain
GATEWAY=192.168.92.2
```

修改`/etc/sysconfig/network-scripts/ifcfg-eth0`
```py
DEVICE="eth0"
#BOOTPROTO="dhcp"
BOOTPROTO="static"
IPADDR=192.168.129.129
NETMASK=255.255.255.0
HWADDR="00:0C:29:56:8F:AD"
IPV6INIT="no"
NM_CONTROLLED="yes"
ONBOOT="yes"
TYPE="Ethernet"
UUID="ba48a4c0-f33d-4e05-98bd-248b01691c20"
DNS1=192.168.92.2
```

## 配置DNS
修改：`/etc/resolv.conf`
配置成你想要使用的DNS服务器。
```py
nameserver 192.168.92.2
```

## 重启网络
```py
/etc/init.d/networking restart
```



## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)