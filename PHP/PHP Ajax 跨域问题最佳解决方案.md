## 前言
Ajax跨域问题在开发中非常常见。
例如网页的域名是client.abc.com，而请求的域名是server.abc.com。
如果直接使用ajax访问，会有以下错误：

    XMLHttpRequest cannot load http://server.abc.com/server.php. No 'Access-Control-Allow-Origin' header is present on the requested resource.Origin 'http://client.abc.com' is therefore not allowed access.

## 最简单的解决
```php
header('content-type:application/json;charset=utf8');  
// 指定允许其他域名访问  
header('Access-Control-Allow-Origin:*');  
// 响应类型  
header('Access-Control-Allow-Methods:POST');  
// 响应头设置  
header('Access-Control-Allow-Headers:x-requested-with,content-type');
```

## 1、允许单个域名访问

指定某域名`client.abc.com`跨域访问，则只需在`server.abc.com/a.php`文件头部添加如下代码：

```php
header('Access-Control-Allow-Origin:http://client.abc.com');
```

## 2、允许多个域名访问

指定多个域名，在`server.php`文件头部添加如下代码：

```php
$origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';
//$_SERVER['HTTP_ORIGN']获得请求访问的域名

$allow_origin = array(
  'http://client.abc.com',
  'http://client2.abc.com'
);

if(in_array($origin, $allow_origin)){
header('Access-Control-Allow-Origin:'.$origin);
}
```

## 3、允许所有域名访问

允许所有域名访问则只需在php文件头部添加如下代码：

```php
header('Access-Control-Allow-Origin:*');
```


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)