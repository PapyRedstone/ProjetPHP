<?php
//ADRIEN
require_once "database.php";

$db = new Database();
$date = new DateTime();

$libelle = str_replace('/', '', $_POST['libelle']);
$fic_img = 'img_csv/'.$libelle.'.png';
$fic_csv = 'img_csv/'.$libelle.'.csv';

//Remplacement des ',' par des '.' puis suppression de tous les caractères qui ne sont ni des chiffres ni la première occurence d'un '.'
$arrayContent = array();

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
            else if($key != 'intradosColor' && $key != 'extradosColor' && $key != 'libelle'){
                $arrayContent[$key][$i] = '';
            }
        }
    }
    $arrayContent[$key] = preg_replace( '/[^[:print:]]/', '',$arrayContent[$key]); // '' est un caractère invisble qui n'est ps accepté par la BDD il faut le supprimer
}



// envoi des données saisies
$db->execute("INSERT INTO parametre VALUES (null,:libelle, :corde, :tMaxmm, :tMaxPercent, :fMaxmm, :fMaxPercent, :nbPoints, :date, :fic_img, :fic_csv, :intradosColor, :extradosColor)",array("libelle"=>$arrayContent['libelle'], "corde"=>$arrayContent['corde'], "tMaxmm"=>$arrayContent['tMaxmm'], "tMaxPercent"=>$arrayContent['tMaxPercent'], "fMaxmm"=>$arrayContent['fMaxmm'], "fMaxPercent"=>$arrayContent['fMaxPercent'], "nbPoints"=>$arrayContent['nbPoints'], "date"=>$date->format('Y-m-d H:i:s'), "fic_img"=>$fic_img, "fic_csv"=>$fic_csv, "intradosColor"=>$arrayContent['intradosColor'], "extradosColor"=>$arrayContent['extradosColor']));

//Retour accueil
header('Location: /ProjetPHP');
?>
