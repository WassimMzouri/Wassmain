<?php 
session_start();
?>


<!DOCTYPE html>
<html lang="en">
    <head>    
        <title>Pratique-Musique-12</title>
        <link rel="stylesheet" href="styleW.css?v=1.x.x">    
    </head>
    <body>

        <header>

            <?php include('menu.php')?>

        </header>            
        
        <br><br><br><br><br><br><br>


        <h1 style="color:black">Enseignement</h1><br>

        <div >
            <p>Cliquez sur les instruments que vous souhaitez découvrir :</p> </br>


            <?php                  
                
                include ('connect.php');
                $sql="SELECT * FROM Instrument";
                $result = $pdo->query($sql);
                
                for($i=0; $i<$result->rowCount(); $i++)
                {                       
                    
                    /* Creer les boutons des differents instruments */
                    if ($result->rowCount()>0){                 
                        while ($row = $result->fetch()){
                            
                            echo '<button class="btn-instrument">';
                            echo $row["Nom"] ."<br>";
                            echo "</button>";

                        }
                        
                    }
                     
                }
                
                /* Exception si pas d'instrument */
                if($result->rowCount()<0){
                    echo "<br>Pas d'instrument :"."<br>";
                    echo '<button><a href="index.php">Retour Accueil</a></button>';
                }  
                   

            ?>

        </div>

        </br></br></br></br>
        <hr style="color:black;">



        <!-- Ajouter un instrument dispo seulement pour admin -->
        <div>
            <h3>Ajouter un instrument </h3>
            <form method="post">             
                
                <label>Nouvel Instrument :</label>
                <input type="text" name="nom">
                <input class="btn-instrument-ajout" type="submit" value="Ajouter"></input>

            </form>
            <?php   
                include ('connect.php');
                if (isset($_POST['prenom'])) {
                    
                    $requete = 'INSERT INTO instrument VALUES($_POST["nom"])';
                    $resultat = $pdo->query($requete);
                
                    if ($resultat)
                        echo "<p>L'instrument a été ajouté</p>";
                    else
                        echo "<p>Erreur</p>";
                }
            ?>
        </div>

        </br></br></br></br></br>

        <?php include('footer.php')?>

    </body>
</html>