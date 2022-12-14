 

<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pratique-Musique-12</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styleW.css?v=1.x.x" />

 
</head>
<body>
    
    <nav>
        <h2 class="titre">
            Pratique Musique 12
        </h2>               
        
        <div class="logo">
            <i class="fa fa-music music" aria-hidden="true"></i>           
        </div> 


        <div class="toggle">
            <i class="fas fa-bars ouvrir"></i>
            <i class="fas fa-times fermer"></i>
        </div>

        
        <ul class="menu">
            <?php
            if(isset($_SESSION['pseudo']) && $_SESSION['is_admin'] === '1') 
            { // Si x est connecté on lui affiche la deconnexion
            ?>
                <li><a href="index.php">Accueil</a></li>

                <li><a href="deconnexion.php"><button class="btn">Se déconnecter</button></a></li>
                <li><a href="admin/home.php"><button class="btn btn-secondary">Espace admin</button></a></li>
            <?php
            }

            elseif(isset($_SESSION['pseudo']) && $_SESSION['is_admin'] === '0')
            { // Si x est connecté on lui affiche la deconnexion
            ?>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="pageAnnonce.php">Annonces</a></li>
                <li><a href="Eveil.php">Eveil</a></li>
                <li><a href="Pratique.php">Pratique</a></li>
                <li><a href="Enseignement.php">Enseignement</a></li>
                <li><a href="Accompagnement.php">Accompagnement</a></li>
                <li><a href="Diffusion.php">Diffusion</a></li>
    
                <li><a href="deconnexion.php"><button class="btn">Se déconnecter</button></a></li>
                <li><a href="espace-membre.php"><button class="btn btn-secondary">Compte</button></a></li>
            <?php
            }
            else {
            ?> <!-- S'il est déconnecté on lui montre la connexion et l'inscription. -->
                <li><a href="index.php">Accueil</a></li>
                <li><a href="pageAnnonce.php">Annonces</a></li>
                <li><a href="Eveil.php">Eveil</a></li>
                <li><a href="Pratique.php">Pratique</a></li>
                <li><a href="Enseignement.php">Enseignement</a></li>
                <li><a href="Accompagnement.php">Accompagnement</a></li>
                <li><a href="Diffusion.php">Diffusion</a></li>

                <li><a href="inscription.php"><button class="btn">Inscription</button></a></li>
                <li><a href="connexion.php"><button class="btn btn-secondary">Connexion</button></a></li>
            <?php
            }
            ?>
        </ul>

    </nav>

        <div class="topnav">
            <div class="search-container">
                <form action="/action_page.php">
                    <input type="text" placeholder="Rechercher.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        

    <script src="app.js"></script>
</body>
</html>