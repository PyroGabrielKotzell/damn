<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
</head>

<style>
    body {
        text-align: center;
        justify-items: center;
    }

    form {
        border: 2px inset blueviolet;
        justify-items: center;
        padding: 5px;
        box-shadow: 4px 4px 3px black;
        margin-top: 2%;
    }

    input:invalid {
        background-color: lightpink;
    }

    #submit {
        margin-top: 2px;
        margin-inline: 2px;
    }
</style>

<body>
    <form method="post">
        <table>
            <tr>
                <td>
                    <label>User</label>
                </td>
                <td>
                    <input type="text" name="userID" pattern="^\S+$" required />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Password</label>
                </td>
                <td>
                    <input type="text" name="userPassword" pattern="^\S+$" required />
                </td>
            </tr>
        </table>
        <button type="submit" name="submit" id="submit" value="login">Login</button>
        <button type="submit" name="submit" id="submit" value="register" <?php echo isset($_SESSION['activating']) && $_SESSION['activating'] ? "hidden" : ""; ?>>Register</button>
    </form>
    <?php
    echo $rejected;

    if ($activating) {
        echo "<pre>$str</pre>";
    }
    ?>
</body>

</html>