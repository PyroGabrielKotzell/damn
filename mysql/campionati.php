<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campionati</title>
</head>

<style>
    body {
        text-align: center;
        display: flex;
        justify-content: center;
    }

    .table {
        
    }
    
    .tableRow {}
    
    .tableData {}

    .tableHeader {}

    .tableButton {}

    #query {
        height: 2vh;
    }
</style>

<body>
    <form method="post">
        <label>query</label><br>
        <input type="text" name="query" id="query" /><br><br>
        <label>submit</label><br>
        <input type="submit" name="action" id="action" value="query" /><br><br>

        <?php
        $conn = mysqli_connect("localhost", "root", "", "campionati");

        if (false === $conn) {
            exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
        }

        $page = 0;

        $baseQuery = 'SELECT * FROM campionato LIMIT 25 OFFSET ' . $page * 25;
        $result = mysqli_query($conn, $baseQuery);

        if (false === $result) {
            exit("Errore: impossibile eseguire la query. " . mysqli_error($conn));
        }

        $cRow = $page * 25 + 1;

        function printData($dataArray, $classes = "")
        {
            echo '<tr class="tableRow ' . $classes . '">';
            foreach ($dataArray as $key => $data) {
                echo '<td class="tableData">';
                echo $data;
                echo '</td>';
            }

            echo '<td class="tableButton">';
            echo '<input type="hidden" name="row" value="' . $GLOBALS['cRow'] . '"/>';
            echo '<input type="submit" name="action" value="delete"/>';
            echo '</td>';

            echo '</tr>';
        }

        echo '<table class="table"><tr class="tableHeader tableRow">';

        foreach (mysqli_fetch_fields($result) as $field) {
            echo '<td class="tableData">';
            echo $field->name;
            echo '</td>';
        }

        echo '<td class="tableData">Actions</td>';

        echo '</tr>';

        while ($row = mysqli_fetch_row($result)) {
            printData($row);
            $cRow++;
        }

        echo '</table>';

        $query = '';
        if (isset($_POST['query']) && $_POST['query'] != "") {
            $query = $_POST['query'];
            $result = mysqli_query($conn, $query);
            if (false === $result) {
                exit("Errore: impossibile eseguire la query. " . mysqli_error($conn));
            }
        }
        ?>
    </form>
</body>

</html>