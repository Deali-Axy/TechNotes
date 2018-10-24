## 前言
最近做项目需要，从之前熟悉的PHP和Python转到了JavaWeb，所以就有了这个笔记。资源图片都是来自网上的资源，根据自己的实际操作应用，做了总结归纳。

## 所需工具
- JDK
- Tomcat
- IDEA


## 创建工程
![image.png](http://upload-images.jianshu.io/upload_images/8869373-1f9f299c255067d6.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

设置工程名字：
![image.png](http://upload-images.jianshu.io/upload_images/8869373-e897e336d9faf433.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

创建完成后工程结构如下：
![image.png](http://upload-images.jianshu.io/upload_images/8869373-d0a224a049837320.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

上面的图片是在网络上复制的，好像我用的`IDEA 2017.3.2`没有这个`Create web.xml`的选项，我也不知道为啥，难道是`IDEA`越更新功能越退步了？
如下图：
![image.png](http://upload-images.jianshu.io/upload_images/8869373-f24b1140c415668f.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


所以这里就要自己配置`IDEA`添加`web.xml`。
步骤：打开Project Structure，在facets中选中次级的web或者在Modules中选中web，在deployment Descriptors面板里，点击 +号选择web.xml以及版本号。然后在弹出的对话框中修改xml默认的目录，加上web就可以了。

![image.png](http://upload-images.jianshu.io/upload_images/8869373-589fb299e8a3e934.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

然后确定，就有`web.xml`文件了。
如图：
![image.png](http://upload-images.jianshu.io/upload_images/8869373-4cb52fbee7db0450.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## Web工程设置
### 创建`classes`、`lib`目录
在WEB-INF 目录下点击右键，New --> Directory，创建 classes 和 lib 两个目录

![image.png](http://upload-images.jianshu.io/upload_images/8869373-4573e088e8cb702a.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

classes目录用于存放编译后的class文件，lib用于存放依赖的jar包

### `classes`目录配置

File --> Project Structure...，进入 Project Structure窗口，点击 Modules --> 选中项目“JavaWeb” --> 切换到 Paths 选项卡 --> 勾选 “Use module compile output path”，将 “Output path” 和 “Test output path” 都改为之前创建的classes目录

![image.png](http://upload-images.jianshu.io/upload_images/8869373-19e9bded8626a320.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

即将后面编译的class文件默认生成到classes目录下

### `lib`目录配置
还是在这个`Project Structure`这个窗口。点击 Modules --> 选中项目“JavaWeb” --> 切换到 Dependencies 选项卡 --> 点击右边的“+”，选择 “JARs or directories...”，选择创建的lib目录。
![
](http://upload-images.jianshu.io/upload_images/8869373-e79cc56965c39fdf.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![image.png](http://upload-images.jianshu.io/upload_images/8869373-0f1e771baa970ce2.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

选择`Jar Directory`
![image.png](http://upload-images.jianshu.io/upload_images/8869373-a60df78d2e597b11.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

![image.png](http://upload-images.jianshu.io/upload_images/8869373-2934bba46b41aa60.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 配置打包方式Artifacts
点击 Artifacts选项卡，IDEA会为该项目自动创建一个名为“JavaWeb:war exploded”的打包方式，表示 打包成war包，并且是文件展开性的，输出路径为当前项目下的 out 文件夹，保持默认即可。另外勾选下“Build on make”，表示编译的时候就打包部署，勾选“Show content of elements”，表示显示详细的内容列表。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-109630a7d88b250a.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## Tomcat配置
### 创建`Tomcat`容器
Run -> Edit Configurations，进入“Run Configurations”窗口，点击"+"-> Tomcat Server -> Local，创建一个新的Tomcat容器。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-2d1c30fcaf1a87f8.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 配置服务器名称路径
在"Name"处输入新的服务名，点击“Application server”后面的“Configure...”，弹出Tomcat Server窗口，选择本地安装的Tomcat目录 -> OK
![image.png](http://upload-images.jianshu.io/upload_images/8869373-8d4096e494b82a66.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 运行配置
在“Run Configurations”窗口的“Server”选项板中，去掉勾选“After launch”，设置“HTTP port”和“JMX port”，点击 Apply -> OK，至此Tomcat配置完成。
![image.png](http://upload-images.jianshu.io/upload_images/8869373-7c9ca4363598fc3e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## JavaWeb测试
### 运行配置
Run -> Edit Configurations，进入“Run Configurations”窗口，选择之前配置好的Tomcat，点击“Deployment”选项卡，点击“+” -> “Artifact”-> 选择创建的web项目的Artifact...
修改“Application context”-> Apply -> OK
![image.png](http://upload-images.jianshu.io/upload_images/8869373-bf7fdf301465c966.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
说明：此处的Application context是指定本工程的根目录。就是你访问服务器的路径，比如这里设置了`JavaWeb`，那么访问服务器的地址就是`http://localhost:8080/JavaWeb`。

### 编辑Jsp文件
在index.jsp文件中的body之间添加要显示的内容，然后点击“运行”的绿色三角
![image.png](http://upload-images.jianshu.io/upload_images/8869373-da525964619a6f22.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

打开浏览器，输入：localhost:8080/JavaWeb
![image.png](http://upload-images.jianshu.io/upload_images/8869373-f029d2dff47b7676.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

至此，intellij idea创建并设置javaweb工程全部完成，下面是在其中编写并运行Servlet。

## Servlet实现
接下来记录一下怎么编写一个`Servlet`程序，到`Servlet`程序运行起来的全过程。

### 引入`Servlet`相关包
我感觉IDEA还是有点不太智能，明明配置了`Tomcat`了，都不给我自动引入`Servlet`包，导致在IDEA中建立Servlet使用javax.servlet.http.HttpServlet等类时，出现了如下错误：
![image.png](http://upload-images.jianshu.io/upload_images/8869373-dd315ca14262f05b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

原因：IntelliJ IDEA 没有导入 `servlet-api.jar` 这个.jar包，需要手动导入。

导入步骤如下：选中项目，右击选择“Open Modules Settings”，选择“Libraries”，点击“+”，选“Java”；在弹出的窗口中选择tomcat所在的目录，在lib目录下找到`servlet-api.jar`这个jar包导入完成即可。

![image.png](http://upload-images.jianshu.io/upload_images/8869373-d7bbd56167919701.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


### 编写`Servlet`源文件
在src目录下新建HelloWorld.java，并编写一下代码并进行编译：
代码如下：
```java
import javax.servlet.ServletException;  
import javax.servlet.http.HttpServlet;  
import javax.servlet.http.HttpServletRequest;  
import javax.servlet.http.HttpServletResponse;  
import java.io.IOException;  
import java.io.PrintWriter;  
  
public class HelloWorld extends HttpServlet {  
private String message;  
  
    @Override  
    public void init() throws ServletException {  
    message = "Hello world, this message is from servlet!";  
    }  
  
    @Override  
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {  
        //设置响应内容类型  
    resp.setContentType("text/html");  
  
        //设置逻辑实现  
    PrintWriter out = resp.getWriter();  
    out.println("<h1>" + message + "</h1>");  
    }  
  
    @Override  
    public void destroy() {  
    super.destroy();  
    }  
} 
```

编译后会发现在classes目录下生成了HelloWorld.class文件

![image.png](http://upload-images.jianshu.io/upload_images/8869373-553a1f7765e86b03.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 部署`servlet`
#### 方法1
在WEB-INF目录下web.xml文件的<web-app>标签中添加如下内容：
```xml
<servlet>  
    <servlet-name>HelloWorld</servlet-name>  
    <servlet-class>HelloWorld</servlet-class>  
</servlet>  
  
<servlet-mapping>  
    <servlet-name>HelloWorld</servlet-name>  
    <url-pattern>/HelloWorld</url-pattern>  
</servlet-mapping>  
```

#### 方法2
（反正我自己测试是没有成功的）
在HelloWorld文件的类前面加上：@WebServlet("/HelloWorld")

### 运行Servlet
点击运行按钮
![image.png](http://upload-images.jianshu.io/upload_images/8869373-4f50baf13ac0ad38.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

控制台出现successfully则tomcat服务启动成功！打开浏览器输入：localhost:8080/JavaWeb/HelloWorld即可查看servlet运行状态了.

![image.png](http://upload-images.jianshu.io/upload_images/8869373-cc5f316238045270.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 后记
作为一个写习惯了`PHP`和`Python`的人来说，刚刚转到`Java`还是有各种不适应的，还好Java和我最喜欢写的C#语法很相近，所以上手也不是很难，就是各种环境配置好麻烦= =...


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)