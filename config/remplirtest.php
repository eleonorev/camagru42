<?php
include 'database.php';
$pw = hash("whirlpool", "blopblop");
$compte = "INSERT INTO users (login, pass, mail, photo) VALUES ('evoisin', '". $pw ."', 'eleonore.v@hotmail.fr', 'profile.gif');";
$connection->exec($compte);

$post = "INSERT INTO post (link, content, tags, timedate, iduser, likers, report) VALUES ('http://www.reactiongifs.com/r/pat1.gif', 'blablablablabalbalbaaa blbalablaaaaa', 'food,repas,manger', NOW(), 1, 'lui,tonpere,darkvador', 0);";
$connection->exec($post);

$post = "INSERT INTO post (link, content, tags, timedate, iduser, likers, report) VALUES ('https://media.giphy.com/media/ueRbr6r0Lev5e/giphy.gif', 'blablablablbalbaaa blbalablaaaaa', 'shock,marionnette,omg', NOW(), 1, 0, 0);";
$connection->exec($post);

$post = "INSERT INTO post (link, content, tags, timedate, iduser, likers, report) VALUES ('https://media.giphy.com/media/Kasr3rTYnUo92/giphy.gif', 'blabla blbalablaaaaa', 'happy,enjoy', NOW(), 1,'caca,lol,xd', 0);";
$connection->exec($post);

$comments = "INSERT INTO comments (idpost, idusercible, content, timedate) VALUES (2, 1, 'Coucou, t moche lol', NOW());";
$connection->exec($comments);

$comments = "INSERT INTO comments (idpost, idusercible, content, timedate) VALUES (1, 2, 'Salut lol', NOW());";
$connection->exec($comments);


$comments = "INSERT INTO comments (idpost, idusercible, content, timedate) VALUES (2, 1, 'Une pomme. #keurkeurkeur', NOW());";
$connection->exec($comments);


$comments = "INSERT INTO comments (idpost, idusercible, content, timedate) VALUES (3, 2, 'Coucou, t vrement moche lol', NOW());";
$connection->exec($comments);



 ?>
