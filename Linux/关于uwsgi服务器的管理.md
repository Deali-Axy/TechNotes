## 前言
使用Django开发项目好是好，就是部署的时候太麻烦，使用Uwsgi服务器的话，每次修改了代码，都需要重新启动服务器才可以生效。然后uwsgi服务器的重启也挺麻烦。

>看了一下官网的文档，最好是把uwsgi安装到venv虚拟环境里面，这样的话在 `ps aux` 的时候容易区分啦。

## 查看uwsgi进程
```bash
ps -aux | grep uwsgi
```
![uwsgi进程](https://upload-images.jianshu.io/upload_images/8869373-965a7fd10e21db26.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


## 结束原uwsgi进程
```bash
kill -9 27543
```

## 结论
这样还是麻烦，要手动去找到uwsgi的进程然后去结束，接下来应该找找有什么便捷的方式，例如把uwsgi加入service，让systemctl来管理，不过官方文档里说不建议这样的操作？


## 补充
还有几个其他的方式，可以简化uwsgi服务器的管理操作。
- **supervisor管理uwsgi服务**
>Supervisor（[http://supervisord.org/](http://supervisord.org/)）是用Python开发的一个client/server服务，是Linux/Unix系统下的一个进程管理工具，不支持Windows系统。它可以很方便的监听、启动、停止、重启一个或**多个**进程。用Supervisor管理的进程，当一个进程意外被杀死，supervisort监听到进程死后，会自动将它重新拉起，很方便的做到进程自动恢复的功能，不再需要自己写shell脚本来控制。

参考资料：
    - https://blog.csdn.net/qq_32402917/article/details/80169366
    - https://blog.csdn.net/windy135/article/details/78945375

- **Emperor模式**
>uWSGI可以运行在’emperor’模式。在这种模式下，它会监控uWSGI配置文件目录，然后为每个它找到的配置文件生成实例 (‘vassals’)。
>每当修改了一个配置文件，emperor将会自动重启 vassal.

参考资料：http://uwsgi-docs-zh.readthedocs.io/zh_CN/latest/tutorials/Django_and_nginx.html


*国际惯例，文章末尾放图片做封面啦。*
![](https://upload-images.jianshu.io/upload_images/8869373-aba160d66b906207.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)