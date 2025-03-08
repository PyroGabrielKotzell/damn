<?php
include '../utils.php';

class Connection
{
	private static $instance;
	private static $conn;

	private function __construct() {}

	private function __clone() {}

	public static function getInstance()
	{
		if (!isset(self::$instance) || !isset(self::$conn)) {
			self::$instance = new Connection();
			self::$conn = mysqli_connect("localhost", "root", "", "sessione");
		}

		return self::$instance;
	}

	function __destruct()
	{
		mysqli_close(self::$conn);
	}

	function checkToken($loggedUser, $token) {
		return mysqli_fetch_assoc(doQuery(self::$conn, "SELECT * FROM tokens WHERE id = ? AND token = ?;", "ss", ...[$loggedUser, $token])) != null;
	}

	function getUtenti($loggedUser)
	{
		$fetchUtenti = doQuery(self::$conn, "SELECT id FROM utente WHERE id != ? AND active = 1;", "s", ...[$loggedUser]);
		$utenti = [];
		while ($row = mysqli_fetch_assoc($fetchUtenti)) {
			$utenti[] = $row['id'];
		}
		return $utenti;
	}

	function getMessaggi($loggedUser, $selectedUser)
	{
		$fetchMessaggi = doQuery(
			self::$conn,
			"SELECT * FROM messaggi WHERE (senderId = ? AND receiverId = ?) OR (senderId = ? AND receiverId = ?);",
			"ssss",
			...[$loggedUser, $selectedUser, $selectedUser, $loggedUser]
		);
		$messaggi = [];
		while ($row = mysqli_fetch_assoc($fetchMessaggi)) {
			$messaggi[] = $row;
		}
		return $messaggi;
	}

	function getNull($loggedUser)
	{
		$fetchMessaggi = doQuery(
			self::$conn,
			"SELECT * FROM messaggi WHERE (senderId = ? AND receiverId is null) OR (senderId is null AND receiverId = ?);",
			"ss",
			...[$loggedUser, $loggedUser]
		);
		$messaggi = [];
		while ($row = mysqli_fetch_assoc($fetchMessaggi)) {
			$messaggi[] = $row;
		}
		return $messaggi;
	}

	function readMessaggio($loggedUser, $messageId)
	{
		doQuery(self::$conn, "UPDATE messaggi SET isRead = 1 WHERE id = ? AND receiverId = ? AND senderId != ?;", "iss", ...[$messageId, $loggedUser, $loggedUser]);
	}

	function writeMessaggio($loggedUser, $selectedUser, $message)
	{
		doQuery(self::$conn, "INSERT INTO messaggi (senderId, receiverId, message, isRead) VALUES (?, ?, ?, 0);", "sss", ...[$loggedUser, $selectedUser, $message]);
	}
}
