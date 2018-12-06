## 前言
（先来一个微笑脸）这个问题已经困扰我好久了，之前各种搜索无果，得到的解决方案无非就是 `AppCompact` 和 `CardView` 包的版本不一样云云，然而我根本没有这个问题。（怕是不把我Gradle看在眼里？）

## 问题

![](https://upload-images.jianshu.io/upload_images/8869373-198a79198c023179.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
就是这么个界面，用到了RecycleView和Cardview，但是在SDK 23以下都不行，官方已经写明这个组件是支持到SDK9还是10的，反正基本是个android手机就可以，然而，它就是不行，在SDK24以上都没问题，我自己用的手机都没问题，就是在模拟器上和几个旧版本的测试机，都闪退了。
我真的想掐死这个Cardview。。


## 解决
今天晚上花了两个小时在查资料上，翻了Google的官方文档，下载了几个官方Samples，然而并没有发现什么有价值的解决方案，然后继续在Stack Overflow上搜索，Stack Overflow真的是程序员居家出行必备的好帮手，最后终于功夫不负有心人，找到了和我一样遇到相同问题的网友。

具有参考意义的是这两个回答：

https://stackoverflow.com/questions/38132148/error-while-inflating-class-android-support-v7-widget-cardview
>Try this it will help you remove this android:foreground="?android:attr/selectableItemBackground"
```xml
<LinearLayout xmlns:android="http://schemas.android.com/apk/res/android"
android:layout_width="wrap_content"
android:layout_height="wrap_content"
xmlns:card_view="http://schemas.android.com/apk/res-auto"
android:paddingLeft="4dp"
android:paddingRight="4dp"
android:paddingBottom="2dp">

<android.support.v7.widget.CardView
    android:layout_width="match_parent"
    android:layout_height="wrap_content"
    android:id="@+id/cardview"
    card_view:cardBackgroundColor="@android:color/white"
    card_view:cardElevation="2dp"
    card_view:cardMaxElevation="2dp"
    card_view:cardUseCompatPadding="true">

    <RelativeLayout
        android:layout_width="match_parent"
        android:layout_height="match_parent"
        android:orientation="vertical">

....here i have a bunch of other layout elements
         </RelativeLayout>
    </android.support.v7.widget.CardView>
</LinearLayout>
```

这个回答让我把 android:foreground 删掉，我照着删掉了，但是还是不行，但是确实SDK 23以下用这个有兼容性问题。


然后是这个：
https://stackoverflow.com/questions/28541920/error-when-inflating-cardview
>From the official notes of [appcompat v21](http://android-developers.blogspot.be/2014/10/appcompat-v21-material-design-for-pre.html)

他让我去看一下官方文档：
>Why are there no ripples on pre-Lollipop? A lot of what allows RippleDrawable to run smoothly is Android 5.0’s new RenderThread. To optimize for performance on previous versions of Android, we've left RippleDrawable out for now.

When trying to use ripple-drawables, you get errors on pre-lollipop (that's why it says line 2, it's the xml drawable). Use a different folder (drawable-v21) for ripples and use selectors in your normal drawables if you want a difference for different states.

Official support is not coming soon, I believe, because lollipop has a dedicated render-thread that no other version has.

意思就是 `android:stateListAnimator="@drawable/selector_elevation"`这个不行，在旧版本的系统上不支持。。
然后还是新的支持coming soon？我不信。

所以最后，我把这两行代码都删掉了，感人的一幕出现了，终于可以了~~~
删掉的代码，shit！
```xml
android:stateListAnimator="@drawable/selector_elevation"
android:foreground="?android:attr/selectableItemBackground"
```


## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)