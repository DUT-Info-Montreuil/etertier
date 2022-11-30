<?php

require_once "connexion.php";
class ModeleJeux extends Connexion{
	public function __construct(){

	}



public function getListe(){
	$selecPrepare = self::$bdd->prepare('SELECT idJeu, nomJeu, image FROM jeux');
	$selecPrepare->execute();
	$tab = $selecPrepare->fetchall();
	return $tab;
}


public function getListeParGenre(){
	if(isset($_GET['genre'])){
		$t = array($_GET['genre']);
		$selecPrepare = self::$bdd->prepare('SELECT jeux.idJeu, jeux.nomJeu, jeux.image FROM jeux INNER JOIN genres_de_jeux ON genres_de_jeux.idJeu = jeux.idJeu WHERE idGenre=?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		
		return $tab;
	}
	
	return NULL;
	
}

public function getGenre() {
	if(isset($_GET['genre'])){
		$t = array($_GET['genre']);
		$selecPrepare = self::$bdd->prepare('SELECT nomGenre FROM genres WHERE idGenre=?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		
		if(isset($tab[0]['nomGenre'])){
			return $tab[0]['nomGenre'];
		}
	}
	return NULL;
}	


public function getDetails(){
	if(isset($_GET['id'])){
		$t = array($_GET['id']);
		$selecPrepare = self::$bdd->prepare('SELECT * FROM jeux WHERE idJeu=?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		if(isset($tab[0])){
			return $tab[0];
		}
	}
	
	return NULL;
	
}

public function getGenreDeJeu(){
	if(isset($_GET['id'])){
		$t = array($_GET['id']);
		$selecPrepare = self::$bdd->prepare('SELECT genres_de_jeux.idGenre, genres.nomGenre FROM genres_de_jeux INNER JOIN genres ON genres_de_jeux.idGenre = genres.idGenre WHERE idJeu=?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		
		return $tab;
	}
	
	return NULL;
	
}

public function getNote(){
	if(isset($_GET['id']) && isset($_SESSION['login'])){
		$t = array($_GET['id'], $_SESSION['login']);
		$selecPrepare = self::$bdd->prepare('SELECT notes.note FROM notes INNER JOIN membres ON notes.membre = membres.id WHERE notes.jeu=? AND membres.login=?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		if(isset($tab[0]['note'])){
			return $tab[0]['note'];
		}
	}

	return NULL;
}

public function getMoyenne(){
	if(isset($_GET['id'])){
		$t = array($_GET['id']);
		$selecPrepare = self::$bdd->prepare('SELECT AVG(notes.note) AS moyenne FROM notes INNER JOIN membres ON notes.membre = membres.id WHERE membres.redacteur = 0 AND notes.jeu = ?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		if(isset($tab[0]['moyenne'])){
			return $tab[0]['moyenne'];
		}
	}

	return NULL;
}

public function getNotesRedac(){
	if(isset($_GET['id'])){
		$t = array($_GET['id']);
		$selecPrepare = self::$bdd->prepare('SELECT notes.note, membres.id, membres.login FROM notes INNER JOIN membres ON notes.membre = membres.id WHERE membres.redacteur = 1 AND notes.jeu = ? ORDER BY notes.note DESC');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		if(isset($tab)){
			return $tab;
		}
	}

	return NULL;
}

public function noter(){

	$t = array($_SESSION["login"]);
	$selecPrepare = self::$bdd->prepare('SELECT id FROM membres where login = ?');
	$selecPrepare->execute($t);
	$membre = $selecPrepare->fetchall();


	if(isset($_POST["note"]) && $_POST['note'] >= 0 && $_POST['note'] <= 20 && isset($membre[0]['id'])){



		$t = array($_POST['note'], $membre[0]['id'], $_GET['id']);

		//On utilise getNote pour savoir si on doit faire un INSERT ou un UPDATE selon si l'utilisateur a déjà noté ce jeu ou pas
		if($this->getNote()==NULL){
			$selecPrepare = self::$bdd->prepare('INSERT INTO notes(note,membre,jeu) VALUES(?,?,?)');
		}
		else{
			$selecPrepare = self::$bdd->prepare('UPDATE notes SET note=? WHERE membre=? AND jeu=?');
		}

		$selecPrepare->execute($t);

	}

	header('Location: index.php?module=jeux&action=details&id='.$_GET['id']);
	exit();
}

	public function uploadImgJeu() {

        if ($_FILES['newImgJeu']['error']) {
                switch ($_FILES['photo']['error']){
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
            $filename = $_FILES["newImgJeu"]["name"];
            $filetype = $_FILES["newImgJeu"]["type"];


            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)){
                return "Erreur : Veuillez sélectionner un format de fichier valide ou veuillez renommer votre fichier avec l'extension a la fin.";
            }
            else{
                move_uploaded_file($_FILES["newImgJeu"]["tmp_name"], "ressources/jeux/" . $_FILES["newImgJeu"]["name"]);

                $selecPrepare = self::$bdd->prepare('UPDATE jeux SET jeux.image=? WHERE idJeu=?');
                $selecPrepare->execute(array($_FILES["newImgJeu"]["name"], $_GET['id']));    

                header('Location: index.php?module=jeux&id='.$_GET['id']);
                exit();
            }
        }
	}

}

?>