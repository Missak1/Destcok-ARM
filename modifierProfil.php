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

// on teste si les variables du formulaire sont déclarées
if (isset($_POST['pseudo']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email'])) {
        
                            // lancement de la requête
        $sql = $bdd->prepare('UPDATE utilisateurs SET pseudo="'.$_POST['pseudo'].'",
                                nom="'.$_POST['nom'].'",
                                prenom="'.$_POST['prenom'].'",
                                email="'.$_POST['email'].'"
                                WHERE id = "'.$_SESSION['id'].'"') ;
        $sql->execute();

        header('location: profil.php');   
    }
    else {
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Profil</title>
</head>
<body>
        <div class="containerAccount">
            <form action="modifierProfil.php" method="POST">
                <h2>Modification de votre profil</h2>
                <div>
                        <label for="pseudo">Pseudo:</label>
                        <input type="text"  id="pseudo" placeholder="Entrez votre nouveau pseudo" name="pseudo"/>
                    </div> 
                    <br />
                    <div>
                        <label for="nom">Nom:</label>
                        <input type="text"  id="nom" placeholder="Entrez votre nouveau nom" name="nom"/>
                    </div>
                    <br />
                    <div>
                        <label for="prenom">Prénom:</label>
                        <input type="text"  id="prenom" placeholder="Entrez votre nouveau prénom" name="prenom"/>
                    </div>
                    <br />
                    <div>
                        <label for="nom">Mot de passe:</label>
                        <a href="modifierMdp.php"><input type="button" id='submitMdp' value='Modifier son mot de passe'></a>
                    </div>
                    <br />
                    <div>
                        <label for="email">Email:</label>
                        <input type="email"  id="email" placeholder="Entrez votre nouveau mail" name="email"/>
                    </div>
                    <br />
                    <input type="submit" id='submit' value='Modifier'>
                    <br />
                    <?php
                    if (isset($_POST['prenom'])) {
                        echo 'Les nouvelles modifications ont été enregistré';
                    }
                    ?>
            </form>
        </div>
</body>
</html>

