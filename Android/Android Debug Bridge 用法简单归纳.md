以下内容选自互联网

ADB，即 Android Debug Bridge，它是 Android开发/测试人员不可替代的强大工具，也是 Android设备玩家的好玩具。

注： 有部分命令的支持情况可能与 Android系统版本及定制 ROM 的实现有关。

基本用法

命令语法

adb 命令的基本语法如下：

adb [-d|-e|-s ]

如果只有一个设备/模拟器连接时，可以省略掉[-d|-e|-s ] 这一部分，直接使用adb 。

为命令指定目标设备

如果有多个设备/模拟器连接，则需要为命令指定目标设备。

参数含义

-d指定当前唯一通过 USB 连接的 Android设备为命令目标

-e指定当前唯一运行的模拟器为命令目标

-s 指定相应 serialNumber 号的设备/模拟器为命令目标

在多个设备/模拟器连接的情况下较常用的是-s  参数，serialNumber可以通过 adb devices命令获取。如：

$ adb devices

List of devices attached

cf264b8f device

emulator-5554 device

10.129.164.6:5555  device

输出里的 cf264b8f、emulator-5554和 10.129.164.6:5555即为 serialNumber。

比如这时想指定 cf264b8f这个设备来运行 adb 命令获取屏幕分辨率：

adb -s cf264b8f shell wm size

又如想给 10.129.164.6:5555这个设备安装应用（这种形式的 serialNumber 格式为 :，一般为无线连接的设备或 Genymotion等第三方 Android 模拟器）：

adb -s 10.129.164.6:5555 install test.apk

遇到多设备/模拟器的情况均使用这几个参数为命令指定目标设备，下文中为简化描述，不再重复。

启动/停止

启动 adb server 命令：

adb start-server

（一般无需手动执行此命令，在运行 adb 命令时若发现 adb server没有启动会自动调起。）

停止 adb server 命令：

adb kill-server

查看 adb 版本

命令：

adb version

示例输出：

Android Debug Bridge version 1.0.36

Revision 8f855a3d9b35-android

以 root 权限运行 adbd

adb 的运行原理是 PC端的 adb server 与手机端的守护进程 adbd建立连接，然后 PC 端的 adb client通过 adb server 转发命令，adbd接收命令后解析运行。

所以如果 adbd 以普通权限执行，有些需要 root权限才能执行的命令无法直接用 adb xxx执行。这时可以 adb shell然后 su后执行命令，也可以让 adbd 以 root权限执行，这个就能随意执行高权限命令了。

命令：

adb root

正常输出：

restarting adbd as root

现在再运行 adb shell，看看命令行提示符是不是变成# 了？

有些手机 root 后也无法通过adb root 命令让 adbd以 root 权限执行，比如三星的部分机型，会提示adbd cannot run as root in production builds，此时可以先安装 adbd Insecure，然后adb root 试试。

相应地，如果要恢复 adbd 为非 root权限的话，可以使用 adb unroot命令。

指定 adb server的网络端口

命令：

adb -P start-server

默认端口为 5037。

设备连接管理

查询已连接设备/模拟器

命令：

adb devices

输出示例：

List of devices attached

cf264b8f device

emulator-5554 device

10.129.164.6:5555  device

输出格式为 [serialNumber] [state]，serialNumber即我们常说的 SN，state有如下几种：

offline ——表示设备未连接成功或无响应。

device ——设备已连接。注意这个状态并不能标识 Android 系统已经完全启动和可操作，在设备启动过程中设备实例就可连接到 adb，但启动完毕后系统才处于可操作状态。

no device —— 没有设备/模拟器连接。

以上输出显示当前已经连接了三台设备/模拟器，cf264b8f、emulator-5554和 10.129.164.6:5555分别是它们的 SN。从emulator-5554 这个名字可以看出它是一个 Android模拟器，而 10.129.164.6:5555这种形为 :的 serialNumber 一般是无线连接的设备或 Genymotion等第三方 Android 模拟器。

常见异常输出：

没有设备/模拟器连接成功。List of devices attached

设备/模拟器未连接到 adb或无响应。List of devices attached

cf264b8f offline

USB 连接

通过 USB 连接来正常使用 adb需要保证几点：

硬件状态正常。包括 Android 设备处于正常开机状态，USB连接线和各种接口完好。

Android设备的开发者选项和 USB 调试模式已开启。可以到「设置」-「开发者选项」-「Android调试」查看。如果在设置里找不到开发者选项，那需要通过一个彩蛋来让它显示出来：在「设置」-「关于手机」连续点击「版本号」7次。

设备驱动状态正常。这一点貌似在 Linux 和 Mac OS X下不用操心，在 Windows 下有可能遇到需要安装驱动的情况，确认这一点可以右键「计算机」-「属性」，到「设备管理器」里查看相关设备上是否有黄色感叹号或问号，如果没有就说明驱动状态已经好了。否则可以下载一个手机助手类程序来安装驱动先。

通过 USB线连接好电脑和设备后确认状态。adb devices

如果能看到xxxxxx device

说明连接成功。

无线连接（需要借助 USB线）

除了可以通过 USB 连接设备与电脑来使用 adb，也可以通过无线连接——虽然连接过程中也有需要使用 USB的步骤，但是连接成功之后你的设备就可以在一定范围内摆脱 USB 连接线的限制啦！

操作步骤：

将 Android设备与要运行 adb 的电脑连接到同一个局域网，比如连到同一个 WiFi。

将设备与电脑通过 USB线连接。应确保连接成功（可运行 adb devices看是否能列出该设备）。

让设备在 5555 端口监听 TCP/IP连接：adb tcpip 5555

断开 USB 连接。

找到设备的 IP地址。一般能在「设置」-「关于手机」-「状态信息」-「IP地址」找到，也可以使用下文里查看设备信息 - IP 地址一节里的方法用 adb 命令来查看。

通过 IP地址连接设备。adb connect

这里的 就是上一步中找到的设备 IP 地址。

确认连接状态。adb devices

如果能看到:5555 device

说明连接成功。

如果连接不了，请确认 Android 设备与电脑是连接到了同一个 WiFi，然后再次执行adb connect  那一步；

如果还是不行的话，通过 adb kill-server重新启动 adb 然后从头再来一次试试。

断开无线连接

命令：

adb disconnect

