<?php

require_once "modules/ModPageAvecCommentaires/vue_pageAvecCommentaires.php";
class VueListes extends VuePageAvecCommentaires{
	public function __construct () {
		parent::__construct();
	}

	public function afficher_liste($tab){
		echo '<h2 class="text-center text-uppercase m-4">Les Listes :</h2>';
		foreach($tab as $cle=>$val){
			echo '<div class="d">
			<p class="text-center">
				<a href="index.php?module=listes&action=details&id=' . $val['idListe'] . '">' . $val['titre'] . '</a>
			</p>
			<p class="text-center">'."écrit par <a href=index.php?module=pageuser&id=".$val['id'].">".$val['login']."</a> le ".$val['dateCreation'].'</p>
		</div>';
		}
	}

	public function afficher_details($tab, $classement){
		if(isset($tab)){
			echo '<h2 class="text-center text-uppercase m-4">' . $tab['titre'] . '</h2><div class ="com"><p>par <a href=index.php?module=pageuser&id='.$tab['id'].'>'.$tab['login'].'</a> le ' . $tab['dateCreation'] . '.</p></div><ul>';

			foreach($classement as $cle=>$val){
				echo "<li> " . $val['classement'] . ". ";
				if(isset($val['image']) && strlen($val['image'])!=0 && file_exists('ressources/jeux/' . $val['image'])){
					echo '<div class="d">
						<p class="text-center">
							<a href="index.php?module=jeuxListe&action=details&id=' . $val['idJeu'] . "&liste=" . $_GET['id'] . '"><img class="size" src=\'ressources/jeux/' . $val['image'] . '\'/></a>
						</p>
					</div>';
				}
				else{
					echo '<div class="d">
						<p class="text-center">
							<a href="index.php?module=jeuxListe&action=details&id=' . $val['idJeu'] . "&liste=" . $_GET['id'] . '">' . $val['nomJeu'] . '</a>
						</p>
					</div>';
				}
				
				echo "</a></li>";			
			}

			echo "</ul>";
		}
		else{
			$this->afficher_erreur();
		}
    }

	public function afficher_erreur(){
		echo '<p>Erreur !</p>';
	}
}



?>