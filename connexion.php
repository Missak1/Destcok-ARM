<?php require('template.php'); ?>

<?php 

	if(isset($_POST['pseudo'])){
		// Récupération des données depuis le formulaire
		$pseudo = $_POST['pseudo'];
		$password = $_POST['pass'];


		// Vérifier que l'utilisateur demandé existe en BDD et récupérer cet utilisateur
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=destock-tout;charset=utf8', 'root', '');
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}

		$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = :pseudo');
		$req->execute(
			array(
				'pseudo' => $pseudo
			)
		);

		$utilisateur = $req->fetch();
		if(empty($utilisateur))
		{
			echo "Aucun utilisateur trouvé...";
		}
		else
		{
			//echo "L'utilisateur trouvé est le numéro " . $utilisateur['S_id'] . "<br />";
			//echo "Le mot de passe essayé est : " . $password . "<br />";
			//echo "Le hash en bdd est : " . $utilisateur['pass'] . "<br />";

			// Les mots de passe correspondent-ils ?
			if(!password_verify($password, $utilisateur['pass']))
			{
				echo "Les mots de passe ne correspondent pas...";
			}
			else
			{
			$req = $bdd->prepare('SELECT id FROM utilisateurs WHERE pseudo = "'.$pseudo.'"');
			$req->execute();
			$req = $req->fetch();
			$_SESSION['id'] = $req['id'];


            // vérifier si l'utilisateur est un administrateur ou un utilisateur
            if ($utilisateur['type'] == 'admin') {
                $_SESSION['utilisateur'] = 'admin';
                header('location: index.php');
            }else{
                $_SESSION['utilisateur'] = 'user';
                header('location: index.php');
            }
                
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
<div class="containerAccount">
    <form action="connexion.php" method="POST">
        <h2>Espace</h2>

        <label><b>Identifiant</b></label>
        <input type="text" placeholder="Entrer votre identifiant" name="pseudo" required>
        <br /><br />

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="pass" required>
        <br /><br />
        <input type="submit" id='submit' value='LOGIN'>
		<a href="inscription.php"><input type="button"  value='Pas de compte? Inscrivez-vous'></a>
    </form>
</div>
</body>
</html>
