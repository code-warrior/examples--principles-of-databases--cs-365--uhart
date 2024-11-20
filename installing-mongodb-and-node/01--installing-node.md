# Installing Node

**Burden**: ~20 mins

1. Install Node
2. [Install MongoDB](02--installing-mongodb.md)

---

Visit [Node.js](https://nodejs.org/en) to download the appropriate executable for your OS.

## Mac

When installing Node, its executable will likely be installed to `\usr\local\bin`. Thus, no path entries need to be updated. Check the installation by typing `node -v` in The Terminal.

## Windows

During the installation procedure, Node will present you with options for **Destination Folder**, **Custom Setup**, and **Tools for Native Modules**. When presented with the **Destination Folder** window, note the target folder, likely `C:\Program Files\nodejs\`, because you’ll need it to edit your Environment Variable and/or your `PATH` in Cygwin.

At the **Custom Setup** window, ensure the option to `add to PATH` (under its drop down menu) is `Entire feature will be installed on local hard drive`.

At the **Tools for Native Modules** window, ensure its check box is **_not_** enabled.

Once the installation is complete, you’ll have a `Node.js` app, which is Node’s REPL (read-evaluate-print-loop), or CLI (command line interface). Hit the Windows key and type “node”. The `Node.js` app should appear. Launch it, then type `.exit`.

You’ll now need to check if Node is available at the Command Prompt and PowerShell. Launch each and type `node -v`. You should be presented with the current Node version. If the `node` command is not recognized, you’ll need to [edit your environment variable](editing-the-windows-environment-variables.md).

For Cygwin, you’ll have to edit the `PATH` variable in your `.bashrc` file, which is in `/home/WINDOWS_USERNAME`¹. Launch `.bashrc` in your editor and add the following²:

```bash
PATH=$PATH:/cygdrive/c/Program\ Files/nodejs/
export PATH
```

---

¹ Replace `WINDOWS_USERNAME` with your username in Windows.  
² The path to Node comes from the **Destination Folder** step during installation. Your path may differ.
