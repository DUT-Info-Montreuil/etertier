<?php



require_once"vue_generique.php";
class VueJeux extends VueGenerique{
	public function __construct () {
		parent::__construct();
	}



	public function afficherListe($tab){
		echo '<h3>Liste des jeux:</h3>';
		foreach($tab as $cle=>$val){
			echo '<p> - <a href="index.php?module=jeux&action=details&id=' . $val['idJeu'] . '">' . $val['nomJeu'] . '</a></p>';
		}
	}

	public function afficherListeParGenre($genre, $tab){
		if(isset($genre)){
			echo '<h3>Liste des jeux de '. $genre .':</h3>';
			foreach($tab as $cle=>$val){
				echo '<p> - <a href="index.php?module=jeux&action=details&id=' . $val['idJeu'] . '">' . $val['nomJeu'] . '</a></p>';
			}
		}	
		else{
			$this->afficher_erreur();
		}

		echo '<p><a href=\'index.php?module=jeux\'><i class="fa-solid fa-arrow-left"></i> Retour à la liste de tout les jeux.</a></p>';
	}

	public function afficherDetails($tab, $genres){
		if(isset($tab)){
			if(isset($tab['image']) && strlen($tab['image'])!=0 && file_exists('ressources/jeux/' . $tab['image'])){
				echo '<img src=\'ressources/jeux/' . $tab['image'] . '\'/>';
			}
			echo '<h3>' . $tab['nomJeu'] . '</h3>';

			echo '<p>Genres: ';

			foreach($genres as $cle=>$val){
				echo '<a href="index.php?module=jeux&action=genre&genre=' . $val['idGenre'] . '">' . $val['nomGenre'] . '</a>  ';
			}

			echo '<p>Date de sortie : ' . $tab['dateSortie'] . '</p>';
			echo '<p>' . $tab['description'] . '</p>';
		}
		else{
			$this->afficher_erreur();
		}

		echo '<p><a href=\'index.php?module=jeux\'><i class="fa-solid fa-arrow-left"></i> Retour à la liste des jeux.</a></p>';
	}

	public function afficher_erreur(){
		echo '<p>Erreur, cette page n\'existe pas.</p>';
	}
}



?>