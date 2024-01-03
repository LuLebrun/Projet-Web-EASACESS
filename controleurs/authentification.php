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
} elseif ($profil == 'apprenti') {
    $sql = "SELECT * FROM apprenti WHERE Mail=? AND Mot_de_passe=?";
}

$requete = $conn->prepare($sql);
$requete->bind_param("ss", $email, $mot_de_passe);
$requete->execute();
$result = $requete->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Récupère les données de l'utilisateur
    // Enregistrement des données de l'utilisateur dans la session
    $_SESSION['email'] = $user['Mail'];
    $_SESSION['profil'] = $profil;
    $_SESSION['nom'] = $user['Nom']; // Stockez le nom de l'utilisateur dans la session
    $_SESSION['prenom'] = $user['Prenom']; // Stockez le prénom de l'utilisateur dans la session

    // Redirection vers la page d'accueil du formateur ou de l'apprenti
    if ($profil == 'formateur') {
        header("Location: /EASACESS/vues/accueilFormateur.php"); // Assurez-vous que ce soit .php
        exit;
    } elseif ($profil == 'apprenti') {
        header("Location: /EASACESS/vues/accueilApprenti.php"); // Assurez-vous que ce soit .php
        exit;
    }
} else {
    echo "Identifiants incorrects.";
}

$conn->close();
?>
