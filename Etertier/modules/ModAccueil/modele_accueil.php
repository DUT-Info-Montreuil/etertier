<?php 

require_once "connexion.php";
class ModeleAccueil extends Connexion{

    public function __construct() {

    }

    public function get_liste_articles_recents(){
		$selecPrepare = self::$bdd->prepare('SELECT idArticle, nom FROM articles ORDER BY date DESC LIMIT 5');
		$selecPrepare->execute();
		$tab = $selecPrepare->fetchall();
		return $tab;
	}

    public function get_liste_tierlists_recents(){
		$selecPrepare = self::$bdd->prepare('SELECT idListe, titre FROM listes ORDER BY dateCreation DESC LIMIT 5');
		$selecPrepare->execute();
		$tab = $selecPrepare->fetchall();
		return $tab;
	}
}


?>