<?php 

class ModUtilisateur {

    public $affichage;

    public function __construct() {

        require_once "cont_utilisateur.php";
        $cont = new ControleurUtilisateur();

        if(isset($_GET['action']) && $_GET['action']=='upload') {
            $cont->uploader();
        }

        $cont->affichePageUser();

        $this->affichage = $cont->vue->getAffichage();

    }

}

?>