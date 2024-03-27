let Tris = require("gridformat");

function getGrid(){
    return new Promise((resolve, reject) => {
        resolve(Tris);
    })
}

function getCell(ncell){
    return new Promise((resolve, reject) => {
        resolve(Tris.find((cell) => cell.cell === ncell));
    })
}

module.exports = {
    getGrid,
    getCell,
    create,
    update
}