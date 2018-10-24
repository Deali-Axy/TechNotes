## 关于部分推文使用英文写作
最近把公众号推给Github上认识的外国朋友，他们虽然关注了，但是表示并不能看懂中文，所以我答应他们试试看用英文写作，一来避免他们觉得无聊取关（逃，二来练习一下惨不忍睹的英文 = =...，文章中难免错漏百出，请朋友们多多包涵和给予指正，谢谢！

## Why am I writing in English
Recently I recommended my WeChat official account and blog to some friends, but they are not able to read Chinese, so I would like to try to write blogs in English and having more communication with them.

## Install virtual environment
If you want to use `virtualenv` on a path which contain spaces, you should install [win32api](http://sourceforge.net/projects/pywin32/)

Using pip to install `virtualenv`
```python
pip install virtualenv
```

## Create virtual environment
Open shell and `cd` to your project path.
Then use the following command to create virtual environment.
```python
virtualenv env_name
```
env_name is the name of the virtual environment, such as `env`

## Activate the virtual environment
At first you should know your virtualenv name, usually it's `env`
then change the dir to your project root.
Command:
```python
env\scripts\activate
```
after that, a <env> sign will display before the cmd to show that you enter the virtualenv successfully.

Now you can install any python packages in the virtualenv and do some other operations.

## Quit the virtual environment
enter
```python
deactivate
```
to quit the virtual environment.


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)