<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["pseudo"])){
    header("Location: ../connexion.php");
    exit(); 
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" type="image/icone.ico" sizes="16x16" href="img/icone.ico" >
    <link rel="stylesheet" href="../style.css" />
  </head>
  <body>
    <div class="sucess">
      <br>
    <h1>Bienvenue <?php echo $_SESSION['pseudo']; ?> !</h1>
    <p>Vous êtes sur votre espace admin</p>
    <a href="addStructure.php">Ajouter une structure</a> | 
    <a href="#">Modifier une structure</a> | 
    <a href="#">Supprimer une structure</a> | 
    <a href="../deconnexion.php">Déconnexion</a>
    </ul>
    </div>
  </body>
</html>


