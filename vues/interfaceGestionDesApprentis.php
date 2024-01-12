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
    <!-- Formulaire d'ajout d'apprenti -->
<div class="ajoutApprenti">
    <h2>Ajouter un apprenti</h2>
    <form action="../controleurs/ajouterApprenti.php" method="POST">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="text" name="prenom" placeholder="Prénom" required>
    <input type="number" name="promotion" placeholder="Promotion" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="submit" value="Ajouter">
</form>

</div>

    <div class="listeApprentis">
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Promotion</th>
                <th>Action</th>
                                    <td>
                                        <form action="supprimerApprenti.php" method="post">
                                        <input type="hidden" name="id_apprenti" value="<?= $apprenti['ID_apprenti'] ?>">
                                        <input type="submit" value="Supprimer">
                                        </form>
                                    </td>

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



    <footer>
        <a href="chemin_vers_la_politique_de_confidentialite.html" class="footer-link">Politiques de confidentialité</a>
        <a href="chemin_vers_les_mentions_legales.html" class="footer-link">Mentions légales</a>
    </footer>
</body>
</html>