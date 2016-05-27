<?php
if (!(defined('database'))) {
  define("database", '../config/database.php');
}

if (isset($_GET['v']) && isset($_GET['l']))
{
    $val = $_GET['v'];
    $login = $_GET['l'];
  include database;
    $motdepasse = $connection->prepare("SELECT * FROM users WHERE login ='".$login."';");
    $motdepasse->execute();
    $blop = $motdepasse->fetchAll(PDO::FETCH_ASSOC);
    $blop = $blop[0];
    $result = $blop['validation'];
  if (strcmp($result, $val) === 0){
  include database;
      $req = "UPDATE users SET validation = '' WHERE login = '" . $login . "';";
    $connection->exec($req);
      header('Location: ../index.php?l=5');
  }
  else {
    header('Location: ../index.php?r=13');
  }

}
?>
