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
            self::$bdd = new PDO("mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201657;charset=utf8", "dutinfopw201657", "qupevuna");
            //self::$bdd = new PDO('mysql:host=localhost;dbname=php', 'root','');
s        }
	}
?>
	
