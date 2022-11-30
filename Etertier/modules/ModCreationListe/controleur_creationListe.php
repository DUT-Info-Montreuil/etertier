<?php

class ControleurCreationListe{

	public $vue;
	private $modele;

	private $action;

	public function __construct(){
		require_once "vue_creationListe.php";
		$this->vue = new VueCreationListe();
		require_once "modele_creationListe.php";
		$this->modele = new ModeleCreationListe();


		if(isset($_GET['action'])){
			$this->action = $_GET['action'];
		}
	}

	public function creationListe(){
		$liste = $this->modele->getListe();
		$this->vue->creationListe($liste, $this->modele->getJeuxListe($liste['idListe']));
	}
				
	public function ajoutJeu(){
		$this->miseAJourNom();
		

		$genres = $this->modele->getGenres();
		$this->vue->debutAjoutJeu($genres);

		foreach($genres as $cle=>$val){
			$this->vue->ajoutJeuParGenre($val['nomGenre'], $this->modele->getJeuxParGenre($val['idGenre']));
		}
	}

	public function miseAJourNom(){
		if($_POST['nomListe'] != $_POST['ancienNomListe'] && strlen($_POST['nomListe'])>0){
			$this->modele->updateName();
		}
	}

	public function ajouter(){
		$this->modele->ajouterJeu();
		header('Location: index.php?module=creationListe');
		exit();
	}


	public function supprimerTout(){

		$this->modele->toutSupprimer();

		header('Location: index.php?module=creationListe');
		exit();
	}


	public function supprimerJeu(){
		$this->miseAJourNom();

		$this->modele->supprimer();

		header('Location: index.php?module=creationListe');
		exit();
	}

	public function deplacerJeu(){
		$this->miseAJourNom();

		$this->modele->intervertir();

		header('Location: index.php?module=creationListe');
		exit();
	}
	public function poster(){
		$this->miseAJourNom();

		$this->modele->poster();

		header('Location: index.php?module=listes&action=details&id=' . $_POST['idListe']);
		exit();
	}


	public function get_action(){
		return $this->action;
	}


}



?>