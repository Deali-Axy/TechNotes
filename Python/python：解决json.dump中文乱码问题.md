## Python2.7
```python
# -*- coding: utf-8 -*-
m = {'a' : '你好'}

print m
=>{'a': '\xe4\xbd\xa0\xe5\xa5\xbd'}

print json.dumps(m)
=>{"a": "\u4f60\u597d"}

print json.dumps(m,ensure_ascii=False)
=>{"a": "浣犲ソ"}

print json.dumps(m,ensure_ascii=False).decode('utf8').encode('gb2312')
=>{"a": "你好"}
```


## Python3
```python
print json.dumps(m,ensure_ascii=False)

=>{"a": "你好"}
```


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)
