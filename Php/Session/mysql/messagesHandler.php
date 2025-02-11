<?php
$conn = mysqli_connect("localhost", "root", "", "sessione");

$fetchUtenti = doQuery("SELECT id FROM utente WHERE id != '$loggedUser';", $conn);
$detail = str_starts_with($submit, "det") ? substr($submit, 3) : "";

if ($detail != "") {
    doQuery("UPDATE messaggi SET isRead = 1 WHERE id = $detail AND senderId != '$loggedUser';", $conn);
}

$fetchMessaggi = doQuery("SELECT * FROM messaggi WHERE senderId = '$loggedUser' OR receiverId = '$loggedUser';", $conn);

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
        doQuery("INSERT INTO messaggi (senderId, receiverId, message, isRead) VALUES ('$loggedUser', '$receiver', '$message', 0);", $conn);
    }
    header("Refresh:0");
}
