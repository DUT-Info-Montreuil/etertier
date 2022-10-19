<?php

	include 'vue_menu.php';
	include 'modele_menu.php';

	class ContMenu {
		public $vue;
		
		public function __construct () {
			$this->vue = new VueMenu();
		}
		
	}

?>