<?php



require_once"vue_generique.php";
class VueCreerJeux extends VueGenerique{
	public function __construct () {
		parent::__construct();
	}

	public function form_ajout_jeu($tab) {
		?><div class="formulaire">
			<form class="form" action="index.php?module=creerjeu&action=ajouterjeu" method="post" enctype="multipart/form-data">
				<p class="text_form">Nom du Jeu :</p>
				<input type="text" name="nomNewJeu" min=1 max=200>
				<p class="text_form">Date de sortie :</p>
				<input type="date" name="dateNewJeu">
				<p class="text_form">Description du jeu :</p>
				<input type="text" name="descriNewJeu" min=1>
				
		<?php
				foreach($tab as $cle=>$val) {		
						echo "<br><input type=checkbox name=" .$val['nomGenre']. " value=".$val['idGenre'].">
						  <label for=".$val['nomGenre'].">".$val['nomGenre']."</label><br>";
				}
		?>
				<p class="text_form">Lien de l'image :</p> -->
				<p>(taille fichier plus petit que 2 MO)</p>
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
				<input type="file" name="photoNewJeu" id="fileUpload">
				<input type="submit" name="creerJeu" value="ajouter">
			</form>
			</div>
		<?php
	}

}



?>