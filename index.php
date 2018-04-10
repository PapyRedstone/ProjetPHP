<html>
  <body>

    <?php
      require 'php/database.php';
      require "php/Naca.php";

      $db = new Database();

      $n = new Naca($db,1);
    ?>
  
  </body>
</html>
