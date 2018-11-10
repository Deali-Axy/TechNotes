## 前言
昨天系统又重装了两次，所以没时间写推文了，今天刚刚搭完就来写了。
这几天电脑升级硬件之后系统还没配置好，只是装了个Win10，我还是更喜欢在Linux环境工作，又看到Deepin的界面设计得很好看，于是就装了一个试试效果。
但是用的时间还不长，所以只能是浅度体验。

## 系统截图
两种模式的桌面。
时尚模式（类似于Mac系统）
![深度截图_20180206113814.png](http://upload-images.jianshu.io/upload_images/8869373-57f809bfd42d030f.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

高校模式（类似与Windows系统）
![深度截图_20180206113737.png](http://upload-images.jianshu.io/upload_images/8869373-7b82486a195a57c8.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

Dashboard（所有应用程序）
![深度截图_20180206113835.png](http://upload-images.jianshu.io/upload_images/8869373-873c807d37d6f60e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

分组查看
![深度截图_20180206113849.png](http://upload-images.jianshu.io/upload_images/8869373-1d51780e4e283cb5.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

多任务视图
![深度截图_20180206113955.png](http://upload-images.jianshu.io/upload_images/8869373-009e81315d830662.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

控制面板
![深度截图_20180206114026.png](http://upload-images.jianshu.io/upload_images/8869373-e2937b353bed6662.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

应用商店
![深度截图_20180206114009.png](http://upload-images.jianshu.io/upload_images/8869373-72759191af9b743f.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 测评开始
本文主要包括：用户界面、应用程序、开发体验、系统性能细节
每个小环节都给出一个评分，满分10分。

## 用户界面
**评分：9.0** （少一分怕你骄傲）

从上面的截图就可以看出来，Deepin的用户界面水平那是真的高，实际使用体验真的很爽，没有很多花哨的特效，界面清爽又不失个性（适合装逼XDD...）
Deepin的这个桌面环境叫做DDE，不是和其他“国产发行版”一样拿Gnome或者KDE换个主题就说是自己做的。这个DDE是使用Qt从头搭建的，以前Deepin的桌面是HTML5开发的，所以比较卡顿，使用Qt重写的这个桌面在使用过程中没有遇到过卡顿。

## 应用程序
**评分：8.5** （日常使用毫无压力，不用再切换到Windows）

操作系统最重要的就是应用数量和质量了，Windows之所以成为桌面操作系统的霸主，就是因为庞大的应用软件支持，Windows Phone系统为何衰落，根本原因也是因为缺乏足够的应用软件。
作为开发者，我其实并不关心Linux桌面系统的推广，我用Linux单纯是因为开发的方便，Linux下所有鼠标能完成的操作，命令肯定可以做到，而反过来就不行。
上面有一张截图是Deepin的应用商店，赫赫在目的就是QQ的图标，事实上，Deepin安装完就已经自带QQ这个应用了，长期以来，Linux平台上运行QQ一直是个大问题，因为腾讯官方不会再推出任何QQ的客户端了，所以不是用WebQQ就是自己去折腾WineQQ，非常麻烦，而且不稳定，Deepin是直接给你配置好了，开箱即用，也足够稳定。关于Windows平台软件的问题，Deepin是购买了Crossover的授权，然后把Windows上的常用软件（例如微信、PS、迅雷、百度云、爱奇艺）都配置好了，在应用商店里就能直接安装了，非常的方便。
虽然应用商店是很方便的，但是作为程序猿大部分时间还是用命令行比较多，我发现Deepin的包管理器apt好像有点迷，因为当我`apt update`检查到有新的软件包可以更新的时候，用`apt upgrade`更新它却提示我通过apt更新会出错，让我在控制面板里面选择`系统更新`...
原来是系统更新不能通过命令行的apt直接更新，要在控制面板里面操作= =，有点麻烦。

## 开发体验
**评分：8.0**

**关于开发工具的安装**：
非常方便，在应用商店里面都有，vscode、sublime、jetbrains全家桶一应俱全，都是一键安装。
（虽然jb全家桶也有个小工具可以管理，但是商店里安装这些真是方便，这个给好评）

**实际开发体验**，并没有多少，只用了几天，Android Studio还没安装，只安装了VSCode写前端代码和PHP，还有pycharm，jb家的东西真是好，不仅体验好，还跨平台。
日常开发没什么问题，npm和pip用起来都OK，Python我用的是anaconda管理的，没毛病。

不过在论坛什么的看到说Deepin的源里面这些工具版本不够新的情况，这个好办，Deepin不是基于Debian构建的吗，直接用Debian的源不就好了。

## 系统性能
**评分：6.5** （性能表现比较中庸）

Deepin这么好看的界面还是比较吃配置的，实际用起来感觉不如Debian配上Gnome或者KDE，我的电脑是i5 6代+16G内存的，Deepin也是安装在SSD上面，但是感觉还是比较奇怪，没有Debian那么舒服。

## 体验细节
**评分：3.0**

首先是**开机**，从开机到进入桌面，没什么毛病，很快，大概15秒内，但是进到桌面却加载不出壁纸？？
这个**加载壁纸的过程需要1分钟左右**，不过这段时间可以自由操作，没多大影响，就是壁纸是一片黑，但是对于轻微强迫症的我来说不能忍。

还有关于**电源管理**，Deepin的电源管理绝对是有问题的，因为，**没办法正常关机和重启**！
对，你没有听错，关机和重启在我的电脑上是不行的。
具体表现为：无论在菜单中选择关机还是在终端输入命令关机，都会卡在这个界面，鼠标可以移动，但是界面卡住了，并不能关机成功，我只好强制断电。

如果说前面的桌面壁纸加载还算是小问题的话，这个应该是大问题了，这个问题直接导致了**Deepin在我的电脑上存活不过3天**。

还有网络也有很大的问题，在电脑从睡眠状态中唤醒之后，WiFi连接就断开了，**并且无法重连！根本搜索不到任何WiFi信号！**，在论坛上有人说网线还能使用，在我的电脑上不行。
并且这个问题不是只有我的电脑才有，很多人都有。

*（还有一些其他小毛病，不想再吐槽了）*

## 总结
**最后，Deepin在上面提到的几个方面里的综合评分为：7**
分数还是不错，因为好看的用户界面和丰富的应用程序拉高了平均分，我还是比较看好Deepin这个发行版的，有很大的潜力，就是到现在还不是很稳定，很多细节不完善。
把电源管理和性能优化好，那绝对又是Linux发行版一大霸主。
引用知乎一个回答：*如果Deepin都不能成功，Linux桌面就完了*。Deepin真的是用心在做的系统，希望越来越好，我在等能回去Deepin的一天。

~~写了这么多，好像不错。不过，溜了，安装大蜥蜴(`OpenSUSE`)去了（逃~~


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)