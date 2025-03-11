<?php

require_once 'connection.php';
$connection = Connection::getInstance();

include 'datavars.php';

header('Content-Type: application/json', true, 200);

function rejectNoAction() {
	echo json_encode("No Action");
    exit();
}

function rejectNotLogged()
{
	http_response_code(401);
	echo json_encode("Not Logged");
	exit();
}

function rejectBadAuth() {
	http_response_code(401);
	echo json_encode("Bad Auth Error");
	exit();
}

function rejectNoUser()
{
	http_response_code(400);
	echo json_encode("Unselected User");
	exit();
}

if ($action == "") rejectNoAction();

if ($loggedUser == "") rejectNotLogged();

if (!$connection->checkToken($loggedUser, $token)) rejectBadAuth();

switch ($action) {
	case "users": {
			$utenti = $connection->getUtenti($loggedUser);
			echo json_encode($utenti);
			break;
		}
	case "messages": {
			if ($selectedUser == "") rejectNoUser();
			$messaggi;
			if ($selectedUser == "null") $messaggi = $connection->getNull($loggedUser);
			else $messaggi = $connection->getMessaggi($loggedUser, $selectedUser);
			echo json_encode($messaggi);
			break;
		}
	case "read": {
			$connection->readMessaggio($loggedUser, $seen);
			echo json_encode("Message read, id:$seen");
			break;
		}
	case "send": {
			if ($selectedUser == "") rejectNoUser();
			$connection->writeMessaggio($loggedUser, $selectedUser, $message);
			echo json_encode("Message sent");
			break;
		}
}
