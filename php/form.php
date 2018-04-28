<?php
require_once "database.php";

$db = new Database();
$date = new DateTime();

$fic_img = $_POST['libelle'].'.png';
// envoi des données saisies
$db->execute("INSERT INTO parametre VALUES (null,:libelle, :corde, :tMaxmm, :tMaxPercent, :fMaxmm, :fMaxPercent, :nbPoints, :date, :fic_img, null)",array("libelle"=>$_POST['libelle'], "corde"=>$_POST['corde'], "tMaxmm"=>$_POST['tMaxmm'], "tMaxPercent"=>$_POST['tMaxPercent'], "fMaxmm"=>$_POST['fMaxmm'], "fMaxPercent"=>$_POST['fMaxPercent'], "nbPoints"=>$_POST['nbPoints'], "date"=>$date->format('Y-m-d H:i:s'), "fic_img"=>$fic_img));

header('Location: /ProjetPHP/index.php');
?>
