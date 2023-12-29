<?php
// Démarrer la session PHP
session_start();

// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "easacess_bd";

// Créez une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupérez les données du formulaire
$email = $_POST['email'];
$mot_de_passe = $_POST['password']; // Utiliser le mot de passe en clair pour le test
$profil = $_POST['profil'];

// Requête SQL pour vérifier les informations d'identification
if ($profil == 'formateur') {
    $sql = "SELECT * FROM formateur WHERE Mail=? AND Mot_de_passe=?";
} else {
    $sql = "SELECT * FROM apprenti WHERE Mail=? AND Mot_de_passe=?";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $mot_de_passe);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Enregistrement des données de l'utilisateur dans la session
    $_SESSION['email'] = $email;
    $_SESSION['profil'] = $profil;

    // Redirection vers la page d'accueil du formateur ou de l'apprenti
    if ($profil == 'formateur') {
        header("Location: /EASACESS/vues/accueilFormateur.html");
        exit;
    } else {
        header("Location: /EASACESS/vues/accueilApprenti.html");
        exit;
    }
} else {
    echo "Identifiants incorrects.";
}

$conn->close();
?>
