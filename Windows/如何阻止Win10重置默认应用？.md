## 前言
Win10比之前版本的Windows系统更现代，然而却不见得更好用，喜欢自作主张重置默认应用就是一个大问题。

就像这样，真的是烦。
![image.png](https://upload-images.jianshu.io/upload_images/8869373-ac71b210d704ed4b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 解决方法
改注册表。
新建一个 `去除重置默认应用.reg` 的注册表文件，粘贴一下代码。
```python
Windows Registry Editor Version 5.00

;Description: Prevents Windows 10 from resetting the file associations

;... by setting NoOpenWith registry value for all the modern apps.

;Tested in Windows 10 Build 10586

;-------------------

;Microsoft.3DBuilder

;-------------------

;File Types: .stl, .3mf, .obj, .wrl, .ply, .fbx, .3ds, .dae, .dxf, .bmp

;... .jpg, .png, .tga

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppXvhc4p7vz4b485xfp46hhk3fq3grkdgjg]

"NoOpenWith"=""

;-------------------

;Microsoft Edge

;-------------------

;File Types: .htm, .html

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppX4hxtad77fbk3jkkeerkrm0ze94wjf3s9]

"NoOpenWith"=""

;File Types: .pdf

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppXd4nrz8ff68srnhf9t5a8sbjyar1cr723]

"NoOpenWith"=""

;File Types: .svg

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppXde74bfzw9j31bzhcvsrxsyjnhhbq66cs]

"NoOpenWith"=""

;File Types: .xml

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppXcc58vyzkbjbs4ky0mxrmxf8278rk9b3t]

"NoOpenWith"=""

;-------------------

;Microsoft Photos

;-------------------

;File Types: .3g2,.3gp, .3gp2, .3gpp, .asf, .avi, .m2t, .m2ts, .m4v, .mkv

;... .mov, .mp4, mp4v, .mts, .tif, .tiff, .wmv

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppXk0g4vb8gvt7b93tg50ybcy892pge6jmt]

"NoOpenWith"=""

;File Types: Most Image File Types

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppX43hnxtbyyps62jhe9sqpdzxn1790zetc]

"NoOpenWith"=""

;File Types: .raw, .rwl, .rw2 and others

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppX9rkaq77s0jzh1tyccadx9ghba15r6t3h]

"NoOpenWith"=""

;-------------------

; Zune Music

;-------------------

;File Types: .aac, .adt, .adts ,.amr, .flac, .m3u, .m4a, .m4r, .mp3, .mpa

;.. .wav, .wma, .wpl, .zpl

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppXqj98qxeaynz6dv4459ayz6bnqxbyaqcs]

"NoOpenWith"=""

;-------------------

; Zune Video

;-------------------

;File Types: .3g2,.3gp, .3gpp, .avi, .divx, .m2t, .m2ts, .m4v, .mkv, .mod

;... .mov, .mp4, mp4v, .mpe, .mpeg, .mpg, .mpv2, .mts, .tod, .ts

;... .tts, .wm, .wmv, .xvid

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppX6eg8h5sxqq90pv53845wmnbewywdqq5h]

"NoOpenWith"=""
```
双击运行即可。

要恢复原状的话，可以再新建一个 `恢复.reg` 注册表文件。代码如下：

```python
Windows Registry Editor Version 5.00

;Description: UNDO file for the earlier NoOpenWith registry edit

;Tested in Windows 10 Build 10586

;-------------------

;Microsoft.3DBuilder

;-------------------

;File Types: .stl, .3mf, .obj, .wrl, .ply, .fbx, .3ds, .dae, .dxf, .bmp

;... .jpg, .png, .tga

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppXvhc4p7vz4b485xfp46hhk3fq3grkdgjg]

"NoOpenWith"=-

;-------------------

;Microsoft Edge

;-------------------

;File Types: .htm, .html

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppX4hxtad77fbk3jkkeerkrm0ze94wjf3s9]

"NoOpenWith"=-

;File Types: .pdf

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppXd4nrz8ff68srnhf9t5a8sbjyar1cr723]

"NoOpenWith"=-

;File Types: .svg

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppXde74bfzw9j31bzhcvsrxsyjnhhbq66cs]

"NoOpenWith"=-

;File Types: .xml

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppXcc58vyzkbjbs4ky0mxrmxf8278rk9b3t]

"NoOpenWith"=-

;-------------------

;Microsoft Photos

;-------------------

;File Types: .3g2,.3gp, .3gp2, .3gpp, .asf, .avi, .m2t, .m2ts, .m4v, .mkv

;... .mov, .mp4, mp4v, .mts, .tif, .tiff, .wmv

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppXk0g4vb8gvt7b93tg50ybcy892pge6jmt]

"NoOpenWith"=-

;File Types: Most Image File Types

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppX43hnxtbyyps62jhe9sqpdzxn1790zetc]

"NoOpenWith"=-

;File Types: .raw, .rwl, .rw2 and others

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppX9rkaq77s0jzh1tyccadx9ghba15r6t3h]

"NoOpenWith"=-

;-------------------

; Zune Music

;-------------------

;File Types: .aac, .adt, .adts ,.amr, .flac, .m3u, .m4a, .m4r, .mp3, .mpa

;.. .wav, .wma, .wpl, .zpl

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppXqj98qxeaynz6dv4459ayz6bnqxbyaqcs]

"NoOpenWith"=-

;-------------------

; Zune Video

;-------------------

;File Types: .3g2,.3gp, .3gpp, .avi, .divx, .m2t, .m2ts, .m4v, .mkv, .mod

;... .mov, .mp4, mp4v, .mpe, .mpeg, .mpg, .mpv2, .mts, .tod, .ts

;... .tts, .wm, .wmv, .xvid

[HKEY_CURRENT_USER\SOFTWARE\Classes\AppX6eg8h5sxqq90pv53845wmnbewywdqq5h]

"NoOpenWith"=-
```

## 参考资料
微软官网
win10之家


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)