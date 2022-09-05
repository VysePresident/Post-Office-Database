//Express
const express = require('express');
const cors = require('cors');
const router = express.Router();

const packagesService = require('../services/package-service');
const postoffices = require('../services/postoffice')
router.get('/', async function(req,res,next) {
    try {
        res.json('packages');
    } catch (err) {
        next(err);
    }
});

router.get('/all-package', async function(req,res,next) {
    try {
        res.json(await packagesService.get(req.query.page));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);

        }   
});

router.get('/all', async function(req,res,next) {
    try {
        res.json(await packagesService.getData());
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.get('/psotOfficeid/:id', async function(req,res,next) {
    let id = req.params.id;
    console.log('ID: ${id}',id);
    try {
        res.json(await packagesService.getById(id));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
        }
});

router.post('/createpackage', async function(req,res,next) {
    try {
        res.json(await packagesService.createpackage(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.put('/updatepackage/:id', async function(req,res,next) {
    try {
        res.json(await packagesService.updatepackage(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

router.delete('/removepackage/:id', async function(req,res,next) {
    try {
        res.json(await packagesService.removepackage(req));
        } catch (err) {
            console.error(`Error `, err.message);
            next(err);
            }
});

                  

module.exports = router;