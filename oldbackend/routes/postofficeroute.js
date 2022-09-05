const express = require('express');
const router = express.Router();
const postoffices = require('../services/postoffice');

router.get('/', async function(req,res,next){
    try{
        res.json(await postoffices.getData());
    }catch(err){   
        next(err);
    }   
});

module.exports = router;
