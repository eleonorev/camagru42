<?php

if (isset($_POST['commenter'])) {
  session_start();
  post_comment();
}

function get_comments($idpost) {
  include 'config/database.php';
  $req = $connection->prepare("SELECT * FROM comments WHERE idpost ='".$idpost."';");
  $req->execute();
  $comments = $req->fetchAll(PDO::FETCH_ASSOC);
  return $comments;
}

function get_nb_comments($idpost) {
  include 'config/database.php';
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
  include '../config/database.php';
  $req = "INSERT INTO comments (idpost, idusercible, content, timedate) VALUES (" . $post .", " . $source .", '" . $content . "', NOW());";
  $connection->exec($req);
  header('Location: ../index.php#' . $post);
}

?>
