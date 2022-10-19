<?php

require_once "connexion.php";
class ModeleArticle extends Connexion{
	public function __construct(){

	}

	public function get_liste(){
		$selecPrepare = self::$bdd->prepare('SELECT idArticle, nom FROM articles');
		$selecPrepare->execute();
		$tab = $selecPrepare->fetchall();
		return $tab;
	}

	public function get_details(){
		if(isset($_GET['id'])){
			$t = array($_GET['id']);
			$selecPrepare = self::$bdd->prepare('SELECT nom, texte FROM articles WHERE idArticle=?');
			$selecPrepare->execute($t);
			$tab = $selecPrepare->fetchall();
			if(isset($tab[0])){
				return $tab[0];
			}
		}
		
		return NULL;
		
	}
}
?>