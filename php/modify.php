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
            require 'database.php';
            require "Parametres.php";
            $db = new Database();
            $parametres = $db->execute('SELECT * FROM parametre WHERE id = '.$_GET['id'],null,"Parametres");

            echo '<br>Modification de profil :<br><br>';
            echo '<form action="../php/form.php" method="POST">';
            echo 'Libelle : <input type="text" name="libelle" value="'.$parametres[0]->getLibelle().'"><br>';
            echo 'Corde (mm): <input type="text" name="corde" value="'.$parametres[0]->getCorde().'"><br><br>';
            echo 't maximum (%) : <input type="text" name="tMaxPercent" value="'.$parametres[0]->getTMaxPercent().'"><br><br>';
            echo 'f maximum (%) : <input type="text" name="fMaxPercent" value="'.$parametres[0]->getFMaxPercent().'"><br><br>';
            echo' Nombre de points : <input type="text" name="nbPoints" value="'.$parametres[0]->getNbPoints().'"><br><br>';
            echo 'Couleur du profil : <input type="color" name="color" value="'.$parametres[0]->getColor().'"><br><br>';
            echo '<input type="hidden" name="id" value="'.$_GET['id'].'">';//Champ caché permettant de définir le numéro d'enregistre en cours de modification
            echo '<input type="submit" value="Valider"/><br>';
            echo '</form>';
        ?>

    <footer></footer>

</body>
</html>