无线连接（无需借助 USB线）

注：需要 root权限。

上一节「无线连接（需要借助 USB 线）」是官方文档里介绍的方法，需要借助于 USB数据线来实现无线连接。

既然我们想要实现无线连接，那能不能所有步骤下来都是无线的呢？答案是能的。

在 Android 设备上安装一个终端模拟器。已经安装过的设备可以跳过此步。我使用的终端模拟器下载地址是：Terminal Emulator for Android Downloads

将 Android设备与要运行 adb 的电脑连接到同一个局域网，比如连到同一个 WiFi。

打开 Android设备上的终端模拟器，在里面依次运行命令：su

setprop service.adb.tcp.port 5555

找到 Android设备的 IP 地址。一般能在「设置」-「关于手机」-「状态信息」-「IP地址」找到，也可以使用下文里查看设备信息 - IP 地址一节里的方法用 adb 命令来查看。

在电脑上通过 adb和 IP 地址连接 Android设备。adb connect

这里的 就是上一步中找到的设备 IP 地址。如果能看到 connected to :5555这样的输出则表示连接成功。

节注一：

有的设备，比如小米 5S + MIUI 8.0 + Android 6.0.1 MXB48T，可能在第 5步之前需要重启 adbd 服务，在设备的终端模拟器上运行：

restart adbd

如果 restart 无效，尝试以下命令：

start adbd

stop adbd

应用管理

查看应用列表

查看应用列表的基本命令格式是

adb shell pm list packages [-f] [-d] [-e] [-s] [-3] [-i] [-u] [--user USER_ID] [FILTER]

即在 adb shell pm list packages的基础上可以加一些参数进行过滤查看不同的列表，支持的过滤参数如下：

参数显示列表

无所有应用

-f显示应用关联的 apk 文件

-d只显示 disabled 的应用

-e只显示 enabled 的应用

-s只显示系统应用

-3只显示第三方应用

-i显示应用的 installer

-u包含已卸载应用

包名包含 字符串

所有应用

命令：

adb shell pm list packages

输出示例：

package:com.android.smoketest

package:com.example.android.livecubes

package:com.android.providers.telephony

package:com.google.android.googlequicksearchbox

package:com.android.providers.calendar

package:com.android.providers.media

package:com.android.protips

package:com.android.documentsui

package:com.android.gallery

package:com.android.externalstorage

...

// other packages here

...

系统应用

AGE

adb shell pm list packages -s第三方应用命令：ad

 shell pm list packages -3

包名包含某字符串的应用

比如要查看包名包含字符串 mazhuang的应用列表，命令：

adb shell pm list packages mazhuang

当然也可以使用 grep 来过滤：

adb shell pm list packages | grep mazhuang

安装 APK

命令格式：

adb install [-lrtsdg]

参数：

adb install 后面可以跟一些可选参数来控制安装 APK的行为，可用参数及含义如下：

参数含义

-l将应用安装到保护目录 /mnt/asec

-r允许覆盖安装

-t允许安装 AndroidManifest.xml 里 application 指定android:testOnly="true" 的应用

-s将应用安装到 sdcard

-d允许降级覆盖安装

-g授予所有运行时权限

运行命令后如果见到类似如下输出（状态为 Success）代表安装成功：

[100%] /data/local/tmp/1.apk

pkg: /data/local/tmp/1.apk

Success

上面是当前最新版 v1.0.36 的 adb的输出，会显示 push apk 文件到手机的进度百分比。

使用旧版本 adb 的输出则是这样的：

12040 KB/s (22205609 bytes in 1.801s)

        pkg: /data/local/tmp/SogouInput_android_v8.3_sweb.apk

Success

而如果状态为 Failure则表示安装失败，比如：

[100%] /data/local/tmp/map-20160831.apk

        pkg: /data/local/tmp/map-20160831.apk

Failure [INSTALL_FAILED_ALREADY_EXISTS]

常见安装失败输出代码、含义及可能的解决办法如下：

输出含义解决办法

INSTALL_FAILED_ALREADY_EXISTS应用已经存在，或卸载了但没卸载干净adb install 时使用-r 参数，或者先adb uninstall  再安装

INSTALL_FAILED_INVALID_APK无效的 APK 文件

INSTALL_FAILED_INVALID_URI无效的 APK 文件名确保 APK 文件名里无中文

INSTALL_FAILED_INSUFFICIENT_STORAGE空间不足清理空间

INSTALL_FAILED_DUPLICATE_PACKAGE已经存在同名程序

INSTALL_FAILED_NO_SHARED_USER请求的共享用户不存在

INSTALL_FAILED_UPDATE_INCOMPATIBLE以前安装过同名应用，但卸载时数据没有移除先 adb uninstall 再安装

INSTALL_FAILED_SHARED_USER_INCOMPATIBLE请求的共享用户存在但签名不一致

INSTALL_FAILED_MISSING_SHARED_LIBRARY安装包使用了设备上不可用的共享库

INSTALL_FAILED_REPLACE_COULDNT_DELETE替换时无法删除

INSTALL_FAILED_DEXOPTdex 优化验证失败或空间不足

INSTALL_FAILED_OLDER_SDK设备系统版本低于应用要求

INSTALL_FAILED_CONFLICTING_PROVIDER设备里已经存在与应用里同名的 content provider

INSTALL_FAILED_NEWER_SDK设备系统版本高于应用要求

INSTALL_FAILED_TEST_ONLY应用是 test-only 的，但安装时没有指定-t 参数

INSTALL_FAILED_CPU_ABI_INCOMPATIBLE包含不兼容设备 CPU 应用程序二进制接口的 native code

INSTALL_FAILED_MISSING_FEATURE应用使用了设备不可用的功能

INSTALL_FAILED_CONTAINER_ERROR1. sdcard 访问失败; 2.应用签名与 ROM 签名一致，被当作内置应用1. 确认 sdcard可用，或者安装到内置存储; 2. 打包时不与 ROM使用相同签名

INSTALL_FAILED_INVALID_INSTALL_LOCATION1. 不能安装到指定位置; 2.应用签名与ROM 签名一致，被当作内置应用1. 切换安装位置，添加或删除-s 参数; 2.打包时不与 ROM 使用相同签名

INSTALL_FAILED_MEDIA_UNAVAILABLE安装位置不可用一般为 sdcard，确认 sdcard可用或安装到内置存储

