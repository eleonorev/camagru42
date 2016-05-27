<?php
session_start();
if (!(defined('database'))) {
  define("database", 'config/database.php');
}
  if (isset($_POST['photo']) && isset($_POST['maskdata'])) {

if (empty($_POST['maskdata'])) {
  header('Location: newphoto.php');
}

$image = imagecreatetruecolor(400,300);
imagecolortransparent($image, imagecolorallocate($image, 0, 0, 0));
imagealphablending($image, false);
imagesavealpha($image, true);
$src = imagecreatefrompng($_POST['maskdata']) or die ('failed imageCreateFromPng');

imagecopy($image, $src, 0, 0, 0, 0, 400, 300);



$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['photo']));
$filepath = "upload/images/tmp.png";
file_put_contents($filepath,$data);
$img = imagecreatefrompng($filepath) or die ('failed imageCreateFromPng');
imagecopyresampled($img, $image, 0, 0, 0, 0, 400, 300, 400, 300);
$filepath = "upload/images/" . uniqid() . ".png";
imagepng($img, $filepath);

include database;
$req = $connection->prepare("INSERT INTO post (link, timedate, iduser) VALUES ('" . $filepath ."', NOW(),". $_SESSION['id'] . ");");
$req->execute();
header('Location: newphoto.php');
}

?>
