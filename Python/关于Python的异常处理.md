## 前言
异常处理在任何一门编程语言里都是值得关注的一个话题，良好的异常处理可以让你的程序更加健壮，清晰的错误信息更能帮助你快速修复问题。在Python中，和部分高级语言一样，使用了try/except/finally语句块来处理异常，如果你有其他编程语言的经验，实践起来并不难。
Python 中（至少）有两种错误：语法错误和异常（ syntax errors 和 exceptions ）。下面稍微介绍一下，

## 语法错误和异常
**语法错误**
语法错误是最明显的错误，遇到这种错误程序根本无法运行。
例如
```python
print("hello"
```
上面这个代码就会引发错误，因为少了一个右括号。

还有下面这个：
```python
if a > b
    print(a)
```
这个也不行，因为if后面没有加冒号。
一般来说，熟悉了语法之后很少会出现这类错误。

**异常**
即使一条语句或表达式在语法上是正确的，当试图执行它时也可能会引发错误。运行期检测到的错误称为异常，大多数异常都不会被程序处理，需要我们自己去捕捉和处理。
错误信息的最后一行指出发生了什么错误。异常也有不同的类型，异常类型做为错误信息的一部分显示出来：示例中的异常分别为 零除错误（ [ZeroDivisionError](https://docs.python.org/3/library/exceptions.html#ZeroDivisionError) ） ，命名错误（ [NameError](https://docs.python.org/3/library/exceptions.html#NameError)） 和 类型错误（ [TypeError](https://docs.python.org/3/library/exceptions.html#TypeError) ）。打印错误信息时，异常的类型作为异常的内置名显示。对于所有的内置异常都是如此，不过用户自定义异常就不一定了（尽管这是一个很有用的约定）。标准异常名是内置的标识（没有保留关键字）。



## python标准异常
| 异常名称                  | 描述                                               |
| ------------------------- | -------------------------------------------------- |
| BaseException             | 所有异常的基类                                     |
| SystemExit                | 解释器请求退出                                     |
| KeyboardInterrupt         | 用户中断执行(通常是输入^C)                         |
| Exception                 | 常规错误的基类                                     |
| StopIteration             | 迭代器没有更多的值                                 |
| GeneratorExit             | 生成器(generator)发生异常来通知退出                |
| StandardError             | 所有的内建标准异常的基类                           |
| ArithmeticError           | 所有数值计算错误的基类                             |
| FloatingPointError        | 浮点计算错误                                       |
| OverflowError             | 数值运算超出最大限制                               |
| ZeroDivisionError         | 除(或取模)零 (所有数据类型)                        |
| AssertionError            | 断言语句失败                                       |
| AttributeError            | 对象没有这个属性                                   |
| EOFError                  | 没有内建输入,到达EOF 标记                          |
| EnvironmentError          | 操作系统错误的基类                                 |
| IOError                   | 输入/输出操作失败                                  |
| OSError                   | 操作系统错误                                       |
| WindowsError              | 系统调用失败                                       |
| ImportError               | 导入模块/对象失败                                  |
| LookupError               | 无效数据查询的基类                                 |
| IndexError                | 序列中没有此索引(index)                            |
| KeyError                  | 映射中没有这个键                                   |
| MemoryError               | 内存溢出错误(对于Python 解释器不是致命的)          |
| NameError                 | 未声明/初始化对象 (没有属性)                       |
| UnboundLocalError         | 访问未初始化的本地变量                             |
| ReferenceError            | 弱引用(Weak reference)试图访问已经垃圾回收了的对象 |
| RuntimeError              | 一般的运行时错误                                   |
| NotImplementedError       | 尚未实现的方法                                     |
| SyntaxError               | Python 语法错误                                    |
| IndentationError          | 缩进错误                                           |
| TabError                  | Tab 和空格混用                                     |
| SystemError               | 一般的解释器系统错误                               |
| TypeError                 | 对类型无效的操作                                   |
| ValueError                | 传入无效的参数                                     |
| UnicodeError              | Unicode 相关的错误                                 |
| UnicodeDecodeError        | Unicode 解码时的错误                               |
| UnicodeEncodeError        | Unicode 编码时错误                                 |
| UnicodeTranslateError     | Unicode 转换时错误                                 |
| Warning                   | 警告的基类                                         |
| DeprecationWarning        | 关于被弃用的特征的警告                             |
| FutureWarning             | 关于构造将来语义会有改变的警告                     |
| OverflowWarning           | 旧的关于自动提升为长整型(long)的警告               |
| PendingDeprecationWarning | 关于特性将会被废弃的警告                           |
| RuntimeWarning            | 可疑的运行时行为(runtime behavior)的警告           |
| SyntaxWarning             | 可疑的语法的警告                                   |
| UserWarning               | 用户代码生成的警告                                 |

## 异常处理语句 try...excpet...finally
示例代码
```python
def div(a, b):
    try:
        print(a / b)
    except ZeroDivisionError:
        print("Error: b should not be 0 !!")
    except Exception as e:
        print("Unexpected Error: {}".format(e))
    else:
        print('Run into else only when everything goes well')
    finally:
        print('Always run into finally block.')

# tests
div(2, 0)
div(2, 'bad type')
div(1, 2)

# Mutiple exception in one line
try:
    print(a / b)
except (ZeroDivisionError, TypeError) as e:
    print(e)

# Except block is optional when there is finally
try:
    open(database)
finally:
    close(database)

# catch all errors and log it
try:
    do_work()
except:    
    # get detail from logging module
    logging.exception('Exception caught!')
    
    # get detail from sys.exc_info() method
    error_type, error_value, trace_back = sys.exc_info()
    print(error_value)
    raise
```

### 总结如下
1. except语句不是必须的，finally语句也不是必须的，但是二者必须要有一个，否则就没有try的意义了。
2. except语句可以有多个，Python会按except语句的顺序依次匹配你指定的异常，如果异常已经处理就不会再进入后面的except语句。
3. except语句可以以元组形式同时指定多个异常，参见实例代码。
4. except语句后面如果不指定异常类型，则默认捕获所有异常，你可以通过logging或者sys模块获取当前异常。
5. 如果要捕获异常后要重复抛出，请使用raise，后面不要带任何参数或信息。
6. 不建议捕获并抛出同一个异常，请考虑重构你的代码。
7. 不建议在不清楚逻辑的情况下捕获所有异常，有可能你隐藏了很严重的问题。
8. 尽量使用内置的异常处理语句来替换try/except语句，比如with语句，getattr()方法。

## 抛出异常 raise
如果你需要自主抛出异常一个异常，可以使用raise关键字，等同于C#和Java中的throw，其语法规则如下。
```python
raise NameError("bad name!")
```

raise关键字后面可以指定你要抛出的异常实例，一般来说抛出的异常越详细越好，Python在exceptions模块内建了很多的异常类型，通过使用dir()函数来查看exceptions中的异常类型，如下：
```python
import exceptions

print dir(exceptions)
# ['ArithmeticError', 'AssertionError'...]
```

## 自定义异常类型
Python中自定义自己的异常类型非常简单，只需要要从Exception类继承即可(直接或间接)：
```python
class SomeCustomException(Exception):
    pass

class AnotherException(SomeCustomException):
    pass
```
一般你在自定义异常类型时，需要考虑的问题应该是这个异常所应用的场景。如果内置异常已经包括了你需要的异常，建议考虑使用内置的异常类型。比如你希望在函数参数错误时抛出一个异常，你可能并不需要定义一个InvalidArgumentError，使用内置的ValueError即可。

## 经验案例
### 传递异常 re-raise Exception
捕捉到了异常，但是又想重新抛出它（传递异常），使用不带参数的raise语句即可：
```python
def f1():
    print(1/0)

def f2():
    try:
        f1()
    except Exception as e:
        raise  # don't raise e !!!

f2()
```
在Python2中，为了保持异常的完整信息，那么你捕获后再次抛出时千万不能在raise后面加上异常对象，否则你的trace信息就会从此处截断。以上是最简单的重新抛出异常的做法，也是推荐的做法。

还有一些技巧可以考虑，比如抛出异常前你希望对异常的信息进行更新。

```python
def f2():
    try:
        f1()
    except Exception as e:
        e.args += ('more info',)
        raise
```

Python3对重复传递异常有所改进，你可以自己尝试一下，不过建议还是遵循以上规则。

### Exception 和 BaseException
当我们要捕获一个通用异常时，应该用`Exception`还是`BaseException`？我建议你还是看一下[ 官方文档说明](https://docs.python.org/2.7/library/exceptions.html#bltin-exceptions)，这两个异常到底有啥区别呢？ 请看它们之间的继承关系。
```python
BaseException
 +-- SystemExit
 +-- KeyboardInterrupt
 +-- GeneratorExit
 +-- Exception
      +-- StopIteration...
      +-- StandardError...
      +-- Warning...
```
从Exception的层级结构来看，BaseException是最基础的异常类，Exception继承了它。BaseException除了包含所有的Exception外还包含了SystemExit，KeyboardInterrupt和GeneratorExit三个异常。

由此看来你的程序在捕获所有异常时更应该使用Exception而不是BaseException，因为被排除的三个异常属于更高级别的异常，合理的做法应该是交给Python的解释器处理。

### except Exception as e和 except Exception, e
代码示例如下：

```python
try:
    do_something()
except NameError as e:  # should
    pass
except KeyError, e:  # should not
    pass
```
在Python2的时代，你可以使用以上两种写法中的任意一种。在Python3中你只能使用第一种写法，第二种写法已经不再支持。第一个种写法可读性更好，而且为了程序的兼容性和后期移植的成本，请你果断抛弃第二种写法。


### raise "Exception string"
把字符串当成异常抛出看上去是一个非常简洁的办法，但其实是一个非常不好的习惯。

```python
if is_work_done():
    pass
else:
    raise "Work is not done!" # not cool
```
上面的语句如果抛出异常，那么会是这样的：

```python
Traceback (most recent call last):
  File "/demo/exception_hanlding.py", line 48, in <module>
    raise "Work is not done!"
TypeError: exceptions must be old-style classes or derived from BaseException, not str
```

这在 Python2.4 以前是可以接受的做法，但是没有指定异常类型有可能会让下游没办法正确捕获并处理这个异常，从而导致你的程序难以维护。简单说，这种写法是是封建时代的陋习，应该扔了。

## 使用内置的语法范式代替try/except
Python 本身提供了很多的语法范式简化了异常的处理，比如for语句就处理了的StopIteration异常，让你很流畅地写出一个循环。

with语句在打开文件后会自动调用finally并关闭文件。我们在写 Python 代码时应该尽量避免在遇到这种情况时还使用try/except/finally的思维来处理。

```python
# should not
try:
    f = open(a_file)
    do_something(f)
finally:
    f.close()

# should 
with open(a_file) as f:
    do_something(f)
```
再比如，当我们需要访问一个不确定的属性时，有可能你会写出这样的代码：

```python
try:
    test = Test()
    name = test.name  # not sure if we can get its name
except AttributeError:
    name = 'default'
```
其实你可以使用更简单的getattr()来达到你的目的。
```python
name = getattr(test, 'name', 'default')
```

## 最佳实践
最佳实践不限于编程语言，只是一些规则和填坑后的收获。

- 只处理你知道的异常，避免捕获所有异常然后吞掉它们。
- 抛出的异常应该说明原因，有时候你知道异常类型也猜不出所以然。
- 避免在catch语句块中干一些没意义的事情，捕获异常也是需要成本的。
- 不要使用异常来控制流程，那样你的程序会无比难懂和难维护。
- 如果有需要，切记使用finally来释放资源。
- 如果有需要，请不要忘记在处理异常后做清理工作或者回滚操作。

## 本文参考资料
- 官方文档：https://docs.python.org/2.7/library/exceptions.html#bltin-exceptions
- https://segmentfault.com/a/1190000007736783
- http://www.pythondoc.com/pythontutorial3/errors.html
- http://www.runoob.com/python/python-exceptions.html
- https://betacat.online/


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)
