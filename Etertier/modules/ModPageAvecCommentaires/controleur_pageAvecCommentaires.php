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

    public function commentaires($tableCommentaires, $tableLike){
        if(isset($_SESSION['login'])){
            $this->vue->afficher_like($this->modele->is_liked($tableLike),$this->modele->get_nb_like($tableLike),$this->modele->get_nb_dislike($tableLike));
            $this->vue->afficher_formulaire();
        } 
        else{
            $this->vue->afficher_like_deco($this->modele->get_nb_like($tableLike),$this->modele->get_nb_dislike($tableLike));
        }
        $this->vue->afficher_commentaires($this->modele->get_commentaire($tableCommentaires, $tableLike));

    }
    public function envoyer_commentaire($tableCommentaires){
        $this->vue->erreur_envoie_commentaire($this->modele->ajouter_commentaire($tableCommentaires));
    }
    public function liker($nomTable){
        $this->modele->liker($nomTable);
    }
    public function disliker($nomTable){
        $this->modele->disliker($nomTable);
    }
    public function enlever($nomTable){
        $this->modele->enlever($nomTable);
    }

    public function liker_com($nomTable){
        $this->modele->liker_com($nomTable);
    }
    public function disliker_com($nomTable){
        $this->modele->disliker_com($nomTable);
    }
    public function enlever_com($nomTable){
        $this->modele->enlever_com($nomTable);
    }
}
?>