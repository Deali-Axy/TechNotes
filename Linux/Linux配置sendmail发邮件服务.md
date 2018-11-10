## 前言
因为开发需要，搞了个`wiki系统`，并且用到了邮件订阅，所以研究了一番发送邮件的方法。

## 安装
没什么好说的，先安装必要组件。

```bash
apt install sendmail-bin
apt install sendmail
apt install sendmail-cf #配置工具
```

## 配置`sendmail`
`sendmail`默认是本机用户发送给本机，所以需要修改可以发送到整个Internet：
修改`sendmail`配置宏文件，路径为`/etc/mail/sendmail.mc`

找到
```bash
DAEMON_OPTIONS('Family=inet,  Name=MTA-v4, Port=smtp, Addr=127.0.0.1')dnl
```
将`Addr=127.0.0.1`修改为`Addr=0.0.0.0`，意思是可以连接到任何服务器。

保存修改的文件，下面备份配置文件：

```bash
cd /etc/mail
mv sendmail.cf sendmail.cf~
```

然后生成新的配置文件：
```bash
m4 sendmail.mc > sendmail.cf
```

重启`sendmail`生效

## 配置域名
配置`sendmail`使用合法的域名分两步，修改`sendmail`的配置文件和添加域名MX记录。

`sendmail`可以直接使用 `-r account@domain.com` 参数来以任意源地址发送邮件，但目前主流的邮箱都会将源地址和反向解析IP进行比较，如果解析不到或是解析的IP不匹配，轻则将邮件直接归为`SPAM`，严重的就直接拒绝接收。

MX记录（Mail Exchanger Record）主要是接收邮件时使用，即当投递一封新邮件时，会查询收件人域名的MX记录，然后通过MX记录得到的IP地址进行投递。同时邮件厂商在接收邮件的时候也会将源地址和MX记录进行比较，作为垃圾邮件的判断标准之一。

### 第一步：添加域名
#### (1) 将域名加入到local-host-names文件
打开：`/etc/mail/local-host-names`
添加：
```bash
deali.cn
```
#### (2) 修改submit.cf文件
打开：`vi /etc/mail/submit.cf`，找到行 `#Dj$w.Foo.COM`，修改为
```bash
Djdeali.cn
```
**注意！一定是`Dj`+`Domain`形式！**

至此，sendmail邮件命名配置完毕，重启sendmail使配置生效。

### 第二步：添加域名MX记录
找到修改域名信息的页面（不同的域名注册商页面不相同），修改结果因域名商的不同最迟会在24小时内生效。
#### (1) 添加域名A记录mail，直接指向你的邮件服务器的静态IP地址：
域名 | 类型 | 记录
--- | ---- | ----
mail | A | 127.0.0.1

#### (2) 添加（或是修改）域名的MX记录，形如：
域名 | 类型 | 记录
--- | ---- | ----
@   | MX   | deali.cn

#### (3) 使用nslookup检测MX记录是否能正确解析到邮件服务器
```bash
nslookup
> set q=mx
> deali.cn
Server:         8.8.8.8
Address:        8.8.8.8#53

Non-authoritative answer:
deali.cn        mail exchanger = 5 deali.cn.

Authoritative answers can be found from:
```

## 发邮件测试
输入如下命令：
`sendmail -t <<EOF`

会出现`>`符号，输入下面格式的内容（每行后面回车）：
```bash
From:Mail test <test@yourdomain.com>
To:xxxx@qq.com
Subject:Test
test
EOF
```

## 参见问题
### Relaying denied（拒绝投递）
出现 `550 5.7.1 <xxx@163.com>... Relaying denied. IP name lookup failed [192.168.1.133]` 异常时，原因是把`sendmail`当做邮件中转站，需要将客户端的IP地址加入到`access`配置文件中。

打开：`/etc/mail/access`，添加：
```bash
Connect:客户端IP                   RELAY
```

重新生成访问权限的数据库：
```bash
cd /etc/mail/
makemap hash access.db < access 
```

### 发出的邮件被其他MTA识别为垃圾
设置域名指向（上节链接），添加spf记录 [操作教程](https://www.renfei.org/blog/introduction-to-spf.html)
同时注意控制发信频率

### 在哪查看sendmail日志?
日志位置： `/var/log/maillog`
调整日志级别（详细程度）： 修改配置文件`define(confLOG_LEVEL',16’)dnl`默认为`9`
或者调用命令时指定`sendmail -O LogLevel=14`

[日志级别说明](http://www-01.ibm.com/support/knowledgecenter/ssw_aix_71/com.ibm.aix.networkcomm/sendmail_debugflags.htm?lang=zh)

### sendmail日志都是什么意思?
**注意`sendmail`并不保证发出的邮件一定会被发到收件人接收**，所以日志中的信息只是接收端MTA反馈的连接信息。
具体格式，慢慢读吧—–[sendmail日志格式](http://www.softpanorama.net/Mail/Sendmail/sendmail_logs_format.shtml)

### sendmail性能参数
[http://www.5dmail.net/html/2008-4-27/200842733006.htm](http://www.5dmail.net/html/2008-4-27/200842733006.htm)

### 一些相关的网站，文章
http://www.5dmail.net/
[sendmail官网](https://www.sendmail.com/sm/open_source/)
[邮件发送那点事](http://park.jobdeer.com/discussion/19/%E9%82%AE%E4%BB%B6%E5%8F%91%E9%80%81%E9%82%A3%E7%82%B9%E4%BA%8B)
[看邮件头](http://www.qqexmail.net/tips/st_security_look_head.asp)



## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)