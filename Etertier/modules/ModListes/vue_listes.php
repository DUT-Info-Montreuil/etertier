<?php

require_once"vue_generique.php";
class VueListes extends VueGenerique{
	public function __construct () {
		parent::__construct();
	}

	public function afficher_liste($tab){
		echo '<h2>Les Listes :</h2>';
		foreach($tab as $cle=>$val){
			echo '<p><a href="index.php?module=listes&action=details&id=' . $val['idListe'] . '">' . $val['titre'] . '</a> par ' . $val['login'] . ' le ' . $val['dateCreation'] . '.</p>';
		}
	}

	public function afficher_details($tab, $classement){
		if(isset($tab)){
			echo '<h2>' . $tab['titre'] . '</h2><p>par ' . $tab['login'] . ' le ' . $tab['dateCreation'] . '.</p><ul>';

			foreach($classement as $cle=>$val){
				echo "<li> " . $val['classement'] . ". <a href=\"index.php?module=jeuxListe&action=details&id=" . $val['idJeu'] . "&liste=" . $_GET['id'] . "\">";
				echo $val['nomJeu'];
				echo "</a></li>";			
			}
			echo "</ul>";
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