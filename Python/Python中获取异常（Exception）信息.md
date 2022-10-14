## 前言
异常信息的获取对于程序的调试非常重要，可以有助于快速定位有错误程序语句的位置。下面介绍几种python中获取异常信息的方法，这里获取异常（Exception）信息采用try...except...程序结构。如下所示

```python
try:
　　...
except Exception, e:
　　...
```


### 1、str(e)

返回字符串类型，只给出异常信息，不包括异常信息的类型，如1/0的异常信息

'integer division or modulo by zero'

### 2、repr(e)

给出较全的异常信息，包括异常信息的类型，如1/0的异常信息

"ZeroDivisionError('integer division or modulo by zero',)"

### 3、e.message

获得的信息同str(e)

### 4、采用traceback模块

需要导入traceback模块，此时获取的信息最全，与python命令行运行程序出现错误信息一致。使用 `traceback.print_exc()` 打印异常信息到标准错误，就像没有获取一样，或者使用 `traceback.format_exc()` 将同样的输出获取为字符串。你可以向这些函数传递各种各样的参数来限制输出，或者重新打印到像文件类型的对象。


## 参考资料
https://www.cnblogs.com/klchang/p/4635040.html