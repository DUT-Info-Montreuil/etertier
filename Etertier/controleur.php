<?php 

include_once('vue_generique.php');
// include_once('composants/mod_menu.php');

    class Controleur {
        private $vue;
        private $module;

        public function __construct() {
            $this->vue = new VueGenerique();
            $this->module = isset($_GET['module']) ? $_GET['module'] : "accueil";
        }

        // public function menu() {
        //     new ModMenu();
        // }

        public function exec() {
            switch($_GET['module']){	
				case 'joueurs': 
					include_once('modules/mod_joueurs/mod_joueurs.php');
					$module = new ModJoueurs();
					break;
				case 'equipes': 
					include_once('modules/mod_equipes/mod_equipes.php');
					$module = new ModEquipe();
					break;
				case 'connexion':
					include_once('modules/mod_connexion/mod_connexion.php');
					$module = new ModConnexion();
					break;
			}
        }
    }







?>