<?php
require "Parametres.php";
require "Cambrure.php";
require_once '../jpgraph-4.2.0/jpgraph.php';
require_once '../jpgraph-4.2.0/jpgraph_line.php';

//ALEXANDRE ADRIEN
class Naca{
  private $Yg;
  private $Xg;
  private $parametre;
  private $cambrures;
  private $db;

  function __construct($db, $id, $force = false){
    $this->db = $db;

    $r = $this->db->execute("SELECT * FROM parametre WHERE id = $id",null,"Parametres");

    if(!isset($r[0])){
      error_log(' /!\ QUERY RESULT FOR "PARAMETRES" NUMBERED '.$id.' IS NULL /!\ ');
      return;
    }
    $this->parametre = $r[0];

    $this->cambrures = $this->db->execute("SELECT * FROM cambrure WHERE idParam = $id",null,"Cambrure");
 
    if(!isset($this->cambrures[0]) || $force){//'$force' permet de forcer la création du graphique et c'est en cas de modification que la création du graphique est forcée, donc le graphique existe déjà
      $this->calculateCambrure();
      $this->createCSV();
      $this->drawGraph(800);
    }
  }

  function getParametres(){
    return $this->parametre;
  }

  function getCambrures(){
    return $this->cambrures;
  }

  function getT($X,$tmmm){
    return -(1.015*pow($X,4)-2.843*pow($X,3)+3.516*pow($X,2)+1.26*$X-2.969*sqrt($X))*$tmmm;
  }

  function calculateCambrure(){
    $id = $this->parametre->getId();
    $c = $this->parametre->getCorde();
    $tmmm = $this->parametre->getTMaxmm();
    $fmmm = $this->parametre->getfMaxmm();
    $nb_points = $this->parametre->getNbPoints();
    
    $dX = $c/$nb_points;
    $sommedS = 0;
    $sommedXdS = 0;
    for($x=0;$x<=$c;$x+=$dX){
      $X = $x/$c;
      $t = $this->getT($X,$tmmm);
      $f = -4*(pow($X,2)-$X)*$fmmm;
      $yI = $f-$t/2;
      $yE = $f+$t/2;

      $this->db->execute("INSERT INTO cambrure VALUES (null,:x,:t,:f,:idP,:yi,:ye,:G, null, null)",array("x"=>$x,"t"=>$t,"f"=>$f,"idP"=>$id,"yi"=>$yI,"ye"=>$yE,"G"=>$x+$dX/2));
      $dS = $dX*$this->getT($X+$dX/2,$tmmm);

      $sommedS += $dS;
      $sommedXdS += $dS * $x+$dX/2;
    }
    $Xg = $sommedXdS / $sommedS;


    $this->cambrures = $this->db->execute("SELECT * FROM cambrure WHERE idParam = ".$id,null,"Cambrure");
  }

//ADRIEN
  function createCSV(){

    if(!file_exists($this->parametre->getFic_csv())){

      $csvFile = fopen($this->parametre->getFic_csv(), "w");
      foreach($this->cambrures as $line){
        $lineCSV = array($line);
        fputcsv($csvFile, $lineCSV, ';', '"');
      }
      fclose($csvFile);
    }
  }

//ADRIEN
  function drawGraph($size){

    if(!file_exists($this->parametre->getFic_img())){ 
      $arrayX = array();
      $arrayYextrados = array();
      $arrayYintrados = array();
      //$arrayXgDot = array();
      //$arrayYgDot = array();
      $i=0;

      foreach($this->cambrures as $cambrure){
        
        $arrayX[$i] = $cambrure->getX();

        $arrayYextrados[$i] = $cambrure->getYextrados();
        $arrayYintrados[$i] = $cambrure->getYintrados();

        $i++;
      }
      //$arrayYgDot = $cambrure->getYgDot();
      //$arrayXgDot = $cambrure->getXgDot();

      //GRAPHIQUE
      $graph = new Graph($size, 0.4*$size);//le ratio est de 0,4 entre la hauteur et la largeur
      $graph->SetScale("intlin", 0, 0, 0, $arrayX[$i-1]);
      $graph->SetShadow();
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

      // Point G
      /*
      $p3 = new LinePlot($arrayYgDot, $arrayXgDot);
      $graph->Add($p3);
      //$p3->SetColor('#FF0000');
      $p3->setWeight(5);
      $p3->mark->SetType(MARK_X,'',100);
      //$p3->mark->SetFillColor('#FF0000');
      $p3->SetLegend('Centre de gravité');
      */
      $graph->legend->SetFrameWeight(1);

      // Stockage de l'image
      $graph->Stroke($this->parametre->getFic_img());
    }
  }
}
?>
