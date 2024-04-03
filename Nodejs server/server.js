const http = require("http");

const host = '192.168.4.22';
const port = 8000;

// use all this from the crontroller
const {
    getGrid,
    getSign,
    setSign,
    resetGrid
} = require("./src/controller");

const requestListener = function (req, res) {
    res.writeHead(200, {"Content-Type": "application/json"});
    res.end();
};

const server = http.createServer(requestListener);
server.listen(port, host, () => {
    console.log(`Server is running on http://${host}:${port}`);
});