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

    .table {}

    .tableRow {}

    .tableData {}

    .tableHeader {}

    .tableButton {}

    #query {
        height: 2vh;
    }
</style>

<body>
    <?php
    $page = 0;
    if (isset($_POST['page'])) {
        $page = $_POST['page'];
    }


    ?>

    <form method="post">
        <input type="hidden" value="<?php echo $page ?>">
        <label>query</label><br>
        <input type="text" name="query" id="query" /><br><br>
        <label>submit</label><br>
        <input type="submit" name="action" id="action" value="<-" />
        <input type="submit" name="action" id="action" value="query" />
        <input type="submit" name="action" id="action" value="->" /><br><br>

        <?php
        $conn = mysqli_connect("localhost", "root", "", "campionati");

        if (false === $conn) {
            exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
        }

        $action = '';
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
        }

        function getQuery() {

        }

        function elaborateQuery() {
            $conn =  $GLOBALS['conn'];
            $page =  $GLOBALS['page'];
            $action = $GLOBALS['action'];
            switch ($action) {
                case '<-': {
                        if ($page > 0) $page--;
                        break;
                    }
                case '->': {
                        $page++;
                        break;
                    }
                case 'query': {
                        
                        break;
                    }
            }
    
            if (isset($_POST['query']) && $_POST['query'] != "") {
                $query = $_POST['query'];
                $result = mysqli_query($conn, $query);
                if (false === $result) {
                    exit("Errore: impossibile eseguire la query. " . mysqli_error($conn));
                }
            }
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
                echo '<button type="submit" name="action" value="del' . $GLOBALS['cRow'] . '">Delete</button>';
                echo '<button type="submit" name="action" value="sav' . $GLOBALS['cRow'] . '">Save</button>';
                echo '</td>';
                echo '</tr>';
            }

        // TABLE OUTPUT
        function outputTable()
        {
            $conn =  $GLOBALS['conn'];
            $page =  $GLOBALS['page'];
            $cRow = $GLOBALS['cRow'];
            $baseQuery = 'SELECT * FROM campionato LIMIT 25 OFFSET ' . $page * 25;
            $result = mysqli_query($conn, $baseQuery);

            if (false === $result) {
                exit("Errore: impossibile eseguire la query. " . mysqli_error($conn));
            }

            echo 'Page: ' . $page + 1;
            echo '<table class="table"><tr class="tableHeader tableRow">';
            $fields = mysqli_fetch_fields($result);

            foreach ($fields as $field) {
                echo '<td class="tableData">';
                echo $field->name;
                echo '</td>';
            }

            echo '<td class="tableData">Actions</td></tr>';

            while ($row = mysqli_fetch_row($result)) {
                printData($row);
                $cRow++;
            }

            echo '</table>';
        }
        echo $page . '  ';
        elaborateQuery();
        echo $page . '  ';
        outputTable();
        ?>
    </form>
</body>

</html>