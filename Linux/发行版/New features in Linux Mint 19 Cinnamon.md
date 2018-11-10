Linux Mint 19 is a long term support release which will be supported until 2023\. It comes with updated software and brings refinements and many new features to make your desktop experience more comfortable.

[![Linux Mint 19 "Tara" Cinnamon Edition](http://upload-images.jianshu.io/upload_images/8869373-cac561b992295591.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/cinnamon.png) 

## Timeshift

In Linux Mint 19, the star of the show is Timeshift. Although it was introduced in Linux Mint 18.3 and backported to all Linux Mint releases, it is now at the center of Linux Mint's update strategy and communication.

Thanks to Timeshift you can go back in time and restore your computer to the last functional system snapshot. If anything breaks, you can go back to the previous snapshot and it's as if the problem never happened.

This greatly simplifies the maintenance of your computer, since you no longer need to worry about potential regressions. In the eventuality of a critical regression, you can restore a snapshot (thus canceling the effects of the regression) and you still have the ability to apply updates selectively (as you did in previous releases).

Security and stability are of paramount importance. By applying all updates you keep your computer secure and with automated snapshots in place its stability is guaranteed.

## Update Manager

The Update Manager no longer promotes vigilance and selective updates. It relies on Timeshift to guarantee the stability of your system and suggests to apply all available updates.

If it cannot find your Timeshift configuration, it shows a warning:

[![The Update Manager](http://upload-images.jianshu.io/upload_images/8869373-6f3afd9ff6c69212.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/mintupdate.png) 

Updates are sorted by type, with security and kernel updates at the top.

A new type was introduced for updates originating from 3rd party repositories and/or PPAs. Hovering your mouse cursor over these updates shows their origin in a tooltip.

In the past automatic updates were reserved to advanced users. It was assumed that if somebody was experienced enough to set a cron job, they would be experienced enough to parse APT logs and work around regressions. Thanks to Timeshift, which makes it easy for anyone to work around regressions by restoring snapshots, automatic updates can now be enabled easily, in the preferences.

[![Automatic updates](http://upload-images.jianshu.io/upload_images/8869373-035f3a2de064df14.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/auto.png) 

The mintupdate-tool command was replaced by mintupdate-cli. This new command doesn't use dconf, it provides better options and it is easier to use in scripts and in the terminal.

Kernel updates rely on meta-packages rather than manually installing kernel packages. This makes it easier to remove older kernels by using "apt autoremove".

Support for "lowlatency" kernels was added.

The Update Manager switched to symbolic icons to better support dark themes and provides a keyboard shortcuts window in its help menu.

## Welcome Screen

Linux Mint 19 ships with a brand new welcome screen.

[![The welcome screen](http://upload-images.jianshu.io/upload_images/8869373-242e92ea663c65df.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/welcome.png) 

The main page is dedicated to welcoming you to your computer and your new operating system.

The new layout makes it easier to add more information and to guide you through your first steps.

In addition to the welcome screen, the Linux Mint team worked on improving its [documentation](https://linuxmint.com/documentation.php). An installation guide, a troubleshooting guide and a translation guide are already available. A security guide and a developer guide are also planned.

## Software Manager

The Software Manager which was revamped and gained Flatpak support in Linux Mint 18.3, received many improvements.

[![The Software Manager](http://upload-images.jianshu.io/upload_images/8869373-1775691d040a584d.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/mintinstall.png) 

In the user interface, the layout was refined and transition animations were added.

The keyboard navigation was reviewed and improved.

The search is faster, asynchronous and you can now search within categories.

An internal cache was developed for APT and Flatpak in Linux Mint. This cache provides an abstraction layer, so that applications such as the Software Manager can handle APT and Flatpak the same way, without worrying about their differences. This cache could potentially be used by other applications in the future, such as the menu or the Update Manager.

Many efforts were made to increase the performance of the cache. This results in the Software Manager launching even faster than before.

Activity and loading indicators were improved. It is now easier to keep track of background activities.

[![Background activities in the Software Manager](http://upload-images.jianshu.io/upload_images/8869373-77e0ee7a8f5bac99.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/tasks.png) 

Support was added for .flatpakref and .flatpakrepo, so you can click buttons on the Web or share Flatpak installation files to easily install Flatpak applications.

When available, the Software Manager shows the size and version of Flatpak applications.

Old screenshots are cleaned up.

## Cinnamon 3.8

Linux Mint 19 ships with the latest Cinnamon 3.8.

**Faster app-launching:**

Cinnamon 3.8 feels snappier because it is faster and more efficient at launching applications and rendering new windows.

The development team investigated Cinnamon's performance and compared with many others.

Here’s how Cinnamon 3.6 compared to Metacity when launching 200 windows:

|  | WINDOWS BUILD TIME | RECOVERY TIME |
| ---- | ------- | -------|
| Metacity | 1s | 6s |
| Cinnamon | 4s | 22s |

Bottlenecks were identified in some applets and in the window manager. After changes were made to tackle these issues, the numbers went down and Cinnamon is now just as fast as Metacity to build the 200 windows and recover.

When launching a single application, the difference isn't as drastic and the original problem isn't as obvious. This gain in performance is however slightly perceivable and gives an impression of snappiness to the desktop.

In addition, the team took the opportunity to improve the window animations. Although they're not responsible for any delay, they also have an impact on comfort and perception. The new animations look cleaner and along with the performance improvements they make Cinnamon feel snappier than before.

**Performance improvements:**

Thanks to improvements in libnemo-extension and the way views are rendered, Nemo is faster at showing directory contents.

Nemo no longer lags when moving files over USB devices.

Improvements ported from GNOME reduce the occurrence of full stage redraws in Cinnamon.

**Adjustable maximum sound level:**

The maximum sound volume was currently set to 150%, with the sound settings allowing to go all the way to 150% while the sound applet and media keys only allowed a range of 0 to 100%. Cinnamon now lets you define what the maximum sound volume is, between 0 and 150%, and all sound controls (whether it’s the sound settings, the sound applet or the media keys) now range between 0 and the maximum value you defined.

[![Adjustable maximum sound level](http://upload-images.jianshu.io/upload_images/8869373-18324198d6b31249.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/sound.png) 

This allows you to quickly reach 150% without going into the sound settings, but also to quickly reach any arbitrary value, whatever suits your speakers and your environment, whether that value is higher than 100% for small speakers in loud environments or lower than 100% in quiet environments.

**File search:**

The Nemo search was simplified and is easier to use.

It’s asynchronous and much faster than before.

[![Better file search in Nemo](http://upload-images.jianshu.io/upload_images/8869373-3ee44d40cfa048b3.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/search.png) 

When performing a search you can click the star icon to remember it.

Right-clicking the star icon gives you access to your previously saved searches.

**Notifications:**

Notifications are smarter. They now have a close button (which unlike the notification itself doesn’t send you towards the source application) and no longer fade-out on mouse-over.

To avoid notification spam, they’re also limited in number per source and disappear when the application is focused, except for particular applications (Firefox, Chromium..etc) which use multiple tabs and which can send notifications for various internal sources.

Notifications can now also show at the bottom of the screen.

**Look and feel:**

Symbolic icons give Cinnamon a more modern look and better support for dark themes.

The coordinates and size of some widgets and components were adjusted to fall on exact pixels (which results in removing a slight blurriness and making them look crisp).

The quit dialog no longer skips the taskbar.

**Other improvements:**

Rubber-banding, which was previously only available in icon view, is now also available in list view.

You can now press Super+Alt (or use the right-click option on the Show Desktop applet) to quickly see your desklets, without minimizing your windows. When doing so, desklets move above your windows, until you click anywhere.

In the sound applet, the microphone and the speakers can now be muted separately. An option was added to choose whether or not to force the aspect-ratio of the album art. Tracks can be changed by scrolling left/right (that option is configurable).

CJS, the Javascript interpreter, was rebased on GJS 1.50.2 and now depends on mozjs52.

Support was added for elogind, systemd-timedated1 (which should replace ntp and ntpdate in Linux Mint 19 Cinnamon Edition), and the admin:// protocol.

Support was improved for GTK 3.22, CSD windows (in particular for their button layout and titlebar click actions) and LibreOffice (in nemo-preview).

With the exception of Nemo extensions, all Python components were ported to Python3.

The network settings were backported from GNOME 3.24 and include fixes from GNOME 3.26.

The region settings now support the ability to show uncommon/exotic keyboard layouts.

In the power settings, "Shutdown immediately" can now be chosen for closed lid and critical battery power events.

Cinnamon now activates the touchpad if no other pointing devices are present.

The screen is now locked synchronously prior to suspend.

Suspend, Hibernate and Screen rotation keys are now supported when the screen is locked.

Thumbnails can now be rendered for files as large as 32GB.

Scale/Overview can now be activated via dbus.

Xlets can now define column options when using lists, settings with dependencies now use a revealer, dependencies can now be inverted and defined on sections (not just widgets). Simple expressions using boolean operators can be used to compare values. The settings example applet was updated to showcase all these new additions.

## HiDPI

HiDPI support gets better with every new release.

All the Linux Mint tools use GTK3 and support HiDPI.

Mint-Y, the default icon theme, ships with "@2x" icons which look crisp in HiDPI.

Gksu, which used GTK+, was removed and all the tools which were using it were migrated to pkexec.

Within the default software selection, only a few remaining applications still lack support for it: Hexchat, Gimp and Tomboy Notes.

## XApps improvements

Xed, the text editor, uses a new preferences window. This type of window is provided by libXapp and could be used by more applications in the future.

[![Xed](http://upload-images.jianshu.io/upload_images/8869373-30d8d89698e117c3.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/xed.png) 

The look and feel was refined and adjusted for GTK 3.22.

A keyboard shortcuts window was added in the help menu.

A new plugin was added for word auto-completion. This plugin doesn't use dictionaries but it is able to auto-complete words which are already present in the document.

The PDF reader, Xreader, also received a libXapp preferences window and support for optional toolbar buttons.

If you enable the option to "Remember recently accessed files" in your "Privacy" settings, Xreader displays and provides quick access to your recently opened PDF and ePub documents.

[![Xreader showing recent documents](http://upload-images.jianshu.io/upload_images/8869373-a8f39df516c5b671.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/xreader2.png) 

It is now possible to change the size of the thumbnails and that size is remembered for each document.

[![Zoomable thumbnails in Xreader](http://upload-images.jianshu.io/upload_images/8869373-3c860a7be382d677.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/xreader.png) 

Annotations can now be deleted.

ePub support was improved. Thumbnails were fixed and it is now possible to save ePub documents.

Support for smooth scrolling was improved.

## Other improvements

The USB stick formatting tool now supports exFat.

The Software Sources tool is able to show the installed packages from a PPA.

A new option was added to the login screen to improve multi-monitor support. You can choose among your monitors which one should show the login form (by default the form jumps from one screen to another as you move your mouse cursor between them).

Starting with version 61, Firefox supports window-progress, so download progress will be visible in your window list.

GNOME Calendar is installed by default. You can use it as an offline calendar application, or connect it to a Google account to sync with online calendars. This application is also able to show weather forecasts.

[![GNOME Calendar](http://upload-images.jianshu.io/upload_images/8869373-9bcff7ece82c2039.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/calendar.png) 

Gnome-system-logs was replaced by gnome-logs.

[![GNOME Logs](http://upload-images.jianshu.io/upload_images/8869373-0356012beaa4e549.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/logs.png) 

The multimedia codecs now include the Microsoft fonts.

All the Mint tools support HiDPI, GTK3 and Python3\. Many also transitioned to AptDaemon and pkexec.

Pidgin was removed from the default software selection. It will continue to be available in the repositories but it is no longer installed by default.

Ntp and ntpdate were removed. Cinnamon uses systemd to adjust the time.

The PIA Manager, the set up tool for PIA VPN connections (available in the repositories), now remembers your username, password and gateway settings.

This release ships with linux-firmware 1.173 and the Linux kernel 4.15.0-20.

## Artwork improvements

Linux Mint 19 features a superb collection of backgrounds from [Aaron Thomas](https://unsplash.com/@aaronphs), [Bruno Fantinatti](https://500px.com/bfantinatti), [Eva Blue](http://evablue.com/), [Ezra Comeau-Jeffrey](https://unsplash.com/@emcomeau), [Jakob Owens](http://www.directorjakobowens.com/), [Jan Kaluza](http://jankaluza.com/), [Joanna Kosinska](http://joannakosinska.com/), [Johannes Plenio](https://500px.com/jopl), [Jonathan Ferland-Valois](https://www.instagram.com/jfvtraining/), [Josh Spires](https://dronenr.com/), [Luke Stackpoole](https://www.withluke.com/), [Micha Sager](https://unsplash.com/@michasager), [Monika](https://uhdwallpapers.org/wallpaper/pure-green-grass_65789/), [Oskars Sylwan](https://www.instagram.com/oskarssylwan), [Rachael Smith](https://www.ourbeautifuladventure.co.uk/), [Sezgin Mendil](https://500px.com/sezginmendil), [Tom Vining](https://www.instagram.com/mrvining), [Vladimir Proskurovskiy](https://videohive.net/user/proskurovskiy), [Will H McMahan](https://mcmahan.me/) and [Willian Justen de Vasconcellos](https://www.instagram.com/will_justen).

[![An overview of the new backgrounds](http://upload-images.jianshu.io/upload_images/8869373-201cee51e3ff1c14.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/backgrounds.png) 

New Linux Mint backgrounds from Bookwood and Kevin Tee were also added:

[![image](http://upload-images.jianshu.io/upload_images/8869373-16d8f667b6204588.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)](https://www.linuxmint.com/pictures/screenshots/tara/mint_backgrounds.png) 
*<small>**New Linux Mint backgrounds**</small>*

The default theme switched to Mint-Y, but Mint-X is still installed by default as an alternative.

Many news icons were added to the Mint-Y icon theme and the places icons are available in multiple colors.

To improve look and feel, but also support for HiDPI and dark themes, many of the tools and applications shipped with Linux Mint switched to symbolic icons.

## Main components

Linux Mint 19 features Cinnamon 3.8, a Linux kernel 4.15 and an Ubuntu 18.04 package base.

## LTS strategy

Linux Mint 19 will receive security updates until 2023.

Until 2020, future versions of Linux Mint will use the same package base as Linux Mint 19, making it trivial for people to upgrade.

Until 2020, the development team won't start working on a new base and will be fully focused on this one.
