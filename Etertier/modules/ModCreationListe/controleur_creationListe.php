<?php

class ControleurCreationListe{

	public $vue;
	private $modele;

	public function __construct(){
		require_once "vue_creationListe.php";
		$this->vue = new VueCreationListe();
		require_once "modele_creationListe.php";
		$this->modele = new ModeleCreationListe();
	}


}



?>