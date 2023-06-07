<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <section class="header-section">
            <div class="container">
                <header class="navbar">
                    <div class="logo">
                    <h3>DESTOCK ARM</h3>
                        <!-- <img src="images/logo.png" alt="destockTout"> -->
                    </div>
                    <nav>
                        <ul id='menu'>
                            <?php
                            if(isset($_SESSION['utilisateur'])){
                                if ($_SESSION['utilisateur'] == 'admin') {
                                    echo'
                                    <li><a href="index.php">Accueil</a></li>
                                    <li><a href="nouveauProduit.php">Promotion de la semaine</a></li>
                                    <li><a class="button" href="rajoutProduit.php"><strong>Nouveau produit</strong></a></li>
                                    <li><a class="button" href="lesReservations.php"><strong>Réservations</strong></a></li>
                                    <li><a class="button" href="profil.php"><strong>Profil</strong></a></li>
                                    <li><a class="button" href="deconnexion.php"><strong>Déconnexion</strong></a></li>
                                    ';
    
                                }elseif($_SESSION['utilisateur'] == 'user'){
                                    echo'
                                    <li><a href="index.php">Accueil</a></li>
                                    <li><a href="nouveauProduit.php">Promotion de la semaine</a></li>
                                    <li><a class="button" href="lesReservations.php"><strong> Mes réservations</strong></a></li>
                                    <li><a class="button" href="profil.php"><strong>Profil</strong></a></li>
                                    <li><a class="button" href="deconnexion.php"><strong>Déconnexion</strong></a></li>
                                    ';
                                }
                            }else{
                                echo'
                                <li><a href="index.php">Accueil</a></li>
                                <li><a href="nouveauProduit.php">Promotion de la semaine</a></li>
                                <li><a href="connexion.php">Compte</a></li>
                                '; 
                            }
                            
                            ?>
                            
                        </ul>
                    </nav>
                </header>
    </section>
</body>