<?php 

require_once 'connexion.php';

class ModeleUtilisateur extends Connexion{

    public function __construct() {
    }

    public function getDetails(){
        if(isset($_GET['id'])){
            $t = array($_GET['id']);
            $selecPrepare = self::$bdd->prepare('SELECT * FROM membres WHERE id=?');
            $selecPrepare->execute($t);
            $tab = $selecPrepare->fetchall();
            if(isset($tab[0])){
                return $tab[0];
            }
        }
        
        return NULL;
        
    }

    public function getSelfDetails(){
        if(isset($_SESSION['login'])){
            $t = array($_SESSION['login']);
            $selecPrepare = self::$bdd->prepare('SELECT * FROM membres WHERE login=?');
            $selecPrepare->execute($t);
            $tab = $selecPrepare->fetchall();
            if(isset($tab[0])){
                return $tab[0];
            }
        }
        
        return NULL;
        
    }

    public function get_Listes($id){
        $t = array($id);
        $selecPrepare = self::$bdd->prepare('SELECT * FROM listes WHERE auteur=?');
        $selecPrepare->execute($t);
        $tab = $selecPrepare->fetchall();
        if(isset($tab)){
            return $tab;
        }
        
        
        return NULL;
        
    }

    public function get_Articles($id){
        $t = array($id);
        $selecPrepare = self::$bdd->prepare('SELECT * FROM articles WHERE idAuteur=?');
        $selecPrepare->execute($t);
        $tab = $selecPrepare->fetchall();
        if(isset($tab)){
            return $tab;
        }
        
        
        return NULL;
        
    }
}

?>