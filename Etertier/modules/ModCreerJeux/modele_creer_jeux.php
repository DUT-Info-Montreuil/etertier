<?php

require_once "connexion.php";
class ModeleCreerJeux extends Connexion{
	public function __construct(){

	}


	public function ajouterJeu() {
		$t=array($_POST['nomNewJeu'], $_POST['dateNewJeu'], $_POST['descriNewJeu']);
		$selecPrepare = self::$bdd->prepare('INSERT INTO jeux VALUES (?, ?, ?, NULL)');
        $selecPrepare->execute($t);
	}

}

?>