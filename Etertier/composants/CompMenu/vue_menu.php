<?php

	class VueMenu{

		public $contenu;

		public function __construct (){
			$this->contenu = '<div>';
				
				$this->contenu .= 
				"<nav>
					<ul class=\"nav justify-content-center\">
						<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php\">Acceuil</a></li>
						<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?module=jeux\">Jeux</a></li>
						<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php\">Liste Rédacteurs</a></li>
						<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php\">Liste Membres</a></li>
						<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?module=article\">Articles</a></li>
						<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php\">FAQ</a></li>
					</ul>
				</nav>";
				if(!isset($_SESSION['login'])){
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