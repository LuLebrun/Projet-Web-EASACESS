<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Formateur</title>  
    <link rel="stylesheet" href="/EASACESS/ressources/styles/styleAccueilFormateur.css">
</head>
<body>
    <header>
        <img src="/EASACESS/ressources/images/logo_aforp.png" alt="Logo AFORP">
        <button type="button" id="seDeconnecter" onclick="window.location.href='/EASACESS/controleurs/deconnexion.php'">Se déconnecter</button>

    </header>
    
    <div class="banniereBienvenue">
        <h1>ACCUEIL FORMATEUR</h1>
        <p>Bienvenue <?php echo htmlspecialchars($_SESSION['prenom']) . ' ' . htmlspecialchars($_SESSION['nom']); ?> (formateur)</p>
    </div>



<div class="conteneurImage">
    <div class="image-card" onclick="window.location.href='/EASACESS/vues/interfaceGestionDesSystemes.php';">
        <img src="/EASACESS/ressources/images/image_electrotechnique.jpg" alt="Gestion des systèmes">
        <div class="image-text">GESTION DES SYSTÈMES</div>
    </div>
    <div class="image-card" onclick="window.location.href='/EASACESS/vues/interfaceGestionDesApprentis.php';">
        <img src="/EASACESS/ressources/images/image_gestion_apprentis.jpg" alt="Gestion des apprentis">
        <div class="image-text">GESTION DES APPRENTIS</div>
    </div>
</div>




    <footer>
        <a href="/EASACESS/vues/mentionsLegales.html" class="footer-link">Mentions légales</a>
        <a href="/EASACESS/vues/politiquesDeConfidentialite.html" class="footer-link">Politiques de confidentialité</a>
    </footer>
</body>
</html>