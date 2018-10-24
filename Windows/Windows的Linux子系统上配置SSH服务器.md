## 安装openssh
这个不用啰嗦太多，首先需要安装`openssh-server`和`openssh-client`。


## 修改`sshd-config`配置
需要关注的就是这三行。
```python
UsePrivilegeSeparation no         #因为wsl没有实现chroot
PasswordAuthentication yes
ListenAddress 0.0.0.0                 #这一项在我的发行版里缺省为注释行。
```
其他的可以根据需求修改。
```
ListenAddress 0.0.0.0                  # 要让其他计算机能连接上需要加上这一行，或者把经常需要连接的计算机IP加入
PermitRootLogin yes                   # 允许root用户登录。
```


## 关闭Windows自带的ssh
我原本还不知道的，查了资料才知道新版Windows自带了ssh服务，不过怎么使用还没有了解。
可以使用powershell来查看这个服务。
```python
PS C:\Users\user> Get-Service -Name ssh*
Status   Name               DisplayName
------   ----               -----------
Stopped  SshBroker          SSH Server Broker
Stopped  SshProxy           SSH Server Proxy
```
在服务控制台里找到这两个服务停掉就行了。
注意要先停掉`sshproxy`才可以关掉`sshbroker`。
![image.png](https://upload-images.jianshu.io/upload_images/8869373-fc7b73140b172090.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


## 以调试方式启动ssh
```python
/usr/sbin/sshd -d
```
`-d`表明是以调试方式启动的服务，这种情况下，错误会显示在控制台上。

要注意即使以这种方法启动ssh server，它仍然只是在存在bash窗口时的一个子服务。一旦最后一个bash窗口关闭，这个ssh server也就关闭了，显然这不是我们想要的。接下来看看怎么将ssh server以windows服务或者后台进程来运行。


## 正常开启ssh
```python
service ssh start
```

## 自动启动ssh服务
当前WSL并不支持ssh server作为服务运行。我们需要借助windows计划任务和脚本，使得在windows启动时自动运行这一服务。

```c
set ws=wscript.createobject("wscript.shell")
ws.run "C:\Windows\System32\bash.exe -c '/usr/sbin/sshd -D'",0
```

将这个文件存为vbs，并在计划任务中添加一个启动任务，触发器设置为系统启动时。
不过使用这个方法的前提是你的WSL默认用户是root，对于默认用户不是root的必须使用sudo方式启动。
但是！
执行sudo时，会提示输入密码，而这时又无法拿到用户的输入。要解决这一问题，需要允许sudo在没有密码的情况下执行命令。

在bash里输入命令：
```python
sudo visudo
```

```python
#includedir /etc/sudoers.d
username ALL=(ALL) NOPASSWD: /usr/sbin/sshd -D
```
把`username`改成你自己的用户名即可。

## 参考资料
[hbaaron.github.io](https://hbaaron.github.io/blog_2017/%E5%9C%A8wsl%E4%B8%8B%E5%AE%89%E8%A3%85%E4%BD%BF%E7%94%A8sshd%E5%85%A8%E6%94%BB%E7%95%A5/)


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)