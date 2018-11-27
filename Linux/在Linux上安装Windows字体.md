## 前言
Linux系统下为安装WPS后，由于版权问题并没有自带字体，而这些字体又是平时必须使用的，下面介绍为Linux系统添加字体的方法。

## 操作

- 由于Windows系统自带了完善的字体，所以可以从安装的windows系统下拷贝。首先执行命令：
```
mkdir /usr/share/fonts/wps_symbol_fonts/    //创建WPS的字体目录
```
然后到windows字体目录下，C：/Windows/Fonts/，进入到该目录，在此打开终端，执行命令：
```
cp *.ttf /usr/share/fonts/wps_symbol_fonts/
cp *.TTF /usr/share/fonts/wps_symbol_fonts/
cp *.otf /usr/share/fonts/wps_symbol_fonts/
cp simsun.ttc /usr/share/fonts/wps_symbol_fonts/
```
将ttf、otf、TTF、及simsun.ttc字体文件拷贝到linux系统下新建的wps_symbol_fonts目录下。
>注意：ttc文件只拷贝simsun.ttc（宋体）这一个，全部都拷进来会使系统字体错乱，并且WPS无法输入中文，具体是哪个ttc文件导致的你可以自己挨个拷进去验证，出错了就删除即可。



- 添加可读可执行权限，并生成字体缓存。命令：
```
cd /usr/share/fonts/
chmod 755 wps_symbol_fonts/
cd /usr/share/fonts/wps_symbol_fonts/
chmod 644 *
mkfontscale
mkfontdir
fc-cache          //更新字体缓存
```

>注意：只要按照该方法即可将windows字体全部添加到linux。字体文件最好不要直接放到fonts目录下，而要放到wps_symbol_fonts下，避免与系统字体冲突，并且可能会使WPS无法输入中文。