<!DOCTYPE html>
<html lang="en">
    <head>    
        <title>Pratique-Musique-12</title>


        <!-- <link rel="stylesheet" href="style.css?v=1.x.x">  -->
        <link rel="stylesheet" href="styleW.css">   
  
    
    
    </head>
    <body>

        <header>

            <?php include('menu.php')?>

        </header>            
        
        </br></br></br></br></br></br></br>


        <h1>Page Eveil</h1>
        
        <br><br><br><br>

        
        <?php    
            include ('connect.php');            
            
            $sql="SELECT * FROM structure ";
            $result = $pdo->query($sql);
        ?>


 
            
        <form action="/test.php">
          
            <label for="categorie">Choisissez une catégorie : </label>
            <select name="categorie" id="categorie">              
              
                <?php  
                    for($i=0; $i<$result->rowCount(); $i++)
                    {   
                        /* Creer les boutons des differents instruments */
                        if ($result->rowCount()>0){                 
                            while ($row1 = $result->fetch()){
                                // for($j=0; $j<$result->rowCount(); $j++)
                                // {
                                    // if ($row1["Offre"] != $row1["Offre"]){
                                                
                                    //     echo "okok";
                                        echo '<option value="'.$row1["Offre"].'">'.$row1["Offre"].'</option>';

                                //     }else {
                                //         echo "pas okoké";
                                //     }
                                // }

                                
                            }
                        }
                    }
                ?>
            </select><br><br> 
            <input type="submit" value="Submit">
        </form>    

                  

<br><br><br>



        <?php    
            
            $sql="SELECT * FROM structure ";
            $result = $pdo->query($sql);
           
                  
                   

            /* Ajoute l'offre de l'annonce */
            for($i=0; $i<$result->rowCount(); $i++)
            {   
                /* Creer les boutons des differents instruments */
                if ($result->rowCount()>0){                 
                    while ($row = $result->fetch()){
                ?>
                        
                         
                        <div class="Structure" >
                         
                            <div class="offre">
                                <p>Catégorie de l'offre :  </p> &nbsp
                                <?php echo $row["Offre"]; ?>
                            </div><br>
                            <div class="test">
                                <div class="imgStructure">
                                    <img class="imageDetaille" src= "img/Structure1.jpg" alt=""> </div>
                                    <div class="nomStructure">
                <?php
                                            echo $row["pseudo"];
                                            
                                            echo '<div class="infoStructure">';
                                            echo '<p>• Adresse : '.$row["ville"].'</p>';
                                        
                                            echo '<p>• Tel : '.$row["tel"].'</p>';
                                            echo '<p>• Mail : '.$row["mail"].'</p>';
                                            echo '<p>• Site : <a href="'.$row["Site"].'">'.$row["Site"].'</a></p>';
                                            
                                            echo '</div></div> </div> </div>';
                        }
                    }
                }    


                    

        ?>
    
        



        </br></br></br></br></br> </br></br></br></br></br> </br></br></br></br></br> </br></br></br></br></br> </br></br></br></br></br>

        <?php include('footer.php')?>

        
    </body>
</html>
