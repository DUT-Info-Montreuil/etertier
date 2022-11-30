<?php

class ControleurJeux{

	public $vue;
	private $modele;

	public function __construct(){
		require_once "vue_jeux.php";
		$this->vue = new VueJeux();
		require_once "modele_jeux.php";
		$this->modele = new ModeleJeux();

	}

	public function afficherListe(){
		$this->vue->afficherListe($this->modele->getListe());
	}


	public function afficherListeParGenre(){
		$this->vue->afficherListeParGenre($this->modele->getGenre(), $this->modele->getListeParGenre());
	}


	public function afficherDetails(){
		$this->vue->afficherDetails($this->modele->getDetails(), $this->modele->getGenreDeJeu(), $this->modele->getNote(), $this->modele->getMoyenne(), $this->modele->getNotesRedac());
	}

	public function noter(){
		$this->modele->noter();
	}

	public function changerImgJeu() {
		$this->vue->form_upload_new_img_jeu();
	}

	public function uploadImg() {
		$this->modele->uploadImgJeu();
	}

}



?>