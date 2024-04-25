<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Formateur</title>
    <link rel="stylesheet" href="/EASACESS/ressources/styles/styleGestionDesSystemes.css">
</head>
<body>
    <header>
        <img src="/EASACESS/ressources/images/logo_aforp.png" alt="Logo AFORP">
        <button type="button" id="seDeconnecter" onclick="window.location.href='/EASACESS/controleurs/deconnexion.php'">Se déconnecter</button>

    </header>
    
    <div class="banniereBienvenue">
        <h1>DOCUMENTS PEDAGOGIQUES ET SYSTÈMES</h1>
        <p>Toujours sur le profil de <?php echo htmlspecialchars($_SESSION['prenom']) . ' ' . htmlspecialchars($_SESSION['nom']); ?> (apprenti)</p>
        <button type="button" id="retour" onclick="window.location.href='/EASACESS/vues/accueilApprenti.php'">retour</button>
    </div>

    <div class="conteneurSystemes">
    <?php foreach ($systemes as $systeme): ?>
    <div class="systeme">
    <img src="<?php echo htmlspecialchars($systeme['Image_systeme']); ?>" alt="<?php echo htmlspecialchars($systeme['Nom_du_systeme']); ?>">

        <div class="description">
            <?php echo htmlspecialchars($systeme['Nom_du_systeme']); ?>
        </div>
        <div class="boutonsGestion">
            <button type="button">Gérer les documents pédagogiques</button>
            <button type="button">Consulter la documentation système</button>
        </div>
    </div>
<?php endforeach; ?>

    </div>

    <footer>
        <a href="/EASACESS/vues/mentionsLegales.html" class="footer-link">Mentions légales</a>    
        <a href="/EASACESS/vues/politiqueDeConfidentialite.html" class="footer-link">Politique de confidentialité</a>
    </footer>
</body>
</html>