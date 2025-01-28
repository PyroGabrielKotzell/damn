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
        background-color: <?php echo isset($_COOKIE['color']) ? $_COOKIE['color'] : "#ffffff" ?>;
    }

    form.base {
        margin-block: 3%;
        width: 90vw;
        padding: 5px;
    }

    .logout {
        justify-self: right;
    }

    #color {
        margin-top: 2%;
    }
</style>

<body>
    <?php
    include 'mysql/users.php';
    ?>
    <form method="post" class="base">
        <div class="logout">
            <input type="submit" name="submit" id="submit" value="logout" />
        </div>
        <input type="color" name="color" id="color" value="<?php echo isset($_COOKIE['color']) ? $_COOKIE['color'] : "#ffffff" ?>">
    </form><br><br>
    <?php include 'messages.php' ?>
    <?php
    ?>
</body>

</html>