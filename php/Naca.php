<?php
require "Parametres.php";
require "Cambrure.php";

class Naca{
  private $Yg;
  private $Xg;
  private $parametre;
  private $cambrures;

  function __construct($db,$id){
    $this->parametre = $db->execute("SELECT * FROM parametre WHERE id = $id",null,"Parametres")[0];
var_dump($this->parametre);
  }
}
?>
