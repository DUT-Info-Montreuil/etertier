<?php

	class compMenu{

		public $controleur;

		public function __construct () {
			include 'cont_menu.php';
			$this->controleur = new ContMenu();
		}

		public function affiche(){
			echo $this->controleur->vue->contenu;
		}

	}

?>