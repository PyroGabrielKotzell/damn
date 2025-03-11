<?php

$data = json_decode(file_get_contents("php://input"), true);

$method = $_SERVER["REQUEST_METHOD"];
$action = "";
$loggedUser = "";
$token = "";
$selectedUser = "";
$seen = "";
$message = "";

switch ($method) {
    case "POST": {
            if (isset($data['action'])) {
                $action = $data['action'];
            }
            if (isset($data['loggedUser'])) {
                $loggedUser = $data['loggedUser'];
            }
            if (isset($data['token'])) {
                $token = $data['token'];
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
            if (isset($_GET['loggedUser'])) {
                $loggedUser = $_GET['loggedUser'];
            }
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
            }
            if (isset($_GET['selectedUser'])) {
                $selectedUser = $_GET['selectedUser'];
            }
            break;
        }
}
