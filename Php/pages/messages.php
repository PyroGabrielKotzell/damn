<style>
    table {
        margin-top: 3%;
        border: double;
    }

    table td {
        padding: 5px;
        border: inset;
    }

    .messages {
        width: fit-content;
        justify-self: center;
        justify-items: center;
    }
</style>
<form method="post" class="messages" id="msgForm">
    <select name="receiver" id="receiver" form="msgForm" required>
        <?php
        while ($row = mysqli_fetch_assoc($fetchUtenti)) {
            $rowid = $row['id'];
            if ($rowid != $_SESSION['userID']) {
                echo "<option value=\"$rowid\">$rowid</option>";
            }
        }
        ?>
    </select>
    <input type="text" name="message" id="message" pattern="^.+" required />
    <input type="submit" name="submit" id="submit" value="send" />

    <?php
    if (isset($_SESSION['rejected']) && $_SESSION['rejected'] != "") {
        echo $_SESSION['rejected'];
    }
    echo '<table>';
    while ($row = mysqli_fetch_assoc($fetchUtenti)) {
        $rowid = $row['id'];
        $rowsenderid = $row['senderId'];
        $rowmessage = substr($row['message'], 0, 10);
        $rowread = $row['isRead'];
        echo '<tr>';
        echo "
        <td>$rowid</td>
        <td>$rowsenderid</td>
        <td><pre>$rowmessage</pre></td>
        <td>$rowread</td>
        ";
        echo '</tr>';
    }
    echo '</table>';
    ?>
</form>