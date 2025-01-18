<?php
$userID = '';
if (isset($_POST['userID'])) {
    $userID = $_POST['userID'];
}

$userPassword = '';
if (isset($_POST['userPassword'])) {
    $userPassword = $_POST['userPassword'];
}

$logout = isset($_POST['logout']);

$color = '';
if (isset($_POST['color'])) {
    $color = $_POST['color'];
}
?>