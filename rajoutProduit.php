<?php require('template.php'); ?>
<?php 
	

	if(isset($_POST['titre'])){
		// Vérification de la validité des informations
		$titre = $_POST['titre'];
		$descrip = $_POST['descrip'];
		$prix = $_POST['prix'];

		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=destock-tout;charset=utf8', 'root', '');
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
			
		// Insertion
		$req = $bdd->prepare('INSERT INTO produit(titre, descrip, prix) 
							VALUES(:titre, :descrip, :prix)');
		
		$result = $req->execute(
			array(
				'titre' => $titre,
				'descrip' => $descrip,
				'prix' => $prix
			)
		);

		if($result)
		{
			echo "Produit ajouté";
			
		}
		else
		{
			echo "Aucun produit n'a été ajouté";
		}
		
		header('Location: nouveauProduit.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Produit</title>
</head>
<body>
<div class="containerAccount">
    <form action="rajoutProduit.php" method="POST">
        <h2>Nouveau produit </h2>

        <label><b>Titre</b></label>
        <input type="text"  name="titre">
        <br /><br />

        <label><b>Description du produit</b></label>
        <textarea name="descrip"></textarea>
        <br /><br />

		<label><b>Prix du produit</b></label>
        <input type="number" name="prix">
        <br /><br />

        <input type="submit" value='Ajouter' name="btn-ajouter">
    </form>
</div>
</body>
</html>