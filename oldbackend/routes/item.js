//Express
const express = require('express');
const cors = require('cors');
const router = express.Router();

const itemService = require('../services/item-service');
const postoffices = require('../services/postoffice')
router.get('/', async function(req,res,next) {
    try {
        res.json('item');
    } catch (err) {
        next(err);
    }
});

router.get('/all-item', async function(req,res,next) {
    try {
        res.json(await itemService.get(req.query.page));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);

        }   
});

router.get('/all', async function(req,res,next) {
    try {
        res.json(await itemService.getData());
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.get('/itemid/:id', async function(req,res,next) {
    let id = req.params.id;
    console.log('ID: ${id}',id);
    try {
        res.json(await itemService.getById(id));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.post('/createitem', async function(req,res,next) {
    try {
        res.json(await itemService.createItem(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.put('/updateitem/:id', async function(req,res,next) {
    try {
        res.json(await itemService.updateItem(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.delete('/removeitem/:id', async function(req,res,next) {
    let id = req.params.id;
    console.log('ID: ${id}',id);
    try {
        res.json(await itemService.removeItem(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

                  

module.exports = router;