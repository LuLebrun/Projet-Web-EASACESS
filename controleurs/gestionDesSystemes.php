<?php
session_start();
include 'connexionBDD.php';

function obtenirSystemes($conn) {
    $systemes = array();
    $result = $conn->query("SELECT * FROM systeme");
    while($row = $result->fetch_assoc()) {
        $systemes[] = $row;
    }
    return $systemes;
}

// Remarque: Cette partie est commentée car nous n'allons pas inclure la vue ici.
// $systemes = obtenirSystemes($conn);
// require '../vues/interfaceGestionDesSystemes.php';
?>
