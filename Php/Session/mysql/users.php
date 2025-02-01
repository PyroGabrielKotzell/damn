<?php
$userID = $_SESSION['userID'];
$conn = mysqli_connect("localhost", "root", "", "sessione");

$fetchUtenti = doQuery("SELECT * FROM utente WHERE 1;", $conn);
$detail = str_starts_with($submit, "det") ? substr($submit, 3) : "";

if ($detail != "") {
    doQuery("UPDATE messaggi SET isRead = 1 WHERE id = $detail AND senderId != '$userID';", $conn);
}

$fetchMessaggi = doQuery("SELECT * FROM messaggi WHERE senderId = '$userID' OR receiverId = '$userID';", $conn);

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
        doQuery("INSERT INTO messaggi (senderId, receiverId, message, isRead) VALUES ('$userID', '$receiver', '$message', 0);", $conn);
        header("Refresh:0");
    }
}
