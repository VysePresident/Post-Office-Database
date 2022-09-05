const express = require('express');

const app = express();
const cors = require('cors');
const port = 3000;

app.use(cors());
app.use(express.json());

//Routes Includes
const customersRouter = require('./routes/customers');
const employeesRouter = require('./routes/employees');
const addressRouter = require('./routes/address');
const itemRouter = require('./routes/item');
const packageRouter = require('./routes/package');
const postOfficeRouter = require('./routes/postOffice');
const supervisonRouter = require('./routes/supervision');
const trackingRouter = require('./routes/tracking');

//Middleware
// app.use((req, res, next) => {
//     console.log("Middleware for authentication");
//     next();
// })

//Authentication Route
const authRouter = require('./routes/auth');
const {authenticateUser} = require('./authenticate');

//Open Auth Endpoint
app.use('/app/auth', authRouter);

//Auth lock
app.use(authenticateUser);

//Routes
app.use('/app/customers', authenticateUser, customersRouter);
app.use('/app/employees', authenticateUser, employeesRouter);
app.use('/app/address', authenticateUser, addressRouter);
app.use('/app/item', authenticateUser, itemRouter); 
app.use('/app/package', authenticateUser, packageRouter);
app.use('/app/postOffice', authenticateUser, postOfficeRouter);
app.use('/app/supervision', authenticateUser, supervisonRouter);
app.use('/app/tracking', authenticateUser, trackingRouter);

app.use ((err, req, res, next) => {
    const code = err.statusCode || 500;
    console.error(err.message, err.stack);
    res.status(code).json({message:err.message});
    return;
});

app.get('/',(req,res)=>{
    res.json({
        message:'Welcome to the Backend'
    });
});


app.listen(port, ()=>console.log(`Server is running on port ${port}`));
