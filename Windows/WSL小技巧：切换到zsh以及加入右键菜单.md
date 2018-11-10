## 切换到zsh
### 说明
在 Windows Subsystem for Linux 中，执行 chsh -s /bin/zsh 并不能成功地将默认 shell 修改为 zsh。在打开 WSL 时，默认 shell 仍然为 bash。 这是因为WSL 在启动时并没有执行 login 相关的组件，而这些组件和默认 shell 有关。Microsoft 已经知晓了这个问题，但并没有计划去解决。

### 方法
我们可以通过一个简易的 workaround 可以使在打开 WSL 时同时打开 zsh。
在 ~/.bashrc 中添加
```bash	
bash -c zsh
```

### 参考资料
https://github.com/Microsoft/WSL/issues/477

## 加入右键菜单
1. 打开运行，输入 `regedit` 运行注册表编辑器

2. 找到注册表中这个文件夹`\HKEY_CLASSES_ROOT\Directory\Background\shell\`

3. 选中shell这个文件夹右键新建一个项，双击默认这个值，改为`WSL Shell Here`，这个是右键菜单显示出来的名字

4. 在默认下面加一个字符串值，名称为`Icon`，双击将它的值改为你想要的图标的地址，可以是`.ico`和`.exe`文件

5. 在 `WSL Shell Here` 下新建一个项，项名称为`command`，将这个项的默认的值改为Ubuntu的exe文件地址，我的是`"C:\Windows\System32\bash.exe"`，注意两边要双引号

![外出中。只能用笔记本上的Windows啦](https://upload-images.jianshu.io/upload_images/8869373-9d478424db87c804.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>Ps: 为什么今天的截图是这样的呢 = =.. 
原因：外出中。只能用笔记本上的Windows啦


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)