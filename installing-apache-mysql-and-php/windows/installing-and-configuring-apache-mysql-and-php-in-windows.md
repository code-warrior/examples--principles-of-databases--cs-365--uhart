# Installing and Configuring Apache, MySQL, and PHP in Windows 10 and 11

Be prepared to restart your machine at least twice during these installations.

The following assumes…

* you’ve installed Chocolatey;
* you’ve installed Firefox;
* you’ve installed and configured MySQL;
* that the PowerShell is your default CLI, or command line interface.

And, lastly, before you begin, consider starting a scratch file on your desktop, perhaps called `paths.txt`. You’ll be working with many paths in the following installation, so having a scratch file with paths will make the installation process easier.

---

## Installing Apache

1. Type `choco install apache-httpd` from the PowerShell to install Apache.
2. Take all the defaults.
3. Type `gcm httpd` to retrieve the path to Apache’s binary. Copy the path.
4. Edit your Environment Variable to include this new path.
5. Restart the PowerShell.
6. Type `httpd -k install` to install the primary Apache service.
7. Restart your computer.
8. Navigate to the `htdocs` folder inside the Apache folder.
9. Create a new file called `info.php`, then add `<?php echo phpinfo();`. Save it. We’ll need this file during the PHP installation phase later.
10. From Apache’s `conf` folder, open `httpd.conf` in your editor.
11. Locate the the following configuration section:
```apache
<IfModule dir_module>
  DirectoryIndex index.html
</IfModule>
```
Precede `index.html` with `index.php`, so it looks like:
```apache
<IfModule dir_module>
  DirectoryIndex index.php index.html
</IfModule>
```
12. In the same `httpd.conf` file, add the following to the end of the file, assuming PHP is in `C:\php`:
```php
# PHP8 module
PHPIniDir "C:/php"
LoadModule php_module "C:/php/php8apache2_4.dll"
AddType application/x-httpd-php .php
```
**Note**: The forward slashes are *not* a typo.

13. Open Firefox and type `localhost` in the address bar. You might be told that the connection isn’t secure. Ignore the warning and continue to the _localhost_ site.

14. In the PowerShell, type `httpd -V` to see some important configuration settings for your Apache server.

---

## Uninstalling Chocolately’s PHP

If you installed PHP via Chocolately, remove it; we’re going to install it manually. Skip this step if you haven’t installed PHP before.

1. Type `gcm php` in the PowerShell to get the path that contains the Chocolately install of PHP. (Likely `C:\tools\php82`.)
2. Navigate to the parent folder of the PHP folder. (Likely `C:\tools`.)
3. Type `choco uninstall php` to have Chocolately unistall PHP.
4. The uninstaller likely will not remove the PHP folder, so we’ll need to do it manually: `rm php82` (assuming `php82` is the name of the PHP folder).

---

## Installing PHP

1. Visit [PHP’s downloads page](https://windows.php.net/download#php-8.3).
2. Download the ZIP archive of the latest *Thread Safe* version of PHP. (The non thread safe version lacks the Apache module we need for this installation.)
3. Install to `C:\php`.
4. Edit your Environment Variable to include this new path.
5. Using the PowerShell, navigate to the `php` folder and locate `php.ini-development`.
6. Copy this configuration file to the proper name PHP looks for: `cp php.ini-development php.ini`.
7. Find the entry for the PHP Data Object/MySQL extension: `;extension=pdo_mysql`. Uncomment it by removing the `;`.
8. Restart your computer.
9. Bounce the server: `httpd -k stop; httpd -k start`, or simply `httpd -k restart`.
10. Launch Firefox and type [`http://localhost/info.php`](http://localhost/info.php). If the installation and configuration of PHP worked, then you would see a web page consisting of a long table with configuration entries. Otherwise, you’d see the contents of `info.php` as plain text in the browser, or your browser would ask you to download the file. Either of these last two events indicates that PHP is not communicating with Apache. Retrace the steps in this installation tutorial.

---

## Stand up the Test App

1. Launch your PowerShell.
2. Navigate to your `htdocs` directory within Apache.
3. Clone the test app we’ll need from [https://bitbucket.org/code-warrior/web-app/src/master/](https://bitbucket.org/code-warrior/web-app/src/master/).
