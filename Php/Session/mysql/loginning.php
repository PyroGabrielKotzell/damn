<?php
$conn = mysqli_connect("localhost", "root", "", "sessione");

if (false === $conn) {
    exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
}

$user = mysqli_fetch_assoc(doQuery($conn, "SELECT * FROM utente WHERE id = ?;", "s", ...[$userID]));
$tmpVar1 = "$userPassword+%";
$login = mysqli_fetch_assoc(doQuery($conn, "SELECT * FROM utente WHERE id = ? AND password LIKE ?;", "ss", ...[$userID, $tmpVar1]));
$tmpVar1 = "%+$userPassword";
$otp = mysqli_fetch_assoc(doQuery($conn, "SELECT * FROM utente WHERE id = ? AND password LIKE ?;", "ss", ...[$userID, $tmpVar1]));
$str = '';

if ($submit == "login") {
    if ($otp && $otp['active'] == "0") {
        doQuery($conn, "UPDATE utente SET active = 1 WHERE id = ?;", "s", ...[$userID]);
        $_SESSION['logged'] = true;
        $_SESSION['activating'] = false;
        $_SESSION['rejected'] = "";
        $_SESSION['userID'] = $userID;
    } else if ($login && $login['active'] == "1") {
        $_SESSION['logged'] = true;
        $_SESSION['activating'] = false;
        $_SESSION['rejected'] = "";
        $_SESSION['userID'] = $userID;
    } else if ($login && $login['active'] == "0") {
        $_SESSION['activating'] = true;
        $_SESSION['rejected'] = "<br>Usa la OneTimePassword per attivare il tuo account.<br>";
        $pass = $login['password'];
        $str = substr($pass, strlen($pass));
    } else {
        $_SESSION['rejected'] = "<br>Password o Utente sbagliato.<br>";
    }
    header("Refresh:0");
} else if ($submit == "register") {
    if ($user) {
        $_SESSION['rejected'] = "<br>L'Utente esiste già!<br>";
    } else {
        $_SESSION['activating'] = true;
        $_SESSION['rejected'] = "<br>Usa la OneTimePassword per attivare il tuo account.<br>";
        $str = randstr();
        doQuery($conn, "INSERT INTO utente VALUES (?, ?, 0);", "ss", ...[$userID, "$userPassword+$str"]);
    }
    header("Refresh:0");
}