INSTALL_FAILED_VERIFICATION_TIMEOUT验证安装包超时

INSTALL_FAILED_VERIFICATION_FAILURE验证安装包失败

INSTALL_FAILED_PACKAGE_CHANGED应用与调用程序期望的不一致

INSTALL_FAILED_UID_CHANGED以前安装过该应用，与本次分配的 UID 不一致清除以前安装过的残留文件

INSTALL_FAILED_VERSION_DOWNGRADE已经安装了该应用更高版本使用 -d参数

INSTALL_FAILED_PERMISSION_MODEL_DOWNGRADE已安装 target SDK 支持运行时权限的同名应用，要安装的版本不支持运行时权限

INSTALL_PARSE_FAILED_NOT_APK指定路径不是文件，或不是以 .apk结尾

INSTALL_PARSE_FAILED_BAD_MANIFEST无法解析的 AndroidManifest.xml 文件

INSTALL_PARSE_FAILED_UNEXPECTED_EXCEPTION解析器遇到异常

INSTALL_PARSE_FAILED_NO_CERTIFICATES安装包没有签名

INSTALL_PARSE_FAILED_INCONSISTENT_CERTIFICATES已安装该应用，且签名与 APK 文件不一致先卸载设备上的该应用，再安装

INSTALL_PARSE_FAILED_CERTIFICATE_ENCODING解析 APK 文件时遇到CertificateEncodingException

INSTALL_PARSE_FAILED_BAD_PACKAGE_NAMEmanifest 文件里没有或者使用了无效的包名

INSTALL_PARSE_FAILED_BAD_SHARED_USER_IDmanifest 文件里指定了无效的共享用户 ID

INSTALL_PARSE_FAILED_MANIFEST_MALFORMED解析 manifest 文件时遇到结构性错误

INSTALL_PARSE_FAILED_MANIFEST_EMPTY在 manifest 文件里找不到找可操作标签（instrumentation或 application）

INSTALL_FAILED_INTERNAL_ERROR因系统问题安装失败

INSTALL_FAILED_USER_RESTRICTED用户被限制安装应用

INSTALL_FAILED_DUPLICATE_PERMISSION应用尝试定义一个已经存在的权限名称

INSTALL_FAILED_NO_MATCHING_ABIS应用包含设备的应用程序二进制接口不支持的 native code

INSTALL_CANCELED_BY_USER应用安装需要在设备上确认，但未操作设备或点了取消在设备上同意安装

INSTALL_FAILED_ACWF_INCOMPATIBLE应用程序与设备不兼容

does not contain AndroidManifest.xml无效的 APK 文件

is not a valid zip file无效的 APK 文件

Offline设备未连接成功先将设备与 adb 连接成功

unauthorized设备未授权允许调试

error: device not found没有连接成功的设备先将设备与 adb 连接成功

protocol failure设备已断开连接先将设备与 adb 连接成功

Unknown option: -sAndroid 2.2 以下不支持安装到 sdcard不使用 -s参数

No space left on devicerm空间不足清理空间

Permission denied ... sdcard ...sdcard 不可用

参考：PackageManager.java

adb install 内部原理简介

adb install 实际是分三步完成：

push apk 文件到 /data/local/tmp。

调用 pm install 安装。

删除 /data/local/tmp 下的对应 apk文件。

所以，必要的时候也可以根据这个步骤，手动分步执行安装过程。

卸载应用

命令：

adb uninstall [-k]

 表示应用的包名，-k参数可选，表示卸载应用但保留数据和缓存目录。

命令示例：

adb uninstall com.qihoo360.mobilesafe

表示卸载 360 手机卫士。

清除应用数据与缓存

命令：

adb shell pm clear

 表示应用名包，这条命令的效果相当于在设置里的应用信息界面点击了「清除缓存」和「清除数据」。

命令示例：

adb shell pm clear com.qihoo360.mobilesafe

表示清除 360 手机卫士的数据和缓存。

查看前台 Activity

命令：

adb shell dumpsys activity activities | grep mFocusedActivity

输出示例：

mFocusedActivity: ActivityRecord{8079d7e u0 com.cyanogenmod.trebuchet/com.android.launcher3.Launcher t42}

其中的 com.cyanogenmod.trebuchet/com.android.launcher3.Launcher就是当前处于前台的 Activity。

查看正在运行的 Services

命令：

adb shell dumpsys activity services []

 参数不是必须的，指定 表示查看与某个包名相关的 Services，不指定表示查看所有Services。

 不一定要给出完整的包名，比如运行adb shell dumpsys activity services org.mazhuang，那么包名org.mazhuang.demo1、org.mazhuang.demo2和 org.mazhuang123等相关的 Services 都会列出来。

与应用交互

主要是使用 am 命令，常用的 如下：

command用途

start [options] 启动 指定的 Activity

startservice [options] 启动 指定的 Service

broadcast [options] 发送 指定的广播

force-stop 停止 相关的进程

 参数很灵活，和写 Android程序时代码里的 Intent 相对应。

用于决定 intent 对象的选项如下：

参数含义

-a 指定 action，比如android.intent.action.VIEW

-c 指定 category，比如android.intent.category.APP_CONTACTS

-n 指定完整 component 名，用于明确指定启动哪个 Activity，如com.example.app/.ExampleActivity

 里还能带数据，就像写代码时的 Bundle一样：

参数含义

--esn null 值（只有 key名）

`-e--es `

--ez boolean 值

--ei integer 值

--el long 值

--ef float 值

--eu URI

--ecn component name

kagename>命令示例：adb shell am force-stop com.qihoo360.mobilesafe表示停止 360 安全卫士的一切进程与服务。文件管理复制设备里的文件到电脑命令：adb pull <设备里的文件路径> [电脑上的目录]

其中认复制到当前目录。例：adb pull /sdcard/sr.mp4 ~/tmp/

*小技巧：*设备上的文件路径可能需要 root 权限才能访问，如果你的设备已经 root 过，可以先使用 adb shell 和 su 命令在 adbshell 里获取 root 权限后，先 cp /path/on/device /sdcard/filename 将文件复制到 sdcard，然后 adb pull /sdcard/filename /path/on/pc。

复制电脑里的文件到设备

命令：

adb push <电脑上的文件路径> <设备里的目录>

