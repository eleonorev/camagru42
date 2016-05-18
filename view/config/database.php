<?php
  $DB_DSN = 'mysql:dbname=camagru;host=localhost';
  $DB_USER = 'root';
  $DB_PASSWORD = '';
  $connection = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
