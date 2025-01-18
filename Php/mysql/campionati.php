<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campionati</title>
</head>

<style>
    body {
        justify-items: center;
    }

    form {
        justify-items: center;
    }

    div.form {
        justify-items: center;
        width: fit-content;
        text-align: center;
        margin-top: 10px;
        padding: 5px;
        border-color: blueviolet;
        border-style: inset;
        box-shadow: 4px 4px 3px black;
    }

    div.box {
        margin-top: 3%;
        justify-items: center;
    }

    table.output {
        margin-block: inherit;
        border: double;
    }

    table.output td {
        padding: 5px;
        border: inset;
    }

    tr.head {
        text-align: center;
        background-color: beige;
    }

    button {
        margin-inline: 2px;
    }

    #action {
        font-size: smaller;
    }
</style>

<body>
    <?php
    // query elaboration
    $page = 0;
    if (isset($_POST['page'])) {
        $page = $_POST['page'];
    }

    $action = '';
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
    }

    $conn = mysqli_connect("localhost", "root", "", "campionati");

    if (false === $conn) {
        exit("Errore: impossibile stabilire una connessione " . mysqli_connect_error());
    }

    function runQuery($query)
    {
        echo $query;
        $conn =  $GLOBALS['conn'];
        $result = mysqli_query($conn, $query);
        if (false === $result) {
            exit("Errore: impossibile eseguire la query. " . mysqli_error($conn));
        }
    }

    function getForm()
    {
        $championship = "";
        if (isset($_POST["championship"])) {
            $championship = $_POST["championship"];
        }
        $nation = "";
        if (isset($_POST["nation"])) {
            $nation = $_POST["nation"];
        }
        $year = "";
        if (isset($_POST["year"])) {
            $year = $_POST["year"];
        }

        return array($championship, $nation, $year);
    }

    function delete($id)
    {
        $query = "DELETE FROM campionato WHERE campionato.id = " . $id . ";";
        runQuery($query);
    }

    function import()
    {
        $arr = getForm();

        $query = "INSERT INTO campionato (denominazione_torneo, nome_nazione, anno_inizio)
        VALUES ('" . $arr[0] . "', '" . $arr[1] . "', " . $arr[2] . ");";
        runQuery($query);
    }

    function save($id)
    {
        $arr = getForm();

        $query = "UPDATE campionato SET denominazione_torneo = '" . $arr[0] . "',
         nome_nazione = '" . $arr[1] . "',
          anno_inizio = " . $arr[2] . "
           WHERE campionato.id = " . $id . ";";
        runQuery($query);
    }

    function elaborateQuery()
    {

        $page =  $GLOBALS['page'];
        $action = $GLOBALS['action'];
        switch ($action) {
            case '<-': {
                    if ($page > 0) $GLOBALS['page']--;
                    break;
                }
            case '->': {
                    $GLOBALS['page']++;
                    break;
                }
            case 'import': {
                    import();
                    break;
                }
        }
        if (str_starts_with($action, "del")) {
            delete(substr($action, 3));
        } else if (str_starts_with($action, "sav")) {
            save(substr($action, 3));
        }
    }

    elaborateQuery();
    ?>

    <form method="post">
        <div class="form">
            <input type="hidden" name="page" id="page" value="<?php echo $page ?>">
            <table>
                <tr>
                    <td><label>Campionato:</label></td>
                    <td><input type="text" name="championship" id="query" /></td>
                </tr>
                <tr>
                    <td><label>Nazione:</label></td>
                    <td><input type="text" name="nation" id="query" /></td>
                </tr>
                <tr>
                    <td><label>Anno:</label></td>
                    <td><input type="number" name="year" id="query" /></td>
                </tr>
            </table>
            <br>
            <input type="submit" name="action" id="action" value="<-" />
            <input type="submit" name="action" id="action" value="import" />
            <input type="submit" name="action" id="action" value="->" />
        </div>

        <?php
        // TABLE OUTPUT

        function printData($dataArray)
        {
            $id = $dataArray[array_keys($dataArray)[0]];
            echo '<tr>';
            foreach ($dataArray as $key => $data) {
                echo '<td>';
                echo $data;
                echo '</td>';
            }

            echo '<td>';
            echo '<button type="submit" name="action" value="del' . $id . '">Delete</button>';
            echo '<button type="submit" name="action" value="sav' . $id . '">Save</button>';
            echo '</td>';
            echo '</tr>';
        }

        function outputTable()
        {
            $conn =  $GLOBALS['conn'];
            $page =  $GLOBALS['page'];
            $baseQuery = 'SELECT * FROM campionato LIMIT 25 OFFSET ' . $page * 25;
            $result = mysqli_query($conn, $baseQuery);

            if (false === $result) {
                exit("Errore: impossibile eseguire la query. " . mysqli_error($conn));
            }

            echo '<div class="box">';
            echo 'Page: ' . $page + 1;

            echo '<table class="output"><tr class="head">';
            $fields = mysqli_fetch_fields($result);

            foreach ($fields as $field) {
                echo '<td>';
                echo $field->name;
                echo '</td>';
            }

            echo '<td>Actions</td></tr>';

            while ($row = mysqli_fetch_row($result)) {
                printData($row);
            }

            echo '</table></div>';
        }
        outputTable();
        ?>
    </form>
</body>

</html>