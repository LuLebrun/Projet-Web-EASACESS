<?php
session_start();
require_once 'connexionBDD.php'; // Assurez-vous que le chemin d'accès est correct.

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id_apprenti'])) {
    $id_apprenti = $_POST['id_apprenti'];

    // Préparer la requête SQL pour supprimer l'apprenti
    $sql = "DELETE FROM apprenti WHERE ID_apprenti = ?";

    // Utiliser une déclaration préparée pour éviter les injections SQL
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erreur lors de la préparation de la requête : " . $conn->error);
    }

    // Lier le paramètre et exécuter la requête
    $stmt->bind_param("i", $id_apprenti);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Apprenti supprimé avec succès.";
    } else {
    $_SESSION['error'] = "Erreur lors de la suppression de l'apprenti: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    
    header("Location: /EASACESS/vues/interfaceGestionDesApprentis.php");
    exit();
} else {
    $_SESSION['error'] = "Aucun apprenti sélectionné pour la suppression.";
    header("Location: /EASACESS/vues/interfaceGestionDesApprentis.php");
    exit();
    }
    ?>