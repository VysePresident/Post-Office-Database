//Express
const express = require('express');
const cors = require('cors');
const router = express.Router();

const supervisionsService = require('../services/supervision-service');
const postoffices = require('../services/postoffice')
router.get('/', async function(req,res,next) {
    try {
        res.json('supervisions');
    } catch (err) {
        next(err);
    }
});

router.get('/all-supervisions', async function(req,res,next) {
    try {
        res.json(await supervisionsService.get(req.query.page));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);

        }   
});

router.get('/all', async function(req,res,next) {
    try {
        res.json(await supervisionsService.getData());
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.get('/supervisionid/:id', async function(req,res,next) {
    let id = req.params.id;
    console.log('ID: ${id}',id);
    try {
        res.json(await supervisionsService.getById(id));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.post('/createsupervision', async function(req,res,next) {
    try {
        res.json(await supervisionsService.createsupervision(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.put('/updatesupervision/:id', async function(req,res,next) {
    try {
        res.json(await supervisionsService.updatesupervision(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.delete('/removesupervision/:id', async function(req,res,next) {
    try {
        res.json(await supervisionsService.removesupervision(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

                  

module.exports = router;