<!--ADRIEN-->

<html style="min-height=100%">
    <head>
<!-- Meta tags -->
        <meta charset="utf-8" />
        <meta name="author" content="Febvre_Lebourgeois" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Title -->
        <title>Nacalculator</title>

        <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Js Scripts -->

        <script type="text/javascript" src="../js/jquery.min.js" defer></script>
        <script type="text/javascript" src="../js/bootstrap.js" defer></script>
        <script type="text/javascript" src="../js/headerFooter.js" defer></script>

  </head>
  <body>
   <header></header>
<?php
    //ADRIEN
    //Affiche les graphiques en grand format ainsi que les données qui ont permis le calcul
    //Permet de télécharger le fichier CSV et les images des graphiques
    //Permet d'acceder à la page de modification ou de supprimer un enregistrement
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
    echo '<a href ="../'.$parametres[0]->getFic_img().'" download> <button type="button"> Profil NACA </button> </a><br><br><br>';
    
    echo '<a href ="../php/modify.php?id='.$_GET['id'].'" > <button type="button"> Modifier le profil </button> </a>';
    echo '<a href ="../php/deleteProfil.php?id='.$_GET['id'].'&sure=false" > <button type="button"> Supprimer le profil </button> </a>';

?>

    <footer></footer>

</body>
</html>
