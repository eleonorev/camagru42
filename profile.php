<?php
include 'view/header.php';

 if (!(isset($_SESSION['login'])))
{
  header('Location: ../index.php?e=5');
}


  $user = $_SESSION['login'];
  ?>

<div id="wall" class="container active">
<?php
  if (isset($_GET['r'])) {
    switch($_GET['r']) {
      case 1 : echo "<span class='alert success'> Post supprimé ! </span>"; break;
      case 2 : echo "<span class='alert error'> Erreur, c'est pas le tien.  </span>";  break;
    }
  } ?>
  <div id="userprofile">
  <div class="profil">
    <div class="pp">
      <img src="upload/profilpictures/<?php echo get_pp($user); ?> "/>
    </div>
      <h2> <?php echo $user; ?></h2>
    </div>
  </div>

    <?php
      $posts = get_userpost($user);
      foreach ($posts as $post) {
      $login = get_login($post['iduser']);
      echo "<div class='post user'>";
      $date = new DateTime("now");
      $date2 = $post['timedate'];
      $date2 = date('Y-m-d', strtotime($date2));
      echo "<a href='post.php?p=" . $post['id'] . "'> <img src='". $post['link'] ."'/></a>";
      //echo "<span class='heure'> report content(" . $post['report'] .") </span>";
      echo "<span class='delete'><a href='model/posts.php?supp=". $post['id'] ."'> Supp </a> </span>";
      echo "<span class='like'>" . get_nblike($post['id']) . " Likes </span>";
      echo "<span class='like'>" .get_nb_comments($post['id']) . " comments </span></span>";

      echo "</div>";
    }

    ?>
</div>

<?php include 'view/footer.php';?>
