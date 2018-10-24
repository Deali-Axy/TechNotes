## 一、下载

Git for Windows，主页：[http://gitforwindows.org/](http://gitforwindows.org/) 
点击页面中“Download”进入下载列表。可根据个人喜好选择下载版本。
这里选择下载最新版：`Git-1.8.3-preview20130601.exe.`

## 二、安装

 下载完毕，双击开始安装：

### 1、除了AdvancedXXX选项，其余全选中

![image](http://upload-images.jianshu.io/upload_images/8869373-2a3cf3b3b64d357c.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 2、选择“Use Git Bash only”

![image](http://upload-images.jianshu.io/upload_images/8869373-966973df87f2ed49.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 3、选择“Checkout as-is，commit as-is”

![image](http://upload-images.jianshu.io/upload_images/8869373-f62f2afe32fd247a.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 4、等待安装完毕。

## 三、配置

### 1、安装完毕，桌面上会有Git Bash图标
![image](http://upload-images.jianshu.io/upload_images/8869373-dbf32407e4d6933b.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

双击进入Git Shell界面
![image](http://upload-images.jianshu.io/upload_images/8869373-2dfa5b5cb2926f62.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 2、配置Name和Email

命令格式：
```bash
git config --global user.name "your name"
git config --global user.email "your email address" 
```
![image](http://upload-images.jianshu.io/upload_images/8869373-12ecadfd8cbb97e1.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 3、生成Public/Private RSA Key

命令格式：
```bash
ssh-keygen -C "your email address" -t rsa
```
![image](http://upload-images.jianshu.io/upload_images/8869373-969a57c92be5bce6.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

注意图中红色数字标注：

1. 设置Public RSA Key的保存位置，直接回车采用默认地址；

2. 设置一个密码，并再次输入确认(**这里不建议设置，方便本地使用**)

3. Public RSA Key的保存路径：c:\users\username\.ssh\id_rsa.pub

4. 将Public Key告知Github

请首先注册一个github账号，Home Page：[https://github.com/](https://github.com/) 。然后进入Account Settings页面，打开SSH Keys，点击“Add SSH Key”。打开`c:\users\username\.ssh\id_rsa.pub`，把里面的内容全部Copy到Key对应的输入框内，点击“Add Key”。

![image](http://upload-images.jianshu.io/upload_images/8869373-5e8970a848427ab4.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 四、Clone Repositories

### 1、进入Git Workspace，右键选择Git GUI Here：

![image](http://upload-images.jianshu.io/upload_images/8869373-f989369b4eb816b0.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 2、选择“克隆已有版本库”

![image](http://upload-images.jianshu.io/upload_images/8869373-609ddd0ab9bb4284.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 3、输入要克隆的版本库地址和保存目录。

![image](http://upload-images.jianshu.io/upload_images/8869373-6f0b6b9edfc475f3.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

需要注意的是：
1. 版本库地址格式：`git@github.com:your resp address`
2. 保存目录的最后一级不能Exist
3. 图中蓝线标注即为your resp address，可以在github.com的Account Settings-->Respositories中看到，如下图红圈所示。
![image](http://upload-images.jianshu.io/upload_images/8869373-7c2d7df89002307b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 4、根据提示输入密码（在第三节的第三项中所设置），可能会输入多次。

![image](http://upload-images.jianshu.io/upload_images/8869373-b4b2e02dad0bce57.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 5、Clone成功。

![image](http://upload-images.jianshu.io/upload_images/8869373-7688c827b017abf3.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 五、简化

第四节中介绍的方法比较复杂，尤其是频繁输入密码。下面介绍一种简单的方法：

1. 一定不要设置密码！！！

2. 在Git Workspace打开Git Bash Here

3. 输入ssh git@github.com 回车，出现如下提示表示已经信任[git@github.com](mailto:git@github.com)站点。
![image](http://upload-images.jianshu.io/upload_images/8869373-98febc2dd1310063.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)