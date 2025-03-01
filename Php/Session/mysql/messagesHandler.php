<?php
$conn = mysqli_connect("localhost", "root", "", "sessione");

$fetchUtenti = doQuery($conn, "SELECT id FROM utente WHERE id != ?;", "s", ...[$loggedUser]);
$detail = str_starts_with($submit, "det") ? substr($submit, 3) : "";

if ($detail != "") {
    doQuery($conn, "UPDATE messaggi SET isRead = 1 WHERE id = ? AND senderId != ?;", "is", ...[$detail, $loggedUser]);
}

$fetchMessaggi = doQuery($conn, "SELECT * FROM messaggi WHERE senderId = ? OR receiverId = ?;", "ss", ...[$loggedUser, $loggedUser]);

if ($submit == "send") {
    $bool = true;
    if ($receiver == '') {
        $_SESSION['rejected'] = "<br>Scegli il ricevente.<br>";
        $bool = false;
    }
    if ($message == '') {
        $_SESSION['rejected'] = "<br>Impossibile leggere il messaggio.<br>";
        $bool = false;
    }
    if ($bool) {
        $_SESSION['rejected'] = "";
        doQuery($conn, "INSERT INTO messaggi (senderId, receiverId, message, isRead) VALUES (?, ?, ?, 0);", "sss", ...[$loggedUser, $receiver, $message]);
    }
    header("Refresh:0");
}
