<?php


class ModCreerJeux{
	

	public $affichage;

	public function __construct(){
		require_once "controleur_creer_jeux.php";
		$cont = new ControleurCreerJeux();

	}
}
	


?>