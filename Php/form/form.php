<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>form</title>
</head>

<style>
  td {
    max-width: 200px;
  }

  img {
    max-width: 200px;
    max-height: 200px;
  }

  video {
    max-width: 200px;
    max-height: 200px;
  }
</style>

<body>
  <form method="post">
    <label>Nome</label><br>
    <input type="text" name="nome" /><br><br>
    <label>Cognome</label><br>
    <input type="text" name="cognome" /><br><br>
    <label>Password</label><br>
    <input type="password" name="password" /><br><br>
    <label>Url immagine</label><br>
    <input type="text" name="immagine" /><br><br>
    <label>Url video</label><br>
    <input type="text" name="video" /><br><br>
    <input type="submit" /><br>
  </form>

  <?php
  $array = array();
  if (!$_POST) return;

  $n = $_POST['nome'];
  $c = $_POST['cognome'];
  $p = $_POST['password'];
  $u = $_POST['immagine'];
  $v = $_POST['video'];

  $array += ["nome" => $n, "cognome" => $c, "password" => $p, "immagine" => $u, "video" => $v];

  echo '<br><table border="1px">';
  foreach ($array as $key => $value) {
    if (!$value) {
      header("Location:/mypagina/form/error.php");
      die();
    }
    echo '<tr><td>';
    echo $key;
    echo '</td><td>';
    if ($key == "immagine")
      echo '<img src="'.$value.'"/>';
    else if ($key == "video")
      echo '<video controls src="'.$value.'"/>';
    else echo $value;
    echo '</td></tr>';
  }
  ?>
</body>

</html>