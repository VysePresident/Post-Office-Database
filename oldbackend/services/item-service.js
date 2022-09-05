const db = require('./db');
const helper = require('../helper');
const config = require('../config');

async function get() {
    const rows = await db.query(`SELECT * FROM Items`);
    const data = helper.rowclean(rows);
    return data;
}

async function getItems(id) {
    const rows = await db.query(`SELECT * FROM Items WHERE Item_ID = ?`, [id]);
    const data = helper.rowclean(rows);
    return data;
}

async function getData(page = 1){
    const offset = helper.getoffset(page, config.listPerPage);
    const rows = await db.query(`select * from Items LIMIT ${offset},${config.listPerPage}`);
    const data = helper.rowclean(rows);
    const meta = {page};
    return {meta, data}
}

async function getById(Item_ID) {
    const user = await db.query(`SELECT * FROM Items WHERE Item_ID = ?`, [Item_ID]);
    const data = helper.rowclean(user);
    // const meta = {page};
    // return {meta, data};
    return data;
}

async function createItem(req) {
    const PO_ID = req.body.PO_ID;
    const Item_ID = req.body.Item_ID;;
    const Item_Name = req.body.Item_Name;
    const Item_Count = req.body.Item_Count;
    const Item_Cost= req.body.Item_Cost; 
    
    console.log("CreateItems", PO_ID, Item_ID, Item_Name, Item_Count, Item_Cost);

    const Items = await db.query(
        `INSERT INTO Items (PO_ID, Item_ID, Item_Name, Item_Count, Item_Cost) 
        VALUES (?,?,?,?,?)`, 
        [PO_ID, Item_ID, Item_Name, Item_Count, Item_Cost]);

   

    console.log("CreateItem:", Items);
    return {"message": "Item created"};
}

async function updateItem(req) {
    const PO_ID = req.body.PO_ID;
    const Item_Name = req.body.Item_Name;
    const Item_Count = req.body.Item_Count;
    const Item_Cost= req.body.Item_Cost;

    console.log("Update Items:", PO_ID, Item_Name, Item_Count, Item_Cost);

    const Items = await db.query(
        `UPDATE Items SET PO_ID=?, Item_Name=?, Item_Count=?, Item_Cost=? WHERE Item_ID = ?`,
        [PO_ID, Item_Name, Item_Count, Item_Cost, req.params.id]);
    
        return("message", "Item updated");
    
}

async function removeItem(req) {
    let id = req.body.id;
    
    const remove = await db.query(`DELETE FROM Items WHERE Item_ID = ?`, [id]);
    let message = `Error deleting item ${id}`
    if (remove.affectedRows) {
        message = `Item ${id} was deleted`
    }
    return {message};
}

module.exports = {
    get,
    getItems,
    getData,
    getById,
    createItem,
    updateItem,
    removeItem
}