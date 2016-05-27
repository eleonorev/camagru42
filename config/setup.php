<?php
include('database.php');
$users = "CREATE TABLE IF NOT EXISTS users(
      id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      login varchar(20),
      pass text,
      mail text,
      photo text,
      nblike int,
      validation text); ";
$connection->exec($users);


$post = "CREATE TABLE IF NOT EXISTS post (
      id int(11) AUTO_INCREMENT PRIMARY KEY,
      link longtext,
      content text,
      tags text,
      timedate datetime,
      iduser int,
      likers text,
      report int); ";
$connection->exec($post);

$comments = "CREATE TABLE IF NOT EXISTS comments (
       id int(11) AUTO_INCREMENT PRIMARY KEY,
       idpost int(11),
       idusercible int(11),
       content text,
       timedate datetime); ";
$connection->exec($comments);

$admin = "admin";
$adminpw = hash("whirlpool", "admin");

include 'database.php';
$compte = "INSERT INTO users (login, pass, mail, photo, nblike) VALUES ('admin', '". $adminpw ."', 'eleonore.v@hotmail.fr', 'profile.gif', 0);";
$connection->exec($compte);

echo "Une pomme."

?>
