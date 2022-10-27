<?php 

class ControleurUtilisateur {

    public $vue;
	private $modele;

    public function __construct() {
        require_once 'modele_utilisateur.php';
        $this->modele = new ModeleUtilisateur();

        require_once 'vue_utilisateur.php';
        $this->vue = new VueUtilisateur();

    }

    public function affichePageUser() {
        $details = $this->modele->getDetails();

        if (!isset($details)) {
            $details = getSelfDetails();
        }

        if (!isset($details)) {
            $this->vue->afficher_erreur();
        }
        else{
            $this->vue->affiche_Details_User($details);
            if($details['redacteur']==1){
                $this->vue->afficher_liste_articles_recents($details['login'], $this->modele->get_Articles());
            }
            $this->vue->afficher_liste_tierlists_recents($details['login'], $this->modele->get_Listes());
        }
    }


}

?>