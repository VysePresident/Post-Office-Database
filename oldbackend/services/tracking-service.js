const db = require('./db');
const helper = require('../helper');
const config = require('../config');

async function get() {
    const rows = await db.query(`SELECT * FROM Tracking`);
    const data = helper.rowclean(rows);
    return data;
}

async function getTracking(id) {
    const rows = await db.query(`SELECT * FROM Tracking WHERE Package_ID = ?`, [id]);
    const data = helper.rowclean(rows);
    return data;
}

async function getData(page = 1){
    const offset = helper.getoffset(page, config.listPerPage);
    const rows = await db.query(`select * from Tracking LIMIT ${offset},${config.listPerPage}`);
    const data = helper.rowclean(rows);
    const meta = {page};
    return {meta, data}
}

async function getById(Package_ID) {
    const user = await db.query(`SELECT * FROM Tracking WHERE Package_ID = ?`, [Package_ID]);
    const data = helper.rowclean(user);

    return data;
}

async function createTracking(req) {
    const Package_ID = req.body.Package_ID;
    const StopNum = req.body.StopNum;;
    const DateArrived = req.body.DateArrived;
    const DateSent = req.body.DateSent;
    const Tracking_Office_ID= req.body.Tracking_Office_ID; 
    
    console.log("CreateTracking", Package_ID, StopNum, DateArrived, DateSent, Tracking_Office_ID);

    const Tracking = await db.query(
        `INSERT INTO Tracking (Package_ID, StopNum, DateArrived, DateSent, Tracking_Office_ID) 
        VALUES (?,?,?,?,?)`, 
        [Package_ID, StopNum, DateArrived, DateSent, Tracking_Office_ID]);


    console.log("CreateTracking:", Tracking);
    return {"message": "Tracking created"};
}

async function updateTracking(req) {
    const StopNum = req.body.StopNum;;
    const DateArrived = req.body.DateArrived;
    const DateSent = req.body.DateSent;
    const Tracking_Office_ID= req.body.Tracking_Office_ID; 

    console.log("Update Tracking:", StopNum, DateArrived, DateSent, Tracking_Office_ID);

    const Tracking = await db.query(
        `UPDATE Tracking SET StopNum=?, DateArrived=?, DateSent=?, Tracking_Office_ID=? WHERE Package_ID = ?`,
        [StopNum, DateArrived, DateSent, Tracking_Office_ID, req.params.id]);
    
        return("message", "Tracking updated");
    
}

async function removeTracking(req) {
    let id = req.body.id;

    const remove = await db.query(`DELETE FROM Tracking WHERE Package_ID = ?`, [id]);
    return {"message": "Tracking deleted"};
}

module.exports = {
    get,
    getTracking,
    getData,
    getById,
    createTracking,
    updateTracking,
    removeTracking
}