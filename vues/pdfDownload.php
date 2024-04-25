<?php
// Informations de connexion à la base de données
$user = 'root';
$password = 'root'; //To be completed if you have set a password to root
$database = 'easacess_bd'; //To be completed to connect to a database. The database must exist.
$port = NULL; //Default must be NULL to use default port
// Variables reçus par la méthode POST
$Nom_du_systeme = $_POST["Nom_du_systeme"];
$Type_De_Document = $_POST["Type_De_Document"];
$Effacer = $_POST["Effacer"];

$pdf=new PDO("mysql:host=localhost;dbname=$database", $user, $password);

// Nom = \"" . $name . "\"
// and Systeme_concerne = (SELECT ID_systeme from systeme where Nom_du_systeme = \"" . $Nom_du_systeme . "\")

    // $Type_De_Document devoir / peda / techni
    switch ($Type_De_Document) {
        case "devoir":
            $list=$pdf->prepare("select Nom_fichier from document_pedagogique where Type_document = \"DEVOIR\" and Systeme_concerne = (SELECT ID_systeme from systeme where Nom_du_systeme = \"" . $Nom_du_systeme . "\")");
          break;
        case "peda":
            $list=$pdf->prepare("select Nom_fichier from document_pedagogique where Type_document = \"CONSIGNE\" and Systeme_concerne = (SELECT ID_systeme from systeme where Nom_du_systeme = \"" . $Nom_du_systeme . "\")");
          break;
        case "techni":
            $list=$pdf->prepare("select Nom from document_technique where Systeme_concerne = (SELECT ID_systeme from systeme where Nom_du_systeme = \"" . $Nom_du_systeme . "\")");
          break;
      }

    //   echo "SQL: select Nom from document_technique where Systeme_concerne = (SELECT ID_systeme from systeme where Nom_du_systeme = \"" . $Nom_du_systeme . "\")";

// $list=$pdf->prepare("select Nom_fichier from document_pedagogique");

try {
    $list->execute();
  } 
  catch (Exception $excep)
  {
      //vérification d'insertion du pdf en base de données
      die("Erreur lors de la récupération des documents en base de données: " . $excep->getMessage());
  }
$fetch=$list->fetchAll(PDO::FETCH_ASSOC);

if (count($fetch) > 0) {
    foreach ($fetch as $value) {
?>
    <a href="uploads/<?php if ($Type_De_Document == "techni") { echo $value['Nom']; } else { echo $value['Nom_fichier']; }?>" download="<?php if ($Type_De_Document == "techni") { echo $value['Nom']; } else { echo $value['Nom_fichier']; }?>"><?php if ($Type_De_Document == "techni") { echo $value['Nom']; } else { echo $value['Nom_fichier']; }?></a>
    <?php if ( $Effacer == "true" && $Type_De_Document == "techni") {
        echo "<a href=\"deleteFile.php?action=delete&filename=$value[Nom]\">delete file</a>";
    } elseif ($Effacer == "true" && $Type_De_Document != "techni") {
        echo "<a href=\"deleteFile.php?action=delete&filename=$value[Nom_fichier]\">delete file</a>";
    }
    
    ?>
    <!-- <a href="deleteFile.php?action=delete&filename=<?php echo $value['Nom_fichier']?>">delete file</a> -->
    </br>
<?php
    }
}else {echo "Aucun document à afficher.";}

?>