const http = require("http");

const host = '192.168.4.22';
const port = 8000;

var callNumber = 0;

const requestListener = function (req, res) {
    res.setHeader("Content-Type", "application/json");
    res.writeHead(200);
    res.end(`{"message": "This is a JSON response : `+callNumber+`"}`);
    callNumber = callNumber + 1;
};


const server = http.createServer(requestListener);
server.listen(port, host, () => {
    console.log(`Server is running on http://${host}:${port}`);
});