const db = require('./db');
const helper = require('../helper');
const config = require('../config');

async function get() {
    const rows = await db.query(`SELECT * FROM Employee`);
    const data = helper.rowclean(rows);
    return data;
}

async function getEmployee(id) {
    const rows = await db.query(`SELECT * FROM Employee WHERE Employee_ID = ?`, [id]);
    const data = helper.rowclean(rows);
    return data;
}

async function getData(page = 1){
    const offset = helper.getoffset(page, config.listPerPage);
    const rows = await db.query(`select * from Employee LIMIT ${offset},${config.listPerPage}`);
    const data = helper.rowclean(rows);
    const meta = {page};
    return {meta, data}
}

async function getById(Employee_ID) {
    const user = await db.query(`SELECT * FROM Employee WHERE Employee_ID = ?`, [Employee_ID]);
    const data = helper.rowclean(user);
    // const meta = {page};
    // return {meta, data};
    return data;
}

async function createEmployee(req) {
    const First_Name = req.body.First_Name;
    const Middle_Init = req.body.Middle_Init;
    const Last_Name = req.body.Last_Name;
    const Employee_Phone_Num = req.body.Employee_Phone_Num;
    const Employee_Address_Key = req.body.Employee_Address_Key; 
    
    const Office_ID = req.body.Office_ID;
    const Super_ID = req.body.Super_ID;

    const Employee_ID = req.Employee_ID;
    const email = req.body.email; 
    const password = req.body.password; 
    
    console.log("CreateEmployee", First_Name, Middle_Init, Last_Name, Employee_Phone_Num, Employee_Address_Key, Office_ID, Super_ID, email, password);

    const employee = await db.query(
        `INSERT INTO Employee (First_Name, Middle_Init, Last_Name, Employee_Address_Key, Employee_Phone_Num, Office_ID, Super_ID, email, password) 
        VALUES (?,?,?,?,?,?,?,?,?,?)`, 
        [First_Name, Middle_Init, Last_Name, Employee_Address_Key, Employee_Phone_Num, Office_ID, Super_ID, email, password]);

    console.log("CreateEmployee:", employee);
    return {"message": "Employee created"};
}

async function updateEmployee(req) {
    const First_Name = req.body.First_Name;
    const Middle_Init = req.body.Middle_Init;;
    const Last_Name = req.body.Last_Name;
    const Employee_Phone_Num = req.body.Employee_Phone_Num;

    const Office_ID = req.body.Employee_Office_ID;
    const Super_ID = req.body.Super_ID;
    const email = req.body.email; 
    const password = req.body.password; 
    console.log("Update Employee:", First_Name, Middle_Init, Last_Name, Employee_Phone_Num, email, password);

    const employee = await db.query(
        `UPDATE Employee SET First_Name = ?, Middle_Init = ?, Last_Name = ?, Employee_Phone_Num = ?, email=?, password=? WHERE Employee_ID = ?`,
        [First_Name, Middle_Init, Last_Name, Employee_Phone_Num,email, password, req.params.id]);
    
        return("message", "Employee updated");
    
}

async function removeEmployee(req) {
    let id = req.body.id;

    const remove = await db.query(`DELETE FROM Employee WHERE Employee_ID = ?`, [id]);
    return {"message": "Employee deleted"};
}

module.exports = {
    get,
    getEmployee,
    getData,
    getById,
    createEmployee,
    updateEmployee,
    removeEmployee
}