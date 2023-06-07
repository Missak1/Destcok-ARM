<?php 
    require('template.php');

	try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=destock-tout;charset=utf8', 'root', '');
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}


	if (isset($_REQUEST['pseudo'], $_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['email'], $_REQUEST['pass'])){
        // récupérer le pseudo
        $pseudo = stripslashes($_REQUEST['pseudo']);
        // récupérer le nom
        $nom = stripslashes($_REQUEST['nom']);
        // récupérer le prenom
        $prenom = stripslashes($_REQUEST['prenom']);
        // récupérer l'email 
        $email = stripslashes($_REQUEST['email']);
        // récupérer le mot de passe 
        $pass = stripslashes($_REQUEST['pass']);
         // Hachage du mot de passe
        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    
        $user = 'user';
        $req = $bdd->prepare('INSERT INTO utilisateurs(pseudo, nom, prenom, email, pass, type) 
							VALUES(:pseudo, :nom, :prenom, :email, :pass , :user)');
        $result = $req->execute(
			array(
				'pseudo' => $pseudo,
				'nom' => $nom,
				'prenom' => $prenom,
				'email' => $email,
				'pass' => $pass_hache,
                'user' => $user
			)
		);
    if($result){
       echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
       </div>";
    }
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="container">
<form class="box" action="inscription.php" method="post">
    <h1 class="box-title">S'inscrire</h1>
    
  <input type="text" class="box-input" name="pseudo" 
  placeholder="Entrez votre pseudo" required />
  
  <input type="text" class="box-input" name="nom" 
  placeholder="Entrez votre Nom d'utilisateur" required />

  <input type="text" class="box-input" name="prenom" 
  placeholder="Entrez votre prenom" required />

    <input type="text" class="box-input" name="email" 
  placeholder="Entrez votre email" required />
  
    <input type="password" class="box-input" name="pass" 
  placeholder="Entrez votre Mot de passe" required />
  
    <input type="submit" name="submit" 
  value="S'inscrire" class="box-button" />
  
    <p class="box-register">Déjà inscrit? 
  <a href="connexion.php">Connectez-vous ici</a></p>
</form>
<?php } ?>
</body>
</html>