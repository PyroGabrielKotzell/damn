<?php
$conn = mysqli_connect("localhost", "root", "", "sessione");

if (false === $conn) {
    exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
}

$user = mysqli_fetch_assoc(doQuery($conn, "SELECT * FROM utente WHERE id = ?;", "s", ...[$userID]));
$login = mysqli_fetch_assoc(doQuery($conn, "SELECT * FROM utente WHERE id = ? AND password = ?;", "ss", ...[$userID, $userPassword]));
$otp = mysqli_fetch_assoc(doQuery($conn, "SELECT * FROM utente WHERE id = ? AND otp = ?;", "ss", ...[$userID, $userPassword]));
$token =  mysqli_fetch_assoc(doQuery($conn, "SELECT * FROM tokens WHERE id = ?;", "s", ...[$userID]));
$str = '';

function activate($conn, $userID, $token)
{
    $_SESSION['logged'] = true;
    $_SESSION['activating'] = false;
    $_SESSION['rejected'] = "";
    $tokenStr = randstr(16);
    if (!$token) {
        doQuery($conn, "INSERT INTO tokens VALUES(?, ?)", "ss", ...[$userID, $tokenStr]);
    } else {
        doQuery($conn, "UPDATE tokens SET token = ? WHERE id = ?", "ss", ...[$tokenStr, $userID]);
    }
    setcookie("userID", $userID, time() + (86400 * 30), "/");
    setcookie("token", $tokenStr, array(
        'expires' => time() + (86400 * 30),
        'path' => "/",
        'secure' => true,
    ));
}

if ($submit == "login") {
    if ($otp && $otp['active'] == "0") {
        doQuery($conn, "UPDATE utente SET active = 1 WHERE id = ?;", "s", ...[$userID]);
        activate($conn, $userID, $token);
    } else if ($login && $login['active'] == "1") {
        activate($conn, $userID, $token);
    } else if ($login && $login['active'] == "0") {
        $_SESSION['activating'] = true;
        $_SESSION['rejected'] = "<br>Usa la OneTimePassword per attivare il tuo account.<br>";
        $str = $login['otp'];
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
        doQuery($conn, "INSERT INTO utente VALUES (?, ?, ?, 0);", "sss", ...[$userID, $userPassword, $str]);
    }
    header("Refresh:0");
}
