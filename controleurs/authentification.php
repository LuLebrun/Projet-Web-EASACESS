<?php
session_start(); // Démarrage de la session

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profil = $_POST['profil']; // Peut être 'formateur' ou 'apprenti'

    // ... (le reste du code pour traiter la connexion) ...
}
?>
