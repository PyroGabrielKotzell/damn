const http = require("http");
const fs = require('fs');

const host = '192.168.4.22';
const port = 8000;

let oggetti = [];

create("Belluno", "Padova", 140);
create("Belluno", "Rovigo", 175);
create("Belluno", "Treviso", 71.9);
create("Belluno", "Venezia", 114);
create("Belluno", "Verona", 199);
create("Belluno", "Vicenza", 125);
create("Padova", "Rovigo", 55.1);
create("Padova", "Treviso", 84.7);
create("Padova", "Venezia", 58.8);
create("Padova", "Verona", 69.3);
create("Padova", "Vicenza", 51.8);
create("Rovigo", "Treviso", 106);
create("Rovigo", "Venezia", 93.8);
create("Rovigo", "Verona", 87.1);
create("Rovigo", "Vicenza", 91.2);
create("Treviso", "Venezia", 57.6);
create("Treviso", "Verona", 109);
create("Treviso", "Vicenza", 56.3);
create("Venezia", "Verona", 126);
create("Venezia", "Vicenza", 88.1);
create("Verona", "Vicenza", 63.6);

const requestListener = function (req, res) {
    if (req.url === "/getdist" && req.method === "GET"){
        res.writeHead(200, { 'Content-Type': 'text/plain' });
        res.end(JSON.stringify(oggetti));
    }else {
        res.writeHead(200, { 'Content-Type': 'text/html' });
        fs.createReadStream("./page.html").pipe(res);
    }
}

const server = http.createServer(requestListener);
server.listen(port, host, () => {
    console.log(`Server is running on http://${host}:${port}`);
});

function create(nome1, nome2, distanza){
    oggetti.push({nome1: nome1, nome2: nome2, distanza: distanza});
}