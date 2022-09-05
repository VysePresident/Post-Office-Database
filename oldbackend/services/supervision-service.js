const db = require('./db');
const helper = require('../helper');
const config = require('../config');

async function get() {
    const rows = await db.query(`SELECT * FROM Supervision`);
    const data = helper.rowclean(rows);
    return data;
}

async function getSupervision(id) {
    const rows = await db.query(`SELECT * FROM Supervision WHERE Employee_ID = ?`, [id]);
    const data = helper.rowclean(rows);
    return data;
}

async function getData(page = 1){
    const offset = helper.getoffset(page, config.listPerPage);
    const rows = await db.query(`select * from Supervision LIMIT ${offset},${config.listPerPage}`);
    const data = helper.rowclean(rows);
    const meta = {page};
    return {meta, data}
}

async function getById(Supervision_ID) {
    const user = await db.query(`SELECT * FROM Supervision WHERE Employee_ID = ?`, [Supervision_ID]);
    const data = helper.rowclean(user);
   
    return data;
}

async function createSupervision(req) {
    const Office_ID = req.body.Office_ID;
    const Employee_ID = req.body.Employee_ID;;
    const Start_Date = req.body.Start_Date;
    
    
    console.log("CreateSupervision", Office_ID, Employee_ID, Start_Date);

    const Supervision = await db.query(
        `INSERT INTO Supervision (Office_ID, Employee_ID, Start_Date) 
        VALUES (?,?,?)`, 
        [Office_ID, Employee_ID, Start_Date]);

    console.log("CreateSupervision:", Supervision);
    return {"message": "Supervision created"};
}

async function updateSupervision(req) {
    const Office_ID = req.body.Office_ID;
    const Start_Date = req.body.Start_Date;

    console.log("Update Supervision:", Office_ID, Start_Date);

    const Supervision = await db.query(
        `UPDATE Supervision SET Office_ID=?, Start_Date=? WHERE Employee_ID = ?`,
        [Office_ID, Start_Date]);
    
        return("message", "Supervision updated");
    
}

async function removeSupervision(req) {
    let id = req.body.id;

    const remove = await db.query(`DELETE FROM Supervision WHERE Employee_ID = ?`, [id]);
    return {"message": "Supervision deleted"};
}

module.exports = {
    get,
    getSupervision,
    getData,
    getById,
    createSupervision,
    updateSupervision,
    removeSupervision
}