<?php

  if (isset($_GET['profile'])) {
    $user = $_GET['profile'];
  }

  else if (isset($_SESSION['login']))
  {
    $user = $_SESSION['login'];
  }
  else {
    header('Location: ../index.php?e=5');
  }
  ?>

<div id="wall" class="container active">
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
      echo "<div class='post'>";
      $date = new DateTime("now");
      $date2 = $post['timedate'];
      $date2 = date('Y-m-d', strtotime($date2));
      echo "<span class='heure'>" . $date2 . "</span>";
      echo "<span class='texte'>" . $post['content'] . "</span>";
      echo "<img src='". $post['link'] ."'/>";
      //echo "<span class='heure'> report content(" . $post['report'] .") </span>";
      echo "<span class='like'>" . get_nblike($post['id']) . "</span>";
      echo "</div>";
    }

    ?>
</div>
