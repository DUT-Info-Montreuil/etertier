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
				echo '<div class="com"'.$val['idCommentaire'].'">
					<p>' . htmlspecialchars($val['texte']) . '<br> par <a href="index.php?module=pageuser&id=' . $val['idAuteur'] . '">' . $val['login'] . '</a> le ' . $val['date'] . '.</p><br/>';
				if(isset($_SESSION['login'])){
					$this->afficher_like_commentaire($val['idCommentaire'], $val['isLiked'], $val['nbLike'], $val['nbDislike']);
				}
				else{
					$this->afficher_like_commentaire_deco($val['idCommentaire'], $val['nbLike'], $val['nbDislike']);
				}
				echo "</div>";
			}
		} else{
			echo "<div class='com'>Il n'y a pas encore de commentaires.</div>";
		}

	}


	public function afficher_like_commentaire($com,$likeOrdislike, $nbLike, $nbDislike){
		$action1 = "likerCom";
		$image1 = "fa-regular fa-thumbs-up";
		$action2 = "dislikerCom";
		$image2 = "fa-regular fa-thumbs-down";
		if(isset($likeOrdislike)){
			if($likeOrdislike == 1){
				$image1 = "fa-solid fa-thumbs-up";
				$action1 = "enleverLikeDislikeCom";
			}
			else{
				$image2 = "fa-solid fa-thumbs-down";
				$action2 = "enleverLikeDislikeCom";
			}
		}
		echo '<p><a href="index.php?module='.$_GET['module'].'&action='. $action1 .'&id='. $_GET['id']. '&com='. $com . '"><i class="' . $image1 . '"></i> ';
		echo $nbLike[0]['nbLike'] .'</a>  ';
		echo '<a href="index.php?module='.$_GET['module'].'&action='. $action2 .'&id='. $_GET['id']. '&com='. $com . '"><i class="' . $image2 . '"></i> ';
		echo $nbDislike[0]['nbDislike'] .'</a></p>';
	}

	
	public function afficher_like_commentaire_deco($com, $nbLike, $nbDislike){
		$image1 = "fa-regular fa-thumbs-up";
		$image2 = "fa-regular fa-thumbs-down";

		echo '<p><i class="' . $image1 . '"></i> ';
		echo $nbLike[0]['nbLike'] .'  ';
		echo '<i class="' . $image2 . '"></i> ';
		echo $nbDislike[0]['nbDislike'] .'</p>';
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
		echo '<div class="com"><p><a href="index.php?module='.$_GET['module'].'&action='. $action1 .'&id='. $_GET['id'].'"><i class="' . $image1 . '"></i> ';
		echo $nbLike[0]['nbLike'] .'</a>  ';
		echo '<a href="index.php?module='.$_GET['module'].'&action='. $action2 .'&id='. $_GET['id'].'"><i class="' . $image2 . '"></i> ';
		echo $nbDislike[0]['nbDislike'] .'</a></p></div>';


	}

	public function afficher_like_deco($nbLike, $nbDislike){
		$image1 = "fa-regular fa-thumbs-up";
		$image2 = "fa-regular fa-thumbs-down";
	
		echo '<div class="com"><p><i class="' . $image1 . '"></i> ';
		echo $nbLike[0]['nbLike'] .'  ';
		echo '<i class="' . $image2 . '"></i> ';
		echo $nbDislike[0]['nbDislike'] .'</p></div> ';


	}

	public function afficher_formulaire(){
		echo '<div class="com"><form action="index.php?module='.$_GET['module'].'&action=envoieComm&id='. $_GET['id'].'" method="post">
			<p>Commentaire : <br/> <textarea name="texteCommentaire"></textarea></p>
			<p><input type="submit" value="Envoyer"></p>
		</form></div>';
	}

	public function erreur_envoie_commentaire($messageErreur){
		echo $messageErreur;
	}



}