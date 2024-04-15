const fs = require('fs');
let t = 0;

function writeDataToFile(filename, content) {
    fs.writeFileSync(filename, JSON.stringify(content), 'utf8', (err) => {
        if(err) {
            console.log(err);
        }
    });
}

function getPostData(req) {
    return new Promise((resolve, reject) => {
        try {
            let body = '';

            req.on('data', (chunk) => {
                body += chunk.toString();
            });

            req.on('end', () => {
                resolve(body);
            });
        } catch (error) {
            reject(error);
        }
    });
}


function getFile(path, res) {
    fs.readFile(path, function(error, data){
        if (error) {
            res.writeHead(500, { 'Content-Type': 'application/json' });
            res.end(JSON.stringify({message: "Played like a damn fiddle", error: error}));
        } else {
            res.writeHead(200, { 'Content-Type': 'text/html' });
            res.json = {turn: t};
            t++;
            res.end(data);
        }
    });
}

module.exports = {
    writeDataToFile,
    getPostData,
    getFile
}