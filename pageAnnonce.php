<?php

session_start();//session_start() combiné à $_SESSION 
require 'annonce.php';
 
$art = new annonce();
$annonces = $art->lire();
$annonces = array_reverse($annonces);
 
for ($i = 0; $i < sizeof($annonces); $i++) {
    $annonce = $annonces[$i];
    ?>
    <h1>Annonce : <?php echo $annonce['titre']?></h1>
    <p> <?php echo $annonce['contenu'] ?></p>
    <?php
}

    if(isset($_SESSION['pseudo'])){
        echo "<a href='createAnnonce.php'>Ajouter une annonce</a>";
    } else {
        echo "<a href='connexion.php'>Connectez-vous à votre espace pour poster une annonce</a>";
    }

    echo "<br><br>";
    echo "<a href='index.php'>Retour à l'accueil</a>";

?>