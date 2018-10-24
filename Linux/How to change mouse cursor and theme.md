## In order to get your custom cursor to work with all applications do:

- Download a cursor theme.
- Extract it to `/usr/share/icons` or `~/.local/share/icons`
- Open Gnome Tweak Tool and change the cursor theme.
- Open a Terminal.
- Run this command:
```bash
sudo update-alternatives --config x-cursor-theme
```
- Select the number corresponding to your choice
- Log out.
- Log back in.