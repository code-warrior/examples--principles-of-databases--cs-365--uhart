installation, mysql, windows, 10, macos, monterey, command line interface, cli, terminal, powershell

# Installing MySQL

## Windows 10/11

1. Visit the [MySQL Community Downloads Page](https://dev.mysql.com/downloads/mysql/). As of 24 September 2023, 8.1.0 Innovation is the latest version.
2. Choose to download `(mysql-8.1.0-winx64.msi)`, which should be about 146.9MB
3. On the next page, choose *No thanks, just start my download*. Your browser should start downloading the `mysql-8.1.0-winx64.msi` Microsoft Installer.
4. At the *Choose Setup Type* window, choose *Typical*, then *Install*.
5. Run the *MySQL Configurator*, then choose a strong password
6. You can choose to *Start the MySQL Server at System Startup*. I would not.
7. Add the samples databases, _Sakila_ and _World_.
8. You should now have a program called `mysql.exe` at the following path: `C:\Program Files\MySQL\MySQL Server 8.1\bin`
9. We need to add this path to our Environment Variable. Hit the Windows key, then type "Environment". Choose to Edit the system environment variables
10. On the *Advanced* tab, choose *Environment Variables...*
11. On the bottom, under *System variables*, look for *Path*. Highlight it, then choose *Edit...*.
12. Choose *New*, then paste the path from step 8 into the new field.
13. click *OK* all the way out.
14. Now your all command line interfaces can “see” MySQL.
15. Finally, let’s launch MySQL using our new root password: `mysql -u root -p`
16. Type `status` to see important, MySQL-related info, such as the user who is logged in, the host on which they’re connected, and the character sets being used.

---

## macOS Ventura

1. Visit the [MySQL Community Downloads Page](https://dev.mysql.com/downloads/mysql/). As of 24 September 2023, 8.1.0 Innovation is the latest version.
2. Choose the correct installer for your chip. Any installer with “arm” in the title is for the M1 and M2 chips.
3. Take all the defaults and choose a strong password.
4. Go to System Settings and search for “mysql”.
5. Click “MySQL”.
6. Click “Initialize Database” then choose a strong password for the `root` user.
7. Click “Start MySQL Server”.
8. Note the path to the MySQL installation, under the version number in bold.
9. Launch The Terminal and use VS Code to edit `.bashrc` from your home folder.
10. Add the following to your path: `export PATH="[PATH-TO-MYSQL]/bin:$PATH"`, where `[PATH-TO-MYSQL]` is the path noted in step 8. My path entry looks like this: `export PATH="/usr/local/mysql-8.1.0-macos13-arm64/bin:$PATH"`
11. Relaunch The Terminal and type `bash`. (The assumption here is that you’re _not_ running bash, but the zsh, which is the default shell in macOS Ventura.)
12. Type `mysql -u root -p` then enter your new password.
13. Type `status` to see important, MySQL-related info, such as the user who is logged in, the host on which they’re connected, and the character sets being used.
