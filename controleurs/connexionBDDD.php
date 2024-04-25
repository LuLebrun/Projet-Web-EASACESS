<?php
// Démarrer la session PHP
session_start();

// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "easacess_bd";
try {
// Créez une connexion
    $conn = new PDO('mysql:host=' . $servername . ';dbname=' . $dbname, $username, $password);
} 
catch (Exception $excep)
{
    //vérification de la connexion
    die("Erreur de connexion à la base de donnée: " . $excep->getMessage());
}

?>




