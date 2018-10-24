## 前言
对初学者来说，Python确实简单好用，毕竟动态类型语言，不用定义就可以拿来用，类型之间随意转换简直不要太方便，因此Python用来写写小脚本，爬虫程序什么的，没什么问题。
不过，一旦用来开发稍微大型一点的项目，例如搭建一个Web应用，就会遇到一些问题，一般缺乏经验的人都会陷入某些坑中。= =...

## 坑
先说坑，函数参数类型是一坑，类与类的对象这又是一坑。
虽然之前用其他静态类型语言（例如C#/Java）的时候都搞明白了的，但是换了个动态类型的Python，总会有点令人疑惑。

## 例子
让我用代码来举例子。

首先定义两个类，都继承自内置的 `Exception` 类，说明这两个类是异常类。
```python
class Error1(Exception):
    def __str__(self):
        return 'error1'


class Error2(Exception):
    def __init__(self):
        print('error2 init')

    def __str__(self):
        return 'error2'
```

然后再定义处理异常的方法：
```python
def error(err: object):
    print(f'err:{err.__str__()}')

def error2(err: Exception):
    print(err)
```

接着是测试代码：
```python
try:
    raise Error1
except Error1 as e:
    error(e)

if 1 != 2:
    error(Error2)
```

运行结果：
```bash
err:error1
  File "/home/test.py", line 33, in <module>
    error(Error2)
  File "/home/test.py", line 19, in error
    print(f'err:{err.__str__()}')
TypeError: __str__() missing 1 required positional argument: 'self'
```
第一个`error()`的结果没毛病，可是第二个接抛出异常了，看看错误信息先：`TypeError: __str__() missing 1 required positional argument: 'self'`，没有提供`self`参数，因为这个参数不是`Error2`类的实例，所以自然没有`self`参数。

到这里应该有点明白了，就是调用`error(Error2)`这个方法的时候，传入的`Error2`参数其实是`Error2`这个类型本身，并不是它的对象，有点神奇，居然把一个类型当成参数用了。

那要怎么解决呢，很简单，传入`Error2`的对象就行了。
代码如下：
```python
if 1 != 2:
    error(Error2())
```

运行结果
```bash
error2 init
err:error2
```

没毛病了，上面代码还有个`error2`方法没有使用呢，来试试看。

```python
error2(Error2)
error2(Error2())
```
运行结果
```bash
<class '__main__.Error2'>
error2 init
error2
```

可以看出，使用`print(Object)`的时候，如果是一个类型，就打印这个类型的信息，是类型的对象时，才会打印`Object.__str__()`返回的结果。
搞明白了之后其实很简单，但是Python对函数参数没有限制，即使给方法加了`type hints`，也只是起到了提示作用，不会做真正的限制或者是隐式转换，所以有时候代码写久了头晕脑胀，就容易掉进动态类型坑里了 T_T...



国际惯例，放图片：
![哈哈哈](https://upload-images.jianshu.io/upload_images/8869373-315041ba0d7aea63.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)