<?php

if (isset($_POST['confirmer'])){
	if (!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
		$pseudo =  htmlspecialchars($_POST['pseudo']);
		$mdp = sha1($_POST['mdp']);
		$insertUser = $bdd->prepare('INSERT INTO users(pseudo, mdp)VALUES(?, ?)');
		$insertUser->execute(array($pseudo, $mdp));

	} else {
		echo "Veuillez compléter tous les champs pour poursuivre l'inscription";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<meta charset="UTF-8" >
	
</head>
<body>

	<form method="POST" action="" align="center">

		<h1>Inscription</h1>
		<div class="icon">
        	<i class="fas fa-user-circle"></i>
      	</div>
      	<div class="formcontainer">
      	<div class="container">
        	<label for="pseudo"> <strong>Pseudo</strong> </label>
			<input type="text" name="pseudo" autocomplete="off" placeholder="Entrez votre pseudo">
			<label for="psw"><strong>Mot de passe</strong></label>
			<input type="password" name="mdp" autocomplete="off" placeholder="Entrez votre mot de passe">
		</div>
		<button type="submit" name="confirmer"> <strong>S'inscrire</strong> </button>
		<div class="container" style="background-color: #eee">
        	<label style="padding-left: 10px">
        	</label>
        	<span class="psw"><a href="#">Mot de passe oublié?</a></span>
      	</div>
	</form>

</body>
</html>



