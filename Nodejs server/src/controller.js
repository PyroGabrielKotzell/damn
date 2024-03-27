// GET
// ip/tris
async function getGrid(req, res){
    try {
        res.writeHead(200, { 'Content-Type': 'application/json' })
        res.end(JSON.stringify(Tris.getGrid()));
    } catch (error) {
        console.log(error)
    }
}

// GET
// ip/tris/:cell
async function getSign(req, res, cell){
    try {
        res.writeHead(200, { 'Content-Type': 'application/json' })
        res.end(JSON.stringify(Tris.getCell(cell)));
    } catch (error) {
        console.log(error)
    }
}

// PUT
// ip/tris/:cell
async function setSign(req, res, cell){
}

// DELETE
// ip/tris
async function resetGrid(req, res){
}