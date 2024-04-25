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
    <link rel="stylesheet" href="../ressources/styles/styleTest.css">
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
    
    <!-- Fonctionnalité : Afficher la liste des systèmes -->
    <?php $systemes = obtenirSystemes(); // Contient toutes les données de la table systeme
        //  print_r ($systemes);
    ?>

        <section class="margeHaut">
            <?php foreach ($systemes as $systeme) : ?>
            <section class="calqueImg">
                <section class="carte">
                    <img class="img_systeme" src="<?php echo '../ressources/images/'.$systeme['image_systeme']?>">
                    <section class="sousMenu">
                        <button onclick="window.location.href = 'interfaceAjouterDevoir.php?Nom_du_systeme=<?php echo urlencode($systeme['Nom_du_systeme']);?>';">Dépôt devoirs</button>
                        <button onclick="window.location.href = 'affichageDocPedagogique.php?Nom_du_systeme=<?php echo urlencode($systeme['Nom_du_systeme']);?>';">Documents pédagogiques</button>
                        <button onclick="window.location.href = 'affichageDocTechnique.php?Nom_du_systeme=<?php echo urlencode($systeme['Nom_du_systeme']);?>';">Documents techniques</button>
                        <!-- Affecter une action pour rédireger vers la page doc tec et envoyer le nom du systeme -->
                    </section>
                    <section class="conteneur">
                        <span class="texte"><?php echo $systeme['Nom_du_systeme']?> </span>
                    </section>
                </section>
            </section>
            <?php endforeach ?>
        </section>


    <footer class="footer">
        <a href="/EASACESS/vues/mentionsLegales.html" class="footer-link">Mentions légales</a>
        <a href="/EASACESS/vues/politiqueDeConfidentialite.html" class="footer-link">Politiques de confidentialité</a>
    </footer>
    
</body>
</html>