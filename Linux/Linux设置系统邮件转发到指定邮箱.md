## 前言
在Linux的操作中，有的时候每敲一下回车，就出来You have new mail in /var/spool/mail/root的提示，究竟是为什么呢？
Linux 系统经常会自动发出一些邮件来提醒用户系统中出了哪些问题（收件箱位置：/var/mail/）。可是这些邮件都是发送给 root 用户的。出于系统安全考虑，通常不建议大家直接使用 root 帐户进行日常操作。所以要想点办法来让系统把发给 root 用户的邮件也给自己指定的外部邮箱发一份，或者是直接关闭此项服务。

## 关闭sendmail服务
这里介绍一种不用关闭sendmail服务的方法
```bash
echo “unset MAILCHECK” >> /etc/profile
source /etc/profile
```

关闭sendmail的功能：
```bash
chmod 0 /usr/sbin/sendmail
mv /usr/sbin/sendmail /usr/sbin/sendmail.bak
ln -s /var/qmail/bin/sendmail /usr/sbin/sendmail
```

清空 /var/spool/mail/root日志
```bash
cat /dev/null > /var/spool/mail/root
cat /dev/null>;/var/spool/mail/root
```

## root邮件转发到自己的邮箱
### 方法一
修改此文件
```bash
/etc/log.d/logwatch.conf
添加 MailTo = root,xxx@xxx.com
```

### 方法二
```bash
修改 /etc/aliases
添加 root: xxx@xxx.com
```

注意：好像如果设置成和主机同域的，好像邮件就发不成，比如本机邮件就是moper.me，那么发这个就没法发，相应的发其他邮箱就可以成功。

关于“/etc/aliases”：

当sendmail收到一个要送给xxx的信时，它会依据/etc/aliases文件中的内容送给另一个使用者。这个功能可以创造一个只有在信件系统内才有效的使用者。例如mailing list就会用到这个功能，在 mailing list 中，我们可能会创造一个叫 redlinux@link.ece.uci.edu的 mailinglist，但实际上并没有一个叫redlinux的使用者。实际 aliases档的内容是将送给这个使用者的信都收给mailing list处理程式负责分送的工作。

/etc/aliases是一个文本文档，而sendmail需要一个二进位格式的 /etc/aliases.db。newaliases的功能传是将/etc/aliases转换成一个sendmail所能了解的db文件：

[root@centos ~]# newaliases

除root外的其它用的邮件可以通过在用户/home/下建立一个.forward文件实现转发:
//somebody
other1
other2
文件权限设为600,作用一样,但.forward可以由用户自行维护,而aliases则只有治理员才能修改。

设定~/.forward档案加入转寄目的即可。

## 参考资料
http://moper.me/linux-you-have-new-mail-in.html


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)