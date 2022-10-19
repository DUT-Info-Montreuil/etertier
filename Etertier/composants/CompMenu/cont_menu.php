<?php

	include 'vue_menu.php';

	class ContMenu {
		public $vue;
		
		public function __construct () {
			$this->vue = new VueMenu();
		}
		
	}

?>