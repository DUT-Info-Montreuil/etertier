<?php

	class VueMenu{

		public $contenu;

		public function __construct (){
			$this->contenu = '<div>';
				if(!isset($_SESSION['login'])){
					$this->contenu .= 
					"<nav>
						<ul class=\"nav justify-content-center\">
							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Acceuil</a></li>
							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Jeux</a></li>
							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Liste Rédacteurs</a></li>
							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Liste Membres</a></li>
							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Articles</a></li>
							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">FAQ</a></li>
						</ul>
				  </nav>";
				  $this->contenu .= 
				  "<nav>
					  <ul class=\"nav justify-content-end\">
					  		<li class=\"nav-item\"><a class=\"nav-link\" href=index.php?module=connexion&action=connexion>Connexion</a></li>
						  	<li class=\"nav-item\"><a class=\"nav-link\" href=index.php?module=connexion&action=inscription>Inscription</a></li>
					  </ul>
				  </nav>";
				} else{
					$this->contenu .= "<i class=\"fa-solid fa-user\"></i>" . $_SESSION['login']." - <a href=index.php?module=connexion&action=deconnexion>Déconnexion</a></nav>";
				}
		}

	}
?>