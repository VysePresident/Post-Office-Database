//Express
const express = require('express');
const cors = require('cors');
const router = express.Router();

const customersService = require('../services/customers-service');
const postoffices = require('../services/postoffice')
router.get('/', async function(req,res,next) {
    try {
        res.json('Customers');
    } catch (err) {
        next(err);
    }
});

router.get('/all-customers', async function(req,res,next) {
    try {
        res.json(await customersService.get(req.query.page));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);

        }   
});

router.get('/all', async function(req,res,next) {
    try {
        res.json(await customersService.getData());
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.get('/userid/:id', async function(req,res,next) {
    let id = req.params.id;
    console.log('ID: ${id}',id);
    try {
        res.json(await customersService.getById(id));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.post('/createcustomer', async function(req,res,next) {
    try {
        res.json(await customersService.createCustomer(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.put('/updatecustomer/:id', async function(req,res,next) {
    try {
        res.json(await customersService.updateCustomer(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.delete('/removecustomer/:id', async function(req,res,next) {
    try {
        res.json(await customersService.removeCustomer(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

                  

module.exports = router;