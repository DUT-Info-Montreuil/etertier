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
					<div class=center>
				<p class="text-center">
					<a href="index.php?module=article&action=details&id=' . $val['idArticle'] . '">' . $val['nom'] . '</a>
				</p>
				<p class="text-center">'."écrit par <a href=index.php?module=pageuser&id=".$val['idAuteur'].">".$val['login']."</a> le ".$val['date'].'</p>
				</div>
			</div>';
		}

		if(isset($_SESSION['login']) && isset($_SESSION['redacteur']) && $_SESSION['redacteur']==1){
			echo '<p><a href="index.php?module=article&action=redaction"> Rédiger un article. </a></p>';
		}
	}

	public function afficher_details($tab){
		if(isset($tab)){
			echo '<h2 class="text-center text-uppercase m-4">' . $tab['nom'] . '</h2><div><p>par <a href=index.php?module=pageuser&id='.$tab['id'].'>'.$tab['login'].'</a> le ' . $tab['date'] . '.</p></div><ul>';
			echo '<p class="com">' . htmlspecialchars($tab['texte']) . '</p>';
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
		<div class="formulaire">
		<form action="index.php?module=article&action=redige" method="post">
			<p class="text_form">Titre de l'article : <input type="text" name="titreArticle" /></p>
			<p class="text_form">Texte de l'article : <textarea name="texteArticle"></textarea></p>
			<p><input type="submit" value="Ajouter"></p>
		</form>
	</div>
		<?php	
	}
}



?>