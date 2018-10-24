## 前言
Servlet是运行在服务器端的程序，它的运行状态由Servlet容器（简称容器）来维护。

通常，在容器收到客户对Servlet的请求时，容器会判断这个Servlet是否为第一次被访问，如果是第一次被访问，则会创建一个Servlet实例同时调用该实例的init()方法，进行初始化。

每个Servlet只会被创建一个实例，同时也只会被初始化一次。然后将这个实例一直保存在内存中，对所有的请求进行处理。默认的服务功能是调用与HTTP请求方法相应的do功能。同时，HttpServlet.service()方法会检查请求方法是否调用了适当的处理方法。

最后，当服务器关闭时，容器将会调用Servlet的destroy()方法清除Servlet实例。

我们下面用实验看一下这个过程：

## 编写测试用jsp
首先，我们写一个很简单的JSP程序，我们通过JSP页面来调用Servlet方法。我们在Tomcat安装目录下的webapps文件夹下新建一个ServletLife文件夹，进入该文件夹，写一个index.jsp文件，代码如下：

index.jsp

```html
<%@ page contentType="text/html;charset=GBK" language="java" %>
<html>
  <head>
    <title>Show servlet life cycle</title>
  </head>
  <body>
    <center>
      <form action="ShowLifeCycle" name=form">
        <input type="submit" value="SUBMIT"></form>
    </center>
  </body>
</html>
```

这是一段很简单的JSP程序，只为说明问题，整个程序只有一个提交表单的`submit`。

- 代码第8行指定表单提交给ShowLifeCycle
- 代码第9行创建一个“提交”

然后我们在我们创建的/ServletLife目录下新建一个WEB-INF文件夹，进入WEB-INF文件夹，再创建一个classes文件夹。

## 编写Servlet程序
Servlet.java 代码

```java
import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.util.*;

public class Servlet extends HttpServlet {
    private ServletConfig config;
    private static int counter = 0;

    public Servlet() {
        super();
        System.out.println("=== " + ++counter + " instances ===");
    }

    //初始化servlet
    @Override
    public void init(ServletConfig config) throws ServletException {
        super.init(config);
        this.config = config;
        System.out.println("=== invoke init() ===" + new Date().toString());
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        System.out.println("=== invoke doPost ===" + new Date().toString());
    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        System.out.println("=== invoke doGet() ===" + new Date().toString());
    }

    @Override
    protected void service(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        super.service(req, resp);
        System.out.println("=== invoke service ===");
    }

    @Override
    public void destroy() {
        System.out.println("=== invoke destroy() ===" + new Date().toString());
    }
}
```

### 代码说明
- 11行，定义一个类变量，用来记录一共创建了几个实例。
- 13~16行，显式地写出构造函数，是为了打印出一共创建了多少个实例。
- 18~24行，初始化函数。每次调用显示”=== invoke init() ===”以及当前时间。
- 26~28行，在doPost()方法中打印”=== invoke doPost ===”以及当前时间。
- 30~32行，在doGet()方法中打印”=== invoke doGet ===”以及当前时间。
- 34~38行，这里我们重写service()方法，只是为了在调用此方法的时候打印出””’ invoke service ===”以及当前时间。
- 40~43行，在调用destroy()方法时，打印”=== invoke destroy() ===”以及当前时间。

将该java文件编译后的Servlet.class放到/WEB-INF/classes文件夹下。

## 编写web.xml配置
然后在/WEB-INF文件夹下创建一个配置文件web.xml：

```xml
<?xml version="1.0" encoding="UTF-8"?>
<web-app xmlns="http://xmlns.jcp.org/xml/ns/javaee"
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://xmlns.jcp.org/xml/ns/javaee http://xmlns.jcp.org/xml/ns/javaee/web-app_3_1.xsd"
         version="3.1">

    <servlet>
            <servlet-name>LifeCycle</servlet-name>
            <servlet-class>Servlet</servlet-class>
    </servlet>
    <servlet-mapping>
        <servlet-name>LifeCycle</servlet-name>
        <url-pattern>/ShowLifeCycle</url-pattern>
    </servlet-mapping>
</web-app>
```

