<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" >
    <title>Creer une annonce</title>
</head>
<body>

    <?php
    session_start();
    ?>

    <p>Vous pouvez créer une nouvelle annonce en remplissant le formulaire ci-dessous</p>

    <?php
    require 'annonce.php';
    if (isset($_POST['titre']) AND isset($_POST['contenu'])) {
        $art = new annonce();
        $art->nouvelle_annonce($_POST['titre'], $_POST['contenu']);
        echo "L'annonce a bien été ajoutée";
        echo "<br>";
    }
    ?>

    <form method="post" action="createAnnonce.php">
        <input type="text" placeholder="Titre de l'annonce" name="titre" />
        <textarea placeholder="Contenu de l'annonce" name="contenu"></textarea>
        <input type="submit" />
    </form>

</body>
</html>

    <?php
        echo "<a href='pageAnnonce.php'>Voir toutes les annonces</a>";
    ?>