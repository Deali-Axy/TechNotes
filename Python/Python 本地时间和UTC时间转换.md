## 代码
```python
import time
import datetime
def utc2local(utc_st):
    """UTC时间转本地时间（+8: 00）"""
    now_stamp = time.time()
    local_time = datetime.datetime.fromtimestamp(now_stamp)
    utc_time = datetime.datetime.utcfromtimestamp(now_stamp)
    offset = local_time - utc_time
    local_st = utc_st + offset
    return local_st


def local2utc(local_st):
    """本地时间转UTC时间（-8: 00）"""
    time_struct = time.mktime(local_st.timetuple())
    utc_st = datetime.datetime.utcfromtimestamp(time_struct)
    return utc_st

if __name__ == '__main__':
    year = int(time.strftime("%Y"))
    month = int(time.strftime("%m"))
    day = int(time.strftime("%d"))
    hour = int(time.strftime("%H"))
    minute = int(time.strftime("%M"))
    second = int(time.strftime("%S"))
    local_time = datetime.datetime(year, month, day, hour, minute, second)
    utc_time = local2utc(local_time)
```

![image.png](https://upload-images.jianshu.io/upload_images/8869373-480251bc54e0f626.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
