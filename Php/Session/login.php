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
                    <input type="text" name="userID" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Password</label>
                </td>
                <td>
                    <input type="text" name="userPassword" />
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" id="submit" value="register" />
        <input type="submit" name="submit" id="submit" value="login" />
    </form>
</body>

</html>