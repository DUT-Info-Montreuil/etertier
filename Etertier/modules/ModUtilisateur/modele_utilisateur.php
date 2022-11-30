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
        $selecPrepare = self::$bdd->prepare('SELECT * FROM listes WHERE auteur=? AND public=1');
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

    public function changer_photo_profil(){
        $t = array($_SESSION["login"]);
        $selecPrepare2 = self::$bdd->prepare('SELECT id FROM membres WHERE login=?');
        $selecPrepare2->execute($t);
        $tab = $selecPrepare2->fetchall();

        $t2 = $tab[0]["id"];

        if ($_FILES['photo']['error']) {
                switch ($_FILES['photo']['error']){
                case 1: // UPLOAD_ERR_INI_SIZE
                  return "Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";
                  break;
                case 2: // UPLOAD_ERR_FORM_SIZE
                  return "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
                  break;
                case 3: // UPLOAD_ERR_PARTIAL
                  return "L'envoi du fichier a été interrompu pendant le transfert !";
                  break;
                case 4: // UPLOAD_ERR_NO_FILE
                  return "Aucune image sélectionnée.";
                  break;
            }
        }
        else{
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["photo"]["name"];
            $filetype = $_FILES["photo"]["type"];


            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)){
                return "Erreur : Veuillez sélectionner un format de fichier valide ou veuillez renommer votre fichier avec l'extension a la fin.";
            }
            else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "ressources/photoProfile/" . $_FILES["photo"]["name"]);

                rename("ressources/photoProfile/" . $_FILES["photo"]["name"], "ressources/photoProfile/" . $t2);

                $t3 = $t2;

                $selecPrepare = self::$bdd->prepare('UPDATE membres SET membres.photoprofil=? WHERE id=?');
                $selecPrepare->execute(array($t3, $t2));    

                header('Location: index.php?module=pageuser');
                exit();
            }
        }
        
    }

    public function change_bio() {
        $t = array($_POST['newbio'], $_SESSION['login']);
        $selecPrepare = self::$bdd->prepare('UPDATE membres SET bio = ? WHERE login=?');
        $selecPrepare->execute($t);
        $tab = $selecPrepare->fetchall();
        
    }
}

?>