## 前言
不清楚什么原因，网络上关于JavaFx的中文资料很少，并且都很老，所以建议大家有兴趣学习JavaFx还是看官方文档比较好，而且貌似部分人不看好JavaFx。
关于Swing的资料倒是要多很多。我觉得挺奇怪的，从设计上来将，还是JavaFx高明一些嘛。

>PS：经过近一周的折腾和探索，发现OpenJDK使用JavaFX真的好多坑～
>OpenJDK 和 Oracle JDK的配置是有差别的，这里推荐大家使用OracleJDK以免遇到奇怪的坑～

## 附上安装OracleJDK的方法
```bash
$ sudo add-apt-repository ppa:webupd8team/java
$ sudo apt-get update
$ sudo apt-get install oracle-java8-installer
```


## OpenJDK需要多一步操作
因为OpenJDK8默认是没有javafx包的，需要先安装 OpenJFX。

## 配置
打开Idea，在一个普通的Java项目里面，导入javafx包是找不到的。
Idea 在创建Java项目的时候默认不导入JavaFx包，所以需要我们自己找到路劲并且导入。

打开 Project Structure，选择SDKs，可以看到JDK路径。
![](https://upload-images.jianshu.io/upload_images/8869373-bf50c3eff30ba41b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

点击旁边的 “+” 号，然后在 jdk 目录下，`/lib/ext`文件夹里找到 `jfxrt.jar` 这个包，并且导入，就OK啦～

## HelloWorld
第一个程序从HelloWorld开始！

```java
package lin.Learning.JavaFx;

import javafx.application.Application;
import javafx.scene.Scene;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;
import javafx.scene.control.Label;


public class HelloWorld extends Application {

    public static void main(String[] args) {
        launch(args);
    }

    @Override
    public void start(Stage primaryStage) {
        Label label = new Label("the first label");
        // 创建面板作为根节点
        StackPane rootNode=new StackPane();
        // 将label控件添加到根节点上
        rootNode.getChildren().add(label);
        // 创建场景对象，指定根节点对象和大小
        Scene scene=new Scene(rootNode,200,60);
        primaryStage.setTitle("Hello JavaFx");
        // 将场景添加到舞台中
        primaryStage.setScene(scene);
        // 显示舞台
        primaryStage.show();
    }
}
```

运行效果：
![](https://upload-images.jianshu.io/upload_images/8869373-22a3037fb6460d91.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


这样就完成了在Linux系统上的第一个JavaFx程序开发了。

## 安装 Scene Builder
JavaFx特色就是 View 和 Controller 分离，使用 fxml 写界面布局，并且 Oracle 提供了一款所见即所得的界面设计工具，不过要自己去安装。

下载地址：
https://www.oracle.com/technetwork/java/javase/downloads/javafxscenebuilder-1x-archive-2199384.html#javafx-scenebuilder-2.0-oth-JPR

选择对应系统的版本下载就行了，这里我选择的是Debian的deb安装包。

![](https://upload-images.jianshu.io/upload_images/8869373-1e1fa17086e3142e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

关于 Scene Builder 的安装，可以参照 oracle 的文档：
https://docs.oracle.com/javase/8/scene-builder-2/installation-guide/preface.htm#sthref2

这里摘一段文档，关于在Linux平台安装 Scene Builder的：
>(Linux platform) Extract the Scene Builder 2.0 files from the javafx_scenebuilder-2_0-linux-<platform>.tar.gz to a directory on your local file system, or double-click the javafx_scenebuilder-2_0-linux-<platform>.deb file to open it with Ubuntu Software Center, where <platform> is either x64 or i586. By default, the Scene Builder application is installed at /opt/JavaFXSceneBuilder2.0/.

可以看到，Scene Builder的安装目录是：`/opt/JavaFXSceneBuilder2.0/`

那么，接下来就要在IDEA中配置了。

## IDEA配置
打开设置
![](https://upload-images.jianshu.io/upload_images/8869373-1435c5f20090bb98.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

配置路径
![](https://upload-images.jianshu.io/upload_images/8869373-6192ace8f679460f.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

然后在我们的项目里面添加一个 FXML 文件。
右键就可以通过 Scene Builder 打开啦，这个界面还不错。
![](https://upload-images.jianshu.io/upload_images/8869373-e415b932c26c2251.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
Learn more on my WeChat Official Account：DealiAxy
Every post was in my blog：[blog.deali.cn](http://blog.deali.cn)