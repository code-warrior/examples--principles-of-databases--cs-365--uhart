# Some Apache-Related Commands

The following commands will likely require you to prepend each command with `sudo`, which means you’ll need the current user’s password, assuming the current user has admin privileges.

## Locate the Apache Binary

```bash
which httpd
```

If you get more than one result, it means you have multiple versions of Apache installed. Apache is pre-installed in macOS. If, for example, you installed Apache at some point using Homebrew, then you may have two copies: `/usr/sbin/apachectl` (pre-installed Apache) and `/usr/local/bin/apachectl` (Homebrew-installed Apache). *This tutorial is for the pre-installed version.*

## Stop the Apache Server

```bash
apachectl stop
```

## Start the Apache Server

```bash
apachectl start
```

## Restart (Bounce) the Apache Server

```bash
apachectl graceful
```

## Run Syntax Check on Config Files

```bash
apachectl -t
```

## Show the Path to the Server Config File

```bash
apachectl -V | grep SERVER_CONFIG_FILE
```

## Show All Included Configuration Files

```bash
apachectl -t -D DUMP_INCLUDES
```
