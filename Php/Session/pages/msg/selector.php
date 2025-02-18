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

    td#s {
        background-color: greenyellow;
    }

    td#d {
        background-color: red;
    }
</style>

<body>
    <form method="post">
        <button type="submit" name="submit" id="submit" value="logout">Logout</button>
    </form>
    <div id="msgbar" hidden>
        <input type="text" id="txt" value="" />
        <button class="send" onclick="send()">Send</button>
        <button class="exit" onclick="selectUser('')">Exit</button>
    </div>
    <div id="container">
    </div>
</body>

<script>
    async function doFetch(method = "post", args = {}) {
        var a;
        switch (method) {
            case "post": {
                a = await fetch("api/chat.php", {
                    method: method,
                    mode: "cors",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(args),
                }).then(res => {
                    return res.json();
                }).then(json => {
                    return json;
                });
                break;
            }
            case "get": {
                var str = "?";
                var argsT = Object.keys(args).map((key) => [key, args[key]]);
                argsT.forEach(e => {
                    str += e[0] + "=" + e[1] + "&";
                });
                str = str.substr(0, str.length - 1);
                a = await fetch("api/chat.php" + str, {
                    method: method,
                    mode: "cors",
                    headers: {
                        "Content-Type": "application/json",
                    },
                }).then(res => {
                    return res.json();
                }).then(json => {
                    return json;
                });
            }
        }
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

    function readMessage() {
        doFetch("post", {
            "action": "read",
            "loggedUser": loggedUser,
            "seen": selmsg,
        });
    }

    async function send() {
        var txtfield = document.getElementById("txt");
        message = txtfield.value;
        txtfield.value = "";
        await doFetch("post", {
            "action": "send",
            "loggedUser": loggedUser,
            "selectedUser": selected,
            "message": message,
        });
        init();
    }

    async function init() {
        var con = document.getElementById("container");

        if (changed) {
            ids = [];
            con.innerHTML = `<table id="a" class=""></table>`;
            changed = false;
        }

        var action = "users";
        if (selected != "") action = "messages";
        var response = await doFetch("get", {
            "action": action,
            "loggedUser": loggedUser,
            "selectedUser": selected,
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
                    var btn = "Details";
                    var colour = 'id="s"';

                    if (selmsg == id) {
                        if (!read) {
                            readMessage();
                        }
                        if (message.length > 10) {
                            id = '';
                            btn = "Exit";
                        }
                    }else {
                        if (message.length > 10) {
                            message = message.substr(0, 10) + "...";
                        }
                        if (!read) {
                            message = `<b>${message}</b>`;
                            colour = 'id="d"';
                        }
                    }

                    if (sender == loggedUser) {
                        sender = `<b>${sender}</b>`;
                    }

                    table.innerHTML += `
                    <tr>
                    <td>${e.id}</td>
                    <td>${sender}</td>
                    <td>${message}</td>
                    <td ${colour}>${read}</td>
                    <td>
                        <button onclick="selectMessage(${id})">${btn}</button>
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