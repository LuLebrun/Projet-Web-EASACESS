<?php
session_start();
require_once 'connexionBDD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $promotion = $_POST['promotion'];
    $email = $_POST['email'];

    // Préparez une requête d'insertion
    $stmt = $conn->prepare("INSERT INTO apprenti (Nom, Prenom, Promotion, Mail) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $nom, $prenom, $promotion, $email);

    // Exécutez la requête
    if ($stmt->execute()) {
        echo "Apprenti ajouté avec succès";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
header('Location: /EASACESS/vues/interfaceGestionDesApprentis.php'); // Redirection vers la liste des apprentis
?>
