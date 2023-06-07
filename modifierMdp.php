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

    if(isset($_POST['submit'])){
        $pass = $_POST['pass'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];


        $req1 = $bdd->prepare("SELECT pass FROM utilisateurs WHERE id = ".$_SESSION['id']);
        $req1->execute();
        $num1 = $req1->fetch();

        $passverif = password_verify($pass, $num1[0]);
        $pass_hache = password_hash($_POST['pass1'], PASSWORD_DEFAULT);

        if($passverif == true && $pass2 == $pass1){
            $con = ("UPDATE utilisateurs set pass = '$pass_hache' WHERE id = ".$_SESSION['id']);
            $stmt=$bdd->query($con) or die('Erreur SQL !'.$con.'<br />'.mysql_error());
            $_SESSION['message1'] = "Le mot de passe a été changé";
        }
        else {
            $_SESSION['message1'] = "Le mot de passe n'a pas été changé";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier son mot de passe</title>
</head>
<body>    
    <div class="containerAccount">
        <form action="modifierMdp.php" method="POST">
            <h2>Modifier votre mot de passe </h2>

            <label><b>Ancien mot de passe</b></label>
            <input type="password" placeholder="Entrer votre ancien mot de passe" name="pass" id="pass" required>
            <br /><br />

            <label><b>Nouveau mot de passe</b></label>
            <input type="password" placeholder="Entrer votre nouveau mot de passe" name="pass1" id="pass1" required>
            <br /><br />

            <label><b>Confirmartion de votre nouveau mot de passe</b></label>
            <input type="password" placeholder="Confirmez votre nouveau mot de passe" name="pass2" id="pass2" required>
            <br /><br />
            <input type="submit" name="submit" value="Modifier son Mot de passe"/>
            <?php
            if(!empty($_SESSION['message1'])): ?>
                <p><?php echo $_SESSION['message1'];?><?php $_SESSION['message1'] = "";?>
            <?php
            endif;
            ?>
        </form>
    </div>
</body>
</html>
