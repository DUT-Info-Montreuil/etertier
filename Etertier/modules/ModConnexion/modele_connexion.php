<?php

require_once "connexion.php";
class ModeleConnexion extends Connexion{
	public function __construct(){

	}


	public function connecter(){
			
		$t = array($_POST["login"]);
		$selecPrepare = self::$bdd->prepare('SELECT login,password, redacteur FROM membres WHERE login=?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();

		if(isset($tab[0]) && password_verify($_POST["password"], $tab[0]['password'])){
			$_SESSION['login'] = $tab[0]['login'];
			$_SESSION['redacteur'] = $tab[0]['redacteur'];
		}


		unset($tab);
		unset($_POST["login"]);
		unset($_POST["password"]);


	}


	public function verifInscription(){

		$t = array($_POST["login"]);
		$selecPrepare = self::$bdd->prepare('SELECT login FROM membres WHERE login=?');
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();

		return(isset($tab[0]));


	}

	public function inscrire(){

		if(isset($_POST["login"]) && isset($_POST["password"]) && $_POST["password"] == $_POST["passwordConfirm"] && strlen($_POST['password']) != 0 && strlen($_POST['login']) != 0){

			$t = array($_POST["login"], password_hash($_POST["password"], PASSWORD_DEFAULT));
			$selecPrepare = self::$bdd->prepare('INSERT INTO membres(login, password, photoprofil) VALUES (?,?,\'0.png\')');
			$selecPrepare->execute($t);

			$_SESSION['login'] = $_POST['login'];
			$_SESSION['redacteur'] = 0;
		}

		unset($_POST["login"]);
		unset($_POST["password"]);
		unset($_POST["passwordConfirm"]);

	}


}






?>