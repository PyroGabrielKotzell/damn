<script>
    var loggedUser = <?php echo "'$loggedUser'" ?>;

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
</script>

<head>
    <title>Page</title>
</head>

<style>
    body {
        justify-items: center;
    }
</style>

<body>
    <div id="aa">adad</div>
</body>

<script>
    async function init() {
        response = await doFetch({
            "action": "selector",
            "loggedUser": loggedUser,
        });
        console.log(response);
        console.log(loggedUser);
    }
    init()
</script>

</html>