<?php


class ModJeux{
	

	public $affichage;

	public function __construct(){
		require_once "controleur_jeux.php";
		$cont = new ControleurJeux();

		if(isset($_GET['action'])){
			switch($_GET['action']){
				case 'details':	$cont->afficherDetails();
					break;
				case 'genre':	$cont->afficherListeParGenre();
					break;
				case 'noter':	$cont->noter();
					break;
				case 'modifImgJeu': $cont->changerImgJeu();
					break;
				case 'upload': $cont->uploadImg();
					break;
				default: $cont->afficherListe();
			}
		}
		else{
			$cont->afficherListe();
		}
		$this->affichage = $cont->vue->getAffichage();
	}
}
	


?>