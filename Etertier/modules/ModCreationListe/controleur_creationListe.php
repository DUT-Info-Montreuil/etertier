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
		$genres = $this->modele->getGenres();
		$this->vue->debutAjoutJeu($genres);

		foreach($genres as $cle=>$val){
			$this->vue->ajoutJeuParGenre($val['nomGenre'], $this->modele->getJeuxParGenre($val['idGenre']));
		}
	}

	public function ajouter(){
		$this->modele->ajouterJeu();
		header('Location: index.php?module=creationListe');
		exit();
	}

	public function action(){
		
		if($_POST['nomListe'] != $_POST['ancienNomListe'] && strlen($_POST['nomListe'])>0){
			$this->miseAJourNom();
		}

		if(isset($_POST['ajoutJeu'])){
			header('Location: index.php?module=creationListe&action=ajoutJeu');
			exit();
		}
		else if(isset($_POST['supprimerJeu'])){
			$this->supprimerJeu();
		}
		else if(isset($_POST['deplacerJeu'])){
			$this->deplacerJeu();
		}
		else if(isset($_POST['poster'])){
			$this->poster();
		}		
		else{
			$this->vue->afficheErreur();
		}

		header('Location: index.php?module=creationListe');
		exit();
		/*
		switch($_POST['action']){
			case "ajoutJeu": $cont->ajoutJeu();
				break;
			case "ajouter": $this->ajouter();
				break;
			case "supprimerJeu": $this->supprimerJeu();
				break;
			case "deplacerJeu": $this->deplacerJeu();
				break;
			case "poster": $this->poster();
				break;
			default: $this->vue->afficheErreur();
		}
		*/

	}

	public function miseAJourNom(){
		$this->modele->updateName();
	}


	public function supprimerTout(){}


	public function supprimerJeu(){}
	public function deplacerJeu(){}
	public function poster(){}


	public function get_action(){
		return $this->action;
	}


}



?>