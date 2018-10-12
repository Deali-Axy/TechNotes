## 变量类型
PHP7版本函数的参数和返回值增加了类型限定。
为什么PHP要加入类型呢？实际上此项特性是为了PHP7.1版本的JIT特性做准备，增加类型后PHP Jit可以准确判断变量类型，生成最佳的机器指令。
*（针对密集运算的优化）*

使用示例
```php
function test(int $a, string $b, array $c) : int {
    //code
}
```

## 错误异常
在过去，PHP程序出错之后Zend引擎会发生致命错误并终止程序运行，PHP7可以使用`try/catch`捕获错误。

```php
try{
    not_exists_func();
}catch(EngineException $e){
    echo "Exception: {$e->getMessage()}\n";
}
```


## PHP7的性能优化
### zval使用栈内存
在Zend引擎和扩展中，经常要创建一个PHP的变量，底层就是一个zval指针。
之前的版本都是通过`MAKE_STD_ZVAL`动态的从堆上分配一个zval内存，而PHP7可以直接使用栈内存。
好处：节省分配内存的花销

**底层代码**
```c
//php5
zval *val;
MAKE_STD_ZVAL(val);

//php7
zval val;
```

### zend_string存储hash值，array查询不再需要重复计算hash
PHP7为字符串单独创建了新类型叫做`zend_string`，除了`char *`指针和长度之外，
增加了一个hash字段，用于保存字符串的hash值。
数组的键值查找不需要反复计算hash值。


```c++
struct _zend_string{
    zend_refcounted     gc;
    zend_ulong          h;
    size_t              len;
    char                val[1];
};
```


### `hashtable`桶内直接存数据，减少了内存申请次数，提升看了Cache命中率和内存访问速度
在之前版本的PHP中，在`array`里每插入一个数据，就要申请一次内存，并且使内存存储在不同的内存页上，访问的时候命中率会降低。

### `zend_parse_parameters`改为宏实现，性能提升5%
提升PHP扩展的性能

### 新增加4种`OPCODE`: `call_user_function`, `is_int/string/array`, `strlen`, `defined` 4个函数变为`PHP OpCode`指令，速度更快

### 其他更多性能优化
- 基础类型`int`, `float`, `bool`等改为直接进行值拷贝
- 排序算法改进
- `PCRE with Jit`(正则表达式)
- `execute_data`和`opline`使用全局寄存器
- 使用`gdb 4.8`的`PGO`功能




## PHP7 Jit
### PHP7.0-final版本不会携带Jit特性
Jit使Just in Time得缩写，表示运行时将指令转为二进制的机器码。
对于计算密集型的程序，Jit可以将PHP的OpCode直接转换为机器码，大幅提升性能。
PHP开发组自己重启Jit开发计划，预计PHP7.1版本会带有Jit特性

### 为什么PHP7.0没有Jit
Jit对于实际项目，如WordPress没有太大的性能提升


## PHP内置开发测试服务器
```bash
cd ~/php
php -S 0.0.0.0:8080
```
即可以`~/php`为网站根目录启动服务器。