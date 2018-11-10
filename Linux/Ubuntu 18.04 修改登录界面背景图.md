## 前言
Ubuntu 18.04用了一段时间了，在Gnome桌面的加持下，兔子 18.04 的颜值还不错，加上自己搭配了几套GTK主题，简直美滋滋，唯一美中不足的就是，Ubuntu的登录管理器换成GDM之后，登录界面背景没办法修改了，这怎么行呢，于是经过一番折腾，有了本文。

## 首先，准备一张图片
图片的尺寸呢，根据你的屏幕分辨率确定咯。
然后把图片放到`/usr/share/backgrounds/`目录下面。

## 修改GDM的CSS文件
感觉如果是做前端的人来用Gnome那就真的美滋滋了，主题、插件、各种美化都可以玩的飞起。

文件位置
```bash
/etc/alternatives/gdm3.css
```

```css
/*找到默认的这个部分*/
#lockDialogGroup {
  background: #2c001e url(resource:///org/gnome/shell/theme/noise-texture.png);
  background-repeat: repeat; 
}

/*改为*/
#lockDialogGroup {
  background: #2c001e url(file:///usr/share/backgrounds/mypicture.jpg);         
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center; 
}
```

提示：CSS代码仅供参考，熟悉前端的同学可以根据自己的喜好制作更好的效果，到时候别忘了分享一波哦～

## 重启
可以重启系统，也可以重启图形界面。
为了避免麻烦，建议还是直接重启系统吧，反正都很快的。

![image.png](https://upload-images.jianshu.io/upload_images/8869373-38a972f1b57f2bd0.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)



## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)
