<style>
    pre {

    }
</style>

<?php
$conn = mysqli_connect("localhost", "root", "", "sessione");

if (false === $conn) {
    exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
}

$login = 'SELECT * FROM utente WHERE id = \'' . $userID . '\' AND password LIKE \'' . $userPassword . '%\';';
$result = mysqli_query($conn, $login);

$otp = 'SELECT * FROM utente WHERE id = \'' . $userID . '\' AND password LIKE \'%-' . $userPassword . '\';';
$result = mysqli_query($conn, $otp);

if (false === $result) {
    exit("Errore: impossibile eseguire la query. " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

function check($conn, $userID, $userPassword)
{
}

function registerSeq($conn, $userID, $userPassword, $otp = "")
{
    if ($otp == "") $otp = randstr();
    echo '<pre>' . $otp . '</pre>';
}

if ($submit == "login") {
    if ($row && $row['active'] == "1") {
        $_SESSION['logged'] = true;
        header("Refresh:0");
    } else if ($row['active'] == "0") {
        if (check($conn, $userID, $userPassword)) echo '<br>Utente non attivo. Per favore, autenticarsi usando la OneTimePassword.<br>';
        $pass = $row['password'];
        registerSeq($conn, $userID, $userPassword, substr($pass, strlen($pass)));
    } else {
        echo '<br>Password o Utente sbagliato.';
    }
} else if ($submit == "register") {
    registerSeq($conn, $userID, $userPassword);
}
