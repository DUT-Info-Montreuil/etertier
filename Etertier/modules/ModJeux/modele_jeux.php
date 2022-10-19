<?php

require_once "connexion.php";
class ModeleJeux extends Connexion{
	public function __construct(){

	}



public function getListe(){
	$selecPrepare = self::$bdd->prepare('SELECT idJeu, nomJeu FROM jeux');
	$selecPrepare->execute();
	$tab = $selecPrepare->fetchall();
	return $tab;
}


public function getListeParGenre(){
	if(isset($_GET['genre'])){
		$t = array($_GET['genre']);
		$selecPrepare = self::$bdd->prepare('SELECT jeux.idJeu, jeux.nomJeu FROM jeux INNER JOIN genres_de_jeux ON genres_de_jeux.idJeu = jeux.idJeu WHERE idGenre=?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		
		return $tab;
	}
	
	return NULL;
	
}

public function getGenre(){
	if(isset($_GET['genre'])){
		$t = array($_GET['genre']);
		$selecPrepare = self::$bdd->prepare('SELECT nomGenre FROM genres WHERE idGenre=?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		
		if(isset($tab[0]['nomGenre'])){
			return $tab[0]['nomGenre'];
		}
	}
	return NULL;
	
}

public function getDetails(){
	if(isset($_GET['id'])){
		$t = array($_GET['id']);
		$selecPrepare = self::$bdd->prepare('SELECT * FROM jeux WHERE idJeu=?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		if(isset($tab[0])){
			return $tab[0];
		}
	}
	
	return NULL;
	
}

public function getGenreDeJeu(){
	if(isset($_GET['id'])){
		$t = array($_GET['id']);
		$selecPrepare = self::$bdd->prepare('SELECT genres_de_jeux.idGenre, genres.nomGenre FROM genres_de_jeux INNER JOIN genres ON genres_de_jeux.idGenre = genres.idGenre WHERE idJeu=?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		
		return $tab;
	}
	
	return NULL;
	
}

}

?>