例：

adb push ~/sr.mp4 /s巧：*设备上的文件路径普通权限可能无法直接写入，如果你的设备已经 root 过，可以先 adb push /path/on/pc /sdcard/filename，然后 adb shell 和 su 在 adb shell 里获取 root 权限后，cp /sdcard/filename /path/on/device。

模拟按在 a

b shell 里有个很实用的命令叫 input，通过它可以做一些有趣的事情。

input 命令的完整 help 信息如下：

Usage: input [] [...]

The s      mouse

      keyboard

      joystick

      touchnavigation

  touchpad

      trackball

      stylus

      dpad

   gesture

      touchscreen

      gamepad

The commands and default sources are:

      text (Default: touchscreen)

      keyevent [--longpress] ...(Default: keyboard)

      tap (Default: touchscreen)

swipe  [duration(ms)] (Default: touchscreen)

    press (Default: trackball)

      roll (Default: trackball)

比如使用 adb shell input keyevent 命令，ycode 能实现不同的功能，完整的 keycode 列表详见 KeyEvent，摘引部分我觉得有意思的如下：

keycode

roll (Default: trackball)

比如使用 adb shell input keyevent 命令，不同的 keycode 能实现不同的功能，完整的 keycode列表详见 KeyEvent，摘引部分我觉得有意思的如下：

keycode

含义

3

HOME 键

4

返回键

5

打开拨号应用

6

挂断电话

24

增加音量

25

降低音量

26

电源键

27

拍照（需要在相机应用里）

64

打开浏览器

82

菜单键

85

播放/暂停

86

停止播放

87

播放下一首

88

播放上一首

122

移动光标到行首或列表顶部

123

移动光标到行末或列表底部

126

恢复播放

127

暂停播放

164

静音

176

打开系统设置

187

切换应用

207

打开联系人

208

打开日历

209

打开音乐

210

打开计算器

220

降低屏幕亮度

221

提高屏幕亮度

223

系统休眠

224

点亮屏幕

231

打开语音助手

276

如果没有 wakelock 则让系统休眠

下面是 input命令的一些用法举例。

电源键

命令：

adb shell input keyevent 26

执行效果相当于按电源键。

菜单键

命令：

adb shell input keyevent 82

HOME 键

命令：

adb shell input keyevent 3

返回键

命令：

adb shell input keyevent 4

音量控制

增加音量：

adb shell input keyevent 24

降低音量：

adb shell input keyevent 25

静音：

adb shell input keyevent 164

媒体控制

播放/暂停：

adb shell input keyevent 85

停止播放：

adb shell input keyevent 86

播放下一首：

adb shell input keyevent 87

播放上一首：

adb shell input keyevent 88

恢复播放：

adb shell input keyevent 126

暂停播放：

adb shell input keyevent 127

点亮/熄灭屏幕

可以通过上文讲述过的模拟电源键来切换点亮和熄灭屏幕，但如果明确地想要点亮或者熄灭屏幕，那可以使用如下方法。

点亮屏幕：

adb shell input keyevent 224

熄灭屏幕：

adb shell input keyevent 223

滑动解锁

如果锁屏没有密码，是通过滑动手势解锁，那么可以通过 input swipe 来解锁。

命令（参数以机型 Nexus 5，向上滑动手势解锁举例）：

adb shell input swipe 300 1000 300 500

参数 300 1000 300 500分别表示起始点x坐标起始点y坐标结束点x坐标结束点y坐标。

输入文本

在焦点处于某文本框时，可以通过 input命令来输入文本。

命令：

adb shell input text hello

现在 hello出现在文本框了。

查看日志

Android 系统的日志分为两部分，底层的 Linux内核日志输出到 /proc/kmsg，Android的日志输出到 /dev/log。

Android 日志

命令格式：

[adb] logcat [] ... [] ...

常用用法列举如下：

按级别过滤日志

Android 的日志分为如下几个优先级（priority）：

V —— Verbose（最低，输出得最多）

D —— Debug

I —— Info

W —— Warning

E —— Error

F —— Fatal

S —— Silent（最高，啥也不输出）

按某级别过滤日志则会将该级别及以上的日志输出。

比如，命令：

adb logcat *:W

会将 Warning、Error、Fatal和 Silent 日志输出。

（注： 在 macOS下需要给 *:W这样以 *作为 tag 的参数加双引号，如adb logcat "*:W"，不然会报错no matches found: *:W。）

按 tag 和级别过滤日志

 可以由多个[:priority] 组成。

比如，命令：

adb logcat ActivityManager:I MyApp:D *:S

表示输出 tag ActivityManager的 Info 以上级别日志，输出 tagMyApp 的 Debug以上级别日志，及其它 tag 的 Silent级别日志（即屏蔽其它 tag 日志）。

日志格式

可以用 adb logcat -v 选项指定日志输出格式。

日志支持按以下几种 ：

brief

默认格式。格式为：/():

示例：D/HeadsetStateMachine( 1785): Disconnected process message: 10, size: 0

process

格式为：()

示例：D( 1785) Disconnected process message: 10, size: 0  (HeadsetStateMachine)

tag

格式为：/:

示例：D/HeadsetStateMachine: Disconnected process message: 10, size: 0

raw

格式为：

示例：Disconnected process message: 10, size: 0

time

格式为： /():

示例：08-28 22:39:39.974 D/HeadsetStateMachine( 1785): Disconnected process message: 10, size: 0

threadtime

格式为： :

示例：08-28 22:39:39.974  1785  1832 D HeadsetStateMachine: Disconnected process message: 10, size: 0

long

格式为：[ : / ]

示例：[ 08-28 22:39:39.974  1785: 1832 D/HeadsetStateMachine ]

Disconnected process message: 10, size: 0

指定格式可与上面的过滤同时使用。比如：

adb logcat -v long ActivityManager:I *:S

清空日志

adb logcat -c

内核日志

命令：

adb shell dmesg

输出示例：

<6>[14201.684016] PM: noirq resume of devices complete after 0.982 msecs

<6>[14201.685525] PM: early resume of devices complete after 0.838 msecs

<6>[14201.753642] PM: resume of devices complete after 68.106 msecs

<4>[14201.755954] Restarting tasks ... done.

<6>[14201.771229] PM: suspend exit 2016-08-28 13:31:32.679217193 UTC

