<?php
session_start();
require_once 'connexionBDDD.php'; // Assurez-vous que le chemin d'accès est correct.

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $promotion = $_POST['promotion'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe']; // À hasher avant de stocker
}
    // Hasher le mot de passe avant de l'insérer pour des raisons de sécurité
$mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Préparer la requête SQL pour insérer l'apprenti
$sql = "INSERT INTO apprenti (Nom, Prenom, Promotion, Mail, Mot_de_passe) VALUES (?, ?, ?, ?, ?)";

// Utiliser une déclaration préparée pour éviter les injections SQL
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erreur lors de la préparation de la requête : " . $conn->error);
}

// Lier les paramètres

$stmt->bind_param("ssiss", $nom, $prenom, $promotion, $email, $mot_de_passe_hash);

// Exécuter la requête
if ($stmt->execute()) {
    // Rediriger vers la page de gestion des apprentis avec un message de succès
    $_SESSION['message'] = "Apprenti ajouté avec succès.";
    header("Location: /EASACESS/vues/interfaceGestionDesApprentis.php");
exit();
} else {
// En cas d'erreur, enregistrer le message d'erreur dans la session
$_SESSION['error'] = "Erreur lors de l'ajout de l'apprenti: " . $stmt->error;
header("Location: /EASACESS/vues/interfaceGestionDesApprentis.php");
exit();
}

// Fermer la déclaration préparée et la connexion à la base de données
$stmt->close();
$conn->close();
?>
