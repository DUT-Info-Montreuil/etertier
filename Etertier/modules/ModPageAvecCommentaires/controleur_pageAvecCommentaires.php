<?php

require_once "vue_pageAvecCommentaires.php";
require_once "modele_pageAvecCommentaires.php";
class ControleurPageAvecCommentaires{
    public $vue;
	public $modele;
    public function __construct () {}

    public function commentaires($tableCommentaires){
        $this->vue->afficher_commentaires($this->modele->get_commentaire($tableCommentaires));
    }
}