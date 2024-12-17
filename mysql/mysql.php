<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mysql</title>
</head>

<style>
</style>

<body>
    <form method="post">
        <label>query</label><br>
        <input type="text" name="query" id="query" /><br><br>
        <label>submit</label><br>
        <input type="submit" name="submit" id="submit" /><br><br>
    </form><br>

    <?php
    $conn = mysqli_connect("localhost", "root", "", "campionati");

    if (false === $conn) {
        exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
    }

    $baseQuery = 'SELECT * FROM campionato LIMIT 25';
    $result = mysqli_query($conn, $baseQuery);

    if (false === $result) {
        exit("Errore: impossibile eseguire la query. " . mysqli_error($conn));
    }
    foreach (mysqli_fetch_fields($result) as $field) {
        echo $field->name . ' ';
    }
    echo '<br>';

    while ($row = mysqli_fetch_row($result)) {
        foreach ($row as $key => $value) {
            echo $value . ' ';
        }
        echo '<br>';
    }

    $query = '';
    if (isset($_POST['query'])) {
        $query = $_POST['query'];
        $result = mysqli_query($conn, $query);
        if (false === $result) {
            exit("Errore: impossibile eseguire la query. " . mysqli_error($conn));
        }
    }
    ?>
</body>

</html>