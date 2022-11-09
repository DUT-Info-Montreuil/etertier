<?php

require_once "connexion.php";
class ModelePageAvecCommentaires extends Connexion{
    public function __construct () {
        parent::__construct();
    }

    public function get_commentaire($nomtable){

		$t = array($_GET['id']);
		$requete = 'SELECT ' . $nomtable . '.*, membres.login FROM ' . $nomtable . ' INNER JOIN membres ON ' . $nomtable . '.idAuteur = membres.id WHERE ' . $nomtable . '.idOrigine = ? ORDER BY ' . $nomtable . '.date ASC';
		$selecPrepare = self::$bdd->prepare($requete);
		$selecPrepare->execute($t);
		$tab = $selecPrepare->fetchall();
		return $tab;
	}
}

?>