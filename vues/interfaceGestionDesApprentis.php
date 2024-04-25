<?php 
session_start();
require_once '../controleurs/gestionApprentis.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Formateur</title>
    <link rel="stylesheet" href="/EASACESS/ressources/styles/styleGestionDesApprentis.css">
</head>
<body>
    <header>
        <img src="/EASACESS/ressources/images/logo_aforp.png" alt="Logo AFORP">
        <button type="button" id="seDeconnecter" onclick="window.location.href='/EASACESS/controleurs/deconnexion.php'">Se déconnecter</button>

    </header>
    <div class="banniereBienvenue">
        <h1>Liste des Apprentis</h1>
        <p>Toujours sur le profil de <?php echo htmlspecialchars($_SESSION['prenom']) . ' ' . htmlspecialchars($_SESSION['nom']); ?> (formateur)</p>
        <button type="button" id="retour" onclick="window.location.href='/EASACESS/vues/accueilFormateur.php'">retour</button>
    </div>

    <div id="ajoutApprentiSection">
    <h2>Ajouter un apprenti</h2>
    <form action="/EASACESS/controleurs/ajouterApprenti.php" method="POST">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="number" name="promotion" placeholder="Promotion" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe provisoire" required>
        <input type="submit" value="Ajouter">
    </form>
</div>

</div>

    <div class="listeApprentis">
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Promotion</th>
            </tr>
            <?php foreach ($apprentis as $apprenti): ?>
                <tr>
                    <td><?= htmlspecialchars($apprenti['ID_apprenti']) ?></td>
                    <td><?= htmlspecialchars($apprenti['Nom']) ?></td>
                    <td><?= htmlspecialchars($apprenti['Prenom']) ?></td>
                    <td><?= htmlspecialchars($apprenti['Promotion']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<!-- Section pour supprimer un apprenti existant -->
<div id="supprimerApprentiSection">
    <h2>Supprimer un apprenti</h2>
    <form action="/EASACESS/controleurs/supprimerApprenti.php" method="POST">
        <select name="id_apprenti" required>
            <option value="">Sélectionner un apprenti</option>
            <?php foreach ($apprentis as $apprenti): ?>
                <option value="<?= htmlspecialchars($apprenti['ID_apprenti']) ?>">
                    <?= htmlspecialchars($apprenti['Prenom']) . ' ' . htmlspecialchars($apprenti['Nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet apprenti ?');">
    </form>
</div>


    <footer>
        <a href="/EASACESS/vues/mentionsLegales.html" class="footer-link">Mentions légales</a>    
        <a href="/EASACESS/vues/politiquesDeConfidentialite.html" class="footer-link">Politiques de confidentialité</a>
    </footer>
</body>
</html>