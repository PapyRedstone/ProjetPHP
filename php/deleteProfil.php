<!--ADRIEN & ALEXANDRE-->
<html style="min-height=100%">
  <head>
<!-- Meta tags -->
   <meta charset="utf-8" />
   <meta name="author" content="Lebourgeois_Febvre" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   
   <!-- Title -->
   <title>Nacalculator</title>
   
   <link href="../css\bootstrap.css" rel="stylesheet">
   
   <!-- Js Scripts -->
   
   <script type="text/javascript" src="../js/jquery.min.js" defer></script>
   <script type="text/javascript" src="../js/bootstrap.js" defer></script>
   <script type="text/javascript" src="../js/headerFooter.js" defer></script>

   
  </head>
   <body>
   <header></header>
   
   
<?php
   require "delete.php";
require_once "database.php";

if($_GET["sure"] == "false"){
  echo "<h1>Voulez vous supprimer ce profil?</h1>";
  echo "<button type='button' onclick=\"location.href='deleteProfil.php?id=".$_GET["id"]."&sure=true'\">Oui</button>";
  echo "<button type='button' onclick=\"location.href='../index.php'\">Non</button>";
  echo "<br>";
 }
 else{
   $db = new Database();
   deleteFiles($db,intval($_GET["id"]));
   deleteFromBDD($db,intval($_GET["id"]));
   header('Location: ../');
 }
?>

<footer></footer>

</body>
</html>
