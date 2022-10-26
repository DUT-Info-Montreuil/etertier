<?php



require_once"vue_generique.php";
class VueJeux extends VueGenerique{
	public function __construct () {
		parent::__construct();
	}



	public function afficherListe($tab){
		echo '<h2 class="text-uppercase m-4">Liste des jeux:</h2>';
		foreach($tab as $cle=>$val){
			if(isset($val['image']) && strlen($val['image'])!=0 && file_exists('ressources/jeux/' . $val['image'])){
				echo '<div class="d">
					<p class="text-center">
						<a class="nav-link" href="index.php?module=jeux&action=details&id=' . $val['idJeu'] . '"><img class="size" src=\'ressources/jeux/' . $val['image'] . '\'/></a>
					</p>
				</div>';
			}
			else{
				echo '<div class="d">
					<p class="text-center">
						<a class="nav-link" href="index.php?module=jeux&action=details&id=' . $val['idJeu'] . '">' . $val['nomJeu'] . '</a>
					</p>
				</div>';
			}
		}
	}

	public function afficherListeParGenre($genre, $tab){
		if(isset($genre)){
			echo '<h2 class="text-uppercase m-4">Liste des jeux de '. $genre .':</h2>';
			foreach($tab as $cle=>$val){
				if(isset($val['image']) && strlen($val['image'])!=0 && file_exists('ressources/jeux/' . $val['image'])){
					echo '<div class="d">
					<p class="text-center">
						<a class="nav-link" href="index.php?module=jeux&action=details&id=' . $val['idJeu'] . '"><img class="size" src=\'ressources/jeux/' . $val['image'] . '\'/></a>
					</p>
				</div>';
				}
				else{
					echo '<div class="d">
						<p class="text-center">
							<a class="nav-link"href="index.php?module=jeux&action=details&id=' . $val['idJeu'] . '">' . $val['nomJeu'] . '</a>
						</p>
					</div>';
				}
			}
		}	
		else{
			$this->afficher_erreur();
		}

		echo '<p><a href=\'index.php?module=jeux\'><i class="fa-solid fa-arrow-left"></i> Retour à la liste de tout les jeux.</a></p>';
	}

	public function afficherDetails($tab, $genres, $noteUtilisateur, $moyenne, $notesRedac){
		if(isset($tab)){
			if(isset($tab['image']) && strlen($tab['image'])!=0 && file_exists('ressources/jeux/' . $tab['image'])){
				echo '<img src=\'ressources/jeux/' . $tab['image'] . '\'/>';
			}

			//Infos du jeu
			echo '<div><h3>' . $tab['nomJeu'] . '</h3>';

			echo '<p>Genres: ';

			foreach($genres as $cle=>$val){
				echo '<a href="index.php?module=jeux&action=genre&genre=' . $val['idGenre'] . '">' . $val['nomGenre'] . '</a>  ';
			}

			echo '<p>Date de sortie : ' . $tab['dateSortie'] . '</p>';
			echo '<p>' . $tab['description'] . '</p></div>';

			//Div des notes
			echo '<div>';
				if(isset($_SESSION['login'])){
					echo '<div><h3>Votre note:</h3>';
					if(isset($noteUtilisateur)){
						echo '<p>'.$noteUtilisateur.'</p>';
						echo '<form action="index.php?module=jeux&action=noter&id='. $_GET['id'] .'" method="post">
							<input type="number" name="note" min="0" max="20">
							<input type="submit" value="Changer la note">
						</form>';
					}
					else{
						echo '<p>Vous n\'avez pas encore noté ce jeu.</p>
						<form action="index.php?module=jeux&action=noter&id='. $_GET['id'] .'" method="post">
							<input type="number" name="note" min="0" max="20">
							<input type="submit" value="Noter ce jeu">
						</form>';
					}
					echo '</div>';
				}
				if($moyenne == NULL){
					echo '<div>Ce jeu n\'a encore aucune note.</div>';
				}
				else{
					echo '<div><h3>Moyenne utilisateur:</h3><p>'.$moyenne.'</p></div>';
				}
				if(isset($notesRedac[0])){
					echo '<div><h3>Notes rédacteurs:</h3>';
					foreach($notesRedac as $cle=>$val){
						echo'<p>'.$val['note'].'</p><p>-'.$val['login'].'</p>';
					}
					echo '</div>';
				}
			echo '</div>';
		}
		else{
			$this->afficher_erreur();
		}
		if($_GET['module']=="jeuxListe"){
			echo '<p><a href=\'index.php?module=listes&action=details&id=' . $_GET['liste'] . '\'><i class="fa-solid fa-arrow-left"></i> Retour à la liste.</a></p>';
		}
		else{
			echo '<p><a href=\'index.php?module=jeux\'><i class="fa-solid fa-arrow-left"></i> Retour à la liste des jeux.</a></p>';
		}
	}

	public function afficher_erreur(){
		echo '<p>Erreur, cette page n\'existe pas.</p>';
	}

}



?>