const db = require('./db');
const helper = require('../helper');
const config = require('../config');

async function get() {
    const rows = await db.query(`SELECT * FROM Package`);
    const data = helper.rowclean(rows);
    return data;
}

async function getPackage(id) {
    const rows = await db.query(`SELECT * FROM Package WHERE Package_ID = ?`, [id]);
    const data = helper.rowclean(rows);
    return data;
}

async function getData(page = 1){
    const offset = helper.getoffset(page, config.listPerPage);
    const rows = await db.query(`select * from Package LIMIT ${offset},${config.listPerPage}`);
    const data = helper.rowclean(rows);
    const meta = {page};
    return {meta, data}
}

async function getById(Package_ID) {
    const user = await db.query(`SELECT * FROM Package WHERE Package_ID = ?`, [Package_ID]);
    const data = helper.rowclean(user);

    return data;
}

async function createPackage(req) {
    const Package_ID = req.body.Package_ID;
    const Customer_ID = req.body.Customer_ID;;
    const Package_Type = req.body.Package_Type;
    const Package_Weight= req.body.Package_Weight;
    const Package_Volume = req.body.Volume; 
    const IC_Address_Key = req.body.IC_Address_Key;
    const OT_Address_Key = req.body.OT_Address_Key; 
    const Recieved = req.body.Recieved;  
    
    console.log("CreatePackage", Package_ID, Customer_ID, Package_Type, Package_Weight, Package_Volume, IC_Address_Key, OT_Address_Key, Recieved);

    const Package = await db.query(
        `INSERT INTO Package (Package_ID, Customer_ID, Package_Type, Package_Weight, Package_Volume, IC_Address_Key, OT_Address_Key, Recieved) 
        VALUES (?,?,?,?,?,?,?,?)`, 
        [Package_ID, Customer_ID, Package_Type, Package_Weight, Package_Volume, IC_Address_Key, OT_Address_Key, Recieved]);


    console.log("CreatePackage:", Package);
    return {"message": "Package created"};
}

async function updatePackage(req) {
    const Customer_ID = req.body.Customer_ID;;
    const Package_Type = req.body.Package_Type;
    const Package_Weight= req.body.Package_Weight;
    const Package_Volume = req.body.Volume; 
    const IC_Address_Key = req.body.IC_Address_Key;
    const OT_Address_Key = req.body.OT_Address_Key; 
    const Recieved = req.body.Recieved;

    console.log("Update Package:", Customer_ID, Package_Type, Package_Weight, Package_Volume, IC_Address_Key, OT_Address_Key, Recieved);

    const Package = await db.query(
        `UPDATE Package SET Customer_ID=?, Package_Type=?, Package_Weight=?, Package_Volume=?, IC_Address_Key=?, OT_Address_Key=?, Recieved=? WHERE Package_ID = ?`,
        [Customer_ID, Package_Type, Package_Weight, Package_Volume, IC_Address_Key, OT_Address_Key, Recieved]);
    
        return("message", "Package updated");
    
}

async function removePackage(req) {
    let id = req.body.id;

    const remove = await db.query(`DELETE FROM Package WHERE Package_ID = ?`, [id]);
    return {"message": "Package deleted"};
}

module.exports = {
    get,
    getPackage,
    getData,
    getById,
    createPackage,
    updatePackage,
    removePackage
}