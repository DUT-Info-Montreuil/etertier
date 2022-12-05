<?php 

require_once"vue_generique.php";
class VueAccueil extends VueGenerique{

    public function __construct() {
        parent::__construct();
    }

    public function afficher_liste_articles_recents($tab){
		echo '<h2 class="text-uppercase m-4">Les Articles récents :</h2>';
		foreach($tab as $cle=>$val){
			echo '<div class="d">
				<div class="center">
					<p>
						<a href="index.php?module=article&action=details&id=' . $val['idArticle'] . '">' . $val['nom'] . '</a>
					</p>
					<p>'."écrit par <a href=index.php?module=pageuser&id=".$val['idAuteur'].">".$val['login']."</a> le ".$val['date'].'</p>
				</div>
			</div>';
		}
	}

    public function afficher_liste_tierlists_recents($tab){
		echo '<h2 class="text-uppercase m-4">Les Listes récentes :</h2>';
		foreach($tab as $cle=>$val){
			echo '<div class="d">
				<div class="center">
					<p>
						<a href="index.php?module=listes&action=details&id=' . $val['idListe'] . '">' . $val['titre'] . '.</a>
					</p>
						
					<p>'."écrit par <a href=index.php?module=pageuser&id=".$val['id'].">".$val['login']."</a> le ".$val['dateCreation'].'</p>
				</div>
			</div>';
		}
	}
}


?>