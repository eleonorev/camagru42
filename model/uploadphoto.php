<?php
session_start();
$dossier = 'upload/';
$fichier = basename($_FILES['avatar']['name']);
$taille_maxi = 100000;
$taille = filesize($_FILES['avatar']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['avatar']['name'], '.');
if(!in_array($extension, $extensions))
{
  header('Location: profile.php?e=6');
  exit;
}
if($taille>$taille_maxi)
{
    header('Location: profile.php?e=7');
    exit;
}
$fichier = strtr($fichier,
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
if($fichier)
{
     $dossier = 'upload/';
     $fichier = basename($_FILES['avatar']['name']);
     $namefile = uniqid() . $extension;
     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $namefile))
     {
       header('Location: profile.php?e=5');
       include 'config/database.php';
       $req = mysqli_prepare($connection, 'UPDATE users SET photo = ? WHERE login = ?');
       mysqli_stmt_bind_param($req, "ss", $namefile, $_SESSION['login']);
       mysqli_stmt_execute($req);
       exit;
     }
     else
     {
       header('Location: profile.php?e=6');
       exit;
     }
}
?>
