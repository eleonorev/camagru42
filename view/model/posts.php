<?php

if (isset($_GET['like'])){
  session_start();
  like($_GET['like']);
}

if (isset($_GET['dlike'])){
  session_start();
  dislike($_GET['dlike']);
}


function get_userpost($user) {
  include 'config/database.php';
  $iduser = get_iduser($user);
  $req = $connection->prepare("SELECT * FROM post WHERE iduser ='".$iduser."';");
  $req->execute();
  $posts = $req->fetchAll(PDO::FETCH_ASSOC);
  return $posts;
}

function get_nb_post($login) {
  $iduser = get_iduser($login);
  include 'config/database.php';
  $req = $connection->prepare("SELECT * FROM post WHERE iduser ='".$iduser."';");
  $req->execute();
  $nbpost = $req->rowCount();
  return $nbpost;
}

function get_iduser($login) {
  include 'config/database.php';
  $req = $connection->prepare("SELECT id FROM users WHERE login ='".$login."';");
  $req->execute();
  $iduser = $req->fetchAll(PDO::FETCH_ASSOC);
  $id = $iduser[0];
  $iduser = $id['id'];
  return $iduser;
}

function getlikers_str($post) {
  include '../config/database.php';
  $req = $connection->prepare("SELECT likers FROM post WHERE id ='".$post."';");
  $req->execute();
  $nblike = $req->fetchAll(PDO::FETCH_ASSOC);
  return $nblike[0]['likers'];
}

function getlikers_str2($post) {
  include 'config/database.php';
  $req = $connection->prepare("SELECT likers FROM post WHERE id ='".$post."';");
  $req->execute();
  $nblike = $req->fetchAll(PDO::FETCH_ASSOC);
  return $nblike[0]['likers'];
}

function getlikers_post($post) {
  include 'config/database.php';
  $req = $connection->prepare("SELECT likers FROM post WHERE id ='".$post."';");
  $req->execute();
  $nblike = $req->fetchAll(PDO::FETCH_ASSOC);
  $like = $nblike[0]['likers'];
  $likers = explode(",", $like);
  unset($likers[count($likers) - 1]);
  return $likers;
}

function get_nblike($post) {
  $likers = getlikers_post($post);
  $like = count($likers);
  return $like;
}

function getlike_user($login) {
  include 'config/database.php';
  $req = $connection->prepare("SELECT nblike FROM users WHERE login ='".$login."';");
  $req->execute();
  $nblike = $req->fetchAll(PDO::FETCH_ASSOC);
  $like = $nblike[0];
  $nblike = $like['nblike'];
  return $nblike;
}

function like($idpost) {
  $likers = getlikers_str($idpost);
  $likers = $likers . $_SESSION['login'] . ",";
  include '../config/database.php';
  $req = "UPDATE post SET likers = '" . $likers . "'WHERE id = " . $idpost . ";";
  $connection->exec($req);
    header('Location: ../index.php#' . $idpost);
}

function dislike($idpost) {
  $likers = getlikers_str($idpost);
  $likers = str_ireplace($_SESSION['login'] . ",", "", $likers);
  include '../config/database.php';
  $req = "UPDATE post SET likers = '" . $likers . "'WHERE id = " . $idpost . ";";
  $connection->exec($req);
    header('Location: ../index.php#' . $idpost);
}

function get_toppost() {
  include 'config/database.php';
  $result = $connection->prepare('SELECT * FROM post;');
  $result->execute();
  $posts = $result->fetchAll(PDO::FETCH_ASSOC);
  return $posts;
}
