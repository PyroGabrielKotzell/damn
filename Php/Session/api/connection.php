<?php

class Connection
{
	private $instance;
	private $conn;

	private function __construct() {}

	private function __clone() {}

	public static function getInstance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new Connection();
			self::$conn = mysqli_connect("localhost", "root", "", "sessione");
		}
		return self::$instance;
	}

	function __destruct()
	{
		mysqli_close(self::$conn);
	}

	function doQuery($query)
	{
		$result = mysqli_query(self::$conn, $query);
		if (false === $result) {
			exit("Errore: impossibile eseguire la query. " . mysqli_error(self::$conn));
		}
		return $result;
	}

	function getUtenti($loggedUser)
	{
		$fetchUtenti = self::doQuery("SELECT id FROM utente WHERE id != '$loggedUser' AND active = 1;");
		$utenti = [];
		while ($row = mysqli_fetch_assoc($fetchUtenti)) {
			$utenti[] = $row['id'];
		}
		return $utenti;
	}

	function getMessaggi($loggedUser, $selectedUser)
	{
		$clause1 = "(senderId = '$loggedUser' AND receiverId = '$selectedUser')";
		$clause2 = "(senderId = '$selectedUser' AND receiverId = '$loggedUser')";
		$fetchMessaggi = self::doQuery("SELECT * FROM messaggi WHERE $clause1 OR $clause2;");
		$messaggi = [];
		while ($row = mysqli_fetch_assoc($fetchMessaggi)) {
			$messaggi[] = $row;
		}
		return $messaggi;
	}

	function readMessaggio($loggedUser, $messageId)
	{
		self::doQuery("UPDATE messaggi SET isRead = 1 WHERE id = $messageId AND receiverId = '$loggedUser' AND senderId != '$loggedUser';");
	}

	function writeMessaggio($loggedUser, $selectedUser, $message) {
		self::doQuery("INSERT INTO messaggi (senderId, receiverId, message, isRead) VALUES ('$loggedUser', '$selectedUser', '$message', 0);");
	}
}
