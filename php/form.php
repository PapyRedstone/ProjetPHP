<?php
//ADRIEN
require_once "database.php";

$db = new Database();
$date = new DateTime();

$fic_img = $_POST['libelle'].'.png';
$fic_csv = $_POST['libelle'].'.csv';

//Remplacement des ',' par des '.'
$arrayContent = array();
foreach($_POST as $key => $value){

    $arrayContent[$key] = str_replace(',', '.', $value);
}


// envoi des données saisies
$db->execute("INSERT INTO parametre VALUES (null,:libelle, :corde, :tMaxmm, :tMaxPercent, :fMaxmm, :fMaxPercent, :nbPoints, :date, :fic_img, :fic_csv, :intradosColor, :extradosColor)",array("libelle"=>$arrayContent['libelle'], "corde"=>$arrayContent['corde'], "tMaxmm"=>$arrayContent['tMaxmm'], "tMaxPercent"=>$arrayContent['tMaxPercent'], "fMaxmm"=>$arrayContent['fMaxmm'], "fMaxPercent"=>$arrayContent['fMaxPercent'], "nbPoints"=>$arrayContent['nbPoints'], "date"=>$date->format('Y-m-d H:i:s'), "fic_img"=>$fic_img, "fic_csv"=>$fic_csv, "intradosColor"=>$arrayContent['intradosColor'], "extradosColor"=>$arrayContent['extradosColor']));

//Retour accueil
header('Location: /ProjetPHP/index.php');
?>
