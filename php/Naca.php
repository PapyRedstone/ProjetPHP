<?php
require "Parametres.php";
require "Cambrure.php";

class Naca{
  private $Yg;
  private $Xg;
  private $parametre;
  private $cambrures;
  private $db;

  function __construct($db,$id){
    $this->db = $db;
    $this->parametre = $this->db->execute("SELECT * FROM parametre WHERE id = $id",null,"Parametres")[0];
    echo $this->parametre."<br>";
    $this->cambrures = $this->db->execute("SELECT * FROM cambrure WHERE id_param = $id",null,"Cambrure");
    echo $this->cambrures[0];
  }
}
?>
