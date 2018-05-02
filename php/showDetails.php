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
    require "Naca.php";
 
    $db = new Database();
$naca = new Naca($db,$_GET["id"]);
    
    echo '<img src="../'.$naca->getParametres()->getFic_img().'"><br>';
    echo 'Corde (mm): '.$naca->getParametres()->getCorde().'<br>';
    echo 't maximum (mm) : '.$naca->getParametres()->getTMaxmm().'<br>';
    echo 't maximum (%) : '.$naca->getParametres()->getTMaxPercent().'<br>';
    echo 'f maximum (mm) : '.$naca->getParametres()->getFMaxmm().'<br>';
echo 'f maximum (%) : '.$naca->getParametres()->getFMaxPercent().'<br>';
echo 'Igz (mm<sup>4</sup>): '.$naca->getIgX().'<br>';
echo 'Surface(mm²) : '.$naca->getS().'<br>';
    echo 'Nombre de points : '.$naca->getParametres()->getNbPoints().'<br><br>';

    echo 'Télécharger : ';
    echo '<a href ="../'.$naca->getParametres()->getFic_csv().'" download> <button type="button"> Fichier CSV </button> </a>';
    echo '<a href ="../'.$naca->getParametres()->getFic_img().'" download> <button type="button"> Image </button> </a><br><br><br>';
    
    echo '<a href ="../php/modify.php?id='.$_GET['id'].'" > <button type="button"> Modifier le profil </button> </a>';
    echo '<a href ="../php/deleteProfil.php?id='.$_GET['id'].'&sure=false" > <button type="button"> Supprimer le profil </button> </a>';

?>

    <footer></footer>

</body>
</html>
