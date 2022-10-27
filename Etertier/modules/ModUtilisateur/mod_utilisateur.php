<?php 

class ModUtilisateur {

    public $affichage;

    public function __construct() {

        require_once "cont_utilisateur.php";
        $cont = new ControleurUtilisateur();

        $cont->affichePageUser();

        $this->affichage = $cont->vue->getAffichage();
    }

}

?>