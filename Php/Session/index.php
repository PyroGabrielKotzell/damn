<?php
session_start();
include 'vars.php';
include 'utils.php';

if ($submit == "logout") {
    setcookie("color", $color, time() + (86400 * 30), "/");
}

if ($submit == "logout") {
    session_unset();
    session_destroy();
    header("Refresh:0");
    return;
}

if ($userID != "" && $userPassword != "") {
    include 'mysql/loginning.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    if ($logged) {
        readfile('pages/msg/selector.html');
    } else {
        include 'pages/login/loginPage.php';
    }
    ?>
</body>

</html>