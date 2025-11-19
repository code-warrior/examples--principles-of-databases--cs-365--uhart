# README

## Stand Up the Local CRUD Example

1. Launch your CLI, then start the Mongo server: `brew services start mongodb-community@8.0`
2. Open another CLI window and log in to Mongo: `mongosh`
3. Open yet another CLI window and navigate to this repo’s `models` folder
4. Run `mongorestore`, which will restore the `project` database containing the `users` collection from the `dump` folder
5. Navigate to the root of this repo
6. Run `npm i` to install the dependencies from the `package.json` file
7. Run `npm run dev`
8. Open a browser and point it to `http://localhost:3000`

---

## Useful Links

[Backing Up and Restoring MongoDB Databases](dumping-and-restoring-the-database.md) (internal)

[Routing](https://expressjs.com/en/guide/routing.html) (external)
