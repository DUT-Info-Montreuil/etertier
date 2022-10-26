<?php 

require_once"vue_generique.php";
class VueAccueil extends VueGenerique{

    public function __construct() {
        
    }

    public function afficher_liste_articles_recents($tab){
		echo '<h2>Les Articles récents :</h2>';
		foreach($tab as $cle=>$val){
			echo '<div class="d">
				<p class="text-center">
					<a class="nav-link" href="index.php?module=article&action=details&id=' . $val['idArticle'] . '">' . $val['nom'] . '</a>
				</p>
				<p class="text-center">'."écrit par ".$val['login']." le ".$val['date'].'</p>
			</div>';
		}
	}

    public function afficher_liste_tierlists_recents($tab){
		echo '<h2>Les Listes récentes :</h2>';
		foreach($tab as $cle=>$val){
			echo '<div class="d">
				<p class="text-center"><a class="nav-link" href="index.php?module=listes&action=details&id=' . $val['idListe'] . '">' . $val['titre'] . '</a> par ' . $val['login'] . ' le ' . $val['dateCreation'] . '.</p>
			</div>';
		}
	}
}


?>