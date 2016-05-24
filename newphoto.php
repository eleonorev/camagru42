<?php include 'view/header.php';?>


<div class="container active">
  <div id="camera">
  <video id="video" width="400" height="300" autoplay></video>
  <button id="screenshot" class="button"> Prendre photo </button>
  <button id="delescreen" class="button"> Reprendre</button> </br>
  <form action="traitement.php" method="post">
    <div class="input-file-container">
      <input type="hidden" id="photo" name="photo" type="file" value="">
      <input class="input-file" id="my-file" type="file">
      <label tabindex="0" for="my-file" class="input-file-trigger">Select a file...</label>
      <input type="submit" value="enregister">
    </div>
    <p class="file-return"></p>
  </form>
  <div id="upload"> <img src=""/></div>

<div id="img"> <img src=""/></div>
  <canvas id="canvas" width="400" height="300"></canvas>
</div>
<div id="mask">
  <img class="choose1" src="upload/images/milk.png">
    <img class="choose1" src="upload/images/hamburger.png">
 </div>
  <div class="button save" onclick="save()"> Save </div>
  </div>

  <script type="text/javascript" src="assets/js/script.js"> </script>
<img id="preview" src=""/>

<?php include 'view/footer.php'; ?>
