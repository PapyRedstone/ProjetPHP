<html>
  <body>
    <img src="php/image.php">
   <?php
   require 'php/database.php'
   require "php/Naca.php"

   $db = new Database();
   
$n = new Naca($db,0);
   ?>
  </body>
</html>
