<?php

require_once "connexion.php";
class ModeleCreerJeux extends Connexion{
	public function __construct(){

	}


	public function ajouterJeu($tab) {
		$t=array($_POST['nomNewJeu'], $_POST['dateNewJeu'], $_POST['descriNewJeu']);
		$selecPrepare = self::$bdd->prepare('INSERT INTO jeux(nomJeu, dateSortie, description, image) VALUES (?, ?, ?, "")');
        $selecPrepare->execute($t);

		$selecPrepare2 = self::$bdd->prepare('SELECT idJeu FROM jeux where nomJeu = ? AND dateSortie = ? AND description=?');
		$selecPrepare2->execute($t);
		$id = $selecPrepare2->fetchall();

		foreach($tab as $key=>$val) {
			if(isset($_POST[$val['nomGenre']])) {
				$t=array($id[0]['idJeu'], $_POST[$val['nomGenre']]);
				$selecPrepare = self::$bdd->prepare('INSERT INTO genres_de_jeux VALUES (?, ?)');
				$selecPrepare->execute($t);
			}
		}
		if($_FILES['photoNewJeu']['error'] != 4) {
			if ($_FILES['photoNewJeu']['error']) {
				switch ($_FILES['photoNewJeu']['error']){
					case 1: // UPLOAD_ERR_INI_SIZE
					return "Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";
					break;
					case 2: // UPLOAD_ERR_FORM_SIZE
					return "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
					break;
					case 3: // UPLOAD_ERR_PARTIAL
					return "L'envoi du fichier a été interrompu pendant le transfert !";
					break;
					case 4: // UPLOAD_ERR_NO_FILE
					return "Aucune image sélectionnée.";
					break;
				}
			}
			else{
				$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
				$filename = $_FILES["photoNewJeu"]["name"];
				$filetype = $_FILES["photoNewJeu"]["type"];


				// Vérifie l'extension du fichier
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if(!array_key_exists($ext, $allowed)){
					return "Erreur : Veuillez sélectionner un format de fichier valide ou veuillez renommer votre fichier avec l'extension a la fin.";
				}
				else{
					move_uploaded_file($_FILES["photoNewJeu"]["tmp_name"], "ressources/jeux/" . $_FILES["photoNewJeu"]["name"]);

					//rename("ressources/jeux/" . $_FILES["photoNewJeu"]["name"], "ressources/jeux/".$_POST['nomNewJeu']);

					$selecPrepare = self::$bdd->prepare('UPDATE jeux SET jeux.image=? WHERE idJeu=?');
					$selecPrepare->execute(array($_FILES["photoNewJeu"]["name"], $id[0]['idJeu']));    

				}
			}
			
		}
		header('Location: index.php?module=jeux&action=details&id='.$id[0]['idJeu']);
		exit();
	
	}

	public function getGenres() {
		$selecPrepare = self::$bdd->prepare('SELECT * FROM genres');
		$selecPrepare->execute();
		$tab = $selecPrepare->fetchall();

		return $tab;
	}

	

}

?>