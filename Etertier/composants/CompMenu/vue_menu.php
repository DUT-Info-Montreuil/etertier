<?php
//href=\"index.php?module=jeux\"
	class VueMenu{

		public $contenu;

		public function __construct ($tab){
			$this->contenu = '<div>';
				
				$this->contenu .= 
					"<nav class=\"navbar navbar-expand navbar-dark bg-dark\">
						<div class=\"navbar-collapse collapse justify-content-between\">
							<ul class=\"navbar-nav\">
								<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php\">Accueil</a></li>
								<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?module=article\">Articles</a></li>
								<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?module=listes\">Listes</a></li>
								<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?module=jeux\">Jeux</a></li>
								<li class=\"nav-item dropdown\">
									<button class=\"btn btn-secondary dropdown-toggle\" type=\"button\" id=\"dropdownmenu\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
										<i class=\"fa-solid fa-arrow-down\"></i>
									</button>
									<div class=\"dropdown-menu\" aria-labelledby=\"dropdownmenu\">";

									foreach($tab as $cle=>$val){
										$this->contenu .= "<a class=\"dropdown-item\" href=\"index.php?module=jeux&action=genre&genre=". $val['idGenre'] ."\">". $val['nomGenre'] ."</a>";
									}

								$this->contenu.="</div>";
								if(isset($_SESSION['login'])){
								$this->contenu.="<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?module=creationListe\">Créer une liste</a></li>";
								if(isset($_SESSION['redacteur']) && $_SESSION['redacteur']==1){
									$this->contenu.="<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?module=article&action=redaction\">Rédiger un article</a></li>";
									$this->contenu.="<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?module=creerjeu\">Ajouter un jeu</a></li>";
								}
								}
								$this->contenu.="<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php\">FAQ</a></li>
							</ul>";
				if(!isset($_SESSION['login'])){
				  $this->contenu .= 
				  "		<ul class=\"navbar-nav\">
							<li class=\"nav-item\"><a class=\"nav-link\" href=index.php?module=connexion&action=connexion>Connexion</a></li>
							<li class=\"nav-item\"><a class=\"nav-link\" href=index.php?module=connexion&action=inscription>Inscription</a></li>
						</ul></div></nav>";
				} else{
					$this->contenu .= "<ul class=\"navbar-nav\">
							<li class=\"nav-item\"><a class=\"nav-link\" href=index.php?module=pageuser>".$_SESSION['login']."</a></li>
							<li class=\"nav-item\"><a class=\"nav-link\" href=index.php?module=connexion&action=deconnexion>Déconnexion</a></li>
						</ul></div></nav>";
				}
		}

	}
?>