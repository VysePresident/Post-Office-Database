//Express
const express = require('express');
const cors = require('cors');
const router = express.Router();

const postOfficesService = require('../services/postOffice-service');
const postoffices = require('../services/postoffice')
router.get('/', async function(req,res,next) {
    try {
        res.json('postOffices');
    } catch (err) {
        next(err);
    }
});

router.get('/all-postOffices', async function(req,res,next) {
    try {
        res.json(await postOfficesService.get(req.query.page));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);

        }   
});

router.get('/all', async function(req,res,next) {
    try {
        res.json(await postOfficesService.getData());
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.get('/postOfficeid/:id', async function(req,res,next) {
    let id = req.params.id;
    console.log('ID: ${id}',id);
    try {
        res.json(await postOfficesService.getById(id));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.post('/createpostOffice', async function(req,res,next) {
    try {
        res.json(await postOfficesService.createpostOffice(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.put('/updatepostOffice/:id', async function(req,res,next) {
    try {
        res.json(await postOfficesService.updatepostOffice(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.delete('/removepostOffice/:id', async function(req,res,next) {
    try {
        res.json(await postOfficesService.removepostOffice(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

                  

module.exports = router;