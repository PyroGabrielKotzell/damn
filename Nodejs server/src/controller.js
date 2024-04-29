const grid = require("./grid");

// use getPostData from serverIO
const { getPostData } = require('./serverIO');

let turn = false;

// GET
// ip/tris
async function getGrid(req, res){
    // stringify the grid
    try {
        const cells = await grid.get();
        
        res.writeHead(200, { 'Content-Type': 'application/json' });
        res.end(JSON.stringify(cells));
    } catch (error) {
        console.log(error);
    }
}

// GET
// ip/tris/:cellNum
async function getSign(req, res, cellNum){
    // stringify the required cell
    try {
        let cell = grid.getCell(cellNum);
        
        if(!cell){
            res.writeHead(404, { 'Content-Type': 'application/json' });
            res.end(JSON.stringify({ message: 'Cell Not Found' }));
        } else {
            res.writeHead(200, { 'Content-Type': 'application/json' });
            res.end(JSON.stringify(cell));
        }
    } catch (error) {
        console.log(error);
    }
}

// PUT
// ip/tris/:cellNum/:player
async function setSign(req, res, cellNum, player){
    // check if the cell exists, if the value is X or O, if the cell isn't already taken
    // then stringify the new sign (changed cell)
    try{
        let cell = await grid.getCell(cellNum);
        if(!cell) {
            res.writeHead(404, { 'Content-Type': 'application/json' });
            res.end(JSON.stringify({ message: 'Cell Not Found' }));
        } else if (cell.value != "N") {
            res.writeHead(401, { 'Content-Type': 'application/json' });
            res.end(JSON.stringify({ message: 'Could Not Write To Cell, Already Set' }));
        } else if (player == "true" != turn){
            res.writeHead(401, { 'Content-Type': 'application/json' });
            res.end(JSON.stringify({ message: 'Could Not Write To Cell, Not your turn' }));
        } else {
            let value = "O";
            if (player == "false") value = "X";

            // player in controller
            modifyTurn();
            const cellSign = { value: value || cell.value };
            const sign = await grid.set(cellNum, cellSign);
            res.writeHead(200, { 'Content-Type': 'application/json' });
            res.end(JSON.stringify(sign));
        }
    } catch (error) {
        console.log(error);
    }
}

// DELETE
// ip/tris
async function resetGrid(req, res){
    // reset of the grid, need to check if the player disconnected or resigned
    grid.reset();
    try {
        res.writeHead(200, { 'Content-Type': 'application/json' });
        res.end(JSON.stringify({message: 'Grid Has Been Resetted'}));
    } catch (error) {
        console.log(error);
    }
}

function modifyTurn(){
    turn = !turn;
}

function getTurn(){
    return turn;
}

module.exports = {
    getGrid,
    getSign,
    setSign,
    resetGrid,
    modifyTurn,
    getTurn
}