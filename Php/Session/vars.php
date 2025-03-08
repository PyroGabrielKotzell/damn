<?php

$submit = '';
if (isset($_POST['submit'])) {
    $submit = $_POST['submit'];
}

// Login form
$userID = '';
if (isset($_POST['userID'])) {
    $userID = $_POST['userID'];
}

$userPassword = '';
if (isset($_POST['userPassword'])) {
    $userPassword = $_POST['userPassword'];
}

// Page form
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

// Sessions variables
$activating = false;
if (isset($_SESSION['activating'])) $activating = $_SESSION['activating'];

$logged = false;
if (isset($_SESSION['logged'])) $logged = $_SESSION['logged'];

$rejected = '';
if (isset($_SESSION['rejected'])) $rejected = $_SESSION['rejected'];
?>