<?php

require_once "vue_generique.php";
class VuePageAvecCommentaires extends VueGenerique{
    public function __construct () {
		parent::__construct();
	}


    public function afficher_commentaires($tab){
		echo '<h2 class="text-center text-uppercase m-4">Commentaires :</h2>';
		if(isset($tab[0])){
			foreach($tab as $cle=>$val){
				echo '<div class="com">
					<p>' . $val['texte'] . '<br> par <a href="index.php?module=pageuser&id=' . $val['idAuteur'] . '">' . $val['login'] . '</a> le ' . $val['date'] . '.</p>
				</div>';
			}
		}
		else{
			echo "Il n'y a pas encore de commentaires.";
		}

	}

	public function afficher_like_commentaire(){
		
	}

	public function afficher_like($likeOrdislike, $nbLike, $nbDislike){
		$action1 = "liker";
		$image1 = "fa-regular fa-thumbs-up";
		$action2 = "disliker";
		$image2 = "fa-regular fa-thumbs-down";
		if(isset($likeOrdislike)){
			if($likeOrdislike == 1){
				$image1 = "fa-solid fa-thumbs-up";
				$action1 = "enleverLikeDislike";
			}
			else{
				$image2 = "fa-solid fa-thumbs-down";
				$action2 = "enleverLikeDislike";
			}
		}
		echo '<p><a href="index.php?module='.$_GET['module'].'&action='. $action1 .'&id='. $_GET['id'].'"><i class="' . $image1 . '"></i> ';
		echo $nbLike[0]['nbLike'] .'</a>   ';
		echo '<a href="index.php?module='.$_GET['module'].'&action='. $action2 .'&id='. $_GET['id'].'"><i class="' . $image2 . '"></i> ';
		echo $nbDislike[0]['nbDislike'] .'</p></a>';


	}

	public function afficher_like_deco($nbLike, $nbDislike){
		$action1 = "liker";
		$image1 = "fa-regular fa-thumbs-up";
		$action2 = "disliker";
		$image2 = "fa-regular fa-thumbs-down";
	
		echo '<p><i class="' . $image1 . '"></i> ';
		echo $nbLike[0]['nbLike'] .'   ';
		echo '<i class="' . $image2 . '"></i> ';
		echo $nbDislike[0]['nbDislike'] .'</p>';


	}

	public function afficher_formulaire(){
		echo '<form action="index.php?module='.$_GET['module'].'&action=envoieComm&id='. $_GET['id'].'" method="post">
			<p>Commentaire : <br/> <textarea name="texteCommentaire"></textarea></p>
			<p><input type="submit" value="Envoyer"></p>
		</form>';
	}

	public function erreur_envoie_commentaire($messageErreur){
		echo $messageErreur;
	}



}