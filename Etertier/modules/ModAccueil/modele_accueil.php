<?php 

require_once "connexion.php";
class ModeleAccueil extends Connexion{

    public function __construct() {

    }

    public function get_liste_articles_recents(){
		$selecPrepare = self::$bdd->prepare('SELECT articles.idArticle, articles.nom, articles.idAuteur, articles.date, membres.login FROM articles INNER JOIN membres ON membres.id = articles.idAuteur  ORDER BY articles.date DESC LIMIT 5');

		$selecPrepare->execute();
		$tab = $selecPrepare->fetchall();
		return $tab;
	}

    public function get_liste_tierlists_recents(){
		$selecPrepare = self::$bdd->prepare('SELECT idListe, titre FROM listes ORDER BY dateCreation DESC LIMIT 5');
		$selecPrepare = self::$bdd->prepare('SELECT listes.idListe, listes.titre, listes.dateCreation, membres.login, membres.id FROM listes INNER JOIN membres ON membres.id = listes.auteur WHERE listes.public = 1 ORDER BY listes.dateCreation DESC LIMIT 5');
		$selecPrepare->execute();
		$tab = $selecPrepare->fetchall();
		return $tab;
	}
}


?>