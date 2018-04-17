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
    $r = $this->db->execute("SELECT * FROM parametre WHERE id = $id",null,"Parametres");
    if(!isset($r[0])){
      return;
    }
    $this->parametre = $r[0];
    echo $this->parametre."<br>";
    $this->cambrures = $this->db->execute("SELECT * FROM cambrure WHERE idParam = $id",null,"Cambrure");
    if(!isset($this->cambrures[0])){
      $this->calculateCambrure($this->parametre->getId(),$this->parametre->getLibelle(),$this->parametre->getCorde(),$this->parametre->getTMaxmm(),$this->parametre->getFMaxmm(),$this->parametre->getNbPoints());
    }
  }

  function getT($X,$tmmm){
    return -(1.015*pow($X,4)-2.843*pow($X,3)+3.516*pow($X,2)+1.26*$X-2.969*sqrt($X))*$tmmm;
  }

  function calculateCambrure($id,$lib,$c,$tmmm,$fmmm,$nb_points){
    $dX = $c/$nb_points;
    $sommedS = 0;
    $sommedXdS = 0;
    for($x=0;$x<=$c;$x+=$dX){
      $X = $x/$c;
      $t = $this->getT($X,$tmmm);
      $f = -4*(pow($X,2)-$X)*$fmmm;
      $yI = $f-$t/2;
      $yE = $f+$t/2;

      $dS = $dX*$this->getT($X+$dX/2,$tmmm);

      $sommedS += $dS;
      $sommedXdS += $dS * $X+$dX/2;
    }
    $Xg = $sommedXdS / $sommedS;
  }
}
?>
