<?php 

include_once('vue_generique.php');

class VueUtilisateur extends VueGenerique{


    public function __construct() {
        parent::__construct();
    }

    public function affiche_Details_User($tab) {
		echo '<img src="ressources/photoProfile/' . $tab['photoprofil'];

        echo '"/><h2>' . $tab['login'] . '</h2><br>';

        echo $tab['bio'];
    }

    public function afficher_liste_articles_recents($pseudo, $tab){
		echo '<h2 class="text-uppercase m-4">Les Articles de ' . $pseudo . ':</h2>';
		foreach($tab as $cle=>$val){
			echo '<div class="d">
				<p class="text-center">
					<a class="nav-link" href="index.php?module=article&action=details&id=' . $val['idArticle'] . '">' . $val['nom'] . '</a>
				</p>
				<p class="text-center">'."écrit le ".$val['date'].'</p>
			</div>';
		}
	}

    public function afficher_liste_tierlists_recents($pseudo, $tab){
		echo '<h2 class="text-uppercase m-4">Les Listes de ' . $pseudo . ':</h2>';
		foreach($tab as $cle=>$val){
			echo '<div class="d">
				<p class="text-center"><a class="nav-link" href="index.php?module=listes&action=details&id=' . $val['idListe'] . '">' . $val['titre'] . '</a> le ' . $val['dateCreation'] . '.</p>
			</div>';
		}
	}

	public function form_upload_pfp() {
		?>
			<div id="upload">
			<form action="index.php?module=pageuser&action=upload" method="post" enctype="multipart/form-data">
				<h2>Changer de photo de profil</h2>
				<p>taille fichier plus petit que 2 MO</p>
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
				<input type="file" name="photo" id="fileUpload">
				<input type="submit" name="submit" value="Upload" class="boutonUpload">
			</form>

			
			</div>
		<?php
	}

    public function afficher_erreur(){
		echo '<p>Erreur, cette page n\'existe pas.</p>';
	}

	public function affiche_erreur_photo($message){
		echo $message;
	}
}

?>