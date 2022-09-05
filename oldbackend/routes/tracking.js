//Express
const express = require('express');
const cors = require('cors');
const router = express.Router();

const trackingsService = require('../services/tracking-service');
const postoffices = require('../services/postoffice')
router.get('/', async function(req,res,next) {
    try {
        res.json('trackings');
    } catch (err) {
        next(err);
    }
});

router.get('/all-trackings', async function(req,res,next) {
    try {
        res.json(await trackingsService.get(req.query.page));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);

        }   
});

router.get('/all', async function(req,res,next) {
    try {
        res.json(await trackingsService.getData());
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.get('/trackingid/:id', async function(req,res,next) {
    let id = req.params.id;
    console.log('ID: ${id}',id);
    try {
        res.json(await trackingsService.getById(id));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.post('/createtracking', async function(req,res,next) {
    try {
        res.json(await trackingsService.createTracking(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.put('/updatetracking/:id', async function(req,res,next) {
    try {
        res.json(await trackingsService.updateTracking(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.delete('/removetracking/:id', async function(req,res,next) {
    try {
        res.json(await trackingsService.removeTracking(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

                  

module.exports = router;