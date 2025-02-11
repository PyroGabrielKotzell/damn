<?php

// the API file
//require_once 'api.php';

include '../utils.php';

header('Content-Type: application/json', true, 200);

$data = json_decode(file_get_contents("php://input"), true);

include 'datavars.php';

$conn = mysqli_connect("localhost", "root", "", "sessione");

if (false === $conn) {
	exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
}

if ($message == "" && $selectedUser == "") {
	$fetchUtenti = doQuery("SELECT id FROM utente WHERE id != '$loggedUser' AND active = 1;", $conn);
	$utenti = [];
	while ($row = mysqli_fetch_assoc($fetchUtenti)) {
		$utenti[] = $row['id'];
	}

	echo json_encode($utenti);
	exit();
}

if ($message == "") {
	$fetchMessaggi = doQuery("SELECT * FROM messaggi
	WHERE (senderId = '$loggedUser' AND receiverId = '$selectedUser') OR (senderId = '$selectedUser' AND receiverId = '$loggedUser');", $conn);

	$messaggi = [];
	while ($row = mysqli_fetch_assoc($fetchMessaggi)) {
		$messaggi[] = $row;
	}

	echo json_encode($messaggi);
	exit();
}

echo json_encode("No Action");