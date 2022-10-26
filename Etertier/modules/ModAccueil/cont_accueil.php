<?php 

class ControleurAccueil {

    public $vue;
	private $modele;

	private $action;

    public function __construct() {
        require_once "vue_accueil.php";
        $this->vue = new VueAccueil();
        require_once "modele_accueil.php";
        $this->modele = new ModeleAccueil();
    }

    public function listeArticlesRecents(){
		$this->vue->afficher_liste_articles_recents($this->modele->get_liste_articles_recents());
	}

    public function listeTierlistsRecentes(){
		$this->vue->afficher_liste_tierlists_recents($this->modele->get_liste_tierlists_recents());
	}

}


?>