<?php
// Informations de connexion à la base de données
$servername = "localhost";
$user = 'root';
$password = 'root'; //To be completed if you have set a password to root
$database = 'easacess_bd'; //To be completed to connect to a database. The database must exist.
$uploads_dir = "uploads";
$deleteOK = true;
$name=$_GET['filename']; // Nom du fichier a effacer

try {
    // Créez une connexion
        $pdf = new PDO('mysql:host=' . $servername . ';dbname=' . $database, $user, $password);
    } 
    catch (Exception $excep)
    {
        //vérification de la connexion
        die("Erreur de connexion à la base de donnée: " . $excep->getMessage());
    }

$del=$pdf->prepare("DELETE from document_pedagogique where Nom_fichier = \"" . $name . "\"");

try {
  $del->execute();
} 
catch (Exception $excep)
{
    //vérification d'insertion du pdf en base de données
    die("Erreur lors de l'effacement du document en base de données: " . $excep->getMessage());
}

//On vérifie si on a déjà le fichier dans le dossier
if (!file_exists("$uploads_dir/$name")) {
    echo "Désolé, le fichier n'existe pas dans le dossier.";
    $deleteOK = false;
  }

   // L'utilisateur veut supprimer un fichier
   if($_GET['action'] && $_GET['action'] == 'delete' && $deleteOK == true) {
       unlink("$uploads_dir/$name");
       echo "Le fichier a bien été effacé du dossier.";
   }
   //header("Location:pdfTesteDownload.php");
   exit();
?>