<?php
if (!(defined('database'))) {
  define("database", '../config/database.php');
}

if (isset($_GET['like'])){
  session_start();
  like($_GET['like']);
}

if (isset($_GET['dlike'])){
  session_start();
  dislike($_GET['dlike']);
}

if (isset($_GET['supp'])){
  session_start();
  supp_post($_GET['supp']);
}


function get_userpost($user) {
  include database;
  $iduser = get_iduser($user);
  $req = $connection->prepare("SELECT * FROM post WHERE iduser ='".$iduser."' ORDER BY timedate desc;");
  $req->execute();
  $posts = $req->fetchAll(PDO::FETCH_ASSOC);
  return $posts;
}

function nb_post() {
  include database;
  $req = $connection->prepare("SELECT * FROM post");
  $req->execute();
  $nbpost = $req->rowCount();
  return $nbpost;
}


function get_nb_post($login) {
  $iduser = get_iduser($login);
  include database;
  $req = $connection->prepare("SELECT * FROM post WHERE iduser ='".$iduser."';");
  $req->execute();
  $nbpost = $req->rowCount();
  return $nbpost;
}

function get_iduser($login) {
  include database;
  $req = $connection->prepare("SELECT id FROM users WHERE login ='".$login."';");
  $req->execute();
  $iduser = $req->fetchAll(PDO::FETCH_ASSOC);
  $id = $iduser[0];
  $iduser = $id['id'];
  return $iduser;
}

function getlikers_str($post) {
  include database;
  $req = $connection->prepare("SELECT likers FROM post WHERE id ='".$post."';");
  $req->execute();
  $nblike = $req->fetchAll(PDO::FETCH_ASSOC);
  return $nblike[0]['likers'];
}

function getlikers_str2($post) {
  include database;
  $req = $connection->prepare("SELECT likers FROM post WHERE id ='".$post."';");
  $req->execute();
  $nblike = $req->fetchAll(PDO::FETCH_ASSOC);
  return $nblike[0]['likers'];
}

function getlikers_post($post) {
  include database;
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
  include database;
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
  include database;
  $req = "UPDATE post SET likers = '" . $likers . "'WHERE id = " . $idpost . ";";
  $connection->exec($req);
    header('Location: ../index.php#' . $idpost);
}

function dislike($idpost) {
  $likers = getlikers_str($idpost);
  $likers = str_ireplace($_SESSION['login'] . ",", "", $likers);
  include database;
  $req = "UPDATE post SET likers = '" . $likers . "'WHERE id = " . $idpost . ";";
  $connection->exec($req);
    header('Location: ../index.php#' . $idpost);
}

function get_toppost($page) {
  $ttpost = nb_post();
  $nbpage = $ttpost / 3;
  $deb = $ttpost - ($page * 3);
  include database;
  $result = $connection->prepare('SELECT * FROM post LIMIT ' . $deb .', 3 ;');
  $result->execute();
  $posts = $result->fetchAll(PDO::FETCH_ASSOC);
  return $posts;
}

function get_post($id) {
  include database;
  $result = $connection->prepare('SELECT * FROM post WHERE id = '. $id .' ORDER BY timedate desc;');
  $result->execute();
  $post = $result->fetchAll(PDO::FETCH_ASSOC);
  return $post[0];
}

function get_iduser_post($idpost) {
  include database;
  $result = $connection->prepare('SELECT * FROM post WHERE id = '. $idpost .' ORDER BY timedate desc;');
  $result->execute();
  $post = $result->fetchAll(PDO::FETCH_ASSOC);
  return $post[0]['iduser'];
}

function supp_post($idpost) {
  include database;
  if (get_iduser_post($idpost) == $_SESSION['id']) {
    $req = "DELETE FROM post WHERE id = " . $idpost . ";";
    $connection->exec($req);
    header('Location: ../profile.php?r=1');
  }
  else {
  header('Location: ../profile.php?r=2'); }
}
