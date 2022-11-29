<?php

class annonce
{
    public $bdd;
    public function __construct(){
        $this->bdd = new PDO('mysql:host=localhost;dbname=AMAC;charset=utf8', 'root', ''); #connexion à la base de donnée
    }

    public function nouvelle_annonce($titre, $contenu) {

    if (empty($titre) or empty($contenu)) { # Si jamais il manque un argument, la fonction ne s'exécute pas
    echo "il manque un argument";
    return;
    //créer un else..

    }
        $this->bdd->exec("INSERT INTO annonce(titre, contenu) VALUES('$titre', '$contenu')");
    }

    public function lire()
    {
        $annonces = $this->bdd->query('SELECT titre, contenu from annonce'); #recuperation
        return $annonces->fetchAll(\PDO::FETCH_ASSOC); #transformation en liste
    }
}

?>