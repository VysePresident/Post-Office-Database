const db = require('./db');
const helper = require('../helper');
const config = require('../config');
const {generateToken} = require('../authenticate');

//bcrypt jsonwebtoken login 
// add username email and password to employee and custoemr tables
// create roles

// employee login
/* email, pass, check in db if user exists
    if user exists, check if password is correct
        if password is correct, return token
        if password is incorrect, return error
    if user does not exist, return error
*/

employee_login = async (req, res, next) => {
    console.log('Employee Login');

    const email = req.body.email;
    const password = req.body.password;
    const params = [email];
    const sql = 'SELECT * FROM Employee WHERE email = ?';
    const rows = await db.query(sql, params);
    if (rows.length == 0) {
        res.status(401).json({
            message: 'User does not exist in database'
        });
    }

    // Get password from user in database
    const employee_password = rows[0].password;

    // Check if password is correct
    try{
        if (employee_password === password) {
            //Authentication begins
            const employee = { email:email }
            const token = generateToken(employee);
            return res.status(200).json({
                authtoken: token,
                type: 'employee'
            })

        }
        else {
            return res.status(401).send("Incorrect combination of email and password");
        }
    }
    catch(err){
        next(err)
    }
}



// customer login
customer_login = async (req, res, next) => {
    console.log('Customer Login');

    const email = req.body.email;
    const password = req.body.password;
    const params = [email];
    const sql = 'SELECT * FROM Customer WHERE email = ?';
    const rows = await db.query(sql, params);
    if (rows.length == 0) {
        res.status(401).json({
            message: 'User does not exist in database'
        });
    }

    // Get password from user in database
    const customer_password = rows[0].password;

    // Check if password is correct
    try{
        if (customer_password === password) {
            //Authentication begins
            const customer = { email:email }
            const token = generateToken(customer);
            return res.status(200).json({
                authtoken: token,
                type: 'customer'
            })

        }
        else {
            return res.status(401).send("Incorrect combination of email and password");
        }
    }
    catch(err){
        next(err)
    }
}
// logout

logout = (req, res) => {
    console.log('Logout');
    const header = req.headers['authorization'];
    const token = header && header.split(' ')[1];
    if (token == null) {
        return res.status(401).send('Nulled token - Logging out user');
    }
    res.send("Logging out");
}

module.exports = {
    employee_login,
    customer_login,
    logout
}