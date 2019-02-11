## 前言
Java的跨平台功能听起来很诱人可口，号称“Write Once，Run Everywhere”，实际上是“Run Once，Debug Everywh”... 在实际开发过程中还是会遇到各种各样的坑的，刚刚解决了一系列问题，特地写个文章总结一下。

## 使用Gradle构建Jar包
感谢万能的Gradle，极大提高了Java开发的生产力～
在Gradle中生成jar包可以使用官方的插件：`application` 来简单生成Jar包，同时还有多种不同的配置可以自定义，了解详情请参照Gradle官方文档。

我这里使用的是一个叫做 `shadow` 的Gradle插件，把构建jar包的配置都安排得明明白白了，非常的方便！
官方文档：https://imperceptiblethoughts.com/shadow/configuration/#configuring-output-name

下面是 `build.gradle` 配置参考：
```groovy
plugins {
    id 'com.github.johnrengelman.shadow' version '4.0.3'

    // Apply the java plugin to add support for Java
    id 'java'

    // Apply the application plugin to add support for building an application
    id 'application'
}

dependencies {
    implementation 'com.github.jengelman.gradle.plugins:shadow:4.0.3'
}

// Output to build/libs/name.jar
shadowJar {
    baseName = 'name'
    classifier = null
    version = null
}

apply plugin: 'com.github.johnrengelman.shadow'
apply plugin: 'java'
```
具体的配置要依照项目的实际需要来配置～
设置完 shadow 插件之后，执行 `gradle build` 就可以在 `build/libs/` 文件夹下面生成你的可执行jar包了，超级方便。
需要更多功能可以查看shadow官网文档，写的很清楚。

## 访问jar包中的资源
虽然jar包中有各种目录结构，但是jar包本质仍然是一个文件，所以不可以用传统的方法去访问，像 `File` 类，`Class` 对象的 `getResouce` 方法都不行的。
应该使用 `ClassLoader` 的 `getResourceStream` 方法直接获取资源文件的输入流。
例如：
```java
InputStream is=this.getClass().getResourceAsStream("/resource/res.txt");
InputStream is=this.getClass().getClassLoader().getResourceStream("/resource/res.txt");
```
注意：`Class`对象和`ClassLoader`对象的`getResourceStream`方法也是有不同的，具体的不同可以查看这个笔记：[正确获取Java项目资源](https://app.yinxiang.com/shard/s10/nl/16462562/1227da4b-9da9-4e97-9523-12fb77399ef5?title=Java%20Gradle%E9%A1%B9%E7%9B%AE%E4%B8%AD%E7%9A%84%E8%B5%84%E6%BA%90%E6%AD%A3%E7%A1%AE%E8%8E%B7%E5%8F%96%20-%20Allocator%E7%9A%84CSDN%E5%8D%9A%E5%AE%A2%20-%20CSDN%E5%8D%9A%E5%AE%A2)

## 访问Jar包中的文件夹
当jar包中的资源文件很多的时候，不可能一个个输入名字去获取，这也太hack了吧，肯定要用自动化的方式来提高生产力。
事实上，访问jar包中的文件夹是挺麻烦的，不过还是找到了取巧的方法，试了一下还是挺好用的。
（不过最好做一下缓存）

代码如下：
```java
String path = getClass().getProtectionDomain().getCodeSource().getLocation().getPath();
JarFile localJarFile = new JarFile(new File(path));

Enumeration<JarEntry> entries = localJarFile.entries();
while (entries.hasMoreElements()) {
      JarEntry jarEntry = entries.nextElement();
      String innerPath = jarEntry.getName();
      System.out.println(innerPath);
}
```

使用`getClass().getProtectionDomain().getCodeSource().getLocation().getPath();` 来获取当前jar包的路径，如果代码不在jar包中运行的话，获取到的就是当前class文件所在路径。所以在使用之前最好做一下判断，看看程序是否在jar包中运行。

## 关于JavaFX的Media资源问题
JavaFX可以播放音乐，但是和其他Image、Font资源不同的是，Media对象的构造函数只能接受一个String参数（即文件URL），所以没办法使用`getResourceStream`方法把文件输入流传入对象。

我查了一下官网，找到了解决办法，把文件URL换成JarURL就可以了，文档：https://docs.oracle.com/javase/6/docs/api/java/net/JarURLConnection.html。

简单示例：
```java
String path = String.format("jar:file:%s!/%s", jarPath, relativePath);
Media media = new Media(path);
```
注意：`relativePath`的形式是 `media/hello.wav` 这样的。


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
Learn more on my WeChat Official Account：DealiAxy
Every post was in my blog：[blog.deali.cn](http://blog.deali.cn)