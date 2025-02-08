<?php

// the API file
//require_once 'api.php';
include '../utils.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$loggedUsr = $data['loggedUser'];
if (!isset($data['action'])) exit();
$action = $data['action'];

$conn = mysqli_connect("localhost", "root", "", "sessione");

if (false === $conn) {
    exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
}

if ($action === "selector") {
	$fetchUtenti = [];
	while ($row = mysqli_fetch_assoc(doQuery("SELECT id FROM utente WHERE id != '$loggedUsr';", $conn)))
		$fetchUtenti += $row;
}

echo json_encode($fetchUtenti);
/*

// creates a new instance of the api class
$api = new api();

// message to return
$message = array();

switch($_POST["action"])
{
	case 'get':
		$params = array();
		$params['id'] = isset($_POST["id"]) ? $_POST["id"] : '';
		if (is_array($data = $api->get($params))) {
			$message["code"] = "0";
			$message["data"] = $data;
		} else {
			$message["code"] = "1";
			$message["message"] = "Error on get method";
		}
		break;

	default:
		$message["code"] = "1";
		$message["message"] = "Unknown method " . $_POST["action"];
		break;
}

//the JSON message
header('Content-type: application/json; charset=utf-8');
echo json_encode($message, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

?>
*/