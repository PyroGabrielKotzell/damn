<style>
    table {
        margin-top: 3%;
        border: outset;
    }

    table td {
        padding-inline: 2px;
        min-width: 5vw;
        border: 3px groove white;
    }

    .messages {
        width: fit-content;
        justify-self: center;
        justify-items: center;
    }

    td#s {
        background-color: greenyellow;
    }

    td#d {
        background-color: red;
    }
</style>
<form method="post" class="messages" id="msgForm">
    <select name="receiver" id="receiver" form="msgForm">
        <?php
        while ($row = mysqli_fetch_assoc($fetchUtenti)) {
            $rowid = $row['id'];
            if ($rowid != $loggedUser) {
                echo "<option value=\"$rowid\">$rowid</option>";
            }
        }
        ?>
    </select>
    <input type="text" name="message" id="message" pattern="^.+" />
    <input type="submit" name="submit" id="submit" value="send" />

    <?php
    echo $rejected;
    
    echo '<table>';
    while ($row = mysqli_fetch_assoc($fetchMessaggi)) {
        $rowid = $row['id'];
        $rowsenderid = $row['senderId'];

        if ($loggedUser == $rowsenderid) {
            $rowsenderid = "<b>$rowsenderid</b>";
        }

        $rowmessage = $row['message'];

        $detBtn = "<button type='submit' name='submit' id='submit' value='det$rowid'>Details</button>";

        if (strlen($rowmessage) > 10) {
            if ($rowid != $detail) {
                $rowmessage = substr($rowmessage, 0, 10) . '...';
            } else {
                $detBtn = "<button type='submit' name='submit' id='submit' value='close'>Close</button>";
            }
        }
        $rowread = $row['isRead'] == 1 ? "id='s'>Seen" : "id='d'>Unread";

        if ($row['isRead'] == 0) {
            $rowmessage = "<b>$rowmessage</b>";
        }

        echo '<tr>';
        echo "
        <td>$rowid</td>
        <td>$rowsenderid</td>
        <td><pre>$rowmessage</pre></td>
        <td $rowread</td>
        <td>$detBtn</td>
        ";
        echo '</tr>';
    }
    echo '</table>';
    ?>

    <table id="messages">

    </table>
</form>