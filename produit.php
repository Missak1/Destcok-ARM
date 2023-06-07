<?php
require('template.php');

try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=destock-tout;charset=utf8', 'root', '');
} catch(Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}

if(isset($_GET['id']) AND !empty($_GET['id'])){
    $get_id = htmlspecialchars($_GET['id']);

    $req = $bdd->prepare('SELECT * FROM produit WHERE id = ?');
    $req->execute(array($get_id));

    if($req->rowCount() == 1) {
        $req = $req->fetch();
        $titre = $req['titre'];
        $prix = $req['prix'];
        $descrip = $req['descrip'];
    }else{
        echo'Cette article ,\'existe pas';
    }
}else{
    echo'Erreur';
}
 
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
            <h1><?= $titre ?></h1>
            <h2>Prix unitaire : <?= $prix ?> €</h2>
            <p><?= $descrip ?></p>
            </br></br>
            <form action="reserver.php" method="post">
            <?php 
            echo'
            <input type="hidden" class="form-control" value ="'.$titre.'" name="produit" ></input> 
            <input type="hidden" class="form-control" value="'.$prix.'" name="prixuni" ></input>
            ';
            ?>
            <?php
            if(!empty($_SESSION['utilisateur'])){
                if ($_SESSION['utilisateur'] == 'user') { ?>
                <input type="number" class="form-control" name="Quentité" ></input>
                <button type="submit" class="btn btn-primary mr-2">Valider</button>
                <?php
            }elseif($_SESSION['utilisateur'] == 'admin') { ?>
                    <div><a class="button" href="modifierProduit.php?id=<?= $get_id?>">Modifier</a> </div>
                    <div><a class="button" href="supprimerProduit.php?id=<?= $get_id?>">Supprimer</a> </div>
                    <?php
            }else{

            }

            }
            ?>
            </form>
            <div><a class="button" href="nouveauProduit.php"><strong>Retour</strong></a> </div>
    </div>
</body>
</html>