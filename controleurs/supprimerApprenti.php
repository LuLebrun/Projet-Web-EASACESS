<?php
session_start();
require_once 'connexionBDD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idApprenti = $_POST['id_apprenti'];

    // Préparez une requête de suppression
    $stmt = $conn->prepare("DELETE FROM apprenti WHERE ID_apprenti = ?");
    $stmt->bind_param("i", $idApprenti);

    // Exécutez la requête
    if ($stmt->execute()) {
        echo "Apprenti supprimé avec succès";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
header('Location: /EASACESS/vues/interfaceGestionDesApprentis.php'); // Redirection vers la liste des apprentis
?>
