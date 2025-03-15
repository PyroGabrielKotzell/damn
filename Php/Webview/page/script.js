async function doFetch() {
    var res = await fetch("../api/api.php")
        .then(res => {
            return res.json();
        })
        .then(json => {
            return json;
        });

    var container = document.getElementById("table");
    container.innerHTML = "";
    res = JSON.parse(res);

    i = 0;
    for (const row of res) {
        var date = row[0];
        if (date.match(/^\d{4}-\d{2}-\d{2}/g)) {
            var rating = row[1];
            var address = row[2];
            var ip = row[3];

            var rateF = parseFloat(rating) - 1;
            var R = rateF * 127;
            var G = 255 - rateF * 51;
            container.innerHTML += `
            <tr style="background-color: rgb(${R}, ${G}, 0);">
                <td>${date}</td>
                <td>${rating}</td>
                <td>${address}</td>
                <td>${ip}</td>
            </tr>
            `;
            if (i == 100) break;
            i++;
            await wait(10);
        }
    }
}

async function wait(mills) {
    return new Promise(res => setTimeout(res, mills));
}