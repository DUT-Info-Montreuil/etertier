<?php

require_once "connexion.php";
class ModeleCreerJeux extends Connexion{
	public function __construct(){

	}


	public function ajouterJeu() {
		$t=array($_POST['nomNewJeu'], $_POST['dateNewJeu'], $_POST['descriNewJeu']);
		$selecPrepare = self::$bdd->prepare('INSERT INTO jeux(nomJeu, dateSortie, description, image) VALUES (?, ?, ?, "")');
        $selecPrepare->execute($t);

		// $selecPrepare2 = self::$bdd->prepare('SELECT idJEU FROM jeux where nomJeu = ? AND dateSortie = ? AND description=?');
		// $selecPrepare2->execute($t);
		// $id = $selecPrepare2->fetch();

		//header('Location: index.php?module=jeux&action=details&id='.$id);
	}

}

?>