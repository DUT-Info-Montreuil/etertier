<?php

require_once "modules/ModPageAvecCommentaires/modele_pageAvecCommentaires.php";
class ModeleListes extends ModelePageAvecCommentaires{
	public function __construct(){

	}

	public function get_liste(){
		$selecPrepare = self::$bdd->prepare('SELECT listes.idListe, listes.titre, listes.dateCreation, membres.login, membres.id FROM listes INNER JOIN membres ON membres.id = listes.auteur WHERE listes.public = 1');
		$selecPrepare->execute();
		$tab = $selecPrepare->fetchall();
		return $tab;
	}

	public function get_details(){
		if(isset($_GET['id'])){
			$t = array($_GET['id']);
			$selecPrepare = self::$bdd->prepare('SELECT listes.titre, listes.dateCreation, membres.login, membres.id FROM listes INNER JOIN membres ON membres.id = listes.auteur WHERE idListe=? AND public = 1');
			$selecPrepare->execute($t);
			$tab = $selecPrepare->fetchall();
			if(isset($tab[0])){
				return $tab[0];
			}
		}
		
		return NULL;
		
	}

	public function get_classement(){
		if(isset($_GET['id'])){
			$t = array($_GET['id']);
			$selecPrepare = self::$bdd->prepare('SELECT jeuDansListe.idJeu, jeuDansListe.classement, jeux.* FROM jeuDansListe INNER JOIN jeux ON jeuDansListe.idJeu = jeux.idJeu WHERE idListe=? ORDER BY classement ASC');
			$selecPrepare->execute($t);
			$tab = $selecPrepare->fetchall();
			if(isset($tab)){
				return $tab;
			}
		}
		
		return NULL;
		
	}
}
?>