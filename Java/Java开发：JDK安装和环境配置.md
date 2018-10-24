## 前言
环境配置是开发中最基础的部分，不过最近有很多新入坑的同学，都在问怎么安装JDK和配置环境，索性写一篇。
这里要注意一下，在Windows平台和Linux平台下做开发是不同的，Windows平台开发Java需要自己手动配置JDK的环境变量，而大多数Linux都是不需要的，安装了OpenJDK就可以了（可能很多发行版都自带了OpenJDK），这点是比较方便的。

## 下载Java JDK
### Windows平台
打开甲骨文的JDK网站：http://www.oracle.com/technetwork/java/javase/downloads/index.html
网站是这样的。
注意下载的时候看清楚版本。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-b159092a908eda7e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

本文选择的版本是JDK8
![image.png](http://upload-images.jianshu.io/upload_images/8869373-4e57bf16c0ffcc8a.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

点击下载按钮下载。
下载完成之后打开进行安装就行了。
划重点：**记得把安装目录记下来！！后面有用**
![image.png](http://upload-images.jianshu.io/upload_images/8869373-e1654bad74be8064.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### Linux平台
Linux平台可以选择OpenJDK也可以用甲骨文提供的JDK。这两者是有区别的。
这里再贴一下OpenJDK和JDK的不同。(以下内容引用自知乎`Aloys寒风`)

>历史上的原因是，OpenJDK是JDK的开放原始码版本，以GPL(General Public License)协议的形式放出(题>主提到的open就是指的开源)。在JDK7的时候，OpenJDK已经作为JDK7的主干开发，SUN JDK7是在OpenJDK7的基础上发布的，其大部分原始码都相同，只有少部分原始码被替换掉。使用JRL(JavaResearch License，Java研究授权协议)发布。至于OpenJDK6则更是有其复杂的一面，首先是OpenJDK6是JDK7的一个分支，并且尽量去除Java SE7的新特性，使其尽量的符合Java6的标准。关于JDK和OpenJDK的区别，可以归纳为以下几点：
>
>**授权协议的不同：**OpenJDK采用GPL V2协议放出，而SUN JDK则采用JRL放出。两者协议虽然都是开放源代码的，但是在使用上的不同在于GPL V2允许在商业上使用，而JRL只允许个人研究使用。OpenJDK不包含Deployment（部署）功能：部署的功能包括：Browser Plugin、Java Web Start、以及Java控制面板，这些功能在OpenJDK中是找不到的。
>
>**OpenJDK源代码不完整：**这个很容易想到，在采用GPL协议的OpenJDK中，SUN JDK的一部分源代码因为产权的问题无法开放给OpenJDK使用，其中最主要的部份就是JMX中的可选元件SNMP部份的代码。因此这些不能开放的源代码 将它作成plug，以供OpenJDK编译时使用，你也可以选择不要使用plug。而Icedtea则为这些不完整的部分开发了相同功能的源代码 (OpenJDK6)，促使OpenJDK更加完整。
>
>**部分源代码用开源代码替换：**由于产权的问题，很多产权不是SUN的源代码被替换成一些功能相同的开源代码，比如说字体栅格化引擎，使用Free Type代替。
>
>**OpenIDK只包含最精简的JDK：**OpenJDK不包含其他的软件包，比如Rhino Java DB JAXP……，并且可以分离的软件包也都是尽量的分离，但是这大多数都是自由软件，你可以自己下载加入。不能使用Java商标：这个很容易理解，在安装OpenJDK的机器上，输入`java
-version`显示的是OpenJDK，但是如果是使用Icedtea补丁的OpenJDK，显示的是java。
>
>总之，在Java体系中，还是有很多不自由的成分，源代码的开发不够彻底。

所以，Linux平台下到底要JDK还是OpenJDK？？
我觉得OpenJDK完全够用啊，安装也方便。在软件包管理器里输入`jdk`进行安装，装下来的就是OpenJDK。

**Debian系安装**：`sudo apt install jdk`

**Rehat系安装**：`yum apt install jdk`

**SUSE安装**：`sudo zypper in jdk`

如果非要用甲骨文的JDK。那么就去甲骨文官网下载。下载地址在上面有。
然后安装方法，各个Linux发行版略微有差别，能折腾Linux的同学安装个软件应该不是问题。

## Path配置
好吧。我承认Java最烦人的东西就是需要配置环境变量，特别是Windows上，你就不能安装完直接配置好吗？！人家Python都能这么方便就你不行 = =

### Windows平台配置
首先打开上面安装完成之后记下来的路径。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-1fcd296d799971e2.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

然后按Win+R键打开运行。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-6f8b22d1a9998167.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
输入：`control` 打开控制面板
![image.png](http://upload-images.jianshu.io/upload_images/8869373-c8a6d297af2d7736.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

我用的是英文版系统，但是大家对照着图片来操作是一样的。
选择“系统”。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-ffc8793c56efb2d2.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![image.png](http://upload-images.jianshu.io/upload_images/8869373-8f9b76bedd0e7713.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

选择"高级系统设置"
![image.png](http://upload-images.jianshu.io/upload_images/8869373-f16bccea8280609e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

环境变量
![image.png](http://upload-images.jianshu.io/upload_images/8869373-f0edbabc2c285034.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

这样就打开了环境变量编辑器
![image.png](http://upload-images.jianshu.io/upload_images/8869373-32d22d0a194f35b0.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

首先创建一个 `JAVA_HOME` 的环境变量。内容就是刚才JDK安装的位置。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-d05c1decea0a16f7.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
![image.png](http://upload-images.jianshu.io/upload_images/8869373-fade088bf18e88da.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

接着添加 `CLASSPATH` 变量。
内容： `.;%JAVA_HOME%\lib;%JAVA_HOME%\lib\dt.jar;%JAVA_HOME%\lib\tools.jar;`
![image.png](http://upload-images.jianshu.io/upload_images/8869373-88b9342e0e96a692.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

最后在系统的 `Path` 里添加 javahome 和 classpath 。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-175655b28ef9f37f.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
点击”添加“。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-92a8f8eae572b346.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
添加下面两个路径。
`%JAVA_HOME%\bin`
`%JAVA_HOME%\jre\bin`
如果不是win10，没有这个Path编辑器的话，就在Path变量原来的基础上加：
`;%JAVA_HOME%\bin;%JAVA_HOME%\jre\bin` **注意前面有个分号**
然后点击”确定“就行了。

## 测试
打开控制台，输入 `jave -version`
![image.png](http://upload-images.jianshu.io/upload_images/8869373-fa1b6a8bd7f918ec.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
配置成功完成！


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)