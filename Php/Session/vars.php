<?php
$userID = '';
if (isset($_POST['userID'])) {
    $userID = $_POST['userID'];
}

$userPassword = '';
if (isset($_POST['userPassword'])) {
    $userPassword = $_POST['userPassword'];
}

$submit = '';
if (isset($_POST['submit'])) {
    $submit = $_POST['submit'];
}

$logout = isset($_POST['logout']);

$color = '';
if (isset($_POST['color'])) {
    $color = $_POST['color'];
}
?>