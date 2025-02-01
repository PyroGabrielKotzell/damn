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

$color = '';
if (isset($_POST['color'])) {
    $color = $_POST['color'];
}

$message = '';
if (isset($_POST['message'])) {
    $message = $_POST['message'];
}

$receiver = '';
if (isset($_POST['receiver'])) {
    $receiver = $_POST['receiver'];
}
?>