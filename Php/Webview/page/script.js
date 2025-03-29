var loader = document.getElementById("loadercon");
var loaderBackgnd = document.getElementById("backgnd");

var textfield = document.getElementById("len");
var fetcher = document.getElementById("fetcher");
var checkbox = document.getElementById("checkbox");

var container = document.getElementById("table");
async function doFetch() {
    fetcher.disabled = true;
    var num = textfield.value;
    var res = await fetch("../api/api.php?len=" + num)
        .then(res => {
            return res.json();
        })
        .then(json => {
            return json;
        });

    container.innerHTML = "";
    res = JSON.parse(res);


    if (checkbox.checked) loader.hidden = false;
    await wait(1);
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

            var rowElement = document.createElement("tr");
            rowElement.innerHTML = `
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
            `;
            rowElement.style.backgroundColor = `rgb(${R}, ${G}, 0)`;
            container.appendChild(rowElement);
            await wait(0);

            if (checkbox.checked) loaderBackgnd.style.height = document.documentElement.scrollHeight + "px";
            if (i >= num && num != 0) break;
            i++;
        }
    }
    await wait(1);
    fetcher.disabled = false;
    if (checkbox.checked) {
        loader.hidden = true;
        loaderBackgnd.style.height = "0px";
    }
}

async function copyTxt(text) {
    navigator.clipboard.writeText(text);
    alert("Address copied: " + text);
}

async function wait(mills) {
    return new Promise(res => setTimeout(res, mills));
}