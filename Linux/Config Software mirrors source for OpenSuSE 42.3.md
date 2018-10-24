I just wrote a shell file to finish it.

```bash
# Disable the system source
sudo zypper mr -da

# Add aliyun mirrors
sudo zypper addrepo -f http://mirrors.aliyun.com/opensuse/update/leap/42.3/non-oss/ openSUSE-42.3-Update-Non-Oss
sudo zypper addrepo -f http://mirrors.aliyun.com/opensuse/distribution/leap/42.3/repo/oss/ openSUSE-42.3-Oss
sudo zypper addrepo -f http://mirrors.aliyun.com/opensuse/distribution/leap/42.3/repo/non-oss/ openSUSE-42.3-Non-Oss
sudo zypper addrepo -f http://mirrors.aliyun.com/packman/openSUSE_Leap_42.3/ openSUSE-42.3-packman

# refresh
sudo zypper ref

# Update
# sudo zypper up
```


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)