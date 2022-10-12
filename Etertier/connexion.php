<?php
//dutinfo
	class Connexion	{
		
	protected static $bdd;
        //dutinfopw201651
        //rubajype
        //http://database-etudiants.iut.univ-paris8.fr/phpmyadmin/
        public function __construct(){
        }

        public static function initConnexion(){
            self::$bdd = new PDO("mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201657;port=mon_port", "dutinfopw201657", "qupevuna");
        }
	}
?>
	
