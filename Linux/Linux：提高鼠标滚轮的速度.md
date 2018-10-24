## 安装
```bash
sudo apt install imwheel
```

## 配置

```bash
nano ~/.imwheelrc
```

```bash
".*"
None,      Up,   Button4, 4
None,      Down, Button5, 4
Control_L, Up,   Control_L|Button4
Control_L, Down, Control_L|Button5
Shift_L,   Up,   Shift_L|Button4
Shift_L,   Down, Shift_L|Button5
```

## 运行
```bash
imwheel
```

重新运行
```bash
imwheel kill
```
看到提示就成功了。

添加到启动项避免每次开机都要手动运行

## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)