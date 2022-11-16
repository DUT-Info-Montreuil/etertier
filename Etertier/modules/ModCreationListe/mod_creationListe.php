<?php


class ModCreationListe{
	

	public $affichage;

	public function __construct(){
		require_once "controleur_creationListe.php";
		$cont = new ControleurCreationListe();

		$this->affichage = $cont->vue->getAffichage();
	}
}
	


?>