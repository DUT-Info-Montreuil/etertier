<?php

require_once "vue_generique.php";
class VuePageAvecCommentaires extends VueGenerique{
    public function __construct () {
		parent::__construct();
	}


    public function afficher_commentaires($tab){
		echo '<h2 class="text-center text-uppercase m-4">Commentaires :</h2>';
		if(isset($tab[0])){
			foreach($tab as $cle=>$val){
				echo '<div class="com">
					<p>' . $val['texte'] . '<br> par <a href="index.php?module=pageuser&id=' . $val['idAuteur'] . '">' . $val['login'] . '</a> le ' . $val['date'] . '.</p>
				</div>';
			}
		}
		else{
			echo "Il n'y a pas encore de commentaires.";
		}

	}
}