const express = require(`express`);
const app = express();
const nunjucks = require(`nunjucks`);
const bodyParser = require(`body-parser`);
const mongoDB = require(`mongodb-legacy`); // https://www.npmjs.com/package/mongodb-legacy
const mongoClient = mongoDB.MongoClient;
const HOST = `localhost`;
const dbPort = `27017`;
const dbURL = `mongodb://${HOST}`;
const dbName = `project`;
const dbCollection = `users`;
const PORT = 3000;
const port = (process.env.PORT || PORT);
const colors = {
    reset: `\x1b[0m`,
    red: `\x1b[31m`,
    green: `\x1b[32m`,
    yellow: `\x1b[33m`,
};

let db;

nunjucks.configure(`views`, {
    express: app,
    autoescape: true
});

mongoClient.connect(`${dbURL}:${dbPort}`, (err, client) => {
    if (err) {
        return console.log(err);
    } else {
        db = client.db(dbName);

        console.log(`MongoDB successfully connected:`);
        console.log(`\tMongo URL:`, colors.green, dbURL, colors.reset);
        console.log(`\tMongo port:`, colors.green, dbPort, colors.reset);
        console.log(`\tMongo database name:`,
            colors.green, dbName, colors.reset, `\n`);
    }
});

app.listen(port, HOST, () => {
    console.log(`Host successfully connected:`);
    console.log(`\tServer URL:`, colors.green, `localhost`, colors.reset);
    console.log(`\tServer port:`, colors.green, port, colors.reset);
    console.log(`\tVisit http://localhost:${port}\n`);
});

// Express’s way of setting a variable. In this case, “view engine” to “njk” (Nunjucks).
app.set(`view engine`, `njk`);

// Express middleware to parse incoming, form-based request data before processing form data.
app.use(bodyParser.urlencoded({extended: true}));

// Express middleware to parse incoming request bodies before handlers.
app.use(bodyParser.json());

// Express middleware to serve HTML, CSS, and JS files from the included “public” folder.
app.use(express.static(`public`));

/**
 * Note:
 *    — All req(uests) are from the client/browser.
 *    — All res(ponses) are to the client/browser.
 */

/**
 * This router handles all GET requests to the root of the web site.
 */
app.get(`/`, (req, res) => {
    console.log(`User requested root of web site.`);
    console.log(`Responding to request with file`,
        colors.green, `index.njk`, colors.reset, `via GET.`);

    res.render(`index.njk`);
});

/**
 * This router handles all GET requests to the “read-a-db-record” directory, specifically, queries to the database.
 */
app.get(`/read-a-db-record`, (req, res) => {
    db.collection(dbCollection).find().toArray((err, arrayObject) => {
        if (err) {
            return console.log(err);
        } else {
            console.log(`User requested http://${HOST}:${port}/read-a-db-record.`);
            console.log(`Responding to request with file`,
                colors.green, `read-from-database.njk`, colors.reset, `via GET.\n`);

            res.render(`read-from-database.njk`, {mongoDBArray: arrayObject});
        }
    });
});

/**
 * This route is invoked — via app.get — when a user visits
 * http://localhost:3000/create-a-db-record/
 */
app.get(`/create-a-db-record`, (req, res) => {
    res.render(`create-a-record-in-database.njk`);
});

/**
 * This route is invoked — via app.post — when a POST request from the form in
 * create-a-record-in-database.njk is submitted.
 */
app.post(`/create-a-db-record`, (req, res) => {
    db.collection(dbCollection).insertOne(req.body, (err) => {
        console.log(req.body);

        if (err) {
            return console.log(err);
        } else {
            console.log(
                `Inserted one record into Mongo via an HTML form using POST.\n`);

            res.redirect(`/read-a-db-record`);
        }
    });
});

/**
 * This route is invoked — via app.get — when a user visits
 * http://localhost:3000/update-a-db-record/
 */
app.get(`/update-a-db-record`, (req, res) => {
    db.collection(dbCollection).find().toArray((err, arrayObject) => {
        if (err) {
            return console.log(err);
        } else {
            console.log(`User requested the resource ` +
                `http://${HOST}:${port}/update-a-db-record`);

            res.render(`update-a-record-in-database.njk`,
                {mongoDBArray: arrayObject});
        }
    });
});

/**
 * This route is invoked — via app.post — when a POST request from the form in
 * update-a-record-in-database.njk is submitted.
 */
app.post(`/update-a-db-record`, (req, res) => {
    let nameFromForm = req.body.name;

    console.log(nameFromForm); // For example, cianna
    console.log(req.body);     // For example, { name: 'cianna', password: 'asdf' }

    db.collection(dbCollection).updateOne(
        { name: nameFromForm },
        { $set: {"password": req.body.password} }
    ).then(() => {
        db.collection(dbCollection).find().toArray((err, arrayObject) => {
            if (err) {
                return console.log(err);
            } else {
                console.log(
                    `Updated one record into Mongo via an HTML form using POST.\n`);

                res.render(`read-from-database.njk`, {mongoDBArray: arrayObject});
            }
        });
    }) ;
});

app.get(`/delete-a-db-record`, (req, res) => {
    db.collection(dbCollection).find().toArray((err, arrayObject) => {
        res.render(`delete-a-record-in-database.njk`,
            {mongoDBArray: arrayObject});
    });
});

app.post(`/delete-a-db-record`, (req, res) => {
    let nameFromForm = req.body.name;

    db.collection(dbCollection).deleteOne({ name: nameFromForm })
        .then(() => {
            db.collection(dbCollection).find().toArray((err, arrayObject) => {
                if (err) {
                    return console.log(err);
                } else {
                    console.log(`User requested the resource ` +
                        colors.green, `http://${HOST}:${port}/delete-a-db-record`, colors.reset);

                    res.render(`read-from-database.njk`, {mongoDBArray: arrayObject});
                }
            });
        });
});
