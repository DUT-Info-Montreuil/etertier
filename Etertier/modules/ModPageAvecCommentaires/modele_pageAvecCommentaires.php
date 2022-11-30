<?php

require_once "connexion.php";
class ModelePageAvecCommentaires extends Connexion{
    public function __construct () {
        parent::__construct();
    }

    public function get_commentaire($nomtable, $tableLike){

		$t = array($_GET['id']);
		
		$requete = 'SELECT ' . $nomtable . '.*, membres.login FROM ' . $nomtable . ' INNER JOIN membres ON ' . $nomtable . '.idAuteur = membres.id WHERE ' . $nomtable . '.idOrigine = ? ORDER BY ' . $nomtable . '.date ASC';
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		$comm = array();
		foreach($tab as $cle=>$val){
			$ligne = array();
			foreach($val as $cle2=>$attribut){
				$ligne[$cle2] = $attribut;
			}
			$ligne['nbLike'] = $this->get_nb_like_com($tableLike, $val['idCommentaire']);
			$ligne['nbDislike'] = $this->get_nb_dislike_com($tableLike, $val['idCommentaire']);
			$ligne['isLiked'] = $this->is_liked_com($tableLike, $val['idCommentaire']);

			$comm[] = $ligne;
		}
		return $comm;
	}

	public function get_nb_like($nomtable){
		$t = array($_GET['id']);
		$requete = 'SELECT count(likeDislike) as nbLike from like_' . $nomtable . ' where idOrigine = ? and likeDislike = 1' ;
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		return $tab;
	} 

	public function get_nb_dislike($nomtable){

		$t = array($_GET['id']);	
		$requete = 'SELECT count(likeDislike) as nbDislike from like_' . $nomtable . ' where idOrigine = ? and likeDislike = 0' ;
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		return $tab;
	} 

	public function is_liked($nomtable){
		$s = array($_SESSION['login']);
		$idMembreCo ='SELECT id FROM membres where login = ?';
		$selecPrepare = self::$bdd->prepare($idMembreCo);
		$selecPrepare->execute($s);
		$tab = $selecPrepare->fetchall();
		$t = array($_GET['id'], $tab[0]['id']);
		$requete = 'SELECT likeDislike from ' . 'like_' . $nomtable . ' where idOrigine = ? and idMembres = ?' ;
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		if(isset($tab[0])){
			return $tab[0]['likeDislike'];
		}
		return NULL;
	}

	public function get_nb_like_com($nomtable, $id){
		$t = array($id);
		$requete = 'SELECT count(likeDislike) as nbLike from like_com_' . $nomtable . ' where idComOrigine = ? and likeDislike = 1' ;
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		return $tab;
	} 

	public function get_nb_dislike_com($nomtable, $id){
		$t = array($id);
		$requete = 'SELECT count(likeDislike) as nbDislike from like_com_' . $nomtable . ' where idComOrigine = ? and likeDislike = 0' ;
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		return $tab;
	} 

	
	public function is_liked_com($nomtable, $id){
		if(isset($_SESSION['login'])){
			$s = array($_SESSION['login']);
			$idMembreCo ='SELECT id FROM membres where login = ?';
			$selecPrepare = self::$bdd->prepare($idMembreCo);
			$selecPrepare->execute($s);
			$tab = $selecPrepare->fetchall();
			$t = array($id, $tab[0]['id']);
			$requete = 'SELECT likeDislike from ' . 'like_com_' . $nomtable . ' where idComOrigine = ? and idMembres = ?' ;
			$selecPrepare = self::$bdd->prepare($requete);
			$selecPrepare->execute($t);
			$tab = $selecPrepare->fetchall();
			if(isset($tab[0])){
				return $tab[0]['likeDislike'];
			}
		}
		return NULL;
	}

	public function ajouter_commentaire($nomtable){
		if(isset($_POST["texteCommentaire"]) && strlen($_POST["texteCommentaire"])>0){
			$l = array($_SESSION["login"]);
			$selecPrepare1 = self::$bdd->prepare('SELECT id FROM membres where login = ?');
			$selecPrepare1->execute($l);
			$membre = $selecPrepare1->fetchall();
			if(isset($membre[0])){
				$t = array($_GET['id'], $membre[0]['id'], $_POST["texteCommentaire"]);
				$requete = 'INSERT INTO ' . $nomtable . '(idOrigine, idAuteur, texte, date) VALUES (?,?,?, NOW())';
				$selecPrepare2 = self::$bdd->prepare($requete);
				$selecPrepare2->execute($t);

				header('Location: index.php?module='. $_GET['module'] .'&action=details&id='.$_GET['id']);
				exit();
			}
		}
		else{
			return "zebi il est où le message";
		}
		return "Erreur lors de l'envoie du commentaire.";
	}

