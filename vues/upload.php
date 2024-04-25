<?php
// Informations de connexion à la base de données
$servername = "localhost";
$user = 'root';
$password = 'root'; //To be completed if you have set a password to root
$database = 'easacess_bd'; //To be completed to connect to a database. The database must exist.
$port = NULL; //Default must be NULL to use default port
$date = date('Y-m-d'); // Date actuelle pour l'insertion du document en base

$uploads_dir = "uploads/";
$target_file = $uploads_dir . basename($_FILES["fileToUpload"]["name"]);//Destination du fichier
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//$fileAsString = base64_encode(file_get_contents('JPM The Death of Diversification Greatly Exaggerated.pdf'));
//$fileAsString = base64_encode(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
// Variables reçus par la méthode POST
$tmp_name = $_FILES["fileToUpload"]["tmp_name"];
$name = $_FILES["fileToUpload"]["name"];
$Nom_du_systeme = $_POST["Nom_du_systeme"];
$Type_De_Document = $_POST["Type_De_Document"];
$Mettre_a_jour = $_POST["Mettre_a_jour"];

// On vérifie l'extension du fichier
/*
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}
*/

// On vérifie si on a déjà le fichier dans le dossier et s'il ne faut pas le mettre à jour (si c'est un premier ajout)
if (file_exists($target_file) && $Mettre_a_jour == "false") {
  echo "Désolé, le fichier existe déjà.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Désolé, Votre fichier est trop volumineux, il dépasse 5Mo.";
  $uploadOk = 0;
}

// On vérifie l'extension
/*
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}*/
if($imageFileType != "pdf" ) {
  echo "Désolé, on accepte que les formats PDF, $imageFileType n'est pas permis.";
  $uploadOk = false;
}

// On vérifie la variable $uploadOk, si elle est à 0 on importe pas, il y eu un problème
if ($uploadOk == 0) {
  echo "Désolé, votre fichier n'a pas été uploadé.";
// if everything is ok, try to upload file
} else {
    //$pdf=new PDO("mysql:host=localhost;dbname=$database", $user, $password);
    try {
      // Créez une connexion
          $pdf = new PDO('mysql:host=' . $servername . ';dbname=' . $database, $user, $password);
      } 
      catch (Exception $excep)
      {
          //vérification de la connexion
          die("Erreur de connexion à la base de donnée: " . $excep->getMessage());
      }


    // $Type_De_Document devoir / peda / techni
    switch ($Type_De_Document) {
      case "devoir":
        $list=$pdf->prepare("SELECT * from document_pedagogique where Nom_fichier = \"" . $name . "\"");
        break;
      case "peda":
        $list=$pdf->prepare("SELECT * from document_pedagogique where Nom_fichier = \"" . $name . "\"");
        break;
      case "techni":
        $list=$pdf->prepare("SELECT * from document_technique where Nom = \"" . $name . "\"");
        break;
    }

    // On vérifie si on a déjà le fichier
    // $list=$pdf->prepare("SELECT * from document_pedagogique where Nom_fichier = \"" . $name . "\"");
    $list->execute();
    $fetch=$list->fetchAll(PDO::FETCH_ASSOC);

    if (count($fetch) > 0 && $Mettre_a_jour == "false") { echo "Le fichier est déjà présent, on ne vas pas uploader le fichier."; }
    else {
        // On met le fichier dans le dossier upload
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
        echo "Le fichier a bien été uploadé dans le dossier.";
        // On récupère l'id du Nom du système
        //echo "Nom du système: " . $Nom_du_systeme . " et l'autre variable: " . $_POST["Nom_du_systeme"];
       // echo "SELECT ID_systeme from systeme where Nom_du_systeme = \"" . $_POST["Nom_du_systeme"] . "\"";
           // $Type_De_Document devoir / peda / techni
        $sql=$pdf->prepare("SELECT ID_systeme from systeme where Nom_du_systeme = \"" . $_POST["Nom_du_systeme"] . "\"");

        try {
          $sql->execute();
        } 
        catch (Exception $excep)
        {
            //vérification d'insertion du pdf en base de données
            die("Erreur lors de la récupération de l'id du nom du système: " . $excep->getMessage());
        }
        $id_sys=$sql->fetchColumn();
        //On importe le nom du fichier dans la base de données
        //echo "Nom du system : " . $_POST["Nom_du_systeme"];
        //echo "SQL : " . $sql->fetch();
        //echo "Variable est : " . $id_sys;


         //$add=$pdf->prepare("INSERT INTO document_technique(Nom,Systeme_concerne,Date, Version, Categorie,Fichier_Document) VALUES('$name',1,'$date','','','')");
         //echo "The name " . $name;
         //echo "test2: " . $id_sys;

         //echo "INSERT INTO document_pedagogique(Nom_fichier,Systeme_concerne,Date_document, Nom_matiere, Document,Type_Document) VALUES('$name',$id_sys,'$date','','','DEVOIR')";

        // $Type_De_Document devoir / peda / techni
        switch ($Type_De_Document) {
          case "devoir":
            $add=$pdf->prepare("INSERT INTO document_pedagogique(Nom_fichier,Systeme_concerne,Date_document, Nom_matiere, Document,Type_Document) VALUES('$name',$id_sys,'$date','','','DEVOIR')");
            break;
          case "peda":
            $add=$pdf->prepare("INSERT INTO document_pedagogique(Nom_fichier,Systeme_concerne,Date_document, Nom_matiere, Document,Type_Document) VALUES('$name',$id_sys,'$date','','','CONSIGNE')");
            break;
          case "techni":
            $add=$pdf->prepare("INSERT INTO document_technique(Nom,Systeme_concerne,Date, Version, Categorie,Fichier_Document) VALUES('$name',$id_sys,'$date','','')");
            break;
        }
        // $add=$pdf->prepare("INSERT INTO document_pedagogique(Nom_fichier,Systeme_concerne,Date_document, Nom_matiere, Document,Type_Document) VALUES('$name',$id_sys,'$date','','','DEVOIR')");

        try {
          $add->execute();
        } 
        catch (Exception $excep)
        {
            //vérification d'insertion du pdf en base de données
            die("Erreur lors de l'insertion du document en base de données: " . $excep->getMessage());
        }
        echo "Le fichier a bien été insérer en base de données";
    }
  }

?>