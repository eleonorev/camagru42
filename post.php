<?php
include 'view/header.php';

if (!(isset($_GET['p'])))
{
  header('Location: ../index.php?e=5');
}
?>
<div class="container active">

<div id="wall">
<?php
$post = get_post($_GET['p']);
$login = get_login($post['iduser']);
echo "<div class='post' id=" . $post['id'] . ">";
$date2 = $post['timedate'];
$date2 = date('Y-m-d', strtotime($date2));
echo "<span class='heure'>" . $date2 . "</span>";
echo "<span class='texte'>" . $post['content'] . "</span>";
echo "<img src='". $post['link'] ."'/>";
echo "<img class='pp' src='upload/profilpictures/" . get_pp($login) . "'/>";
echo "<a href='profile?login=" . $login . "'><span class='login'>" . $login . "</span></a>";

//echo "<span class='heure'> report content(" . $post['report'] .") </span>";
echo "<span class='like'>" . get_nblike($post['id']) . " likes - <span class='opencomments'>";
echo get_nb_comments($post['id']) . " comments </span></span>";
$comments = get_comments($post['id']);
echo "<div class='comments active'>";
  foreach ($comments as $com) {
    $date = $com['timedate'];
    $date = date('d/m/Y', strtotime($date));
    echo "<div class='com'>";
    $user = get_login($com['idusercible']);
    echo "<div class='userinfos'><img class='pp' src='upload/profilpictures/" . get_pp($user) . "'/>";
    echo "<a href='profile?login=" . $login . "'><span class='login'> Par " . $user . " le " . $date ."</span></a> </div>";
    echo "<div class='texte'>" . $com['content'] . "</div>";
    echo "</div>";

  }
  if (isset($_SESSION['login'])) {
  ?>
    <form action="model/comments.php" name="commenter" method="post">
      <input type="hidden" name="idpost" value="<?php echo $post['id'];?>"/>
      <input type="hidden" name="iduser" value="<?php echo $post['iduser'];?>"/>
      <textarea name="content" placeholder="Reply..."></textarea>
      <button type="submit" class="button" value="Submit" name="commenter"> Submit </button>
    </form>
     <?php   $likers = getlikers_str2($post['id']);
       if (!(strstr($likers, $_SESSION['login']))) {
    echo "<a href='model/posts.php?like=". $post['id'] . "'><div class='button like'> Like ? </div></a>";
  }
  else {
    echo "<a href='model/posts.php?dlike=". $post['id'] . "'><div class='button like'> Vous aimez ça ! </div></a>";
  }
}
else {
  echo "<p style='text-align:center;color:rgba(0,0,0,0.2);font-style:italic;font-size:0.8em;'> Connectez-vous pour commenter ou liker. </p>";
}
echo "</div>";

include 'view/footer.php';?>
