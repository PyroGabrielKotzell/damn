async function doFetch() {
    var num = document.getElementById("len").value;
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

    var i = 0;
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
                <td id="${i}">
                    <div>
                        <pre>${address}</pre>
                        <button class="hoverable" onclick="copyTxt('${address}')">
                            <img src="copy_to_clipboard.svg" />
                            <div class="text">Copy</div>
                        </button>
                    </div>
                </td>
                <td>${ip}</td>
            </tr>
            `;
            await wait(10);
            if (i >= num && num != 0) break;
            i++;
        }
    }
}

async function copyTxt(text) {
    navigator.clipboard.writeText(text);
    alert("Address copied: " + text);
}

async function wait(mills) {
    return new Promise(res => setTimeout(res, mills));
}