<6>[14201.872373] PM: suspend entry 2016-08-28 13:31:32.780363596 UTC

<6>[14201.872498] PM: Syncing filesystems ... done.

中括号里的 [14201.684016]代表内核开始启动后的时间，单位为秒。

通过内核日志我们可以做一些事情，比如衡量内核启动时间，在系统启动完毕后的内核日志里找到Freeing init memory 那一行前面的时间就是。

查看设备信息

型号

命令：

adb shell getprop ro.product.model

输出示例：

Nexus 5

电池状况

命令：

adb shell dumpsys battery

输入示例：

Current Battery Service state:

  AC powered: false

  USB powered: true

  Wireless powered: false

  status: 2

  health: 2

  present: true

  level: 44

  scale: 100

  voltage: 3872

  temperature: 280

  technology: Li-poly

其中 scale代表最大电量，level 代表当前电量。上面的输出表示还剩下 44% 的电量。

屏幕分辨率

命令：

adb shell wm size

输出示例：

Physical size: 1080x1920

该设备屏幕分辨率为 1080px * 1920px。

如果使用命令修改过，那输出可能是：

Physical size: 1080x1920

Override size: 480x1024

表明设备的屏幕分辨率原本是 1080px * 1920px，当前被修改为 480px * 1024px。

屏幕密度

命令：

adb shell wm density

输出示例：

Physical density: 420

该设备屏幕密度为 420dpi。

如果使用命令修改过，那输出可能是：

Physical density: 480

Override density: 160

表明设备的屏幕密度原来是 480dpi，当前被修改为 160dpi。

显示屏参数

命令：

adb shell dumpsys window displays

输出示例：

WINDOW MANAGER DISPLAY CONTENTS (dumpsys window displays)

  Display: mDisplayId=0

    init=1080x1920 420dpi cur=1080x1920 app=1080x1794 rng=1080x1017-1810x1731

    deferred=false layoutNeeded=false

其中 mDisplayId为 显示屏编号，init是初始分辨率和屏幕密度，app的高度比 init里的要小，表示屏幕底部有虚拟按键，高度为 1920 - 1794 = 126px合 42dp。

android_id

命令：

adb shell settings get secure android_id

输出示例：

51b6be48bac8c569

IMEI

在 Android 4.4 及以下版本可通过如下命令获取 IMEI：

adb shell dumpsys iphonesubinfo

输出示例：

Phone Subscriber Info:

  Phone Type = GSM

  Device ID = 860955027785041

其中的 Device ID就是 IMEI。

而在 Android 5.0 及以上版本里这个命令输出为空，得通过其它方式获取了（需要 root权限）：

adb shell

su

service call iphonesubinfo 1

输出示例：

Result: Parcel(

  0x00000000: 00000000 0000000f 00360038 00390030 '........8.6.0.9.'

  0x00000010: 00350035 00320030 00370037 00350038 '5.5.0.2.7.7.8.5.'

  0x00000020: 00340030 00000031                   '0.4.1...        ')

把里面的有效内容提取出来就是 IMEI 了，比如这里的是860955027785041。

参考：adb shell dumpsys iphonesubinfo not working since Android 5.0 Lollipop

Android 系统版本

命令：

adb shell getprop ro.build.version.release

输出示例：

5.0.2

IP 地址

每次想知道设备的 IP 地址的时候都得「设置」-「关于手机」-「状态信息」-「IP地址」很烦对不对？通过 adb 可以方便地查看。

命令：

adb shell ifconfig | grep Mask

输出示例：

inet addr:10.130.245.230  Mask:255.255.255.252

inet addr:127.0.0.1  Mask:255.0.0.0

那么 10.130.245.230就是设备 IP 地址。

在有的设备上这个命令没有输出，如果设备连着 WiFi，可以使用如下命令来查看局域网 IP：

adb shell ifconfig wlan0

输出示例：

wlan0: ip 10.129.160.99 mask 255.255.240.0 flags [up broadcast running multicast]

或

wlan0     Link encap:UNSPEC

          inet addr:10.129.168.57  Bcast:10.129.175.255  Mask:255.255.240.0

          inet6 addr: fe80::66cc:2eff:fe68:b6b6/64 Scope: Link

          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1

          RX packets:496520 errors:0 dropped:0 overruns:0 frame:0

          TX packets:68215 errors:0 dropped:0 overruns:0 carrier:0

          collisions:0 txqueuelen:3000

          RX bytes:116266821 TX bytes:8311736

如果以上命令仍然不能得到期望的信息，那可以试试以下命令（部分系统版本里可用）：

adb shell netcfg

输出示例：

wlan0    UP                               10.129.160.99/20  0x00001043 f8:a9:d0:17:42:4d

lo       UP                                   127.0.0.1/8   0x00000049 00:00:00:00:00:00

p2p0     UP                                     0.0.0.0/0   0x00001003 fa:a9:d0:17:42:4d

sit0     DOWN                                   0.0.0.0/0   0x00000080 00:00:00:00:00:00

rmnet0   DOWN                                   0.0.0.0/0   0x00000000 00:00:00:00:00:00

rmnet1   DOWN                                   0.0.0.0/0   0x00000000 00:00:00:00:00:00

rmnet3   DOWN                                   0.0.0.0/0   0x00000000 00:00:00:00:00:00

rmnet2   DOWN                                   0.0.0.0/0   0x00000000 00:00:00:00:00:00

rmnet4   DOWN                                   0.0.0.0/0   0x00000000 00:00:00:00:00:00

rmnet6   DOWN                                   0.0.0.0/0   0x00000000 00:00:00:00:00:00

rmnet5   DOWN                                   0.0.0.0/0   0x00000000 00:00:00:00:00:00

rmnet7   DOWN                                   0.0.0.0/0   0x00000000 00:00:00:00:00:00

rev_rmnet3 DOWN                                   0.0.0.0/0   0x00001002 4e:b7:e4:2e:17:58

rev_rmnet2 DOWN                                   0.0.0.0/0   0x00001002 4e:f0:c8:bf:7a:cf

rev_rmnet4 DOWN                                   0.0.0.0/0   0x00001002 a6:c0:3b:6b:c4:1f

rev_rmnet6 DOWN                                   0.0.0.0/0   0x00001002 66:bb:5d:64:2e:e9

