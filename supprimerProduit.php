<?php
require('template.php');

try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=destock-tout;charset=utf8', 'root', '');
} catch(Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}

if (isset($_GET['id'])) {
        
    // lancement de la requête
$sql = $bdd->prepare('DELETE FROM `produit`  WHERE id = :id');
$sql->bindParam('id', $_GET['id']);
$sql->execute();

header('location: nouveauProduit.php');
}else {

    echo'Erreur';

}


?>
