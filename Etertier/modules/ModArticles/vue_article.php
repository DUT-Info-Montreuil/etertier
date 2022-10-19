<?php

require_once"vue_generique.php";
class VueArticle extends VueGenerique{
	public function __construct () {
		parent::__construct();
	}

	public function afficher_liste($tab){
		echo '<h2>Les Articles :</h2>';
		foreach($tab as $cle=>$val){
			echo '<p><a href="index.php?module=article&action=details&id=' . $val['idArticle'] . '">' . $val['nom'] . '</a></p>';
		}
	}

	public function afficher_details($tab){
		if(isset($tab)){
			echo '<h2>' . $tab['nom'] . '</h2><p>' . $tab['texte'] . '</p>';
		}
		else{
			$this->afficher_erreur();
		}
    }

	public function afficher_erreur(){
		echo '<p>Erreur !</p>';
	}
}



?>