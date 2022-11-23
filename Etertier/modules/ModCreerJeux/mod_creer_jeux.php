<?php


class ModCreerJeux{
	

	public $affichage;

	public function __construct(){
		require_once "controleur_creer_jeux.php";
		$cont = new ControleurCreerJeux();

		switch($cont->get_action()){
			case "ajouterjeu": 
				$cont->ajouter_jeu();
				break;
			default: $cont->form_new_jeu();

		}

		$this->affichage = $cont->vue->getAffichage();



	}
}
	


?>