const express = require('express');
const cors = require('cors');
const router = express.Router();

const addressService = require('../services/address-service');
const postoffices = require('../services/postoffice');

router.get('/', async function(req,res,next) {
    try {
        res.json('Address');
    } catch (err) {
        next(err);
    }
});

router.get('/all-addresses', async function(req,res,next) {
    try {
        res.json(await adressService.get(req.query.page));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);

        }   
});

router.get('/all', async function(req,res,next) {
    try {
        res.json(await adressService.getData());
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.get('/addressid/:id', async function(req,res,next) {
    let id = req.params.id;
    console.log('ID: ${id}',id);
    try {
        res.json(await adressService.getById(id));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.post('/createadress', async function(req,res,next) {
    try {
        res.json(await adressService.createAdress(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.put('/updateaddress/:id', async function(req,res,next) {
    try {
        res.json(await adressService.updateAddress(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.delete('/removeaddress/:id', async function(req,res,next) {
    try {
        res.json(await adressService.removeAddress(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

                  

module.exports = router;