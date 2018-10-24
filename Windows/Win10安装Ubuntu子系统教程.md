## 一、启用“适用于Linux的Windows子系统”

通过Win10任务栏中的Cortana搜索框搜索打开“启用或关闭Windows功能”，向下滚动列表，即可看到“适用于Linux的Windows子系统”项。

![image.png](http://upload-images.jianshu.io/upload_images/8869373-e68eb17c8b750c94.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

勾选它，确定，然后按提示重启系统。

## 二、启用开发人员模式

然后进入“设置 - 更新和安全 - 针对开发人员”设置页面，选中“开发人员模式”。如图：

![image.png](http://upload-images.jianshu.io/upload_images/8869373-1597673cfc5cebca.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

然后就会下载安装开发人员模式程序包，等待安装完成。

## 三、启用Linux子系统

右键点击Win10开始按钮，选择“Windows PowerShell(管理员)”以管理员身份运行`Windows PowerShell`。

输入并回车运行以下命令：

```bash
> Enable-WindowsOptionalFeature -Online -FeatureName Microsoft-Windows-Subsystem-Linux
```
![image.png](http://upload-images.jianshu.io/upload_images/8869373-951db2eddcbece22.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

可能需要重启系统。

这个时候已经能进入`bash`了，但是并没有发行版可以用，运行`bash`，会有以下界面提示：
![image.png](http://upload-images.jianshu.io/upload_images/8869373-4fcc7abe2429bc19.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 四、在Windows商店安装Linux发行版

打开`Windows Store`，然后随便搜索一个Linux发行版的名字，比如我输入`Ubuntu`。

![image.png](http://upload-images.jianshu.io/upload_images/8869373-4fe521904f231cbb.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

点获取App。
可以看到里面有3个发行版可选。

![image.png](http://upload-images.jianshu.io/upload_images/8869373-022c45bb088c563e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

这里我们还是选Ubuntu吧，我比较熟练。

![image.png](http://upload-images.jianshu.io/upload_images/8869373-aa878a578eef963e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

点击获取开始下载。

安装完成
![image.png](http://upload-images.jianshu.io/upload_images/8869373-d8b96124891ff6fe.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

点击启动，继续下一步的安装操作。
输入用户名和密码就可以了。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-d8ee1b32f69521f0.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

安装完成，可以愉快地玩耍了。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-768992e1a119eb72.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)