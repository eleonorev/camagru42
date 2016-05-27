<?php
if (!(defined('database'))) {
  define("database", '../config/database.php');
}


if (isset($_POST['connexion'])) {
  session_start();
  login();
}

if (isset($_POST['inscription'])) {
  session_start();
  create_user();
}

if (isset($_POST['forgot'])) {
  session_start();
  regeneratepwd();
}

 if (isset($_GET['e']) && ($_GET['e'] == 12)) {
   session_start();
    session_destroy();
    header('Location: ../index.php');
  }

  if (isset($_POST['changepass'])) {
    session_start();
    changepass();
  }


function get_pp($login) {
  include database;
    $result = $connection->prepare("SELECT photo FROM users WHERE login ='".$login."';");
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_ASSOC);
    $photo =  $users[0]['photo'];
  return $photo;
}

function get_mail_user($login) {
  include database;
    $result = $connection->prepare("SELECT mail FROM users WHERE login ='".$login."';");
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_ASSOC);
  return $users[0]['mail'];
}

function get_followers($login) {
  include database;
    $result = $connection->prepare("SELECT follow FROM users WHERE login ='".$login."';");
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_ASSOC);
    $follow =  $users[0]['follow'];
    $followers = explode(",", $follow);
  unset($followers[count($followers) - 1]);
  return $followers;
}

function nb_follow($login) {
  $tab = get_followers($login);
  $nbfollow = count($tab);
  return $nbfollow;
}

function get_login($iduser) {
  include database;
    $result = $connection->prepare("SELECT login FROM users WHERE id ='".$iduser."';");
  $result->execute();
  $login = $result->fetchAll(PDO::FETCH_ASSOC);
$log =  $login[0]['login'];
  return $log;
}

function create_user() {
  $error = 0;
  if ($_POST['passwd_one'] != $_POST['passwd_two']) {
     $error = 2;
  }
  else {
       $pass = hash("whirlpool", $_POST['passwd_one']);
  }
  if (strlen($_POST['passwd_one']) < 8 || strlen($_POST['passwd_one']) > 40) {
     $error = 3;
  }
  if (strlen($_POST['login']) < 3 || strlen($_POST['login']) > 18) {
     $error = 4;
  }
  if (strlen($_POST['mail']) < 7) {
    $error = 5;
  }
if ($error != 0) {
   header('Location: ../index.php?r=' . $error);
   exit;
}
$login = $_POST['login'];
$mail = $_POST['mail'];
$val = uniqid();

include '../config/database.php';
$register = $connection->prepare("SELECT * FROM users WHERE login ='" . $login . "';");
$register->execute();
$user = $register->fetchAll(PDO::FETCH_ASSOC);
if (isset($user[0])) {
   $error = 6;
}


else if ($error == 0) {
      include database;
     $register = "INSERT INTO users (login, pass, mail, photo, nblike, validation) VALUES
     ('" . $login . "','" . $pass . "', '" . $mail . "', 'profile.gif', 0, '" . $val . "');";
     $connection->exec($register);
     $message = " Pour valider votre compte sur ce lien : localhost:8080/camagru/model/validation.php?v=" . $val ."&l=" . $login;
     mail($mail, 'Validation - Camagru', $message);
     $error = 12;
}

header('Location: ../index.php?r=' . $error);
exit;

}

function regeneratepwd() {
  $login = $_POST['login'];
  $val = uniqid();
  include database;
  $modify = "UPDATE users SET validation = '" . $val . "'WHERE login = '" . $login . "';";
  $connection->exec($modify);
  $mail = get_mail_user($login);
  $message = " Pour modifiez votre mot de passe sur ce lien : localhost:8080/camagru/modifypass.php?v=" . $val ."&l=" . $login;
  if (isset($mail) && mail($mail, 'Modification mdp - Camagru', $message)) {
  header('Location: ../index.php?r=12'); }
  else {   header('Location: ../index.php?r=13'); }
}

function changepass() {
  $login = $_POST['login'];
  $val = $_POST['val'];
  $pass1 = $_POST['pass1'];
  $pass2 = $_POST['pass2'];
  if (empty($val)) {
      header('Location: ../index.php?l=1');
  }
  if ($pass1 == $pass2) {
    $passwd = hash("whirlpool", $pass1);
    include database;
      $modify = $connection->prepare("UPDATE users SET pass = '" . $passwd . "' WHERE login ='".$login."';");
    $modify->execute();
    include database;
        $req = "UPDATE users SET validation = '' WHERE login = '" . $login . "';";
      $connection->exec($req);
    }
    else {
      header('Location: ../index.php?l=1');
    }
    header('Location: ../index.php?l=5');
}


function login() {
      $login = $_POST['login'];
      $passwd = hash("whirlpool", $_POST['pass']);
      include database;
      $motdepasse = $connection->prepare("SELECT * FROM users WHERE login ='".$login."';");
      $motdepasse->execute();
      $blop = $motdepasse->fetchAll(PDO::FETCH_ASSOC);
      $blop = $blop[0];
      $result = $blop['pass'];
      $photo = $blop['photo'];
      $iduser = $blop['id'];

      if ($passwd == $result && $blop['validation'] == NULL) {
      		$_SESSION['login'] = $login;
      		$_SESSION['id'] = $iduser;
      		$_SESSION['photo'] = $photo;
      		$error = 3;
      	}
      	else {
      		$error = 1;
      	}
      if ($error === 3 && isset($_SESSION['login'])) {
      	header('Location: ../index.php?l=' . $error);
      }
      else {
      header('Location: ../index.php?l=' . $error);
        }
}


?>