	public function liker($nomTable){
		$s = array($_SESSION['login']);
		$idMembreCo ='SELECT id FROM membres where login = ?';
		$selecPrepare = self::$bdd->prepare($idMembreCo);
		$selecPrepare->execute($s);
		$tab = $selecPrepare->fetchall();
		$t = array($_GET['id'], $tab[0]['id']);
		$requete ='DELETE from ' . 'like_' . $nomTable . ' where idOrigine = ? and idMembres = ?';
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		$requete ='INSERT INTO ' . 'like_' . $nomTable . '(likeDislike, idOrigine, idMembres) VALUES (1,?,?)' ;
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		header('Location: index.php?module='.$_GET['module'].'&action=details&id='. $_GET['id']);
		exit();
	}

	public function disliker($nomTable){
		$s = array($_SESSION['login']);
		$idMembreCo ='SELECT id FROM membres where login = ?';
		$selecPrepare = self::$bdd->prepare($idMembreCo);
		$selecPrepare->execute($s);
		$tab = $selecPrepare->fetchall();
		$t = array($_GET['id'], $tab[0]['id']);
		$requete ='DELETE from ' . 'like_' . $nomTable . ' where idOrigine = ? and idMembres = ?';
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		$requete ='INSERT INTO ' . 'like_' . $nomTable . '(likeDislike, idOrigine, idMembres) VALUES (0,?,?)' ;
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		header('Location: index.php?module='.$_GET['module'].'&action=details&id='. $_GET['id']);
		exit();
	}

	public function enlever($nomTable){
		$s = array($_SESSION['login']);
		$idMembreCo ='SELECT id FROM membres where login = ?';
		$selecPrepare = self::$bdd->prepare($idMembreCo);
		$selecPrepare->execute($s);
		$tab = $selecPrepare->fetchall();
		$t = array($_GET['id'], $tab[0]['id']);
		$requete ='DELETE from ' . 'like_' . $nomTable . ' where idOrigine = ? and idMembres = ?';
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		header('Location: index.php?module='.$_GET['module'].'&action=details&id='. $_GET['id']);
		exit();
	}



	public function liker_com($nomTable){
		$s = array($_SESSION['login']);
		$idMembreCo ='SELECT id FROM membres where login = ?';
		$selecPrepare = self::$bdd->prepare($idMembreCo);
		$selecPrepare->execute($s);
		$tab = $selecPrepare->fetchall();
		$t = array($_GET['com'], $tab[0]['id']);
		$requete ='DELETE from ' . 'like_com_' . $nomTable . ' where idComOrigine = ? and idMembres = ?';
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		$requete ='INSERT INTO ' . 'like_com_' . $nomTable . '(likeDislike, idComOrigine, idMembres) VALUES (1,?,?)' ;
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		header('Location: index.php?module='.$_GET['module'].'&action=details&id='. $_GET['id'] . '#com' . $_GET['com']);
		exit();
	}

	public function disliker_com($nomTable){
		$s = array($_SESSION['login']);
		$idMembreCo ='SELECT id FROM membres where login = ?';
		$selecPrepare = self::$bdd->prepare($idMembreCo);
		$selecPrepare->execute($s);
		$tab = $selecPrepare->fetchall();
		$t = array($_GET['com'], $tab[0]['id']);
		$requete ='DELETE from ' . 'like_com_' . $nomTable . ' where idComOrigine = ? and idMembres = ?';
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		$requete ='INSERT INTO ' . 'like_com_' . $nomTable . '(likeDislike, idComOrigine, idMembres) VALUES (0,?,?)' ;
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		header('Location: index.php?module='.$_GET['module'].'&action=details&id='. $_GET['id'] . '#com' . $_GET['com']);
		exit();
	}

	public function enlever_com($nomTable){
		$s = array($_SESSION['login']);
		$idMembreCo ='SELECT id FROM membres where login = ?';
		$selecPrepare = self::$bdd->prepare($idMembreCo);
		$selecPrepare->execute($s);
		$tab = $selecPrepare->fetchall();
		$t = array($_GET['com'], $tab[0]['id']);
		$requete ='DELETE from ' . 'like_com_' . $nomTable . ' where idComOrigine = ? and idMembres = ?';
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);		
		header('Location: index.php?module='.$_GET['module'].'&action=details&id='. $_GET['id'] . '#com' . $_GET['com']);
		exit();
	}


}

?>