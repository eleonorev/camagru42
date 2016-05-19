<?php
include('database.php');
$users = "CREATE TABLE IF NOT EXISTS users(
      id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      login varchar(20) NOT NULL,
      pass text NOT NULL,
      mail text NOT NULL,
      photo text NOT NULL,
      nblike int,
      validation text); ";
$connection->exec($users);


$post = "CREATE TABLE IF NOT EXISTS post (
      id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      link text NOT NULL,
      content text NOT NULL,
      tags text NOT NULL,
      timedate datetime NOT NULL,
      iduser int NOT NULL,
      likers text NOT NULL,
      report int NOT NULL); ";
$connection->exec($post);

$comments = "CREATE TABLE IF NOT EXISTS comments (
       id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
       idpost int(11) NOT NULL,
       idusercible int(11) NOT NULL,
       content text NOT NULL,
       timedate datetime NOT NULL); ";
$connection->exec($comments);

$admin = "admin";
$adminpw = hash("whirlpool", "admin");

include 'database.php';
$compte = "INSERT INTO users (login, pass, mail, photo, nblike) VALUES ('admin', '". $adminpw ."', 'eleonore.v@hotmail.fr', 'profile.gif', 0);";
$connection->exec($compte);

echo "Une pomme."

?>
