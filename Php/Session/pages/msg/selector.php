<script>
    var loggedUser = "" + <?php echo "'$loggedUser'" ?>;
    var selected = "";
    var selmsg = "";
    var message = "";
    var changed = true;
    var ids = [];
</script>

<head>
    <title>Page</title>
</head>

<style>
    body {
        justify-items: center;
        text-align: center;
    }

    form {
        justify-self: end;
    }

    table.usrs {}

    table.usrs tr {}

    table.usrs td {}

    table.msgs {}

    table.msgs tr {}

    table.msgs td {}

    .exit {}

    #container {}

    #msgbar {
        padding: 5px;
    }
</style>

<body>
    <form method="post">
        <button type="submit" name="submit" id="submit" value="logout">Logout</button>
    </form>
    <div id="msgbar" hidden>
        <button class="exit" onclick="selectUser('')">Exit</button>
    </div>
    <div id="container">
    </div>
</body>

<script>
    async function doFetch(body = {}) {
        var a = await fetch("api/chat.php", {
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

        //console.log(a);
        return a;
    }

    function selectUser(user) {
        selected = user;
        var con = document.getElementById("msgbar");
        con.hidden = user == '';
        changed = true;
        init();
    }

    function selectMessage(msg) {
        selmsg = msg;
        changed = true;
        init();
    }

    function send() {
        
        //"message": message,
    }

    async function init() {
        var con = document.getElementById("container");

        if (changed) {
            ids = [];
            con.innerHTML = `<table id="a" class=""></table>`;
            changed = false;
        }

        var response = await doFetch({
            "loggedUser": loggedUser,
            "selectedUser": selected,
            "seen": selmsg,
        });

        if (selected == "") {
            var table = document.getElementById("a");
            table.className = "usrs";

            response.forEach(e => {
                if (!ids.find(n => n == e) || ids.length == 0) {
                    table.innerHTML += `
                    <tr>
                    <td><pre>${e}</pre></td>
                    <td><button onclick="selectUser('${e}')">Select</button></td>
                    </tr>
                    `;
                    ids.push(e);
                }
            });
        } else {
            var table = document.getElementById("a");
            table.className = "msgs";

            response.forEach(e => {
                if (!ids.find(n => n == e.id)) {
                    var id = e.id;
                    var sender = e.senderId;
                    var message = e.message;
                    var read = e.isRead;

                    if (selmsg != id && e.message.length > 10) {
                        message = e.message.substr(0, 10) + "...";
                    }

                    if (selmsg == id && !read) {
                        readMessage(id);
                    }

                    table.innerHTML += `
                    <tr>
                    <td>${id}</td>
                    <td>${sender}</td>
                    <td>${message}</td>
                    <td>${read}</td>
                    <td>
                        <button onclick="selectMessage(${selmsg == e.id ? '' : e.id})">Details</button>
                    </td></tr>
                    `;
                    ids.push(e.id);
                }
            });
        }
    }

    init();
    setInterval(() => {
        init();
    }, 5000);
</script>

</html>