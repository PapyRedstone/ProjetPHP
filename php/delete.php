<?php
require_once 'database.php';
//ADRIEN
function deleteFiles($db,$id){

    $paths = $db->execute('SELECT fic_img, fic_csv FROM parametre WHERE id = '.$id']);

    //Suppression des fichiers liés aux enregistrements
    chmod('../'.$paths[0]['fic_img'], 777);
    unlink('../'.$paths[0]['fic_img']);
    chmod('../'.$paths[0]['fic_csv'], 777);
    unlink('../'.$paths[0]['fic_csv']);

    $db = new Database();

    deleteFiles($db);
    
    //Il faut supprimer les points de cambrure avant les paramètres car ils dépendent de ces derniers
    $db->execute("DELETE FROM cambrure WHERE idParam = :id", array("id"=>$id));
    $db->execute("DELETE FROM parametre WHERE id = :id", array("id"=>$id));
    
}


?>
