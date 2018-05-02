<?php
require_once 'database.php';
//ADRIEN
function deleteFiles($db,$id){

    $paths = $db->execute('SELECT fic_img, fic_csv FROM parametre WHERE id = '.$id)[0];

    //Suppression des fichiers liés aux enregistrements
    chmod($paths['fic_img'], 777);
    unlink($paths['fic_img']);
    chmod($paths['fic_csv'], 777);
    unlink($paths['fic_csv']);
}
//ALEXANDRE
function deleteCambrures($db,$id){
  //Supprimer le contenu de la table cambrure relatif a un parametre
  $db->execute("SET FOREIGN_KEY_CHECKS = 0");
  $db->execute("DELETE FROM cambrure WHERE idParam = :id", array("id"=>$id));
  $db->execute("SET FOREIGN_KEY_CHECKS = 1");    
}

function deleteFromBDD($db,$id){
  //Supprimer le contenu de la table cambrure et parametre lies entre eux
  deleteCambrures($db,$id);
  $db->execute("DELETE FROM parametre WHERE id = :id", array("id"=>$id));
}


?>
