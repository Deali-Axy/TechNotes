## 前言
腾讯估计是不会给Linux系统开发任何软件了，不过问题不大。我们有很多好用的第三方软件替代~~（无奈之举，摊手）~~

## 关于Snap
**Ubuntu官网上的介绍**
>Snaps are applications packaged with all their dependencies to run on all popular Linux distributions from a single build. They update automatically and roll back gracefully. Whether you’re building for desktop, cloud, or the Internet of Things, publishing as a snap will keep users up to date and make system configuration issues less likely, freeing you to code more and debug less.
>Snapcraft, the open source tool to publish snaps, picks up from your existing build artefacts or language of choice, be it Python, Go, C/C++, Node.js, or even .NET. With 20 minutes you can have your first app built and released in the Snap Store.

了解更多：[https://snapcraft.io](https://snapcraft.io)

## 安装Snap基本环境
```bash
sudo apt install snapd snappy
```

## 安装electronic-wechat
```bash
sudo snap install electronic-wechat
```

由于 Snap 版自带了所有依赖，所以软件体积比较大，安装需要点耐心。如果安装失败，建议每次安装一个软件，逐个重试。
安装后，需要重启或者注销系统，才能在主菜单中看到微信的启动器（快捷方式）。

## Application Config
**把微信添加到应用程序菜单里**

Create file : `/usr/share/applications/electronic-wechat.desktop`

File content:
```ini
[Desktop Entry]
Name=Electronic Wechat
Name[zh_CN]=微信电脑版
Name[zh_TW]=微信电脑版
Exec=/opt/electronic-wechat/electronic-wechat
Icon=/opt/electronic-wechat/resources/electronic-wechat.png
Terminal=false
X-MultipleArgs=false
Type=Application
Encoding=UTF-8
Categories=Application;Utility;Network;InstantMessaging;
StartupNotify=false
```

这样设置是全局有效的，如果需要只对当前用户有效，则在以下目录新建desktop文件即可。
`~/.local/share/applications`

## End
Snap 应用安装简单，便于移植，缺点就是体积较大，毕竟为了保证在任何 Linux 发行版都能使用，集成了全部的依赖软件。当然，现在的电脑硬盘都很大，Snap 这一点体积可以忽略不计，重点是我们 Linux 用户有了更多好用的软件。

## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)
