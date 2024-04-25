<?php
// session_start();
include 'connexionBDDD.php';

function obtenirSystemes() {
    global $conn;
    $requete = "SELECT * FROM `systeme`";
    $requete_prepare= $conn->prepare($requete);
    $requete_prepare->execute();
    $systemes = $requete_prepare->fetchAll(PDO::FETCH_ASSOC);
    return $systemes;
}

//Fonction qui récupère tous les documents technique d'un système dont on connait le nom
function recupDoc($nomSysteme) {
//Obtenir l'id du système dont le nom est donnée 
    global $conn; //Pour appeler 
  
    $requete = "SELECT `ID_systeme` FROM `systeme` WHERE `Nom_du_systeme`= ?";
    $requete_prepare= $conn->prepare($requete);  
    $requete_prepare->bindParam(1, $nomSysteme, PDO::PARAM_STR); //pour faire le lien entre ma variable du code php et le marqueur de ma requête
    $requete_prepare->execute();
    $resultat = $requete_prepare->fetch();
    $systeme_id= $resultat['ID_systeme'];
    // print_r($resultat);

    //Faire une requete qui recupere le nom de doc_tec du systeme selectionné a 

    $requete = "SELECT `Fichier_document` FROM `document_technique` WHERE `Systeme_concerne`= ?";
    $requete_prepare= $conn->prepare($requete);  
    $requete_prepare->bindParam(1, $systeme_id, PDO::PARAM_STR);
    $requete_prepare->execute();
    $resultat = $requete_prepare->fetchAll(PDO::FETCH_ASSOC);

   return $resultat;//contiens la liste de noms de fichiers des documents techniques
}

//Fonction qui récupère tous les documents technique d'un système dont on connait le nom
function recupDocP($nomSysteme) {
    //Obtenir l'id du système dont le nom est donnée 
        global $conn; //Pour appeler 
      
        $requete = "SELECT `ID_systeme` FROM `systeme` WHERE `Nom_du_systeme`= ?";
        $requete_prepare= $conn->prepare($requete);  
        $requete_prepare->bindParam(1, $nomSysteme, PDO::PARAM_STR); //pour faire le lien entre ma variable du code php et le marqueur de ma requête
        $requete_prepare->execute();
        $resultat = $requete_prepare->fetch();
        $systeme_id= $resultat['ID_systeme'];
        // print_r($resultat);
    
        //requete qui recupere le nom de doc_tech du systeme selectionné 
    
        $requete = "SELECT `Nom_fichier` FROM `document_pedagogique` WHERE `Systeme_concerne`= ?";
        $requete_prepare= $conn->prepare($requete);  
        $requete_prepare->bindParam(1, $systeme_id, PDO::PARAM_STR);
        $requete_prepare->execute();
        $resultat = $requete_prepare->fetchAll(PDO::FETCH_ASSOC);
    
       return $resultat;//contiens la liste de noms de fichiers des documents techniques
    }
    



   //Obtenir les doc techniques du système dont l'id est donné
   //$requete_prepare = "SELECT * FROM `document_technique` WHERE `ID_systeme`= ?";
   //$requete_prepare->bindParam(1, $nomSysteme, PDO::PARAM_STR);    
?>
