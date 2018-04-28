<!--ADRIEN & ALEXANDRE-->
<html style="min-height=100%">
  <head>
<!-- Meta tags -->
  <meta charset="utf-8" />
   <meta name="author" content="Febvre_Lebourgeois" />
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
      require "php/Naca.php";

      $db = new Database();
      $n = new Naca($db,2);
      $n -> drawGraph(500, true);
    ?>

    <footer></footer>

   </body>
</html>
