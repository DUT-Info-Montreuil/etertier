<?php

require_once "modules/ModPageAvecCommentaires/modele_pageAvecCommentaires.php";
class ModeleArticle extends ModelePageAvecCommentaires{
	public function __construct(){

	}

	public function get_liste(){
		$selecPrepare = self::$bdd->prepare('SELECT articles.idArticle, articles.nom, articles.idAuteur, articles.date, membres.login FROM articles INNER JOIN membres ON membres.id = articles.idAuteur');
		$selecPrepare->execute();
		$tab = $selecPrepare->fetchall();
		return $tab;
	}

	public function get_details(){
		if(isset($_GET['id'])){
			$t = array($_GET['id']);
			$selecPrepare = self::$bdd->prepare('SELECT articles.nom, articles.texte, articles.date, membres.login, membres.id FROM articles INNER JOIN membres ON membres.id = articles.idAuteur  WHERE idArticle=?');
			$selecPrepare->execute($t);
			$tab = $selecPrepare->fetchall();
			if(isset($tab[0])){
				return $tab[0];
			}
		}
		
		return NULL;
		
	}

	public function redige() {
		$l = array($_SESSION["login"]);
		$selecPrepare1 = self::$bdd->prepare('SELECT id, redacteur FROM membres where login = ?');
		$selecPrepare1->execute($l);
		$membre = $selecPrepare1->fetchall();
		if(isset($_POST["titreArticle"]) && isset($_POST["texteArticle"]) && strlen($_POST["titreArticle"])>0 && strlen($_POST["texteArticle"])>0 && isset($membre[0]['redacteur']) && $membre[0]['redacteur']==1){
			$t = array($membre[0]['id'], $_POST["titreArticle"], $_POST["texteArticle"]);
			$selecPrepare2 = self::$bdd->prepare('INSERT INTO articles(idAuteur, nom, texte, date) VALUES (?,?,?, NOW())');
			$selecPrepare2->execute($t);

			$t2 = array($membre[0]['id'], $_POST["titreArticle"]);
            $selecPrepare3 = self::$bdd->prepare('SELECT idArticle FROM articles WHERE idAuteur=? AND nom=? ORDER BY articles.date DESC');
            $selecPrepare3->execute($t2);
            $article = $selecPrepare3->fetchall();

			header('Location: index.php?module=article&action=details&id='.$article[0]['idArticle']);
            exit();
		}
		return NULL;
	}
}
?>