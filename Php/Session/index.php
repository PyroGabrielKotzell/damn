<?php
session_start();
include 'vars.php';
include 'utils.php';

include 'mysql/loginning.php';
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