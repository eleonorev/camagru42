<?php include 'view/header.php';?>

<div id="app">
<div class="container active">
  <div id="camera">
  <video id="video" width="400" height="300" autoplay></video>
  <canvas id="canvas" width="400" height="300"> </canvas>
  <canvas id="img" width="400" height="300"> <img src=""/></canvas>

  <div id="mask">

    <img class="choose1" src="upload/images/milk.png">
      <img class="choose1" src="upload/images/hamburger.png">
      <img class="choose1" src="upload/images/summerbreak.png">
      <img class="choose1" src="upload/images/particule.png">
      <img class="choose1" src="upload/images/minion.png">

   </div>
   <button id="screenshot" class="button disable"> Prendre photo </button>
  <button id="delescreen" class="button disable"> Reprendre</button> </br>

  <form action="traitement.php" method="post">
    <div class="input-file-container">
      <input type="hidden" id="photo" name="photo" value="">
      <input type="hidden" id="maskdata" name="maskdata" value="">
      <input class="input-file" id="my-file" type="file">

      <label tabindex="0" for="my-file" class="input-file-trigger">Choose photo...</label>
      <input type="submit" id="saveimg" class="button disable" value="Enregister">
    </div>
    <p class="file-return"></p>
  </form>
  <div id="upload"> <img src=""/></div>



</div>


  <script type="text/javascript" src="assets/js/script.js"> </script>

<div id="preview_gallery">
<?php
$user = $_SESSION['login'];
  $posts = get_userpost($user);
  foreach ($posts as $post) {
  $login = get_login($post['iduser']);
  echo "<div class='post user'>";
  echo "<a href='post.php?p=" . $post['id'] . "'> <img src='". $post['link'] ."'/></a>";
  //echo "<span class='heure'> report content(" . $post['report'] .") </span>";
  echo "<span class='delete'><a href='model/posts.php?supp=". $post['id'] ."'> X </a> </span>";

  echo "</div>";
}

?>
</div>

</div>
</div>

<?php include 'view/footer.php'; ?>
