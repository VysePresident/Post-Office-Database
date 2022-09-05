const db = require('./db');
const helper = require('../helper');
const config = require('../config');

async function get() {
    const rows = await db.query(`SELECT * FROM Post_Office`);
    const data = helper.rowclean(rows);
    return data;
}

async function getpostOffice(id) {
    const rows = await db.query(`SELECT * FROM Post_Office WHERE Office_ID = ?`, [id]);
    const data = helper.rowclean(rows);
    return data;
}

async function getData(page = 1){
    const offset = helper.getoffset(page, config.listPerPage);
    const rows = await db.query(`select * from Post_Office LIMIT ${offset},${config.listPerPage}`);
    const data = helper.rowclean(rows);
    const meta = {page};
    return {meta, data}
}

async function getById(Office_ID) {
    const user = await db.query(`SELECT * FROM Post_Office WHERE Office_ID = ?`, [Office_ID]);
    const data = helper.rowclean(user);
    // const meta = {page};
    // return {meta, data};
    return data;
}

async function createpostOffice(req) {
    const Office_ID = req.body.Office_ID;
    const Office_Name = req.body.Office_Name;;
    const PO_Address_Key = req.body.PO_Address_Key;
    const PO_Phone_Num = req.body.PO_Phone_Num;
    const Supervisor_ID = req.body.Supervisor_ID; 
    const Num_Of_Packages = req.body.Num_Of_Packages; 
    const Num_Of_Employees = req.body.Num_Of_Employees; 
    const Manager_Start = req.body.Manager_Start; 
    
    console.log("CreatepostOffice", Office_ID, Office_Name, PO_Address_Key, PO_Phone_Num, Supervisor_ID,  Num_Of_Packages, Num_Of_Employees, Manager_Start);

    const postOffice = await db.query(
        `INSERT INTO postOffice (Office_ID, Office_Name, PO_Address_Key, PO_Phone_Num, Supervisor_ID,  Num_Of_Packages, Num_Of_Employees, Manager_Start) 
        VALUES (?,?,?,?,?,?,?,?)`, 
        [Office_ID, Office_Name, PO_Address_Key, PO_Phone_Num, Supervisor_ID,  Num_Of_Packages, Num_Of_Employees, Manager_Start]);

    // const postOffice = await db.query(`INSERT INTO postOffice (First_Name, Middle_Init, Last_Name, postOffice_Phone_Num, postOffice_Address_Key) VALUES ('first','m','last',123456,1)`);

    console.log("CreatepostOffice:", Post_Office);
    return {"message": "postOffice created"};
}

async function updatepostOffice(req) {
    const Office_Name = req.body.Office_Name;;
    const PO_Address_Key = req.body.PO_Address_Key;
    const PO_Phone_Num = req.body.PO_Phone_Num;
    const Supervisor_ID = req.body.Supervisor_ID; 
    const Num_Of_Packages = req.body.Num_Of_Packages; 
    const Num_Of_Employees = req.body.Num_Of_Employees; 
    const Manager_Start = req.body.Manager_Start; 

    console.log("Update postOffice:", Office_Name, PO_Address_Key, PO_Phone_Num, Supervisor_ID,  Num_Of_Packages, Num_Of_Employees, Manager_Start);

    const postOffice = await db.query(
        `UPDATE postOffice SET Office_Name=?, PO_Address_Key=?, PO_Phone_Num=?, Supervisor_ID=?,  Num_Of_Packages=?, Num_Of_Employees=?, Manager_Start=? WHERE Office_ID = ?`,
        [Office_Name, PO_Address_Key, PO_Phone_Num, Supervisor_ID,  Num_Of_Packages, Num_Of_Employees, Manager_Start, req.params.id]);
    
        return("message", "postOffice updated");
    
}

async function removepostOffice(req) {
    let id = req.body.id;

    const remove = await db.query(`DELETE FROM Post_Office WHERE Office_ID = ?`, [id]);
    return {"message": "postOffice deleted"};
}

module.exports = {
    get,
    getpostOffice,
    getData,
    getById,
    createpostOffice,
    updatepostOffice,
    removepostOffice
}