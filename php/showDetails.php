<?php
    
    require 'database.php';
    require "Parametres.php";

    $db = new Database();
    $parametres = $db->execute('SELECT * FROM parametre WHERE id = '.$_GET['id'],null,"Parametres");
    
    echo '<img src="../'.$parametres[0]->getFic_img().'"><br>';
    echo 'Corde (mm): '.$parametres[0]->getCorde().'<br>';
    echo 't maximum (mm) : '.$parametres[0]->getTMaxmm().'<br>';
    echo 't maximum (%) : '.$parametres[0]->getTMaxPercent().'<br>';
    echo 'f maximum (mm) : '.$parametres[0]->getFMaxmm().'<br>';
    echo 'f maximum (%) : '.$parametres[0]->getFMaxPercent().'<br>';
    echo 'Nombre de points : '.$parametres[0]->getNbPoints().'<br><br>';
    echo 'Télécharger : ';
    echo '<a href ="../'.$parametres[0]->getFic_csv().'" download> <button type="button"> Fichier CSV </button> </a>';
    echo '<a href ="../'.$parametres[0]->getFic_img().'" download> <button type="button"> Profil NACA </button> </a>';
    //echo '<a href="#"> <img border="0" alt="W3Schools" src="'.$parametres->getFic_img()." width="100" height="100"></a>'
?>