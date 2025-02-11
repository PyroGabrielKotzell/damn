<?php

$loggedUser = "";
if (isset($data['loggedUser'])) {
	$loggedUser = $data['loggedUser'];
}

if ($loggedUser == "") {
    header("", false, 401);
    echo json_encode("Not Logged");
    exit();
}

$selectedUser = "";
if (isset($data['selectedUser'])) {
	$selectedUser = $data['selectedUser'];
}

$message = "";
if (isset($data['message'])) {
	$message = $data['message'];
}

if ($message != "" && $selectedUser == "") {
    header("", false, 400);
    echo json_encode("Unselected User");
    exit();
}