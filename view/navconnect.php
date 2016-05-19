<div id="profile">
  <div class="imgprofile">
    <img src="upload/profilpictures/<?php echo $_SESSION['photo']; ?>"/>
  </div>

    <h3> @<?php echo $_SESSION['login'] ?> </h3>
    <div id="stat">
      <div class="block"> <span class="number"><?php echo get_nb_post($_SESSION['login']); ?></span><span class="text">Posts</span></div>
      <div class="block"> <span class="number"><?php echo getlike_user($_SESSION['login']); ?></span><span class="text">Likes</span></div>
    </div>
    <a class="button" href="profile.php">My profile</a>
    <a class="button" href="newphoto.php">New photo</a>
    <a class="button logout" href="model/users.php?e=12">Log out</a>
</div>
