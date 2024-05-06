let Tris = require("./gridformat");

// use writeDataToFile from serverIO
const { writeDataToFile } = require('./serverIO');

function get(){
    // resolve the tris grid
    return new Promise((resolve, reject) => {
        resolve(Tris);
    });
}

function getCell(ncell){
    // resolve the found cell
    return new Promise((resolve, reject) => {
        resolve(Tris.find((c) => c.cell === ncell));
    });
}

function set(cell, sign){
    // resolve the updated cell after updating the json
    return new Promise((resolve, reject) => {
        const index = Tris.findIndex((c) => c.cell === cell);
        Tris[index] = {cell, ...sign};
        if (process.env.NODE_ENV !== 'test') {
            writeDataToFile('gridformat.json', Tris);
        }
        resolve(Tris[index]);
    });
}

function reset(){
    // resolve the grid after updating the json
    return new Promise((resolve, reject) => {
        Tris.forEach(cell => {
            cell.value = "N";
        });
        if (process.env.NODE_ENV !== 'test') {
            writeDataToFile('gridformat.json', Tris);
        }
        resolve(Tris);
    });
}

module.exports = {
    get,
    getCell,
    set,
    reset
}