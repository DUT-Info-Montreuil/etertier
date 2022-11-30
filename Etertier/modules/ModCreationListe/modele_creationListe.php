<?php

require_once "connexion.php";
class ModeleCreationListe extends Connexion{
	public function __construct(){

	}


	public function getListe(){
		if(isset($_SESSION['login'])){
            $t = array($_SESSION['login']);
            $selecPrepare = self::$bdd->prepare('SELECT id FROM membres WHERE login=?');
            $selecPrepare->execute($t);
            $tab1 = $selecPrepare->fetchall();
            if(!isset($tab1[0])){
                return NULL;
            }

			$t = array($tab1[0]['id']);
            $selecPrepare = self::$bdd->prepare('SELECT * FROM listes WHERE auteur=? AND public=0');
            $selecPrepare->execute($t);
            $tab2 = $selecPrepare->fetchall();

			if(isset($tab2[0])){
                return $tab2[0];
            }
			return $this->nouvelleListe($tab1[0]['id']);
        }

		return NULL;
	}

	public function nouvelleListe($id){
		
		$t = array($id);
		$selecPrepare = self::$bdd->prepare('INSERT INTO listes(auteur, titre, public) VALUES(?,"Nouvelle liste",0)');
		$selecPrepare->execute($t);

		$selecPrepare = self::$bdd->prepare('SELECT * FROM listes WHERE auteur=? AND public=0');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		if(!isset($tab[0])){
			return NULL;
		}
		return $tab[0];

	}

	public function getJeuxListe($id){
		if(isset($id)){
			$t = array($id);
			$selecPrepare = self::$bdd->prepare('SELECT jeuDansListe.classement, jeux.* FROM jeuDansListe INNER JOIN jeux ON jeuDansListe.idJeu = jeux.idJeu WHERE jeuDansListe.idListe = ? ORDER BY jeuDansListe.classement ASC');
			$selecPrepare->execute($t);
			$tab = $selecPrepare->fetchall();
			return $tab;
		}
		return NULL;
	}

	public function getGenres(){
		$selecPrepare = self::$bdd->prepare('SELECT * FROM genres ORDER BY nomGenre');
		$selecPrepare->execute();
		$tab = $selecPrepare->fetchall();
		return $tab;
	}


	public function getJeuxParGenre($idGenre){
		$t = array($idGenre, $_POST['idListe']);
		$selecPrepare = self::$bdd->prepare('SELECT jeux.idJeu, jeux.nomJeu, jeux.image FROM jeux INNER JOIN genres_de_jeux ON genres_de_jeux.idJeu = jeux.idJeu WHERE idGenre=? AND jeux.idJeu NOT IN (SELECT idJeu FROM jeuDansListe WHERE idListe=?) ORDER BY jeux.nomJeu');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		
		return $tab;
	}

	public function ajouterJeu(){

		$t = array($_SESSION['login']);
		$selecPrepare = self::$bdd->prepare('SELECT id FROM membres WHERE login=?');
		$selecPrepare->execute($t);
		$tab1 = $selecPrepare->fetchall();
		if(!isset($tab1[0])){
			return NULL;
		}

		$t = array($tab1[0]['id']);
		$selecPrepare = self::$bdd->prepare('SELECT * FROM listes WHERE auteur=? AND public=0');
		$selecPrepare->execute($t);
		$tab2 = $selecPrepare->fetchall();
		if(!isset($tab2[0])){
			return NULL;
		}

		$t = array($tab2[0]['idListe']);
		$selecPrepare = self::$bdd->prepare('SELECT MAX(classement) AS max FROM jeuDansListe WHERE idListe=?');
		$selecPrepare->execute($t);
		$tab3 = $selecPrepare->fetchall();
		if(!isset($tab3[0])){
			$t = array($tab2[0]['idListe'],$_GET['id'], 1);
		}
		else{
			$t = array($tab2[0]['idListe'],$_GET['id'], ($tab3[0]['max']+1));
		}

		$selecPrepare = self::$bdd->prepare('INSERT INTO jeuDansListe(idListe, idJeu, classement) VALUES(?,?,?)');
		$selecPrepare->execute($t);
	}

	public function updateName(){
		$t = array($_POST['nomListe'], $_POST['idListe']);
		$selecPrepare = self::$bdd->prepare('UPDATE listes SET titre = ? WHERE idListe = ?');
		$selecPrepare->execute($t);
	}


	public function intervertir(){
		//On récupère le classement du jeu qu'on veux bouger
		$t = array($_GET['idJeu'], $_POST['idListe']);
		$selecPrepare = self::$bdd->prepare('SELECT classement FROM jeuDansListe WHERE idJeu = ? AND idListe = ?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();

		//On change le classement du jeu au dessus
		$t = array($tab[0]['classement'], $tab[0]['classement']-1, $_POST['idListe']);
		$selecPrepare = self::$bdd->prepare('UPDATE jeuDansListe SET classement=? WHERE classement = ? AND idListe = ?');
		$selecPrepare->execute($t);

		//Et on change le classement du jeu
		$t = array($tab[0]['classement']-1, $_GET['idJeu'], $_POST['idListe']);
		$selecPrepare = self::$bdd->prepare('UPDATE jeuDansListe SET classement=? WHERE idJeu = ? AND idListe = ?');
		$selecPrepare->execute($t);
	}

	public function supprimer(){
		//On récupère le classement du jeu qu'on veux supprimer
		$t = array($_GET['id'], $_POST['idListe']);
		$selecPrepare = self::$bdd->prepare('SELECT classement FROM jeuDansListe WHERE idJeu = ? AND idListe = ?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();

		//On supprime le jeu
		$selecPrepare = self::$bdd->prepare('DELETE FROM jeuDansListe WHERE idJeu = ? AND idListe = ?');
		$selecPrepare->execute($t);

		//On fait remonter dans le classement tout les jeux qui étaient après
		$t = array($_POST['idListe'], $tab[0]['classement']);
		$selecPrepare = self::$bdd->prepare('UPDATE jeuDansListe SET classement=classement-1 WHERE idListe=? AND classement>?');
		$selecPrepare->execute($t);

	}

	public function toutSupprimer(){
				$t = array($_POST['idListe']);
				$selecPrepare = self::$bdd->prepare('DELETE FROM jeuDansListe WHERE idListe = ?');
				$selecPrepare->execute($t);
				$selecPrepare = self::$bdd->prepare('DELETE FROM listes WHERE idListe = ?');
				$selecPrepare->execute($t);
	}

	public function poster(){
		$t = array($_POST['idListe']);
		$selecPrepare = self::$bdd->prepare('UPDATE listes SET public=1, dateCreation=NOW() WHERE idListe = ?');
		$selecPrepare->execute($t);
	}

}

?>