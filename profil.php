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
    if(isset($_SESSION['utilisateur'])){
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = "'.$_SESSION['id'].'"');
	$req->execute();
	$req = $req->fetch();

?>
<?php $title = "Mon profil"; ?>


    <div class="containerAccount">
        <form action="profil.php" method="POST">
            <h1>Voici le profil de <?php echo $req['pseudo']; ?></h1>
            <br />

            <div>Quelques informations sur vous : </div>
            <br />
            <ul>
                <li>Votre nom  : <?php echo $req['nom']; ?></li>
                <br />
                <li>Votre prenom  : <?php echo $req['prenom']; ?></li>
                <br />
                <li>Votre mail : <?php echo $req['email']; ?></li>
                <br />

                <div><a class="button" href="modifierProfil.php"><strong>Modifier son profil</strong></a> </div>
            </ul>

        <?php   
            }
            else{
                echo "Pas d'utilisateurs trouvé";
            }
        ?>
        </form>
    </div>
</body>
</html>

