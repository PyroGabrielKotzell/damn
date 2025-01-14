<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['logged']) && $_SESSION['logged']) {
        readfile('./logged.html');
    } else {
        readfile('./login.html');
    }
    ?>

    <?php
    $userID = '';
    if (isset($_POST['userID'])) {
        $userID = $_POST['userID'];
    }

    $userPassword = '';
    if (isset($_POST['userPassword'])) {
        $userPassword = $_POST['userPassword'];
    }

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Refresh:0");
        return;
    }
    if ($userID === '' && $userPassword === '') {
        return;
    }

    $conn = mysqli_connect("localhost", "root", "", "sessione");

    if (false === $conn) {
        exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
    }

    $baseQuery = 'SELECT * FROM utente WHERE id = ' . $userID . ' AND password = \'' . $userPassword .'\';';
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
</body>

</html>