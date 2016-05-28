<?php
  session_start();
  define('BASE_PATH', realpath(dirname(__FILE__)));
  define("database", BASE_PATH . '/../config/database.php');
  include('model/posts.php');
  include('model/users.php');
  include('model/comments.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Camagru</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" media="screen" type="text/css" href="assets/css/nav.css">
  <link rel="stylesheet" media="screen" type="text/css" href="assets/css/app.css">
  <script src="assets/js/toggle.js"></script>
</head>
<body>
<div id="header">
      <ul class="menu">
          <div class="menuright">
            <span class="logo">Camagru </span>
                  </div>

                </ul>
</div>

<div id="toggle" class="on">
      <div class="one"></div>
      <div class="two"></div>
      <div class="three"></div>
  </div>

    <div id="navigation" class="active">
        <?php
          if (isset($_SESSION['login'])) {
            include('navconnect.php');}
         else {
            include('navdisconnect.php');
          }


        ?>

    </div>
