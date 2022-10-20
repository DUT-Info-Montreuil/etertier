<?php

require_once "connexion.php";
class ModeleMenu extends Connexion{
	public function __construct(){

	}

	public function get_genres(){
		$selecPrepare = self::$bdd->prepare('SELECT* FROM genres');
		$selecPrepare->execute();
		$tab = $selecPrepare->fetchall();
		return $tab;
	}
}
?>