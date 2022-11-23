<?php



require_once"vue_generique.php";
class VueCreerJeux extends VueGenerique{
	public function __construct () {
		parent::__construct();
	}

	public function form_ajout_jeu() {
		?>
			<form action="index.php?module=creerjeu&action=ajouterjeu" method="post">
				<p>Nom du Jeu</p>
				<input type="text" name="nomNewJeu" min=1 max=200>
				<p>Date de sortie</p>
				<input type="date" name="dateNewJeu">
				<p>Description du jeu</p>
				<input type="text" name="descriNewJeu" min=1>
				<!-- <p>Lien de l'image</p> -->
				<!-- <p>taille fichier plus petit que 2 MO</p>
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
				<input type="file" name="photo" id="fileUpload">
				<input type="submit" name="submit" value="Upload" class="boutonUpload"> -->
				<input type="submit" name="creerJeu" value="ajouter">
			</form>

		<?php
	}

}



?>