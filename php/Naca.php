<?php
require "Parametres.php";
require "Cambrure.php";

class Naca{
  private $id;
  private $Yg;
  private $Xg;
  private $parametre;
  private $cambrures;
  private $db;

  function __construct($db,$id){
    $this->id = $id;
    $this->db = $db;
    $r = $this->db->execute("SELECT * FROM parametre WHERE id = $id",null,"Parametres");
    if(!isset($r[0])){
      echo "Les parametres n'existent pas<br>";
      return;
    }
    $this->parametre = $r[0];

    $this->cambrures = $this->db->execute("SELECT * FROM cambrure WHERE idParam = $id",null,"Cambrure");
    if(!isset($this->cambrures[0])){
      echo isset($this->cambrures[0])." <br><pre>";
      var_dump($this->cambrures);
      var_dump($this->parametre);
      echo "</pre>";
      $this->calculateCambrure();
    }
    else{
      echo "Deja calculer<br>";
    }
  }

  function getT($X,$tmmm){
    return -(1.015*pow($X,4)-2.843*pow($X,3)+3.516*pow($X,2)+1.26*$X-2.969*sqrt($X))*$tmmm;
  }

  function calculateCambrure(){
    $id = $this->parametre->getId();
    $c = $this->parametre->getCorde();
    $tmmm = $this->parametre->getTMaxmm();
    $fmmm = $this->parametre->getFMaxmm();
    $nb_points = $this->parametre->getNbPoints();
    
    $this->db->execute("DELETE FROM cambrure WHERE idParam = :id",array("id"=>$id));
    
    $dX = $c/$nb_points;
    $sommedS = 0;
    $sommedXdS = 0;
    for($x=0;$x<=$c;$x+=$dX){
      $X = $x/$c;
      $t = $this->getT($X,$tmmm);
      $f = -4*(pow($X,2)-$X)*$fmmm;
      $yI = $f-$t/2;
      $yE = $f+$t/2;

      $this->db->execute("INSERT INTO cambrure VALUES (null,:x,:t,:f,:yi,:ye,:idP,:G)",array("x"=>$x,"t"=>$t,"f"=>$f,"yi"=>$yI,"ye"=>$yE,"idP"=>$id,"G"=>$x+$dX/2));

      $dS = $dX*$this->getT($X+$dX/2,$tmmm);

      $sommedS += $dS;
      $sommedXdS += $dS * $x+$dX/2;
    }
    $Xg = $sommedXdS / $sommedS;

    createImg();
    createCSV();
  }

  function createImg(){}

  function createCSV(){
    
  }
}
?>
