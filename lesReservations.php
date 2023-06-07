<?php
require('template.php');

try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=destock-tout;charset=utf8', 'root', '');
} catch(Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}

$lesReservationsAdmin = $bdd->query('SELECT * FROM reservation ORDER BY temps DESC');

$checkuser = $bdd->query("SELECT * FROM utilisateurs WHERE id = '".$_SESSION['id']."'");
$row = $checkuser->fetch(PDO::FETCH_ASSOC);

$lesReservationsUser = $bdd->query('SELECT * FROM reservation WHERE pseudo = "'.$row['pseudo'].'" ORDER BY temps DESC');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les réservations</title>
</head>
<body>
    <div class="containerAccount">
        <form action="" method="POST">
            <table>
                <thead>
                    <tr>
                        <th><p>Pseudo</p></th>
                        <th><p>Produit</p></th>
                        <th><p>Quantité</p></th>
                        <th><p>Date</p></th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
            <?php
            if(isset($_SESSION['utilisateur'])){
                if ($_SESSION['utilisateur'] == 'admin') {
                             while($a = $lesReservationsAdmin->fetch()){ ?>
                                <td><?= $a['pseudo'] ?></td>
                                <td><?= $a['produit'] ?></td>
                                <td><?= $a['quantite'] ?></td>
                                <td><?= $a['temps'] ?></td>

                                <tr>
                                    
                                    <?php
                          } 
                        }elseif($_SESSION['utilisateur'] == 'user'){
                            while($a = $lesReservationsUser->fetch()){ ?>
                                <td><?= $a['pseudo'] ?></td>
                                <td><?= $a['produit'] ?></td>
                                <td><?= $a['quantite'] ?></td>
                                <td><?= $a['temps'] ?></td>
                                <tr>
                        <?php
                            }
                        }       
            }
                        ?>
                    </tr>
                </tbody>
            </table>

            
            
    </div>
</body>
</html>