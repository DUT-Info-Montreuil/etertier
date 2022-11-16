<?php

require_once "connexion.php";
class ModelePageAvecCommentaires extends Connexion{
    public function __construct () {
        parent::__construct();
    }

    public function get_commentaire($nomtable){

		$t = array($_GET['id']);
		$requete = 'SELECT ' . $nomtable . '.*, membres.login FROM ' . $nomtable . ' INNER JOIN membres ON ' . $nomtable . '.idAuteur = membres.id WHERE ' . $nomtable . '.idOrigine = ? ORDER BY ' . $nomtable . '.date ASC';
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		return $tab;
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
}

?>