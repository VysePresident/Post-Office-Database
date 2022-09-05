const express = require('express');
const app = express();
const port = 3000;
const postofficerouter = require('./routes/postofficeroute');

app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use('/postoffice', postofficerouter);
app.use ((err, req, res, next) => {
    const code = err.statusCode || 500;
    console.error(err.message, err.stack);
    res.status(code).json({message:err.message});
    return;
});
app.get("/", (req, res) => res.json({ message: "Hello World!" }));

app.listen(port, () => console.log(`Server listening on port ${port}!`));

