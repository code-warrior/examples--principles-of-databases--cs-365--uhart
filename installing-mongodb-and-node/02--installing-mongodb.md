# Installing MongoDB

**Burden**: ~30 mins

1. [Install Node](01--installing-node.md)
2. Install MongoDB

---

To install the latest version of MongoDB, version 8.0 as of 17 November 2024, you’ll need macOS 11 (Big Sur, 2020) or later. If you’re running macOS 10.14 (Mojave, 2018), you can install version 6.0. No in-class support is provided for versions of macOS under 10.14.

**Note**: Installing MongoDB via Homebrew, noted below, installs the `mongod` server, the `mongos` sharded cluster query router, and `mongosh`, the MongoDB shell.

---

## Mac

[Homebrew](https://brew.sh/) is required to install MongoDB. Run `brew update` before proceeding.

### Installing 8.0 (for macOS 11 — Big Sur — or later)

[https://www.mongodb.com/docs/manual/tutorial/install-mongodb-on-os-x/#std-label-install-mdb-community-macos](https://www.mongodb.com/docs/manual/tutorial/install-mongodb-on-os-x/#std-label-install-mdb-community-macos)

### Installing 6.0 (for macOS 10.14 — Mojave — or later)

[https://www.mongodb.com/docs/v6.0/tutorial/install-mongodb-on-os-x/](https://www.mongodb.com/docs/v6.0/tutorial/install-mongodb-on-os-x/)

### Installation in a Nutshell

#### 1. Add `mongodb/brew` to Homebrew’s tap

```bash
brew tap mongodb/brew
```

#### 2. Update Homebrew

```bash
brew update
```

#### 3. Install MongoDB

For macOS 11 (Big Sur) or later

```bash
brew install mongodb-community@8.0
```

For macOS 10.14 (Mojave) or later

```bash
brew install mongodb-community@6.0
```

#### 4. Install MongoDB’s Tools

```bash
brew install mongodb-database-tools
```

---

## Windows

Installing MongoDB is a two-step process in Windows (10 and 11). The first step installs the Community Server, which is comprised of the `mongod` server and the `mongos` sharded cluster query router. The second step installs `mongosh`, the MongoDB shell.

1. Visit [https://www.mongodb.com/docs/manual/tutorial/install-mongodb-on-windows/](https://www.mongodb.com/docs/manual/tutorial/install-mongodb-on-windows/) and click `Download` to download the `mongodb-windows-x86_64-8.0.3-signed.msi` installer. Take all the defaults during installation, and, optionally, install Compass. The installer will install its binaries to the folder `C:\Program Files\MongoDB\Server\8.0`.

2. Visit [https://www.mongodb.com/try/download/shell](https://www.mongodb.com/try/download/shell) and click `Download` to download `mongosh-2.3.3-win32-x64.zip`. Uncompressing the `.zip` file creates a folder called `mongosh-2.3.3-win32-x64`. Move this folder into the `C:\Program Files\MongoDB\` folder created in the previous step. The resulting path should be `C:\Program Files\MongoDB\mongosh-2.3.3-win32-x64`.

3. Visit [https://www.mongodb.com/try/download/database-tools](https://www.mongodb.com/try/download/database-tools) and click `Download` to download `mongodb-database-tools-windows-x86_64-100.10.0.zip`. Uncompressing the `.zip` file creates a folder called `mongodb-database-tools-windows-x86_64-100.10.0`. Move this folder into the `C:\Program Files\MongoDB\` folder created in step 1. The resulting path should be `C:\Program Files\MongoDB\mongodb-database-tools-windows-x86_64-100.10.0`.

The folders that were just created included `bin` folders for their binaries: `C:\Program Files\MongoDB\Server\8.0\bin`, `C:\Program Files\MongoDB\mongosh-2.3.3-win32-x64\bin`, and `C:\Program Files\MongoDB\mongodb-database-tools-windows-x86_64-100.10.0\bin`. Verify these paths, then [add them to your Environment Variables](editing-the-windows-environment-variables.md). If you’re using Cygwin, you’ll need to update your `PATH` in `~/.bashrc`:

```bash
# Add MongoDB’s mongod, mongos, the tools, and mongosh binaries to the path
PATH=$PATH:/cygdrive/c/Program\ Files/MongoDB/Server/8.0/bin/:PATH=$PATH:/cygdrive/c/Program\ Files/MongoDB/mongosh-2.3.3-win32-x64/bin/:PATH=$PATH:/cygcrive/c/Program\ Files/MongoDB/mongodb-database-tools-windows-x86_64-100.10.0/bin
export PATH
```

Launch the Command Prompt and type `mongsh`, then do the same for PowerShell, and, optionally Cygwin. Each CLI should take you to MongoDB’s `test` database.
