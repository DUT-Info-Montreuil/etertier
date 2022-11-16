<?php 

class ModUtilisateur {

    public $affichage;

    public function __construct() {

        require_once "cont_utilisateur.php";
        $cont = new ControleurUtilisateur();

        if(isset($_GET['action']) && $_GET['action']=='upload') {
            $cont->uploaderPhotoProfil();
        }

        if (isset($_POST['newbio']) && strlen($_POST['newbio'])>0 && isset($_GET['action']) && $_GET['action']=='uploadbio') {
            $cont->uploaderBio();
        }

        $cont->affichePageUser();

        $this->affichage = $cont->vue->getAffichage();

    }

}

?>