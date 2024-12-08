# Configure Apache, MySQL, and PHP on macOS Ventura

This tutorial configures the pre-installed version of Apache in macOS, MySQL 9.0.1 (downloaded externally), and PHP 8.3 (downloaded via Homebrew) on macOS Ventura (13.7)

**Note**: This was also tested in macOS Monterey (12.7.6) running version 8.03 of MySQL.

---

## Install MySQL

Download the Community Server version of MySQL (version 9.1 as of this writing) from [MySQL Community Downloads](https://dev.mysql.com/downloads/mysql/). Choose the **DMG Archive** version of the installer for the chip on your machine: **x86, 64-bit** for Intel chips; **ARM, 64-bit** for the Apple M1, M2, and M3 chips. Make sure to take all the defaults during the installation process.

Once you’re done installing MySQL, log in as root and run the `status` command. Ensure that `Server characterset`, `Db characterset`, `Client characterset`, and `Conn. characterset` are all set to `utf8mb4`.

---

## Install PHP

Use Homebrew to install PHP:

```bash
brew install php
```

Pay attention to the the `caveats` that Homebrew informs you about once the installation is complete. If you miss it, run `brew info php` at anytime to retrieve that info.

---

## Configure Apache

**Note**: You will be asked repeatedly for the password associated with the current user anytime you save `httpd.conf`, starting with step 2 below.

### 1. Put `/etc/apache2` under Git control

### 2. Open `/etc/apache2/httpd.conf` in an editor

Look for the following line:

```apacheconf
#PHP was deprecated in macOS 11 and removed from macOS 12
```

Replace it with:

```apacheconf
LoadModule php_module /usr/local/opt/php/lib/httpd/modules/libphp.so
```

**Note**: The above module is installed by PHP.

### 3. Set a Handler for PHP

```apacheconf
<FilesMatch \.php$>
    SetHandler application/x-httpd-php
</FilesMatch>
```

### 4. Have the Server Also Serve `index.php` From a Folder

Look for the `<IfModule dir_module>` entry, then update it to handle `index.php`:

```apacheconf
DirectoryIndex index.php index.html
```

### 5. Sign the PHP Module

1. [How to create Certificate Authority for Code Signing in macOS](https://www.simplified.guide/macos/keychain-ca-code-signing-create)
2. [How to Sign Homebrew PHP Module in macOS](https://www.simplified.guide/macos/apache-php-homebrew-codesign)

### 6. Restart/Bounce the Server

```bash
sudo apachectl graceful
```

See the [Apache-Related Commands](some-apache-commands.md) file for more commands.

---

## Configure Apache to Work With a Home Directory

### 1. Again, open `/etc/apache2/httpd.conf` in an editor

### 2. Enable Home Directories

Enable home directories by locating the following commented line in
`httpd.conf`, then uncommenting it:

```apacheconf
#Include /private/etc/apache2/extra/httpd-userdir.conf
```

Save the file.

### 3. Enable the `userdir` Shared Object

Uncomment the following line:

```apacheconf
LoadModule userdir libexec/apache2/mod_userdir.so
```

Save the file.

### 4. Update `User` and `Group`

Search for the `IfModule unixd_module` tag. Within it you’ll find `User` and `Group`, each of which likely has a `_www` value, like the following:

```apacheconf
User _www
Group _www
```

For `User`, change `_www` to your Mac’s current user short name. (Type `whoami` in The Terminal to get this value.) For `Group`, change `_www` to `staff`.

Save the file. This is the last change to `httpd.conf`, so you may now close it.

### 5. Enable The Sites Folder

Open `etc/apache2/extra/httpd-userdir.conf` in your editor, then uncomment the
line:

```apacheconf
#Include /private/etc/apache2/users/*.conf
```

Save and close the file.

### 6. Create The Folder That Will Hold Your Sites

Create a folder called `Sites` in your home folder. For example, on my system
the path would be `/Users/royv/Sites`.

### 7. Add Your User-Specific Config File

Navigate to the `/etc/apache2/users` folder and see if you have a `.conf` file with your computer’s short name in the file name. It’s likely that you don’t. (Type `whoami` in The Terminal to get your short name.) For example, if my short name was `royv`, then a `royv.conf` file should exist under the `users` folder. If it doesn’t exist, create it (you’ll be asked for your current user’s password):

```bash
sudo touch $(whoami).conf
```

Now edit the file, adding the following and replacing `ENTER_SHORT_USER_NAME_HERE` with your short name:

```apacheconf
<Directory "/Users/ENTER_SHORT_USER_NAME_HERE/Sites/"> 
    AddLanguage en .en
    AddHandler cgi-script .cgi .php
    Options Indexes MultiViews FollowSymLinks ExecCGI
    AllowOverride None
    Require host localhost
</Directory>
```

### 8. Bounce the Server

```bash
sudo apachectl graceful
```

### 9. Visit `localhost`

1. Open a browser and point it to `localhost`. It should say that “It Works!”.
2. Repoint your browser to `localhost/~YOUR_USERNAME`, where `YOUR_USERNAME` is your Mac’s short name. It should say “Index of /”.

---

## Notes

### Something Broken?

If something’s not working, retrace your steps. If you find a mistake, file an issue on GitHub.

### Access and Errors

It’s imperative that you’re aware of access and error records thrown in real time by the server. The files `error_log` and `access_log` are in `/var/log/apache2`. Run the `tail` command on each file within two separate CLI windows:

```bash
tail -f /var/log/apache2/access_log
```

and

```bash
tail -f /var/log/apache2/error_log
```
