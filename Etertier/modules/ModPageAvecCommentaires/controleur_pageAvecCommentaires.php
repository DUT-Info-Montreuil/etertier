<?php

require_once "vue_pageAvecCommentaires.php";
require_once "modele_pageAvecCommentaires.php";
class ControleurPageAvecCommentaires{
    public $vue;
	public $modele;
    public function __construct ($vue,$modele) {
        $this->vue = $vue;
        $this->modele = $modele;
    }

    public function commentaires($tableCommentaires){
        $this->vue->afficher_commentaires($this->modele->get_commentaire($tableCommentaires));
        $this->vue->afficher_formulaire();
    }
    public function envoyer_commentaire($tableCommentaires){
        $this->vue->erreur_envoie_commentaire($this->modele->ajouter_commentaire($tableCommentaires));
    }
}