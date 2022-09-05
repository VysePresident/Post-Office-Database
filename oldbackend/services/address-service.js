const db = require('./db');
const helper = require('../helper');
const config = require('../config');

async function get() {
    const rows = await db.query(`SELECT * FROM Address`);
    const data = helper.rowclean(rows);
    return data;
}

async function getAddress(id) {
    const rows = await db.query(`SELECT * FROM Address WHERE Address_ID = ?`, [id]);
    const data = helper.rowclean(rows);
    return data;
}

async function getData(page = 1){
    const offset = helper.getoffset(page, config.listPerPage);
    const rows = await db.query(`select * from Address LIMIT ${offset},${config.listPerPage}`);
    const data = helper.rowclean(rows);
    const meta = {page};
    return {meta, data}
}

async function getById(Address_Key) {
    const user = await db.query(`SELECT * FROM Address WHERE Address_Key = ?`, [Address_Key]);
    const data = helper.rowclean(user);
    // const meta = {page};
    // return {meta, data};
    return data;
}

async function createAddress(req) {
    const Building_Num = req.body.Building_Num;
    const Street_Name = req.body.Street_Name;;
    const City = req.body.City;
    const State= req.body.State;
    const Zipcode = req.body.Zipcode; 
    const Address_Key = req.body.Address_Key; 
    
    console.log("CreateAddress", Building_Num, Street_Name, City, State, Zipcode, Address_Key);

    const Address = await db.query(
        `INSERT INTO Address (Building_Num, Street_Name, City, State, Zipcode, Address_Key) 
        VALUES (?,?,?,?,?,?)`, 
        [Building_Num, Street_Name, City, State, Zipcode, Address_Key]);

    

    console.log("CreateAddress:", Address);
    return {"message": "Address created"};
}

async function updateAddress(req) {
    const Building_Num = req.body.Building_Num;
    const Street_Name = req.body.Street_Name;;
    const City = req.body.City;
    const State= req.body.State;
    const Zipcode = req.body.Zipcode;

    console.log("Update Address:", Building_Num, Street_Name, City, State, Zipcode);

    const Address = await db.query(
        `UPDATE Address SET Building_Num = ?, Street_Name = ?, City = ?, State = ?, Zipcode = ?,  WHERE Address_Key = ?`,
        [Building_Num, Street_Name, City, State, Zipcode, req.params.id]);
    
        return("message", "Address updated");
    
}

async function removeAddress(req) {
    let id = req.body.id;

    const remove = await db.query(`DELETE FROM Address WHERE Address_Key = ?`, [id]);
    return {"message": "Address deleted"};
}

module.exports = {
    get,
    getAddress,
    getData,
    getById,
    createAddress,
    updateAddress,
    removeAddress
}