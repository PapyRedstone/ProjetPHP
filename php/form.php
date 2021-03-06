<?php
require_once "database.php";
require "Naca.php";
require_once "delete.php";

//ADRIEN
//Vérifie que le formulaire a été rempli
function formChecking($formArray){

    foreach($formArray as $key => $value){

        if((strlen($value) == 0) || ($value == '/')){
            return false;
        }
    }
    return true;
}

//ADRIEN
//Purifie les données saisies dans le formulaire
function formPurify($formArray){

    //Supprime les '/' qi sont interdits dans les noms de fichier
    $libelle = str_replace('/', '', $formArray['libelle']);
    //Le nom de fichier est composé avec un timestamp afin d'éviter qu'un nouveau fichier n'en écrase un ancien de même nom
    $time = time();
    $fic_img = 'img_csv/'.$libelle.'_'.$time.'.png';
    $fic_csv = 'img_csv/'.$libelle.'_'.$time.'.csv';

    $arrayContent = array();
    $arrayContent['fic_img'] = $fic_img;
    $arrayContent['fic_csv'] = $fic_csv;

    //Remplacement des ',' par des '.' puis suppression de tous les caractères qui ne sont ni des chiffres ni la première occurence d'un '.'
    foreach($formArray as $key => $value){

        $arrayContent[$key] = str_replace(',', '.', $value);

        $length = strlen($arrayContent[$key]);
        $length;
        $test = $arrayContent[$key];
        $firstOccurrence = false;

        for($i=0 ; $i<$length ; $i++){

            $c = $arrayContent[$key][$i];
            
            if($c != '0' && $c != '1' && $c != '2' && $c != '3' && $c != '4' && $c != '5' && $c != '6' && $c != '7' && $c != '8' && $c != '9'){
                if($c == '.' && !$firstOccurrence){
                    $firstOccurrence = true;
                }
                else if($key != 'color' && $key != 'libelle' && $key != 'id'){
                    $arrayContent[$key][$i] = '';
                }
            }
        }
        $arrayContent[$key] = preg_replace( '/[^[:print:]]/', '',$arrayContent[$key]); // '' est un caractère invisble qui n'est ps accepté par la BDD il faut le supprimer
    }

    $arrayContent["tMaxmm"] = $arrayContent['tMaxPercent']/100*$arrayContent['corde'];
    $arrayContent["fMaxmm"] = $arrayContent['fMaxPercent']/100*$arrayContent['corde'];
    
    return $arrayContent;
}

//ALEXANDRE ADRIEN 
//Envoie la version purifiée des données saisies dans le formulaire
function addParametre($arrayContent){

    $db = new Database();
    $date = new DateTime();

    //S'il s'agit de la modification d'un enregistrement existant:
    if($arrayContent['id'] != 'false'){
      deleteFiles($db,$arrayContent['id']);
      deleteCambrures($db,$arrayContent['id']);
        //Modification des parametres de en BDD
        $query = "UPDATE parametre SET libelle = :libelle, corde = :corde, tMaxmm = :tMaxmm, tMaxPercent = :tMaxPercent, fMaxmm = :fMaxmm, fMaxPercent = :fMaxPercent, nbPoints = :nbPoints, date = :date, fic_img = :fic_img, fic_csv = :fic_csv, color = :color WHERE id = :id";

        $data = array("libelle"=>$arrayContent['libelle'], "corde"=>$arrayContent['corde'], "tMaxmm"=>$arrayContent['tMaxPercent']/100*$arrayContent['corde'], "tMaxPercent"=>$arrayContent['tMaxPercent'], "fMaxmm"=>$arrayContent['fMaxPercent']/100*$arrayContent['corde'], "fMaxPercent"=>$arrayContent['fMaxPercent'], "nbPoints"=>$arrayContent['nbPoints'], "date"=>$date->format('Y-m-d H:i:s'), "fic_img"=>"../".$arrayContent['fic_img'], "fic_csv"=>"../".$arrayContent['fic_csv'], "color"=>$arrayContent['color'],"id"=>$arrayContent['id']);

        $db->execute($query,$data);
        
        $naca = new Naca($db,$arrayContent['id'],true);
    }
    else{
      $query = "INSERT INTO parametre VALUES (null,:libelle, :corde, :tMaxmm, :tMaxPercent, :fMaxmm, :fMaxPercent, :nbPoints, :date, :fic_img, :fic_csv, :color)";
      
      $data = array("libelle"=>$arrayContent['libelle'], "corde"=>$arrayContent['corde'], "tMaxmm"=>$arrayContent['tMaxPercent']/100*$arrayContent['corde'], "tMaxPercent"=>$arrayContent['tMaxPercent'], "fMaxmm"=>$arrayContent['fMaxPercent']/100*$arrayContent['corde'], "fMaxPercent"=>$arrayContent['fMaxPercent'], "nbPoints"=>$arrayContent['nbPoints'], "date"=>$date->format('Y-m-d H:i:s'), "fic_img"=>"../".$arrayContent['fic_img'], "fic_csv"=>"../".$arrayContent['fic_csv'], "color"=>$arrayContent['color']);

      $db->execute($query,$data);

      $query = "SELECT * FROM parametre WHERE fic_img = '../".$arrayContent["fic_img"]."'";
      
      $id = $db->execute($query)[0]["id"];

      $naca = new Naca($db,$id,true);
    }

    return $arrayContent;
}

//ADRIEN
//fonction de synthèse
function form($form){

  if(formChecking($form)){
    $array = addParametre(formPurify($form));
    //Retour accueil
    header('Location: ../');
    exit();
}
 else{
   echo '<script type="text/javascript" src="../js/jquery.min.js" defer></script>'+
     '<script type="text/javascript" src="../js/bootstrap.js" defer></script>'+
     '<script type="text/javascript" src="../js/headerFooter.js" defer></script>';
   echo 'Aucun champ du formulaire ne doit être vide.<br>';
   echo '<form> <input type="button" value="Retour au formulaire" onclick="history.go(-1)"> </form>';
 }
}

form($_POST);

?>
