<html>
  <head>
    		<!-- Meta tags -->
		<meta charset="utf-8" />
		<meta name="author" content="Febvre_Lebourgeois" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<!-- Title -->
		<title>Nacalculator</title>

    <!-- Js Scripts -->
    <script src="js/jquery.min.js" defer></script>
		<script src="js/bootstrap.min.js" defer></script>
		<script type="text/javascript" src="js/headerFooter.js" defer></script>

  </head>
  <body>

    <?php
      require 'php/database.php';
      require "php/Naca.php";

      $db = new Database();

      $n = new Naca($db,1);
    ?>
  

  </body>
</html>
