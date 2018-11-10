## 设置方法
搜索了半天，也试了很久。

用以下命令可以：
使用Xfce的文件管理器
```bash
xdg-mime default Thunar.desktop inode/directory
```
thunar.desktop换成你想要的文件管理器名称
再不行就只能把原来的那个文件管理器卸载掉= =。

我比较喜欢用Gnome的文件管理器：
```bash
xdg-mime default org.gnome.Nautilus.desktop inode/directory
```

在深度论坛上看到另一个方法：
>在`~/.config/mimeapps.list`的
`[Default Applications]`字段下修改
`inode/directory=org.gnome.Nautilus.desktop`
即可更改默认的文件管理器

这个方法更加直观方便！
说来也奇怪，之前用在国外的论坛社区转了一圈，只找到了最上面的方法，很多也都比较含糊，而使用中文搜索之后很快就找到了解决方法，不得不说，我们国内的计算机发展真的是不差的！

![Screenshot from 2018-05-26 19-29-02.png](https://upload-images.jianshu.io/upload_images/8869373-4d5d0313e107250d.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)