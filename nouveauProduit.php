<?php
require('template.php');
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=destock-tout;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$nouveauProduit = $bdd->query('SELECT * FROM produit ORDER BY id ASC');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveauté</title>
</head>
<body>
    <div class="containerAccount">
        <form action="" method="POST">
        <?php
            while($a = $nouveauProduit->fetch()){ ?>
        <li><a href="produit.php?id=<?= $a['id']?>"><?= $a['titre'] ?></li>
            <?php } ?>
        </form>
    </div>
</body>
</html>