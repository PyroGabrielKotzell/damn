<?php
$conn = mysqli_connect("localhost", "root", "", "sessione");
$fetchUtenti = doQuery("SELECT * FROM utente WHERE 1;", $conn);
$userID = $_SESSION['userID'];
$fetchMessaggi = doQuery("SELECT * FROM messaggi WHERE receiverId = '$userID';", $conn);

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
        doQuery("INSERT INTO messaggi ('senderId', 'receiverId', 'message', 'isRead') VALUES ('$userID', '$receiver', '$message', 0);", $conn);
    }
}
