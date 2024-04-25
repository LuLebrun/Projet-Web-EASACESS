<?php 
// session_start();
// include('/controleurs/connexionBDDD.php');
include_once('/controleurs/gestionDesSystemes.php');
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
<?php $systemes = RecupDoc("DOSAJET");
        //  print_r ($systemes);
    ?>
</body>
</html>