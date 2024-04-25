<?php 
session_start();

include 'connexionBDDD.php';

// Récupération des données du formulaire
$email = $_POST['email'];
$mot_de_passe = $_POST['password']; // Le mot de passe saisi par l'utilisateur
$profil = $_POST['profil'];

// Requête SQL pour récupérer le mot de passe haché de l'utilisateur
if ($profil == 'formateur') {
    $sql = "SELECT * FROM formateur WHERE Mail=?";
} elseif ($profil == 'apprenti') {
    $sql = "SELECT * FROM apprenti WHERE Mail=?";
}

$requete = $conn->prepare($sql);
$requete->bind_param("s", $email);
$requete->execute();
$result = $requete->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Récupère les données de l'utilisateur

    // Vérification que le mot de passe saisi correspond au mot de passe haché stocké
    if (password_verify($mot_de_passe, $user['Mot_de_passe'])) {
        // Enregistrement des données de l'utilisateur dans la session
        $_SESSION['email'] = $user['Mail'];
        $_SESSION['profil'] = $profil;
        $_SESSION['nom'] = $user['Nom']; // Stockage du nom de l'utilisateur dans la session
        $_SESSION['prenom'] = $user['Prenom']; // Stockage du prénom de l'utilisateur dans la session

        // Redirection vers la page d'accueil du formateur ou de l'apprenti
        if ($profil == 'formateur') {
            header("Location: /EASACESS/vues/accueilFormateur.php");
            exit;
        } elseif ($profil == 'apprenti') {
            header("Location: /EASACESS/vues/accueilApprenti.php");
            exit;
        }
    } else {
        echo "Identifiants incorrects.";
    }
} else {
    echo "Identifiants incorrects.";
}

?>