rev_rmnet5 DOWN                                   0.0.0.0/0   0x00001002 0e:1b:eb:b9:23:a0

rev_rmnet7 DOWN                                   0.0.0.0/0   0x00001002 7a:d9:f6:81:40:5a

rev_rmnet8 DOWN                                   0.0.0.0/0   0x00001002 4e:e2:a9:bb:d0:1b

rev_rmnet0 DOWN                                   0.0.0.0/0   0x00001002 fe:65:d0:ca:82:a9

rev_rmnet1 DOWN                                   0.0.0.0/0   0x00001002 da:d8:e8:4f:2e:fe

可以看到网络连接名称、启用状态、IP 地址和 Mac地址等信息。

Mac 地址

命令：

adb shell cat /sys/class/net/wlan0/address

输出示例：

f8:a9:d0:17:42:4d

这查看的是局域网 Mac 地址，移动网络或其它连接的信息可以通过前面的小节「IP地址」里提到的 adb shell netcfg命令来查看。

CPU 信息

命令：

adb shell cat /proc/cpuinfo

输出示例：

Processor       : ARMv7 Processor rev 0 (v7l)

processor       : 0

BogoMIPS        : 38.40

processor       : 1

BogoMIPS        : 38.40

processor       : 2

BogoMIPS        : 38.40

processor       : 3

BogoMIPS        : 38.40

Features        : swp half thumb fastmult vfp edsp neon vfpv3 tls vfpv4 idiva idivt

CPU implementer : 0x51

CPU architecture: 7

CPU variant     : 0x2

CPU part        : 0x06f

CPU revision    : 0

Hardware        : Qualcomm MSM 8974 HAMMERHEAD (Flattened Device Tree)

Revision        : 000b

Serial          : 0000000000000000

这是 Nexus 5 的 CPU信息，我们从输出里可以看到使用的硬件是 Qualcomm MSM 8974，processor的编号是 0 到 3，所以它是四核的，采用的架构是ARMv7 Processor rev 0 (v71)。

内存信息

命令：

adb shell cat /proc/meminfo

输出示例：

MemTotal:        1027424 kB

MemFree:          486564 kB

Buffers:           15224 kB

Cached:            72464 kB

SwapCached:        24152 kB

Active:           110572 kB

Inactive:         259060 kB

Active(anon):      79176 kB

Inactive(anon):   207736 kB

Active(file):      31396 kB

Inactive(file):    51324 kB

Unevictable:        3948 kB

Mlocked:               0 kB

HighTotal:        409600 kB

HighFree:         132612 kB

LowTotal:         617824 kB

LowFree:          353952 kB

SwapTotal:        262140 kB

SwapFree:         207572 kB

Dirty:                 0 kB

Writeback:             0 kB

AnonPages:        265324 kB

Mapped:            47072 kB

Shmem:              1020 kB

Slab:              57372 kB

SReclaimable:       7692 kB

SUnreclaim:        49680 kB

KernelStack:        4512 kB

PageTables:         5912 kB

NFS_Unstable:          0 kB

Bounce:                0 kB

WritebackTmp:          0 kB

CommitLimit:      775852 kB

Committed_AS:   13520632 kB

VmallocTotal:     385024 kB

VmallocUsed:       61004 kB

VmallocChunk:     209668 kB

其中，MemTotal就是设备的总内存，MemFree是当前空闲内存。

更多硬件与系统属性

设备的更多硬件与系统属性可以通过如下命令查看：

adb shell cat /system/build.prop

这会输出很多信息，包括前面几个小节提到的「型号」和「Android系统版本」等。

输出里还包括一些其它有用的信息，它们也可通过 adb shell getprop <属性名>命令单独查看，列举一部分属性如下：

属性名含义

ro.build.version.sdkSDK 版本

ro.build.version.releaseAndroid 系统版本

ro.build.version.security_patchAndroid 安全补丁程序级别

ro.product.model型号

ro.product.brand品牌

ro.product.name设备名

ro.product.board处理器型号

ro.product.cpu.abilistCPU 支持的 abi列表[节注一]

persist.sys.isUsbOtgEnabled是否支持 OTG

dalvik.vm.heapsize每个应用程序的内存上限

ro.sf.lcd_density屏幕密度

节注一：

一些小厂定制的 ROM 可能修改过 CPU支持的 abi 列表的属性名，如果用ro.product.cpu.abilist 属性名查找不到，可以这样试试：

adb shell cat /system/build.prop | grep ro.product.cpu.abi

示例输出：

ro.product.cpu.abi=armeabi-v7a

ro.product.cpu.abi2=armeabi

修改设置

注： 修改设置之后，运行恢复命令有可能显示仍然不太正常，可以运行adb reboot 重启设备，或手动重启。

修改设置的原理主要是通过 settings 命令修改 /data/data/com.android.providers.settings/databases/settings.db里存放的设置值。

分辨率

命令：

adb shell wm size 480x1024

表示将分辨率修改为 480px * 1024px。

恢复原分辨率命令：

adb shell wm size reset

屏幕密度

命令：

adb shell wm density 160

表示将屏幕密度修改为 160dpi。

恢复原屏幕密度命令：

adb shell wm density reset

显示区域

命令：

adb shell wm overscan 0,0,0,200

四个数字分别表示距离左、上、右、下边缘的留白像素，以上命令表示将屏幕底部 200px留白。

恢复原显示区域命令：

adb shell wm overscan reset

关闭 USB 调试模式

命令：

adb shell settings put global adb_enabled 0

恢复：

用命令恢复不了了，毕竟关闭了 USB 调试 adb就连接不上 Android 设备了。

去设备上手动恢复吧：「设置」-「开发者选项」-「Android调试」。

状态栏和导航栏的显示隐藏

本节所说的相关设置对应 Cyanogenmod 里的「扩展桌面」。

命令：

adb shell settings put global policy_control

 可由如下几种键及其对应的值组成，格式为=:=。

key含义

immersive.full同时隐藏

immersive.status隐藏状态栏

immersive.navigation隐藏导航栏

immersive.preconfirms?

这些键对应的值可则如下值用逗号组合：

value含义

apps所有应用

*所有界面

packagename指定应用

-packagename排除指定应用

例如：

adb shell settings put global policy_control immersive.full=*

表示设置在所有界面下都同时隐藏状态栏和导航栏。

