<?php

require_once "modules/ModPageAvecCommentaires/vue_pageAvecCommentaires.php";
class VueArticle extends VuePageAvecCommentaires{
	public function __construct () {
		parent::__construct();
	}

	public function afficher_liste($tab){
		echo '<h2 class="text-center text-uppercase m-4">Les Articles :</h2>';
		foreach($tab as $cle=>$val){
			echo '<div class="d">
				<p class="text-center">
					<a class="nav-link" href="index.php?module=article&action=details&id=' . $val['idArticle'] . '">' . $val['nom'] . '</a>
				</p>
				<p class="text-center">'."écrit par <a href=index.php?module=pageuser&id=".$val['idAuteur'].">".$val['login']."</a> le ".$val['date'].'</p>
			</div>';
		}

		if(isset($_SESSION['login']) && isset($_SESSION['redacteur']) && $_SESSION['redacteur']==1){
			echo '<div class="d">
				<p class="text-center"><a class="nav-link" href="index.php?module=listes&action=details&id=' . $val['idListe'] . '">' . $val['titre'] . '</a> par ' . $val['login'] . ' le ' . $val['dateCreation'] . '.</p>
			</div>';
		}
	}

	public function afficher_details($tab){
		if(isset($tab)){
			echo '<h2 class="text-center text-uppercase m-4">' . $tab['nom'] . '</h2><p class="com">' . $tab['texte'] . '</p>';
		}
		else{
			$this->afficher_erreur();
		}
    }

	public function afficher_erreur(){
		echo '<p>Erreur !</p>';
	}

	public function form_redac() {
		?>
		<h3>Rédaction d'un article :</h3>
		<form action="index.php?module=article&action=redige" method="post">
			<p>Titre de l'article : <input type="text" name="titreArticle" /></p>
			<p>Texte de l'article : <textarea name="texteArticle"></textarea></p>
			<p><input type="submit" value="Ajouter"></p>
		</form>
		<?php	
	}
}



?>