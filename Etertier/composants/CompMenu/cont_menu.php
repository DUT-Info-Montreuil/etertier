<?php

	class ContMenu {
		public $vue;
		private $modele;
		
		public function __construct () {
			require_once 'modele_menu.php';
			require_once 'vue_menu.php';
			
			$this->modele = new ModeleMenu();
			$this->vue = new VueMenu($this->modele->get_genres());
		}
		
	}

?>