adb shell settings put global policy_control immersive.status=com.package1,com.package2:immersive.navigation=apps,-com.package3

表示设置在包名为 com.package1和 com.package2的应用里隐藏状态栏，在除了包名为 com.package3的所有应用里隐藏导航栏。

实用功能

屏幕截图

截图保存到电脑：

adb exec-out screencap -p > sc.png

如果 adb 版本较老，无法使用exec-out 命令，这时候建议更新 adb版本。无法更新的话可以使用以下麻烦点的办法：

先截图保存到设备里：

adb shell screencap -p /sdcard/sc.png

然后将 png 文件导出到电脑：

adb pull /sdcard/sc.png

可以使用 adb shell screencap -h查看 screencap命令的帮助信息，下面是两个有意义的参数及含义：

参数含义

-p指定保存文件为 png 格式

-d display-id指定截图的显示屏编号（有多显示屏的情况下）

实测如果指定文件名以 .png结尾时可以省略 -p 参数；否则需要使用 -p参数。如果不指定文件名，截图文件的内容将直接输出到 stdout。

另外一种一行命令截图并保存到电脑的方法：

Linux 和 Windows

adb shell screencap -p | sed "s/\r$//" > sc.png

Mac OS X

adb shell screencap -p | gsed "s/\r$//" > sc.png

这个方法需要用到 gnu sed 命令，在 Linux下直接就有，在 Windows 下 Git安装目录的 bin 文件夹下也有。如果确实找不到该命令，可以下载sed for Windows并将 sed.exe 所在文件夹添加到 PATH环境变量里。

而在 Mac 下使用系统自带的 sed命令会报错：

sed: RE error: illegal byte sequence

需要安装 gnu-sed，然后使用 gsed命令：

brew install gnu-sed

录制屏幕

录制屏幕以 mp4 格式保存到 /sdcard：

adb shell screenrecord /sdcard/filename.mp4

需要停止时按 Ctrl-C，默认录制时间和最长录制时间都是 180秒。

如果需要导出到电脑：

adb pull /sdcard/filename.mp4

可以使用 adb shell screenrecord --help查看 screenrecord命令的帮助信息，下面是常见参数及含义：

参数含义

--size WIDTHxHEIGHT视频的尺寸，比如 1280x720，默认是屏幕分辨率。

--bit-rate RATE视频的比特率，默认是 4Mbps。

--time-limit TIME录制时长，单位秒。

--verbose输出更多信息。

重新挂载 system分区为可写

注：需要 root权限。

/system 分区默认挂载为只读，但有些操作比如给 Android系统添加命令、删除自带应用等需要对 /system 进行写操作，所以需要重新挂载它为可读写。

步骤：

进入 shell 并切换到 root用户权限。命令：adb shell

su

查看当前分区挂载情况。命令：mount

输出示例：rootfs / rootfs ro,relatime 0 0

tmpfs /dev tmpfs rw,seclabel,nosuid,relatime,mode=755 0 0

devpts /dev/pts devpts rw,seclabel,relatime,mode=600 0 0

proc /proc proc rw,relatime 0 0

sysfs /sys sysfs rw,seclabel,relatime 0 0

selinuxfs /sys/fs/selinux selinuxfs rw,relatime 0 0

debugfs /sys/kernel/debug debugfs rw,relatime 0 0

none /var tmpfs rw,seclabel,relatime,mode=770,gid=1000 0 0

none /acct cgroup rw,relatime,cpuacct 0 0

none /sys/fs/cgroup tmpfs rw,seclabel,relatime,mode=750,gid=1000 0 0

none /sys/fs/cgroup/memory cgroup rw,relatime,memory 0 0

tmpfs /mnt/asec tmpfs rw,seclabel,relatime,mode=755,gid=1000 0 0

tmpfs /mnt/obb tmpfs rw,seclabel,relatime,mode=755,gid=1000 0 0

none /dev/memcg cgroup rw,relatime,memory 0 0

none /dev/cpuctl cgroup rw,relatime,cpu 0 0

none /sys/fs/cgroup tmpfs rw,seclabel,relatime,mode=750,gid=1000 0 0

none /sys/fs/cgroup/memory cgroup rw,relatime,memory 0 0

none /sys/fs/cgroup/freezer cgroup rw,relatime,freezer 0 0

/dev/block/platform/msm_sdcc.1/by-name/system /system ext4 ro,seclabel,relatime,data=ordered 0 0

/dev/block/platform/msm_sdcc.1/by-name/userdata /data ext4 rw,seclabel,nosuid,nodev,relatime,noauto_da_alloc,data=ordered 0 0

/dev/block/platform/msm_sdcc.1/by-name/cache /cache ext4 rw,seclabel,nosuid,nodev,relatime,data=ordered 0 0

/dev/block/platform/msm_sdcc.1/by-name/persist /persist ext4 rw,seclabel,nosuid,nodev,relatime,data=ordered 0 0

/dev/block/platform/msm_sdcc.1/by-name/modem /firmware vfat ro,context=u:object_r:firmware_file:s0,relatime,uid=1000,gid=1000,fmask=0337,dmask=0227,codepage=cp437,iocharset=iso8859-1,shortname=lower,errors=remount-ro 0 0

/dev/fuse /mnt/shell/emulated fuse rw,nosuid,nodev,relatime,user_id=1023,group_id=1023,default_permissions,allow_other 0 0

/dev/fuse /mnt/shell/emulated/0 fuse rw,nosuid,nodev,relatime,user_id=1023,group_id=1023,default_permissions,allow_other 0 0

找到其中我们关注的带 /system 的那一行：/dev/block/platform/msm_sdcc.1/by-name/system /system ext4 ro,seclabel,relatime,data=ordered 0 0

重新挂载。命令：mount -o remount,rw -t yaffs2 /dev/block/platform/msm_sdcc.1/by-name/system /system

这里的 /dev/block/platform/msm_sdcc.1/by-name/system就是我们从上一步的输出里得到的文件路径。

如果输出没有提示错误的话，操作就成功了，可以对 /system 下的文件为所欲为了。

查看连接过的 WiFi密码

注：需要 root权限。

命令：

adb shell

su

