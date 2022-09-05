const express = require('express');
const cors = require('cors');
const router = express.Router();
const {employee_login, customer_login, logout} = require('../services/auth-service');
const {authenticateUser} = require('../authenticate');

router.post('/employee-login', employee_login); //Employee admin login
router.post('/customer-login', customer_login); //Customer login
router.post('/logout', authenticateUser, logout);

module.exports = router;

