<?php 
// session_start();
include('../controleurs/connexionBDDD.php');
include_once('../controleurs/gestionDesSystemes.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Apprenti</title>
    <link rel="stylesheet" href="../ressources/styles/styleAccueilApprenti.css">
</head>

<body>
    <header>
        <img src="/EASACESS/ressources/images/logo_aforp.png" alt="Logo AFORP">
        <button type="button" id="seDeconnecter" onclick="window.location.href='/EASACESS/controleurs/deconnexion.php'">Se déconnecter</button>
    </header>

    <div class="banniereBienvenue">
        <h1>ACCUEIL APPRENTI</h1>
        <p>Bienvenue <?php echo htmlspecialchars($_SESSION['prenom']) . ' ' . htmlspecialchars($_SESSION['nom']); ?> (apprenti)</p>
    </div>
    
    <!-- Fonctionnalité 1 : Afficher la liste des systèmes -->
    <?php $systemes = obtenirSystemes();
        //  print_r ($systemes);
    ?>

    <!-- <section class="content_photo_formateur">
        <section class="margeHaut">  -->
            <?php foreach ($systemes as $systeme) : ?>
            <section class="calqueImg">
                <section class="carte">
                    <img src="<?php echo BASE_URL.'/ressources/images/'.$systeme['image_systeme']?>">
                    <section class="conteneur">
                        <span class="texte"><?php echo $systeme['Nom_du_systeme']?> </span>
                    </section>
                </section>
            </section>
            <?php endforeach ?>
        <!-- </section>
    </section> -->
    <!-- Fonctionnalité 2 : Consulter la documentation d'un système -->
    <!-- <div class="consulterDocumentation">
        <h2>Consulter la documentation d'un système :</h2>
        <select id="systemeSelectionne">
            <option value="systeme1">MACHINE A CAFE</option>
            <option value="systeme2">ECOL'CAFE</option>
            <option value="systeme3">HYDROLIS</option>
            <option value="systeme4">2xRAVOUX(Dosajet + Indexa)</option>
            <option value="systeme5">STAUBLI</option>
            <option value="systeme6">EXTRUDICC</option>
            <option value="systeme7">PONT LEVAGE</option></select>
        <button onclick="afficherDocumentation()">Afficher documentation</button>

        <div id="documentation">
           
        </div>
    </div>

    <!-- Fonctionnalité 3 : Afficher la liste des documents pédagogiques déposés par le formateur -->
    <div class="listeDocumentsPedagogiques">
        <h2>Liste des documents pédagogiques :</h2>
        <ul>
            <li>Document 1</li>
            <li>Document 2</li>
            <li>Document 3</li>
            <li>Document 4</li>
            <option value="systeme8">ARMOIRE HE (Habilitation électrique)</option> -->

            <!-- Si je besoin d'ajouter d'autres systèmes -->
            
        
            <li>Document 5</li>
            <li>Document 6</li>
            <li>Document 7</li>
            <li>Document 8</li>
            
            <!-- Si je besoin d'ajouter d'autres documents pédagogiques -->
        </ul>
    </div>

    <!-- Fonctionnalité 4 : Afficher le contenu d'un document pédagogique sélectionné -->
    <div class="afficherContenuDocument">
        <h2>Afficher le contenu d'un document pédagogique :</h2>
        <select id="documentSelectionne">
            <option value="document1">Document 1</option>
            <option value="document2">Document 2</option>
            <option value="document3">Document 3</option>
            <option value="document4">Document 4</option>
            <option value="document5">Document 5</option>
            <option value="document6">Document 6</option>
            <option value="document7">Document 7</option>
            <option value="document8">Document 8</option>

            <!-- Si je besoin d'ajouter d'autres documents pédagogiques -->
        </select>
        <button onclick="afficherContenuDocument()">Afficher Contenu</button>

        <div id="contenuDocument">
            <!-- Le contenu du document sera affiché ici en fonction de la sélection -->
        </div>
    </div>

    <footer>
        <a href="/EASACESS/vues/mentionsLegales.html" class="footer-link">Mentions légales</a>
        <a href="/EASACESS/vues/politiquesDeConfidentialite.html" class="footer-link">Politiques de confidentialité</a>
    </footer>
    
 <!-- **** à faire**** Affichage de documentation -->
 
 <!-- **** à faire**** Afficher le contenu du document en fonction de la sélection -->


<script>
    // Fonction pour afficher la documentation en fonction du système sélectionné
    function afficherDocumentation() {
        var systemeSelectionne = document.getElementById("systemeSelectionne").value;
        var documentationDiv = document.getElementById("documentation");

        
        documentationDiv.innerHTML = "Documentation pour " + systemeSelectionne;
    }

    // Fonction pour afficher le contenu du document en fonction de la sélection
    function afficherContenuDocument() {
        var documentSelectionne = document.getElementById("documentSelectionne").value;
        var contenuDocumentDiv = document.getElementById("contenuDocument");

        
        contenuDocumentDiv.innerHTML = "Contenu du document " + documentSelectionne;
    }
</script>



</body>
</html>