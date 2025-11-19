## Dumping the Database
In your project’s root folder, run the following command, replacing `DATABASE_NAME` with the name of the database you want to back up, and `COLLECTION_NAME` with the name of the collection in your database that you’d like to back up.

```bash
mongodump \
   --db DATABASE_NAME \
   --collection COLLECTION_NAME
```

If the command was successful, you’ll have a `dump` folder in your current directory.

---

## Restoring from a Dump
Simply run `mongorestore` from the parent of the `dump` folder.
