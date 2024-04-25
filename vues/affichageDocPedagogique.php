<!-- Consulter la documentation d’un système:l’apprentis sélectionne un système et demande l’affichage d’un document particulier--> 

<?php include_once('../controleurs/gestionDesSystemes.php');
//Instructions pour récuperer la variable(nom_systeme) envoye par la page descedent (Test_systeme.php)
$recupSysteme=$_GET['Nom_du_systeme'];
?>

<?php $documents = recupDocP($recupSysteme); 
   // print_r ($documents);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un document pédagogique</title>
    <link rel="stylesheet" href="../ressources/styles/styleDevoir.css">
</head>
<body>

    <header>
        <img src="/EASACESS/ressources/images/logo_aforp.png" alt="Logo AFORP">
        <button type="button" id="seDeconnecter" onclick="window.location.href='../EASACESS/controleurs/deconnexion.php'">Se déconnecter</button>
    </header>

    <div class="banniereBienvenue">
        <h1>Document(s) pédagogique(s)</h1>
        <p>Système <?php echo htmlspecialchars($_SESSION['prenom']) . ' ' . htmlspecialchars($_SESSION['nom']); ?> (apprenti)</p>
        <button type="button" id="retour" onclick="window.location.href='../EASACESS/vues/Test_systeme.php'">retour</button>
    </div>
    
    <!-- Télécharger un document pédagogique -->
    <div id="DevoirSection">
    <h2>Télécharger un document pédagogique</h2>
    <form action="pdfDownload.php" method="post" enctype="multipart/form-data">
        <!-- <form action="upload.php" method="post" enctype="multipart/form-data"></form> $_GET['Nom_du_systeme'] -->
        <!-- Select pdf to download: -->
        <input type="hidden" name="Nom_du_systeme" value="<?php echo $_GET['Nom_du_systeme'] ; ?>">
        <input type="hidden" name="Type_De_Document" value="peda">
        <!-- <input type="file" name="fileToDownload" id="fileToDownload"> -->
        <input type="hidden" name="Effacer" value="false">
        <input type="submit" value="Download" name="submit">
    </form>
    </div>


<!-- Fonctionnalité : Afficher la liste des documents pédagogique -->

        <section class="margeHaut">
            <?php foreach ($documents as $document) : ?>
            <section class="calqueImg">
                <section class="carte">
                    <section class="conteneur">
                        <img class="img_systeme" src="<?php echo '../ressources/images/document.png'?>">
                        <span class="texte"><?php echo $document["Nom_fichier"]?></span>
                        <a href="../EASACESS/vues/affichageDocPedagogique.php"><img src=""></a>;
                    </section>
                </section>
            </section>
            <?php endforeach ?>
        </section>


<footer class="footer">
        <a href="/EASACESS/vues/mentionsLegales.html" class="footer-link">Mentions légales</a>
        <a href="/EASACESS/vues/politiqueDeConfidentialite.html" class="footer-link">Politique de confidentialité</a>
    </footer>
    
</body>
</html>