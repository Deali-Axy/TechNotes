## 错误信息
```
Argument for @NotNull parameter 'message' of com/android/tools/idea/gradle/project/sync/GradleSyncState.syncFailed must not be null java.lang.IllegalArgumentException: Argument for @NotNull parameter 'message' of com/android/tools/idea/gradle/project/sync/GradleSyncState.syncFailed must not be null at com.android.tools.idea.gradle.project.sync.GradleSyncState.$$$reportNull$$$0(GradleSyncState.java) at com.android.tools.idea.gradle.project.sync.GradleSyncState.syncFailed(GradleSyncState.java) at com.android.tools.idea.gradle.project.sync.idea.IdeaSyncPopulateProjectTask.doPopulateProject(IdeaSyncPopulateProjectTask.java:135) at com.android.tools.idea.gradle.project.sync.idea.IdeaSyncPopulateProjectTask.populate(IdeaSyncPopulateProjectTask.java:97) at com.android.tools.idea.gradle.project.sync.idea.IdeaSyncPopulateProjectTask.access$000(IdeaSyncPopulateProjectTask.java:39) at com.android.tools.idea.gradle.project.sync.idea.IdeaSyncPopulateProjectTask$1.run(IdeaSyncPopulateProjectTask.java:86) at com.intellij.openapi.progress.impl.CoreProgressManager$TaskRunnable.run(CoreProgressManager.java:750) at com.intellij.openapi.progress.impl.CoreProgressManager.lambda$runProcess$1(CoreProgressManager.java:157) at com.intellij.openapi.progress.impl.CoreProgressManager.registerIndicatorAndRun(CoreProgressManager.java:580) at com.intellij.openapi.progress.impl.CoreProgressManager.executeProcessUnderProgress(CoreProgressManager.java:525) at com.intellij.openapi.progress.impl.ProgressManagerImpl.executeProcessUnderProgress(ProgressManagerImpl.java:85) at com.intellij.openapi.progress.impl.CoreProgressManager.runProcess(CoreProgressManager.java:144) at com.intellij.openapi.progress.impl.CoreProgressManager$4.run(CoreProgressManager.java:395) at com.intellij.openapi.application.impl.ApplicationImpl$1.run(ApplicationImpl.java:305) at java.util.concurrent.Executors$RunnableAdapter.call(Executors.java:511) at java.util.concurrent.FutureTask.run(FutureTask.java:266) at java.util.concurrent.ThreadPoolExecutor.runWorker(ThreadPoolExecutor.java:1142) at java.util.concurrent.ThreadPoolExecutor$Worker.run(ThreadPoolExecutor.java:617) at java.lang.Thread.run(Thread.java:745)
```

## 情境
之前这几个android项目是在windows上编写的，切换到linux环境之后继续做开发。
我把这个分区挂载到 `/media/user/data` 之后，为了方便使用，创建了一个软链接 `/home/user/data/`
打开项目是从这个软链接打开的，结果每次都build不了，我还以为我电脑出了什么问题，Google无果。

偶然在StackOverFlow看到一个奇葩问题，`# [Android Studio build error on NTFS partition](https://stackoverflow.com/questions/52721989/android-studio-build-error-on-ntfs-partition)`

>I'm having problems building apps on Android Studio. Things work fine when the project is on my ext4 partition, but when I created a new one on my NTFS, I encountered this:

>The error disappeared when I restarted Android Studio, but after that I still cannot run my app (the project structure in the sidebar is not displayed properly).
>I'm using Android Studio 3.2 on Ubuntu 18.04.1.

下面有一个回答：
>I figured it out. (By mistake, to be honest...)
>
>Let's say you have an NTFS partition mount at /mnt/ntfs, and your project is at /mnt/ntfs/projects/project. Your home partition (ext4) is mounted at /home, your home directory is /home/user and you have a symbolic link at /home/user/projects that points to /mnt/ntfs/projects.
>
>The reason I (and hopefully you too) have encountered this error is that when using Android Studio's "Open Project..." option, I provided the symbolic link (/home/user/projects/project). When trying to provide the real path (/mnt/ntfs/projects/project) the gradle sync succeeded.
>
>So to fix this for now, simply provide the real path. However, this should probably be addressed by IntelliJ or the developers of Gradle.


## 解决
所以就解决了呀，不要用软链接打开就行了，Gradle不支持软链接文件夹。无语


![](https://upload-images.jianshu.io/upload_images/8869373-83b21c9677032224.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## About
![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------
了解更多有趣的操作请关注我的微信公众号：DealiAxy
每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)