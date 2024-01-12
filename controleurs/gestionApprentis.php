<?php
require_once 'connexionBDD.php'; // Incluez votre script de connexion à la base de données.

function obtenirApprentis($conn) {
    $sql = "SELECT ID_apprenti, Nom, Prenom, Promotion FROM apprenti";
    $result = $conn->query($sql);
    $apprentis = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $apprentis[] = $row;
        }
    } else {
        // Gérer l'erreur
        echo "Erreur : " . $conn->error;
    }
    return $apprentis;
}

// Appel de la fonction et stockage des résultats
$apprentis = obtenirApprentis($conn);
?>
