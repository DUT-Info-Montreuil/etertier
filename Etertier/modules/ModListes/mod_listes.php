<?php

class ModListes{
	
	public $affichage;

	public function __construct(){
		require_once "controleur_listes.php";
		$cont = new ControleurListes();

		switch($cont->get_action()){
			case "details": $cont->details();
				break;
			default: $cont->liste();
		}


		$this->affichage = $cont->vue->getAffichage();
	}
}
	
?>