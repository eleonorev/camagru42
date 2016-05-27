<?php  if (isset($_GET['r'])) {
		switch($_GET['r']) {
			case 2 : echo "<span class='alert error'> Me prend pas pour un con </span>"; break;
			case 3 : echo "<span class='alert success'> Message posté ! </span>";  break;
		}
  } ?>

<div id="profile">

  <div class="imgprofile">
    <img src="upload/profilpictures/<?php echo $_SESSION['photo']; ?>"/>
  </div>

    <h3> @<?php echo $_SESSION['login'] ?> </h3>
    <div id="stat">
      <div class="block"> <span class="number"><?php echo get_nb_post($_SESSION['login']); ?></span><span class="text">Post</span></div>
      <div class="block"> <span class="number"><?php echo get_user_nb_comments($_SESSION['id']); ?></span><span class="text">Reaction</span></div>
    </div>
    <a class="button" href="index.php">Galerie</a>
    <a class="button" href="profile.php">My profile</a>
    <a class="button" href="newphoto.php">New photo</a>
    <a class="button logout" href="model/users.php?e=12">Log out</a>
</div>
