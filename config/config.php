<?php 
session_start();
$id_session = session_id();

$host = 'localhost'; //sera changé avec l'adresse IP du serveur de la base de donnée 
$user = 'root'; //identifiant pour acceder à la base de données 
$passwd = 'root'; 
$bdd = 'easacess_bd'; 
try {

    $connect = new PDO('mysql:host=' . $host . ';dbname=' . $bdd, $user, $passwd); 
}

catch (Exception $exep){
    die("Error connecting to database: " . $exep->getMessage());
}
//echo("connexion reussie");

define(ROOT_PATH , realpath(dirname(__FILE__)));
define(BASE_URL, 'http://localhost:80/EASACESS/');