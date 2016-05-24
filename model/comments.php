<?php
if (!(defined('database'))) {
  define("database", '../config/database.php');
}

if (isset($_POST['commenter'])) {
  session_start();

  post_comment();
}

function get_comments($idpost) {
  include database;
  $req = $connection->prepare("SELECT * FROM comments WHERE idpost ='".$idpost."';");
  $req->execute();
  $comments = $req->fetchAll(PDO::FETCH_ASSOC);
  return $comments;
}

function get_nb_comments($idpost) {
  include database;
  $req = $connection->prepare("SELECT * FROM comments WHERE idpost ='".$idpost."';");
  $req->execute();
  $nbcomments = $req->rowCount();
  return $nbcomments;
}


function post_comment() {
  $post = $_POST['idpost'];
  $source = $_SESSION['id'];
  if (empty($_POST['content']))
  {	header('Location: ../index.php?e=3');}
  $content = $_POST['content'];
  $content = htmlentities($content);
  include database;
  $req = $connection->prepare("INSERT INTO comments (idpost, idusercible, content, timedate) VALUES (" . $post .", " . $source .", '" . $content . "', NOW());");
  $req->execute();
  $message = "Vous avez un nouveau commentaire sur l'un de vos posts";
  include 'users.php';
  $login = get_login($_POST['iduser']);
  $mail = get_mail_user($login);
  mail($mail, 'Camagru - Nouveau Commentaire', $message);
  header('Location: ../index.php#' . $post . "caca=" . $mail);
}

?>
