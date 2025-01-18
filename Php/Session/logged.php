<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
</head>

<style>
    body {
        text-align: center;
        justify-items: center;
        background-color: <?php echo $_COOKIE['color'] ?>;
    }

    form {
        margin-block: 3%;
        width: 90vw;
        padding: 5px;
    }

    #logout {
        float: right;
    }

    #color {
        clear: both;
        margin-top: 2%;
    }
</style>

<body>
    <form method="post">
        <input type="submit" name="logout" id="logout" value="logout" />
        <input type="color" name="color" id="color">
    </form>
</body>

</html>