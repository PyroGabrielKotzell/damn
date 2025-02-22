<?php

require_once 'connection.php';

include '../utils.php';

header('Content-Type: application/json', true, 200);

include 'datavars.php';

$conn = mysqli_connect("localhost", "root", "", "sessione");
$connection = Connection::getInstance();

if (false === $conn) {
	exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
}

function rejectNoUser()
{
	header("", false, 400);
	echo json_encode("Unselected User");
	exit();
}

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
