<?php
include 'vars.php';
include 'utils.php';

if ($logout) {
    setcookie("color", $color, time() + (86400 * 30), "/");
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
    session_start();
    if ($logout) {
        session_unset();
        session_destroy();
        header("Refresh:0");
        return;
    }

    if ($userID != "" && $userPassword != "") {
        include 'loginning.php';
    }

    if (isset($_SESSION['logged']) && $_SESSION['logged']) {
        include 'page.php';
    } else {
        include 'login.php';
    }
    ?>
</body>

</html>