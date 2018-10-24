## 先看代码
```python
def add(x: int, y: int) -> int:
    return x + y
```

没用过类型注解(Type Annotations)的同学可能咋一看有点迷糊，其实上面这段代码和下面这个代码是一样的。

```python
def add(x, y):
    return x + y
```


## 类型注解介绍
我们知道 Python 是一种动态语言，变量以及函数的参数是不区分类型。
Python解释器会在运行的时候动态判断变量和参数的类型，这样的好处是编写代码速度很快，很灵活，但是坏处也很明显，不好维护，可能代码写过一段时间重新看就很难理解了，因为那些变量、参数、函数返回值的类型，全都给忘记了。
而且当你在读别人的代码的时候，也无法一眼看出变量或者参数的类型，经常要自己推敲，这样给学习带来了很大的障碍。

所以Python3里有了这个新特性，可以给参数、函数返回值和变量的类型加上注解，不过这个仅仅是注释而已，对代码的运行来说没有任何影响，变量的真正类型还是会有Python解释器来确定，你所做的只是在提高代码的可读性，仅此而已。


## 看代码
```python
def add(x: int, y: int) -> int:
    return x + y


def area_calculation(radius: float) -> float:
    # 变量类型注解需要 py3.6 以上版本
    # Var Type Annotations need python 3.6 and later
    pi: float = 3.1415926
    return radius * radius * pi


if __name__ == '__main__':
    print(add(1, 2))
    print(add.__annotations__)
    print(area_calculation(2))
    print(area_calculation.__annotations__)
```

运行结果：
```
3
{'x': <class 'int'>, 'y': <class 'int'>, 'return': <class 'int'>}
12.5663704
{'radius': <class 'float'>, 'return': <class 'float'>}
```

这里调用了函数的`__annotations__`属性，通过这个属性可以看到参数和返回值类型的注解。


## 测试注解的正确性
前面说了，这个注解仅仅起到了注释的作用，不会影响代码的执行，所以即使你类型注解写错了，程序运行的时候还是会按照正确的类型去运行。
然后，Python提供了一个工具方便我们测试代码里的类型注解正确性，`mypy`

首先安装：
```
pip install mypy
```

使用测试：
```
mypy filename.py
```

如果没有错误则没有输出，如果有错误则会有相应输出，如
```
$ mypy demo.py
demo.py:14: error: Incompatible return value type (got "float", expected "int")
```


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)
