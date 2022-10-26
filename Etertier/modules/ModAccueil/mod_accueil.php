<?php 

class ModAccueil {

    public $affichage;

    public function __construct() {
        require_once "cont_accueil.php";
		$cont = new ControleurAccueil();

        $cont->listeArticlesRecents();
        $cont->listeTierlistsRecentes();

		$this->affichage = $cont->vue->getAffichage();
    }
}


?>