## 前言
![](https://upload-images.jianshu.io/upload_images/8869373-5ffe3d048c65470f.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

Ubuntu 18.04，新的 Gnome 桌面的确好看很多。但同时出现了很多之前在 Unity 没有出现过的 BUG，例如在 Telegram 下无论怎么切换输入法都不能输入中文。

大概是所有 QT 编写的应用程序在 Gnome3 下都会出现这个问题，解决方法是引入 QT_IM_MODULE 变量。大致

## 步骤如下

- 编辑` ~/.local/share/applications/telegramdesktop.desktop `文件
- 修改 Exec 该行，添加环境变量` env QT_IM_MODULE=ibus` ，使用 fcitx 的用户，把 ibus 替换成 fcitx
- 重新启动telegram即可

(参考自github issuse和国内博客)


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)