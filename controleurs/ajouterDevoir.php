<?php 
session_start();
require_once '../controleurs/ajouterDevoir.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Apprenti</title>
    <link rel="stylesheet" href="/EASACESS/ressources/styles/styleAccueilApprenti.css">
</head>
<body>
    <header>
        <img src="/EASACESS/ressources/images/logo_aforp.png" alt="Logo AFORP">
        <button type="button" id="seDeconnecter" onclick="window.location.href='/EASACESS/controleurs/deconnexion.php'">Se déconnecter</button>

    </header>
    <div class="banniereBienvenue">
        <h1>Devoir</h1>
        <p>Toujours sur le profil de <?php echo htmlspecialchars($_SESSION['prenom']) . ' ' . htmlspecialchars($_SESSION['nom']); ?> (apprenti)</p>
        <button type="button" id="retour" onclick="window.location.href='/EASACESS/vues/accueilApprenti.php'">retour</button>
    </div>

    <!-- Fonctionnalité : Déposer les supports des travaux demandés par le formateur -->
    <div class="ajoutDevoir">
        <h2>Ajouter devoir :</h2>
        <!-- Formulaire de dépôt de fichiers -->
        <form action="/EASACESS/controleurs/ajouterDevoir.php" method="post" enctype="multipart/form-data">
            <label for="fichier">Sélectionner un fichier :</label>
            <input type="file" name="fichier" id="fichier" required>
            <button type="submit">Ajouter</button>
        </form>
    </div>


    <div id="supprimerApprentiSection">
    <h2>Ajouter un devoir</h2>
    <form action="/EASACESS/controleurs/ajouterDevoir.php" method="POST">
        <select name="id_apprenti" required>
            <option value="">Sélectionner un fichier</option>
            <?php foreach ($devoirs as $devoir): ?>
                <option value="<?= htmlspecialchars($devoir['ID_devoir']) ?>">
                    <?= htmlspecialchars($apprenti['Prenom']) . ' ' . htmlspecialchars($apprenti['Nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Ajouter" onclick="return confirm('Êtes-vous sûr de vouloir ajouter ce devoir ?');">
    </form>


    <footer>
        <a href="/EASACESS/vues/mentionsLegales.html" class="footer-link">Mentions légales</a>
        <a href="/EASACESS/vues/politiquesDeConfidentialite.html" class="footer-link">Politiques de confidentialité</a>
    </footer>
