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