<?php include 'view/header.php';?>


<div class="container active">
  <div id="camera">
  <video id="video" width="400" height="300" autoplay></video>
  <button id="screenshot" class="button"> Prendre photo </button>
  <button id="delescreen" class="button"> Reprendre</button>
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
