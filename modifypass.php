<?php
include('view/header.php');


if (isset($_GET['v']) && isset($_GET['l']))
{
    $val = $_GET['v'];
    $login = $_GET['l'];
    include database;
      $motdepasse = $connection->prepare("SELECT * FROM users WHERE login ='".$login."';");
      $motdepasse->execute();
      $blop = $motdepasse->fetchAll(PDO::FETCH_ASSOC);
      $blop = $blop[0];
      $result = $blop['validation'];
}

else {
  $val = 'non';
  $result = 'lol';
}

?>

<div class="container active">
  <?php
  if (strcmp($result, $val) != 0) {
      echo "<span class='alert error'>Me prend pas pour un con </span>";
      exit();
  }
   ?>
<form action="model/users.php" method="post">
    <input type="hidden" id="login" name="login" value="<?php echo $login; ?>" class="input">
    <input type="hidden" id="login" name="val" value="<?php echo $val; ?>" class="input">

  <div class="group">
    <label for="pass" class="label">Choose a new password</label>
    <input id="pass" name="pass1" type="password" class="input" data-type="password">
  </div>
  <div class="group">
    <label for="pass" class="label">Retape your new password</label>
    <input id="pass" name="pass2" type="password" class="input" data-type="password">
  </div>
  <div class="group">
    <input name="changepass" type="submit" class="button" value="Modifier">
  </div>
</form>
</div>

<?php
include('view/footer.php');
?>
