<html style="min-height=100%">
  <head>
<!-- Meta tags -->
  <meta charset="utf-8" />
   <meta name="author" content="Febvre_Lebourgeois" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   
   <!-- Title -->
   <title>Nacalculator</title>

   <link href="css\bootstrap.css" rel="stylesheet">
   
     
   </head>
  <body>
   <header></header>
    <?php
   require 'php/database.php';
require "php/Naca.php";

$db = new Database();

$n = new Naca($db,2);
?>

<footer></footer>

<!-- Js Scripts -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
   <script type="text/javascript" src="js/bootstrap.js"></script>
   <script type="text/javascript" src="js/headerFooter.js"></script>
   
   </body>
</html>
