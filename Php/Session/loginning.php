<?php
$conn = mysqli_connect("localhost", "root", "", "sessione");

if (false === $conn) {
    exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
}

$baseQuery = 'SELECT * FROM utente WHERE id = ' . $userID . ' AND password = \'' . $userPassword . '\';';
$result = mysqli_query($conn, $baseQuery);

if (false === $result) {
    exit("Errore: impossibile eseguire la query. " . mysqli_error($conn));
}

if (mysqli_fetch_row($result)) {
    $_SESSION['logged'] = true;
    header("Refresh:0");
} else {
    echo '<br>Password o ID utente sbagliato';
}
?>