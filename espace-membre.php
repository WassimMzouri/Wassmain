<?php
    /*************************
    * Page: espace-membre.php
    **************************/

session_start();//session_start() combiné à $_SESSION (voir en fin de traitement du formulaire) nous permettra de garder le pseudo en sauvegarde pendant qu'il est connecté, si vous voulez que sur une page, le pseudo soit (ou tout autre variable sauvegardée avec $_SESSION) soit retransmis, mettez session_start() au début de votre fichier PHP, comme ici

$Pseudo=$_SESSION['pseudo'];//on défini la variable $Pseudo (Plus simple à écrire que $_SESSION['pseudo']) pour pouvoir l'utiliser plus bas dans la page
//on se connecte une fois pour toutes les actions possible de cette page:
$mysqli=mysqli_connect('localhost','root','','amac2');
if(!$mysqli) {
    echo "Erreur connexion BDD";
    echo "<br>Erreur retournée: ".mysqli_error($mysqli);
    exit(0);
}
//on récupère les infos du membre si on souhaite les afficher dans la page:
$req=mysqli_query($mysqli,"SELECT * FROM membres WHERE pseudo='$Pseudo'");
$info=mysqli_fetch_assoc($req);?>

<!DOCTYPE HTML>
<html>
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styleW.css?v=1.x.x" >
    <link rel="icon" type="image/icone.ico" sizes="16x16" href="img/icone.ico" >

    <style>
        body { color: white;}
        a { color: white;}
    </style>

    <title>Espace membre</title>
</head>

<body>

    <header>    

        <?php 
        include('menu.php');?>           

    </header>
    <br><br><br><br><br><br>

    <h1>Espace membre</h1>
    <hr /><br>
    Pour modifier vos informations, <b><a href="espace-membre.php?modifier">cliquez ici</a></b>
    <br>
    Pour supprimer votre compte, <b><a href="espace-membre.php?supprimer">cliquez ici</a></b>
    <br>
    Pour vous déconnecter, <b><a href="deconnexion.php">cliquez ici</a></b>
    <br>
    Pour revenir à l'accueil, <b><a href="index.php">cliquez ici</a></b>

    <br><br>
    <h1>Administration des annonces</h1>
    <hr /><br>
    Pour créer une annonce, <b><a href="createAnnonce.php">cliquez ici</a></b>
    <br>
    Pour voir vos annonces, <b><a href="pageAnnonce.php">cliquez ici</a></b>

    <?php
    //si "?modifier" est dans l'URL:
    if(isset($_GET['supprimer'])){
        if($_GET['supprimer']!="ok"){
            echo "<p>Êtes-vous sûr de vouloir supprimer votre compte définitivement?</p>
            <br>
            <a href='espace-membre.php?supprimer=ok' style='color:red'>OUI</a> - <a href='espace-membre.php' style='color:green'>NON</a>";
        } else {
                //on supprime le membre avec "DELETE"
            if(mysqli_query($mysqli,"DELETE FROM membres WHERE pseudo='$Pseudo'")){
                echo "Votre compte vient d'être supprimé définitivement.";
                    unset($_SESSION['pseudo']);//on tue la session pseudo avec unset()
                } else {
                    echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
                    //echo "<br>Erreur retournée: ".mysqli_error($mysqli);
                }
            }
        }
        //si "?modifier" est dans l'URL:
        if(isset($_GET['modifier'])){
            ?>
            <br><br>
            <h1>Modification du compte</h1>
            <hr /><br>
            Choisissez une option: 
            <p>
                <b><a href="espace-membre.php?modifier=mail">Modifier mon adresse mail</a></b>
                <br>
                <b><a href="espace-membre.php?modifier=mdp">Modifier le mot de passe</a></b>
            </p>
            
            <?php
            if($_GET['modifier']=="mail"){
                echo "<p>Renseignez le formulaire ci-dessous pour modifier vos informations:</p>";
                if(isset($_POST['valider'])){
                    if(!isset($_POST['mail'])){
                        echo "Le champ mail n'est pas reconnu.";
                    } else {
                        if(!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,30}$#i",$_POST['mail'])){
                            //cette preg_match est un petit peu complexe, je vous invite à regarder l'explication détaillée sur mon site c2script.com
                            echo "L'adresse mail est incorrecte.";
                            //normalement l'input type="email" vérifie que l'adresse mail soit correcte avant d'envoyer le formulaire mais il faut toujours être prudent et vérifier côté serveur (ici) avant de valider définitivement
                        } else {
                            //tout est OK, on met à jours son compte dans la base de données:
                            if(mysqli_query($mysqli,"UPDATE membres SET mail='".htmlentities($_POST['mail'],ENT_QUOTES,"UTF-8")."' WHERE pseudo='$Pseudo'")){
                                echo "Adresse mail {$_POST['mail']} modifiée avec succès!";
                                $TraitementFini=true;//pour cacher le formulaire
                            } else {
                                echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
                                //echo "<br>Erreur retournée: ".mysqli_error($mysqli);
                            }
                        }
                    }
                }
                if(!isset($TraitementFini)){
                    ?>
                    <br>
                    <form method="post" action="espace-membre.php?modifier=mail">
                        <input type="email" name="mail" value="<?php echo $info['mail']; ?>" required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
                        <input type="submit" name="valider" value="Valider la modification">
                    </form>
                    <?php
                }
            } elseif($_GET['modifier']=="mdp"){
                echo "<p>Renseignez le formulaire ci-dessous pour modifier vos informations:</p>";
                //si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
                if(isset($_POST['valider'])){
                    //vérifie si tous les champs sont bien pris en compte:
                    if(!isset($_POST['nouveau_mdp'],$_POST['confirmer_mdp'],$_POST['mdp'])){
                        echo "Un des champs n'est pas reconnu.";
                    } else {
                        if($_POST['nouveau_mdp']!=$_POST['confirmer_mdp']){
                            echo "Les mots de passe ne correspondent pas.";
                        } else {
                            $Mdp=md5($_POST['mdp']);
                            $NouveauMdp=md5($_POST['nouveau_mdp']);
                            $req=mysqli_query($mysqli,"SELECT * FROM membres WHERE pseudo='$Pseudo' AND mdp='$Mdp'");
                            //on regarde si le mot de passe correspond à son compte:
                            if(mysqli_num_rows($req)!=1){
                                echo "Mot de passe actuel incorrect.";
                            } else {
                                //tout est OK, on met à jours son compte dans la base de données:
                                if(mysqli_query($mysqli,"UPDATE membres SET mdp='$NouveauMdp' WHERE pseudo='$Pseudo'")){
                                    echo "Mot de passe modifié avec succès!";
                                    $TraitementFini=true;//pour cacher le formulaire
                                } else {
                                    echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
                                    //echo "<br>Erreur retournée: ".mysqli_error($mysqli);
                                }
                            }
                        }
                    }
                }
                if(!isset($TraitementFini)){
                    ?>
                    <br>
                    <form method="post" action="espace-membre.php?modifier=mdp">
                        <input type="password" name="mdp" placeholder="Votre mot de passe actuel..." required>
                        <input type="password" name="nouveau_mdp" placeholder="Nouveau mot de passe..." required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
                        <input type="password" name="confirmer_mdp" placeholder="Confirmer nouveau passe..." required>
                        <input type="submit" name="valider" value="Valider la modification">
                    </form>
                    <?php
                }
            }
        }
        ?>
    </body>
    </html>