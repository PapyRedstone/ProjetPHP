<!--ADRIEN & ALEXANDRE-->
<html style="min-height=100%">
  <head>
<!-- Meta tags -->
  <meta charset="utf-8" />
   <meta name="author" content="Lebourgeois_Febvre" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   
   <!-- Title -->
   <title>Nacalculator</title>

   <link href="css\bootstrap.css" rel="stylesheet">

   <!-- Js Scripts -->

   <script type="text/javascript" src="js/jquery.min.js" defer></script>
  <script type="text/javascript" src="js/bootstrap.js" defer></script>
   <script type="text/javascript" src="js/headerFooter.js" defer></script>

     
  </head>
  <body>
   <header></header>

    <?php
      require 'php/database.php';
      require 'php/Naca.php';

      $db = new Database();
      $width = 300;
      $height = $width*0.4;
      $array = $db->execute("SELECT id, fic_img FROM parametre");

      foreach($array as $params){
        $naca = new Naca($db, $params['id']);
        echo '<a href="php/showDetails.php?id='.$naca->getParametres()->getId().'"><img src="'.$naca->getParametres()->getFic_img().'" width = "'.$width.'" height = "'.$height.'"></a><br><br>';
      }


<<<<<<< HEAD
=======
      $n = new Naca($db,1);
      //$n -> drawGraph(800, true);

>>>>>>> b706eb1a508255e3eb292449314e38abf8bdfec0
    ?>

    <footer></footer>

   </body>
</html>
