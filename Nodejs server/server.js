const http = require("http");

const host = '192.168.4.22';
const port = 8000;

// use all this from the crontroller
const {
    getGrid,
    getSign,
    setSign,
    resetGrid,
    modifyTurn,
    getTurn
} = require("./src/controller");

const { getFile } = require("./src/serverIO");

const requestListener = function (req, res) {
    if (req.url === '/tris/game' && req.method === 'GET') {
        getFile('./client/page.html', res);
        modifyTurn();
    } else if (req.url === '/tris/turn' && req.method === 'GET') {
        res.writeHead(200, { 'Content-Type': 'application/json' });
        res.end(JSON.stringify(getTurn()));
    } else if (req.url === '/tris' && req.method === 'GET') {
        getGrid(req, res);
    } else if (req.url.match(/\/tris\/\w/) && req.method === 'GET') {
        const id = req.url.split('/')[2];
        getSign(req, res, id);
    } else if (req.url.match(/\/tris\/\w\/\w+/) && req.method === 'PUT') {
        const id = req.url.split('/')[2];
        const player = req.url.split('/')[3];
        console.log("player: " + player + ", cell: " + id + ", server turn: " + getTurn());
        setSign(req, res, id, player);
    } else if (req.url === '/tris' && req.method === 'DELETE') {
        resetGrid(req, res);
    } else {
        res.writeHead(404, { 'Content-Type': 'application/json' });
        res.end(
            JSON.stringify({
                message: 'Route Not Found',
            }));
        }
    };
    
    const server = http.createServer(requestListener);
    server.listen(port, host, () => {
        console.log(`Server is running on http://${host}:${port}`);
    });