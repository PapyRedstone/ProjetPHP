<?php
require_once 'database.php';
//ADRIEN
function deleteFiles($db){

    $paths = $db->execute('SELECT fic_img, fic_csv FROM parametre WHERE id = '.$_GET['id']);
    var_dump($paths);
    //Suppression des fichiers liés aux enregistrements
    chmod('../'.$paths['fic_img'], 777);
    unlink('../'.$paths['fic_img']);
    chmod('../'.$paths['fic_csv'], 777);
    unlink('../'.$paths['fic_csv']);
}

$db = new Database();

deleteFiles($db);

//Il faut supprimer les points de cambrure avant les paramètres car ils dépendent de ces derniers
$db->execute("DELETE FROM cambrure WHERE idParam = :id", array("id"=>$_GET['id']));
$db->execute("DELETE FROM parametre WHERE id = :id", array("id"=>$_GET['id']));
//Retour accueil
?>