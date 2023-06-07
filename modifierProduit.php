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

// on teste si les variables du formulaire sont déclarées
if (isset($_POST['titre']) && isset($_POST['descrip']) && isset($_POST['prix'])) {
        
    // lancement de la requête
$sql = $bdd->prepare('UPDATE `produit` SET 
        `titre`="'.$_POST['titre'].'",
        `descrip`="'.$_POST['descrip'].'",
        `prix`="'.$_POST['prix'].'"
        WHERE id =  :id ') ;
$sql->bindParam('id', $_GET['id']);
$sql->execute();
header('location: nouveauProduit.php');
}else {


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le produit</title>
</head>
<body>
        <div class="containerAccount">
            <form action="modifierProduit.php?id=<?php echo $_GET['id'] ?>" method="POST">
      
                <h2>Modification le produit</h2>
                <div>
                        <label for="titre">Titre</label>
                        <input type="text"  id="titre" placeholder="Entrez votre nouveau titre" name="titre" value = <?php  echo "'$titre'" ?>/>
                    </div> 
                    <br />
                    <div>
                        <label for="descrip">Description</label>
                        <input type="text"  id="descrip" placeholder="Entrez votre nouvelle description" name="descrip" value = <?php  echo "'$descrip'" ?>/>
                    </div>
                    <br />
                    <div>
                        <label for="prix">Prix:</label>
                        <input type="text"  id="prix" placeholder="Entrez votre nouveau prix" name="prix" value = <?php  echo "'$prix'" ?>/>
                    </div>
                    <br />
                    <input type="submit" id='submit' value='Modifier'>
                    <?php
                    if (isset($_POST['titre'])) {
                        echo 'Les nouvelles modifications ont été enregistré';
                    }
                    ?>
            </form>
        </div>
</body>
</html>

