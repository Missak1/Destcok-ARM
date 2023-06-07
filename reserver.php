<?php require('template.php');

try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=destock-tout;charset=utf8', 'root', '');
} catch(Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}

$titre = $_POST['produit'];
$qte = $_POST['Quentité'];

// Récupérer l'heure actuelle
$date = new DateTime('now', new DateTimeZone('Europe/Paris'));

// Ajouter 7 jours
$date->add(new DateInterval('P7D'));

// Formater la date au format MySQL
$date_resa = $date->format('Y-m-d H:i:s');

$requete = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = :id');
$requete->bindParam(':id', $_SESSION['id']);
$requete->execute();
$reponse = $requete->fetch(PDO::FETCH_ASSOC);

$pseudo = $reponse['pseudo'];

$stmt = $bdd->prepare("INSERT INTO reservation (produit, pseudo, temps, quantite) VALUES (:produit, :pseudo, :temps, :quantite)");
$stmt->bindParam(':produit', $titre);
$stmt->bindParam(':pseudo', $pseudo);
$stmt->bindParam(':temps', $date_resa);
$stmt->bindParam(':quantite', $qte);
$stmt->execute();