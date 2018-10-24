## 前言
最近在服务器上部署项目的时候，用pip安装库，结果提示可以升级，那我就按照提示升级了pip，结果pip就用不了了。

错误信息如下：
```python
Traceback (most recent call last):
  File "/usr/bin/pip3", line 9, in <module>
    from pip import main
ImportError: cannot import name 'main'
```

## 解决方法
当然是重新安装一次pip咯
```bash
sudo python3 -m pip uninstall pip && sudo apt install python3-pip --reinstall
```
