<?php
require "Parametres.php";
require "Cambrure.php";
require_once ('jpgraph-4.2.0/jpgraph.php');
require_once ('jpgraph-4.2.0/jpgraph_line.php');

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
      error_log(' /!\ QUERY RESULT FOR "PARAMETRES" NUMBERED '.$id.' IS NULL /!\ ');
      return;
    }
    $this->parametre = $r[0];

    $this->cambrures = $this->db->execute("SELECT * FROM cambrure WHERE idParam = $id",null,"Cambrure");
    if(!isset($this->cambrures[0])){
      echo isset($this->cambrures[0])." <br><pre>";

      echo "</pre>";
      $this->calculateCambrure($this->parametre->getId(),$this->parametre->getCorde(),$this->parametre->getTMaxmm(),$this->parametre->getFMaxmm(),$this->parametre->getNbPoints());
    }
    else{
      echo "Deja calculer #Voltaire<br>";
    }
  }

  function getT($X,$tmmm){
    return -(1.015*pow($X,4)-2.843*pow($X,3)+3.516*pow($X,2)+1.26*$X-2.969*sqrt($X))*$tmmm;
  }

  function calculateCambrure($id,$c,$tmmm,$fmmm,$nb_points){

    $dX = $c/$nb_points;
    $sommedS = 0;
    $sommedXdS = 0;
    for($x=0;$x<=$c;$x+=$dX){
      $X = $x/$c;
      $t = $this->getT($X,$tmmm);
      $f = -4*(pow($X,2)-$X)*$fmmm;
      $yI = $f-$t/2;
      $yE = $f+$t/2;

      $this->db->execute("INSERT INTO cambrure VALUES (null,:x,:t,:f,:idP,:yi,:ye,:G)",array("x"=>$x,"t"=>$t,"f"=>$f,"idP"=>$id,"yi"=>$yI,"ye"=>$yE,"G"=>$x+$dX/2));
      $dS = $dX*$this->getT($X+$dX/2,$tmmm);

      $sommedS += $dS;
      $sommedXdS += $dS * $x+$dX/2;
    }
    $Xg = $sommedXdS / $sommedS;

    createImg();
    createCSV();
  }

  function createImg(){}//pas besoin

  function createCSV(){
    
  }

  function drawGraph(){

    $arrayX = array();
    $arrayYextrados = array();
    $arrayYintrados = array();
    $i=0;

    foreach($this->cambrures as $cambrure){
      
      $arrayX[$i] = $cambrure->getX();

      $arrayYextrados[$i] = $cambrure->getYextrados();
      $arrayYintrados[$i] = $cambrure->getYintrados();
      $i++;
    }

    //GRAPHIQUE
    $graph = new Graph(500);
    $graph->SetScale("intlin", 0, 0, 0, $arrayX[$i]);

    $theme_class=new UniversalTheme;

    $graph->SetTheme($theme_class);
    $graph->img->SetAntiAliasing();
    $graph->title->Set($this->parametre->getLibelle().' - '.$this->parametre->getDate());
    $graph->SetBox(false);

    // Axe des ordonnées
    $graph->yaxis->HideZeroLabel();
    $graph->yaxis->HideLine(false);
    $graph->yaxis->HideTicks(false,false);
    $graph->xgrid->Show();
    $graph->xgrid->SetLineStyle("solid");
    $graph->xgrid->SetColor('#E3E3E3');

    // Première courbe
    $p1 = new LinePlot($arrayYextrados, $arrayX);
    $graph->Add($p1);
    $p1->SetColor($this->parametre->getIntradosColor());
    $p1->SetLegend('Y Extrados');

    // Deuxième courbe
    $p2 = new LinePlot($arrayYintrados, $arrayX);
    $graph->Add($p2);
    $p2->SetColor($this->parametre->getExtradosColor());
    $p2->SetLegend('Y Intrados');


    $graph->legend->SetFrameWeight(1);
    //$graph->img->SetAntiAliasing();

    // Stockage de l'image
    $graph->Stroke($this->parametre->getLibelle().".png");

    echo '<img src="'.$this->parametre->getLibelle().'.png"></img>';

  }
}
?>