<?php

$data = json_decode(file_get_contents("php://input"), true);

$method = $_SERVER["REQUEST_METHOD"];
$action = "";
$loggedUser = "";
$token = "";
$selectedUser = "";
$seen = "";
$message = "";

if (isset($_COOKIE['userID'])) {
    $loggedUser = $_COOKIE['userID'];
}
if (isset($_COOKIE['token'])) {
    $token = $_COOKIE['token'];
}

switch ($method) {
    case "POST": {
            if (isset($data['action'])) {
                $action = $data['action'];
            }
            if (isset($data['selectedUser'])) {
                $selectedUser = $data['selectedUser'];
            }
            if (isset($data['seen'])) {
                $seen = $data['seen'];
            }
            if (isset($data['message'])) {
                $message = $data['message'];
            }
            break;
        }
    case "GET": {
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
            }
            if (isset($_GET['selectedUser'])) {
                $selectedUser = $_GET['selectedUser'];
            }
            break;
        }
}
