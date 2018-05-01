<?php
require_once "database.php";

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
    foreach($_POST as $key => $value){

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
                else if($key != 'intradosColor' && $key != 'extradosColor' && $key != 'libelle' && $key != 'exist'){
                    $arrayContent[$key][$i] = '';
                }
            }
        }
        $arrayContent[$key] = preg_replace( '/[^[:print:]]/', '',$arrayContent[$key]); // '' est un caractère invisble qui n'est ps accepté par la BDD il faut le supprimer
    }
    return $arrayContent;
}

//ADRIEN
//Envoie la version purifiée des données saisies dans le formulaire
function addParametre($arrayContent){

    $db = new Database();



    //$r = $this->db->execute("SELECT * FROM parametre WHERE id = $id",null,"Parametres");
    $date = new DateTime();
    $db->execute("INSERT INTO parametre VALUES (null,:libelle, :corde, :tMaxmm, :tMaxPercent, :fMaxmm, :fMaxPercent, :nbPoints, :date, :fic_img, :fic_csv, :intradosColor, :extradosColor)",array("libelle"=>$arrayContent['libelle'], "corde"=>$arrayContent['corde'], "tMaxmm"=>$arrayContent['tMaxmm'], "tMaxPercent"=>$arrayContent['tMaxPercent'], "fMaxmm"=>$arrayContent['fMaxmm'], "fMaxPercent"=>$arrayContent['fMaxPercent'], "nbPoints"=>$arrayContent['nbPoints'], "date"=>$date->format('Y-m-d H:i:s'), "fic_img"=>$arrayContent['fic_img'], "fic_csv"=>$arrayContent['fic_csv'], "intradosColor"=>$arrayContent['intradosColor'], "extradosColor"=>$arrayContent['extradosColor']));
}

//ADRIEN
//fonction de synthèse
function form($form){

    if(formChecking($form)){
        addParametre(formPurify($form));
        //Retour accueil
        //header('Location: /ProjetPHP');
    }
    else{
        echo 'Aucun champ du formulaire ne doit être vide.<br>';
        echo '<form> <input type="button" value="Retour au formulaire" onclick="history.go(-1)"> </form>';
    }
}

form($_POST);
?>