cat /data/misc/wifi/*.conf

输出示例：

network={

ssid="TP-LINK_9DFC"

scan_ssid=1

psk="123456789"

key_mgmt=WPA-PSK

group=CCMP TKIP

auth_alg=OPEN

sim_num=1

priority=13893

}

network={

ssid="TP-LINK_F11E"

psk="987654321"

key_mgmt=WPA-PSK

sim_num=1

priority=17293

}

ssid 即为我们在 WLAN设置里看到的名称，psk 为密码，key_mgmt 为安全加密方式。

设置系统日期和时间

注：需要 root权限。

命令：

adb shell

su

date -s 20160823.131500

表示将系统日期和时间更改为 2016 年 08月 23 日 13点 15 分 00秒。

重启手机

命令：

adb reboot

检测设备是否已 root

命令：

adb shell

su

此时命令行提示符是 $则表示没有 root 权限，是# 则表示已 root。

使用 Monkey进行压力测试

Monkey 可以生成伪随机用户事件来模拟单击、触摸、手势等操作，可以对正在开发中的程序进行随机压力测试。

简单用法：

adb shell monkey -p -v 500

表示向 指定的应用程序发送 500 个伪随机事件。

Monkey 的详细用法参考官方文档。

开启/关闭 WiFi

注：需要 root权限。

有时需要控制设备的 WiFi 状态，可以用以下指令完成。

开启 WiFi：

adb root

adb shell svc wifi enable

关闭 WiFi：

adb root

adb shell svc wifi disable

若执行成功，输出为空；若未取得 root 权限执行此命令，将执行失败，输出Killed。

刷机相关命令

重启到 Recovery模式

命令：

adb reboot recovery

从 Recovery重启到 Android

命令：

adb reboot

重启到 Fastboot模式

命令：

adb reboot bootloader

通过 sideload更新系统

如果我们下载了 Android 设备对应的系统更新包到电脑上，那么也可以通过 adb来完成更新。

以 Recovery 模式下更新为例：

重启到 Recovery模式。命令：adb reboot recovery

在设备的 Recovery界面上操作进入 Apply update-Apply from ADB。注：不同的 Recovery 菜单可能与此有差异，有的是一级菜单就有Apply update from ADB。

通过 adb上传和更新系统。命令：adb sideload

更多 adb shell命令

Android 系统是基于 Linux内核的，所以 Linux 里的很多命令在 Android里也有相同或类似的实现，在 adb shell里可以调用。本文档前面的部分内容已经用到了 adb shell命令。

查看进程

命令：

adb shell ps

输出示例：

USER     PID   PPID  VSIZE  RSS     WCHAN    PC        NAME

root      1     0     8904   788   ffffffff 00000000 S /init

root      2     0     0      0     ffffffff 00000000 S kthreadd

...

u0_a71    7779  5926  1538748 48896 ffffffff 00000000 S com.sohu.inputmethod.sogou:classic

u0_a58    7963  5926  1561916 59568 ffffffff 00000000 S org.mazhuang.boottimemeasure

...

shell     8750  217   10640  740   00000000 b6f28340 R ps

各列含义：

列名含义

USER所属用户

PID进程 ID

PPID父进程 ID

NAME进程名

查看实时资源占用情况

命令：

adb shell top

输出示例：

User 0%, System 6%, IOW 0%, IRQ 0%

User 3 + Nice 0 + Sys 21 + Idle 280 + IOW 0 + IRQ 0 + SIRQ 3 = 307

  PID PR CPU% S  #THR     VSS     RSS PCY UID      Name

 8763  0   3% R     1  10640K   1064K  fg shell    top

  131  0   3% S     1      0K      0K  fg root     dhd_dpc

 6144  0   0% S   115 1682004K 115916K  fg system   system_server

  132  0   0% S     1      0K      0K  fg root     dhd_rxf

 1731  0   0% S     6  20288K    788K  fg root     /system/bin/mpdecision

  217  0   0% S     6  18008K    356K  fg shell    /sbin/adbd

 ...

 7779  2   0% S    19 1538748K  48896K  bg u0_a71   com.sohu.inputmethod.sogou:classic

 7963  0   0% S    18 1561916K  59568K  fg u0_a58   org.mazhuang.boottimemeasure

 ...

各列含义：

列名含义

PID进程 ID

PR优先级

CPU%当前瞬间占用 CPU 百分比

S进程状态（R=运行，S=睡眠，T=跟踪/停止，Z=僵尸进程）

#THR线程数

VSSVirtual Set Size 虚拟耗用内存（包含共享库占用的内存）

RSSResident Set Size 实际使用物理内存（包含共享库占用的内存）

PCY调度策略优先级，SP_BACKGROUND/SPFOREGROUND

UID进程所有者的用户 ID

NAME进程名

top 命令还支持一些命令行参数，详细用法如下：

Usage: top [ -m max_procs ] [ -n iterations ] [ -d delay ] [ -s sort_column ] [ -t ] [ -h ]

-m num 最多显示多少个进程

-n num 刷新多少次后退出

-d num 刷新时间间隔（单位秒，默认值 5）

-s col 按某列排序（可用 col值：cpu, vss, rss, thr）

-t 显示线程信息

-h 显示帮助文档

其它

如下是其它常用命令的简单描述，前文已经专门讲过的命令不再额外说明：

命令功能

cat显示文件内容

cd切换目录

chmod改变文件的存取模式/访问权限

df查看磁盘空间使用情况

grep过滤输出

kill杀死指定 PID 的进程

ls列举目录内容

mount挂载目录的查看和管理

mv移动或重命名文件

ps查看正在运行的进程

rm删除文件

top查看进程的资源占用情况

常见问题

启动 adb server失败

出错提示

error: protocol fault (couldn't read status): No error

可能原因

adb server 进程想使用的 5037端口被占用。

解决方案

找到占用 5037 端口的进程，然后终止它。以 Windows下为例：

netstat -ano | findstr LISTENING

...

TCP    0.0.0.0:5037           0.0.0.0:0              LISTENING       1548

...

这里 1548 即为进程 ID，用命令结束该进程：

taskkill /PID 1548

然后再启动 adb 就没问题了。





## About

![](https://upload-images.jianshu.io/upload_images/8869373-901590e019f6f85b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---------------

了解更多有趣的操作请关注我的微信公众号：DealiAxy

每一篇文章都在我的博客有收录：[blog.deali.cn](http://blog.deali.cn)