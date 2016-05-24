<?php

session_start();
if (!(defined('database'))) {
  define("database", 'config/database.php');
}

  if (isset($_POST['photo'])) {
    include database;
    $req = $connection->prepare("INSERT INTO post (link, timedate, iduser) VALUES ('" . $_POST['photo'] ."', NOW(),". $_SESSION['id'] . ");");
    $req->execute();
    header('Location: newphoto.php');
  }
?>