这个文件主要来配置Servlet的。

## 运行Tomcat
接下来运行Tomcat，查看控制台日志，里面会有一行刚刚打印的文字：

```
13-Jan-2018 10:26:21.214 INFO [main] org.apache.catalina.startup.Catalina.start Server startup in 108 ms
```
说明Tomcat服务器正常启动。

然后我们在浏览器地址栏输入以下网址：
```
http://localhost:8080/ServletOne/
```
页面上只有一个submit按钮

## 分析日志测试
点击该按钮，此时Servlet被请求，查看控制台输出，此时内容如下:
```log
=== 1 instances ===
=== invoke init() ===Sat Jan 13 10:26:30 CST 2018
=== invoke doGet() ===Sat Jan 13 10:26:30 CST 2018
=== invoke service ===
```

- 第2行，当第一次收到该Servlet请求时，会调用该Servlet的实例方法，并创建1个实例。”=== 1 instances ===”;
- -第3行，创建该实例后，调用Servlet的init()方法进行初始化操作；
- 第4行，通过doGet()方法处理请求响应；
- 第5行，在service()方法最后一行打印出”=== invoke service ===”,实际上，doGet()方法是由service()方法调用的。

接下来我们重新创建一个Servlet请求，打开浏览器，重复以上过程，找到localhost/8080/ServletLife/index.jsp页面，点击submit，然后重新打开刚才的文本文档，内容如下：

```log
=== 1 instances ===
=== invoke init() ===Sat Jan 13 10:26:30 CST 2018
=== invoke doGet() ===Sat Jan 13 10:26:30 CST 2018
=== invoke service ===
13-Jan-2018 10:26:31.202 INFO [localhost-startStop-1] org.apache.catalina.startup.HostConfig.deployDirectory Deploying web application directory [C:\Program Files\Apache Software Foundation\Tomcat 8.5\webapps\manager]
13-Jan-2018 10:26:31.272 INFO [localhost-startStop-1] org.apache.catalina.startup.HostConfig.deployDirectory Deployment of web application directory [C:\Program Files\Apache Software Foundation\Tomcat 8.5\webapps\manager] has finished in [70] ms
=== invoke doGet() ===Sat Jan 13 10:33:10 CST 2018
=== invoke service ===
```
新增加了6、7两行。再次请求Servlet，并没有新建一个Servlet实例，也没有init过程，直接使用上次创建的实例来处理请求响应，doGet()方法被调用。

然后我们关闭Tomcat服务器。查看控制台日志，内容如下：

```log
=== 1 instances ===
=== invoke init() ===Sat Jan 13 10:26:30 CST 2018
=== invoke doGet() ===Sat Jan 13 10:26:30 CST 2018
=== invoke service ===
13-Jan-2018 10:26:31.202 INFO [localhost-startStop-1] org.apache.catalina.startup.HostConfig.deployDirectory Deploying web application directory [C:\Program Files\Apache Software Foundation\Tomcat 8.5\webapps\manager]
13-Jan-2018 10:26:31.272 INFO [localhost-startStop-1] org.apache.catalina.startup.HostConfig.deployDirectory Deployment of web application directory [C:\Program Files\Apache Software Foundation\Tomcat 8.5\webapps\manager] has finished in [70] ms
=== invoke doGet() ===Sat Jan 13 10:33:10 CST 2018
=== invoke service ===
=== invoke destroy() ===Sat Jan 13 10:33:20 CST 2018
```

可以看到destroy()方法被调用，清除Servlet实例。

## 总结
### Servlet的生命周期

- 浏览器向Servlet提交请求，Servlet实例化
- Servlet执行`init`方法，持续相应HTTP请求
- 浏览器/页面 关闭，Servlet实例析构


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)