## 简介
Spring Boot 是一个轻量级框架，可以完成基于 Spring 的应用程序的大部分配置工作。在本教程中，将学习如何使用 Spring Boot 的 starter、特性和可执行 JAR 文件结构，快速创建能直接运行的基于 Spring 的应用程序。
本文使用IDEA作为开发工具，Gradle作为构建工具，创建一个简单的SpringBoot应用，暂时不涉及数据库的配置。


## 使用IDEA创建
新建项目，选择 `Spring Initializr`
![](https://upload-images.jianshu.io/upload_images/8869373-32ceb528a36e4069.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

下一步
![](https://upload-images.jianshu.io/upload_images/8869373-8626af17625e59b5.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


配置依赖
我选择的依赖都显示在右边。
Web的选择了Rest支持，这样可以很方便写Rest应用，直接mapping就行。
数据库的选择了，JDBC和MySQL驱动。（不过第一个应用里面不会用到的。）
![](https://upload-images.jianshu.io/upload_images/8869373-b758d85186d18207.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

再下一步就是选择保存项目的文件夹了，这里就不截图了哈~
最后点击`完成`按钮，Gradle就开始构建项目，这个过程比较久，请耐心等待。

## 编写代码
等待Gradle构建完成之后就可以开始写Rest接口了。
代码如下。
```java
package cn.deali.demo;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.autoconfigure.jdbc.DataSourceAutoConfiguration;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
// 排除引入数据源配置类
@SpringBootApplication(exclude = {DataSourceAutoConfiguration.class})
public class DemoApplication {

    @RequestMapping("/")
    String index() {
        return "hello world";
    }

    @RequestMapping("hello")
    String hello() {
        return "hello";
    }

    public static void main(String[] args) {
        SpringApplication.run(DemoApplication.class, args);
    }
}
```

## 运行 & 测试
点击 `Run` - `Run DemoApplication` 运行Spring Boot项目。

一切正常的话，看看Run窗口的输出。
![](https://upload-images.jianshu.io/upload_images/8869373-065ba9d8ad7846c1.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

这个时候打开浏览器输入
`http://127.0.0.1:8080`
或者
`http://127.0.0.1:8080/hello`
就可以查看运行效果了


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)