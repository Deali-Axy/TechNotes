## 前言
有点烦，最近给电脑升级一下配置，加了内存和固态硬盘，结果新内存不太兼容，导致电脑频繁死机，去找商家换了一条内存之后就好了，这也导致我贸然重装了系统 = =... 有一点资料放在系统盘忘记保存结果丢了。今天下午才把新系统配置好，所以这两天都没有办法写推文。
（不得不说Chrome真是好用，这同步功能免去了很多麻烦。）

## 首先喷一下Gradle
**缺点**：占用资源大，速度又慢，在国内用网络还很差。
今天下午在配置环境时，这货浪费了我好久的时间。
一开始是Gradle文件下载不了，手动下载之后就依赖包下载不了，醉了，各种找镜像和手动下载折腾了半天都没弄好。（没有经验）
你问我为啥不用代理？？啥子，我设置了socks代理了啊，可是他根本不理我，该下载不了的地方还是下载不了，maven仓库照样不能用。
更多的废话就不说了，直接说**解决方法：**
设置代理的正确姿势应该是这样，编辑`gradle.properties`：

>这个文件的位置：
Linux/Mac系统：`~/.gradle/gradle.properties`
Windows系统：`C:\Users\你的用户名\.gradle\gradle.properties`

设置socks代理有用算我输好吧，还有https必须要设置！
```gradle
systemProp.http.proxyHost=127.0.0.1
systemProp.http.proxyPort=1080
systemProp.https.proxyHost=127.0.0.1
systemProp.https.proxyPort=1080
```
设置完代理之后在`Project Root`里输入`./gradlew build`，应该就没什么问题了，如果有错误再根据提示信息解决就行了，我比较喜欢用命令行操作，比IDE直观。

## 优化Gradle速度
Gradle的性能差是众所周知的，怎么解决，堆硬件呗，~~不充钱你也想变强？~~
不多说，还是编辑这个`gradle.properties`：
```gradle
org.gradle.daemon=true
org.gradle.parallel=true
org.gradle.configureondemand=true
org.gradle.jvmargs=-Xmx2048m -XX:MaxPermSize=512m -XX:+HeapDumpOnOutOfMemoryError -Dfile.encoding=UTF-8
```
并且在IDE里面设置一下：
![image.png](http://upload-images.jianshu.io/upload_images/8869373-c3b60a47109fc04d.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
![image.png](http://upload-images.jianshu.io/upload_images/8869373-7d32ec6e9aa98177.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## emmmm
嗯，关于`Gradle`这个配置就是这样了，现在看到这个词就有点慌，莫名回想起被Gradle支配的恐惧。
溜了~


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)