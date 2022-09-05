//Express
const express = require('express');
const cors = require('cors');
const router = express.Router();

const employeesService = require('../services/employees-service');

router.get('/', async function(req,res,next) {
    try {
        res.json('Cmployees');
    } catch (err) {
        next(err);
    }
});

router.get('/all-employees', async function(req,res,next) {
    try {
        res.json(await employeesService.get(req.query.page));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);

        }   
});

router.get('/all', async function(req,res,next) {
    try {
        res.json(await employeesService.getData());
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.get('/userid/:id', async function(req,res,next) {
    let id = req.params.id;
    console.log('ID: ${id}',id);
    try {
        res.json(await employeesService.getById(id));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.post('/createemployee', async function(req,res,next) {
    try {
        res.json(await employeesService.createEmployee(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.put('/updateemployee/:id', async function(req,res,next) {
    try {
        res.json(await employeesService.updateEmployee(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.delete('/removeemployee/:id', async function(req,res,next) {
    try {
        res.json(await employeesService.removeEmployee(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

                  

module.exports = router;