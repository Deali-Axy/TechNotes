## NPM
>npm（全称 Node Package Manager，即“node包管理器”）是Node.js默认的、以JavaScript编写的软件包管理系统。
>npm可以管理本地项目的所需模块并自动维护依赖情况，也可以管理全局安装的JavaScript工具。

但是由于npm的源在国外，所以国内使用起来动辄10kb/s，甚至根本下载不了，所以使用国内镜像源替代官方源就很有必要了。

## 国内源

### 淘宝npm镜像

*   搜索地址：[](http://npm.taobao.org/)[http://npm.taobao.org/](http://npm.taobao.org/)
*   registry地址：[](http://registry.npm.taobao.org/)[http://registry.npm.taobao.org/](http://registry.npm.taobao.org/)

### cnpmjs镜像

*   搜索地址：[](http://cnpmjs.org/)[http://cnpmjs.org/](http://cnpmjs.org/)
*   registry地址：[](http://r.cnpmjs.org/)[http://r.cnpmjs.org/](http://r.cnpmjs.org/)

## 配置方法
有很多方法来配置npm的registry地址，下面根据不同情境列出几种比较常用的方法。以淘宝npm镜像举例：

### 临时配置

```python
npm --registry https://registry.npm.taobao.org install express
```

### 保存配置
推荐用这个，毕竟每次使用npm都配置一次太麻烦了。
```python
npm config set registry https://registry.npm.taobao.org
```

配置后可通过下面方式来验证是否成功
```python
npm config get registry
```
或
```python
npm info express
```

### 通过cnpm使用
```python
npm install -g cnpm --registry=https://registry.npm.taobao.org
```

使用
```python
cnpm install expresstall express
```

---------------

了解更多有趣的操作请关注我的微信公众号：DealiAxy

![公众号：DealiAxy](http://upload-images.jianshu.io/upload_images/8869373-47d427c3652d113c.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)