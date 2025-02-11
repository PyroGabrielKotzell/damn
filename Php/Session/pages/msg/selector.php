<script>
    var loggedUser = "" + <?php echo "'$loggedUser'" ?>;
    var selected = "";
    var message = "";
    var interval = null;

    async function doFetch(body = {}) {
        return await fetch("api/chat.php", {
            method: "post",
            mode: "cors",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(body),
        }).then(res => {
            return res.json();
        }).then(json => {
            return json;
        });
    }

    function selectUser(user) {
        selected = user;
        init();
        if (user == '') {
            clearInterval(interval);
        } else {
            interval = setInterval(() => {
                init()
            }, 5000);
        }
    }
</script>

<head>
    <title>Page</title>
</head>

<style>
    body {
        justify-items: center;
        text-align: center;
    }

    table.usrs {}

    table.usrs tr {}

    table.usrs td {}

    table.msgs {}

    table.msgs tr {}

    table.msgs td {}

    .exit {}
</style>

<body>
    <div id="container">
    </div>
</body>

<script>
    async function init() {
        var con = document.getElementById("container");
        if (selected == "") {
            var response = await doFetch({
                "loggedUser": loggedUser,
            });

            console.log(response);
            var d = `<table class="usrs">`;
            response.forEach(e => {
                d += `
                <tr>
                <td>
                    <pre>${e}</pre>
                </td><td>
                    <button onclick="selectUser('${e}')">Select</button>
                </td></tr>
                `;
            });
            d += `</table>`;
            con.innerHTML = d;
        } else {
            var response = await doFetch({
                "loggedUser": loggedUser,
                "selectedUser": selected,
            });

            console.log(response);
            var d = `<button class="exit" onclick="selectUser('')">Exit</button>`;
            d += `<table class="msgs">`;
            response.forEach(e => {
                d += `
                <tr>
                <td>${e.id}</td>
                <td>${e.senderId}</td>
                <td>${e.message}</td>
                <td>${e.isRead}</td>
                <td>
                    <button onclick="console.log('a')">Details</button>
                </td></tr>
                `;
            });
            d += `</table>`;
            con.innerHTML = d;
        }
    }

    init()
</script>

</html>