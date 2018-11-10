## 前言
Linux的图形界面实在是太耗资源了，同时开几个虚拟机感觉已经hold不住了，赶紧把这些Linux服务器的图形界面都关掉。
>CLI：command Line Interface，命令行界面。
现在的Linux发行版默认登陆界面几乎都是默认为GUI界面，如果按照旧版本的修改inittab文件，在一些比较新的版本是没有这个文件的(Linux的启动服务机制发生改变)

## 修改Grub配置文件
打开grup配置文件
```python
nano /etc/default/grub 
```
修改
```py
GRUB_CMDLINE_LINUX=”” 为GRUB_CMDLINE_LINUX=”text” 
```
更新grub
```py
update-grub 
```
更新系统服务管理器配置
```py
systemctl set-default multi-user.target 
```
重启：`init 6`

```python

# If you change this file, run ‘update-grub’ afterwards to update 
# /boot/grub/grub.cfg. 
# For full documentation of the options in this file, see: 
# info -f grub -n ‘Simple configuration’

GRUB_DEFAULT=0 
GRUB_TIMEOUT=5 
GRUB_DISTRIBUTOR=lsb_release -i -s 2> /dev/null || echo Debian 
GRUB_CMDLINE_LINUX_DEFAULT="quiet"
GRUB_CMDLINE_LINUX="text"

# Uncomment to enable BadRAM filtering, modify to suit your needs 
# This works with Linux (no patch required) and with any kernel that obtains 
# the memory map information from GRUB (GNU Mach, kernel of FreeBSD …) 
#GRUB_BADRAM=”0x01234567,0xfefefefe,0x89abcdef,0xefefefef”

# Uncomment to disable graphical terminal (grub-pc only) 
#GRUB_TERMINAL=console

# The resolution used on graphical terminal 
# note that you can use only modes which your graphic card supports via VBE 
# you can see them in real GRUB with the command `vbeinfo’ 
#GRUB_GFXMODE=640x480

# Uncomment if you don’t want GRUB to pass “root=UUID=xxx” parameter to Linux 
#GRUB_DISABLE_LINUX_UUID=true

# Uncomment to disable generation of recovery mode menu entries 
#GRUB_DISABLE_RECOVERY=”true”

# Uncomment to get a beep at grub start 
#GRUB_INIT_TUNE=”480 440 1”
```

## 解除debian root用户登陆限制

打开gdm配置文件：
```py
nano /etc/gdm3/deamon.conf 
```
配置安全设置：
`[security]` 下一行添加 `AllowRoot = ture`
去除gdm登陆用户名检测：
打开文件 `/etc/pam.d/gdm-autologin`，并其相关配置信息删除或注释掉：`auth required pam_succeed_if.so user != root quiet_success`

修改后的gdm-autologin文件：
```py
#%PAM-1.0 
auth requisite pam_nologin.so 
#auth required pam_succeed_if.so user != root quiet_success 
auth required pam_permit.so 
@include common-account 
# SELinux needs to be the first session rule. This ensures that any 
# lingering context has been cleared. Without this it is possible 
# that a module could execute code in the wrong domain. 
session [success=ok ignore=ignore module_unknown=ignore default=bad] pam_selinux.so close 
session required pam_loginuid.so 
# SELinux needs to intervene at login time to ensure that the process 
# starts in the proper default security context. Only sessions which are 
# intended to run in the user’s context should be run after this. 
session [success=ok ignore=ignore module_unknown=ignore default=bad] pam_selinux.so open 
session optional pam_keyinit.so force revoke 
session required pam_limits.so 
session required pam_env.so readenv=1 
session required pam_env.so readenv=1 envfile=/etc/default/locale 
@include common-session 
@include common-password
```


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)