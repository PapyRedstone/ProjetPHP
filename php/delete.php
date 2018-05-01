<?php
    require 'database.php';

    if($_GET['sure'] == 'true'){

        $db = new Database();
        //Il faut supprimer les points de cambrure avant les paramètres car ils dépendent de ces derniers
        $db->execute("DELETE FROM cambrure WHERE idParam = :id", array("id"=>$_GET['id']));
        $db->execute("DELETE FROM parametre WHERE id = :id", array("id"=>$_GET['id']));
        //Retour accueil
        header('Location: /ProjetPHP');
    }
    else{
        echo 'Etes vous sûr de vouloir supprimer l\'enregistrement ?<br><br>';
        echo '<a href ="../php/delete.php?id='.$_GET['id'].'&sure=true" > <button type="button"> Oui supprimer le profil </button> </a>';
        echo '<a href ="../php/showDetails.php?id='.$_GET['id'].'" > <button type="button"> Nop </button> </a>';
    }



?>