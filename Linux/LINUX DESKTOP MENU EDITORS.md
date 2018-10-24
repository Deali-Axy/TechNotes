Which application can you use when you need to modify menu with applications on your desktop? Let’s take a look..

Linux desktops (like Gnome or KDE) usually follow freedesktop.org menu specification for their hierarchical menus with desktop applications [1]. Thanks to this, you can edit the application menu manually via files stored in directories defined by the freedesktop specification [1] like `$XDG_CONFIG_DIRS/menus/${XDG_MENU_PREFIX}` (which will be something like `/etc/xdg/menus/`, `/home/$USER/.config/menus/`, etc. on your system). However, if you are lazy like me and prefer more easiest and comfy approach, you will choose an GUI application. The most famous one is probably an **Alacarte**, but I personally prefer a the one called **MenuLibre**. If you need to modify application menu of your desktop, now you know what to install.

## MenuLibre

An advanced menu editor that provides modern features in a clean, easy-to-use interface.

[https://smdavis.us/projects/menulibre/](https://smdavis.us/projects/menulibre/)

## Alacarte

A menu editor for GNOME.

[https://github.com/GNOME/alacarte](https://github.com/GNOME/alacarte)

## Meow

An application Menu Editor for GNOME written in Scala (Java).

[https://pnmougel.github.io/meow/](https://pnmougel.github.io/meow/)

And that’s it. The whole purpose of this post is to have a post with “MenuLibre” name in it because I always keep forgetting that name when I’m configuring somebody else’s desktop and I need to look it up via google every time.

[1] [https://specifications.freedesktop.org/menu-spec/menu-spec-1.0.html](https://specifications.freedesktop.org/menu-spec/menu-spec-1.0.html)
