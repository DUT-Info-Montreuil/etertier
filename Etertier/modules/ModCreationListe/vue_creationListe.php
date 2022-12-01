<?php



require_once"vue_generique.php";
class VueCreationListe extends VueGenerique{
	public function __construct () {
		parent::__construct();
	}


	public function creationListe($liste, $jeux){
		
		if(isset($liste)){
			?>
			<div class="d-flex justify-content-center">
			<form action="index.php?module=creationListe" method="post">
				<h1>Création de liste :</h1>
				<input type="hidden" name="idListe" value="<?php echo $liste["idListe"]; ?>"/>
				<input type="hidden" name="ancienNomListe" value="<?php echo $liste["titre"]; ?>"/>
				<input type="text" name="nomListe" min=1 max=50 value="<?php echo $liste["titre"]; ?>"/>
				<br/>

				<?php
					foreach($jeux as $cle=>$val){
						if($cle > 0){
							echo '<input type="submit" name="deplacerJeu" value="Intervertir" formaction="index.php?module=creationListe&action=deplacerJeu&idJeu='.$val['idJeu'].'"/>';
							echo "<br/>";
						}
						echo "<div>";
						if(isset($val['image']) && strlen($val['image'])!=0 && file_exists('ressources/jeux/' . $val['image'])){
							echo '<div class="d">
								<p class="text-center">
									<img class="size" src=\'ressources/jeux/' . $val['image'] . '\'/>
								</p>
							</div>';
						}
						else{
							echo '<div class="d">
								<p class="text-center">'.$val['nomJeu'].'</p>
							</div>';
						}				
						echo '<input type="submit" name="supprimerJeu" value="Supprimer" formaction="index.php?module=creationListe&action=supprimerJeu&id='.$val['idJeu'].'"></div><br/>';

					}

					echo '<div class="com"><input class="text-center" type="submit" name="ajoutJeu" value="Ajouter un jeu" formaction="index.php?module=creationListe&action=ajoutJeu"></div>';
					if(count($jeux)>1){
						echo '<div class="com"><input class="text-center" type="submit" name="poster" value="Poster la liste" formaction="index.php?module=creationListe&action=poster"></div>';
					}
					else{
						echo '<div class="com">Placez au moins deux jeux dans la liste pour la poster.</div>';
					}
					echo '<div class="com"><input class="text-center" type="submit" name="supprimerTout" value="Tout supprimer" formaction="index.php?module=creationListe&action=supprimerTout"></div>';
				

				?>

			</form>
			</div>
			<?php
		}
		else{
			$this->afficheErreur();
		}
	}

	public function debutAjoutJeu($genres){
		echo "<br/><div><h3>Liste de genres : ";
		$premierjeu = 1;
		foreach($genres as $cle=>$val){
			if($premierjeu == 0){
				echo " - ";
			}
			else{
				$premierjeu = 0;
			}
			echo "<a href=#" . $val['nomGenre'] . ">" . $val['nomGenre'] . "</a>";
		}
		echo "</h3></div>";

	}

	public function ajoutJeuParGenre($nomGenre, $jeux){
		echo '<h2 class="text-uppercase m-4" id="'. $nomGenre .'">'. $nomGenre .':</h2>';
		foreach($jeux as $cle=>$val){
			if(isset($val['image']) && strlen($val['image'])!=0 && file_exists('ressources/jeux/' . $val['image'])){
				echo '<div class="d">
				<p class="text-center">
					<a href="index.php?module=creationListe&action=ajouter&id=' . $val['idJeu'] . '"><img class="size" src=\'ressources/jeux/' . $val['image'] . '\'/></a>
				</p>
			</div>';
			}
			else{
				echo '<div class="d">
					<p class="text-center">
						<a href="index.php?module=creationListe&action=ajouter&id=' . $val['idJeu'] . '">' . $val['nomJeu'] . '</a>
					</p>
				</div>';
			}
		}
	}


	public function afficheErreur(){
		echo "Erreur.";
	}

}



?>