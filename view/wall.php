
<div class="container active">

<div id="wall">
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    else {$page = 1;}

    $posts = get_toppost($page);
    for($i = 2; $i >= 0; $i--) {
      $login = get_login($posts[$i]['iduser']);
      echo "<div class='post' id=" . $posts[$i]['id'] . ">";
      $date2 = $posts[$i]['timedate'];
      $date2 = date('Y-m-d', strtotime($date2));
      echo "<span class='heure'>" . $date2 . "</span>";
      echo "<span class='texte'>" . $posts[$i]['content'] . "</span>";
      echo "<img src='". $posts[$i]['link'] ."'/>";
      echo "<img class='pp' src='upload/profilpictures/" . get_pp($login) . "'/>";
      echo "<span class='login'>" . $login . "</span>";

      //echo "<span class='heure'> report content(" . $posts[$i]['report'] .") </span>";
      echo "<span class='like'>" . get_nblike($posts[$i]['id']) . " likes - <span class='opencomments'>";
      echo get_nb_comments($posts[$i]['id']) . " comments </span></span>";
      $comments = get_comments($posts[$i]['id']);
      echo "<div class='comments active'>";
        foreach ($comments as $com) {
          $date = $com['timedate'];
          $date = date('d/m/Y', strtotime($date));
          echo "<div class='com'>";
          $user = get_login($com['idusercible']);
          echo "<div class='userinfos'><img class='pp' src='upload/profilpictures/" . get_pp($user) . "'/>";
          echo "<span class='login'> Par " . $user . " le " . $date ."</span> </div>";
          echo "<div class='texte'>" . $com['content'] . "</div>";
          echo "</div>";

        }
        if (isset($_SESSION['login'])) {
        ?>
          <form action="model/comments.php" name="commenter" method="post">
            <input type="hidden" name="idpost" value="<?php echo $posts[$i]['id'];?>"/>
            <input type="hidden" name="iduser" value="<?php echo $posts[$i]['iduser'];?>"/>
            <textarea name="content" placeholder="Reply..."></textarea>
            <button type="submit" class="button" value="Submit" name="commenter"> Submit </button>
          </form>
           <?php   $likers = getlikers_str2($posts[$i]['id']);
             if (!(strstr($likers, $_SESSION['login']))) {
          echo "<a href='model/posts.php?like=". $posts[$i]['id'] . "'><div class='button like'> Like ? </div></a>";
        }
        else {
          echo "<a href='model/posts.php?dlike=". $posts[$i]['id'] . "'><div class='button like'> Vous aimez ça ! </div></a>";
        }
      }
      else {
        echo "<p style='text-align:center;color:rgba(0,0,0,0.2);font-style:italic;font-size:0.8em;'> Connectez-vous pour commenter ou liker. </p>";
      }
      echo "</div></div>";
    }

    $prec = $page - 1;
    $suiv = $page + 1;
    $maxpage = nb_post() / 3;
    echo "<span style='text-align: center; margin-bottom: 30px; width: 100%; height: 50px; display: block;'> ";
    if ($prec > 0) {
    echo "<a href='index.php?page=" . $prec . "'> Precedent </a>"; }
    echo "<span style='color: white;'> Page " . $page . "</span>";
    if ($suiv < $maxpage) {
    echo "<a href='index.php?page=" . $suiv . "'> Suivant </a>"; }
    echo "</span>";
    ?>
  </br>

</div>



</div>
