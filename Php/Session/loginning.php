<?php
$conn = mysqli_connect("localhost", "root", "", "sessione");

if (false === $conn) {
    exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
}

function doQuery($query, $conn)
{
    $result = mysqli_query($conn, $query);
    if (false === $result) {
        exit("Errore: impossibile eseguire la query. " . mysqli_error($conn));
    }
    return $result;
}

$user = mysqli_fetch_assoc(doQuery("SELECT * FROM utente WHERE id = '$userID';", $conn));
$login = mysqli_fetch_assoc(doQuery("SELECT * FROM utente WHERE id = '$userID' AND password LIKE '$userPassword+%';", $conn));
$otp = mysqli_fetch_assoc(doQuery("SELECT * FROM utente WHERE id = '$userID' AND password LIKE '%+$userPassword';", $conn));
$str = '';

if ($submit == "login") {
    if ($otp && $otp['active'] == "0") {
        doQuery("UPDATE utente SET active = 1 WHERE id = '$userID';", $conn);
        $_SESSION['logged'] = true;
        $_SESSION['activating'] = false;
        $_SESSION['rejected'] = "";
        header("Refresh:0");
    } else if ($login && $login['active'] == "1") {
        $_SESSION['logged'] = true;
        $_SESSION['activating'] = false;
        $_SESSION['rejected'] = "";
        header("Refresh:0");
    } else if ($login && $login['active'] == "0") {
        $_SESSION['activating'] = true;
        $_SESSION['rejected'] = "<br>Usa la OneTimePassword per attivare il tuo account.<br>";
        $pass = $login['password'];
        $str = substr($pass, strlen($pass));
    } else {
        $_SESSION['rejected'] = "<br>Password o Utente sbagliato.<br>";
    }
} else if ($submit == "register") {
    if ($user) {
        $_SESSION['rejected'] = "<br>L'Utente esiste già!<br>";
    } else {
        $_SESSION['activating'] = true;
        $_SESSION['rejected'] = "<br>Usa la OneTimePassword per attivare il tuo account.<br>";
        $str = randstr();
        doQuery("INSERT INTO utente VALUES ('$userID', '$userPassword+$str', 0);", $conn);
    }
}
