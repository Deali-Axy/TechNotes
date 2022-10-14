## 解决方法
首先，打开WSL是不需要输入密码的，如果你打开WSL时的默认用户不是root，请按照一下方式修改。

### 修改默认登录WSL用户
以管理员权限启动Powershell
```python
 lxrun /setdefaultuser root
```

此时重新打开WSL就是root用户了，并且不需要密码。

然后输入以下命令修改密码。
```python
passwd root
```
