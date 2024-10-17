# Configuring MySQL in Windows

## Adding the Path to MySQL Binaries to your Environment

1. Type the key with the Windows® key + R.
2. Enter `services.msc`.
3. Locate `MySQL` then context-click it.
4. Choose `Properties` and note the executable path, which will include `mysql.exe` or `mysqld.exe`.
5. Add the parent to the `mysql.exe/mysqld.exe` to your environment.

---

## Starting/Stopping the MySQL Service

The following assumes you have MySQL 8.1

1. Run `net stop MYSQL81` to stop MySQL from the PowerShell.
2. Run `net start MYSQL81` to start it.
