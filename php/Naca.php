<?php
require "Parametres.php";
require "Cambrure.php";
require_once 'jpgraph-4.2.0/jpgraph.php';
require_once 'jpgraph-4.2.0/jpgraph_line.php';

//ALEXANDRE ADRIEN
class Naca{
  private $Yg;
  private $Xg;
  private $IgX;
  private $S;
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
 
    if(!isset($this->cambrures[0]) || $force){//'$force' permet de forcer la generation des points
      $this->calculateCambrure();
      $this->createCSV();
      $this->drawGraph(800);
    }
    $this->calculateIgz();
  }

  function getParametres(){
    return $this->parametre;
  }

  function getCambrures(){
    return $this->cambrures;
  }

  function getIgX(){
    return $this->IgX;
  }

  function getS(){
    return $this->S;
  }

  function getT($X,$tmmm){
    return -(1.015*pow($X,4)-2.843*pow($X,3)+3.516*pow($X,2)+1.26*$X-2.969*sqrt($X))*$tmmm;
  }

  function getF($X,$fmmm){
    return -4*(pow($X,2)-$X)*$fmmm;
  }

  function calculateCambrure(){
    $id = $this->parametre->getId();
    $c = $this->parametre->getCorde();
    $tmmm = $this->parametre->getTMaxmm();
    $fmmm = $this->parametre->getfMaxmm();
    $nb_points = $this->parametre->getNbPoints();
    
    $dX = $c/$nb_points;
    $sumdS = 0;
    $sumXgdS = 0;
    $sumYgdS = 0;

    for($x = 0; $x <= $c ; $x += $dX){
      $t = $this->getT($x/$c,$tmmm);
      $f = $this->getF($x/$c,$fmmm);
      $yI = $f-$t/2;
      $yE = $f+$t/2;

      $dSi = $dX*$this->getT(($x+$dX/2)/$c,$tmmm);

      $sumdS += $dSi;
      $sumXgdS += ($x + $dX/2) * $dSi;
      $sumYgdS += abs($yE+$yI)/2 * $dSi;

      $this->db->execute("INSERT INTO cambrure VALUES (null,:x,:t,:f,:idP,:yi,:ye,:Igx)",array("x"=>$x,"t"=>$t,"f"=>$f,"idP"=>$id,"yi"=>$yI,"ye"=>$yE,"Igx"=>$dX * pow(abs($yE-$yI),3)/12));
    }

    $this->Xg = $sumXgdS / $sumdS;
    $this->Yg = $sumYgdS / $sumdS;

    $this->cambrures = $this->db->execute("SELECT * FROM cambrure WHERE idParam = ".$id,null,"Cambrure");
  }

  function calculateIgz(){
    $dX = $this->parametre->getCorde()/$this->parametre->getNbPoints();
    $sumIgz = 0;
    $S = 0;
    $c = $this->parametre->getCorde();
    $tmmm = $this->parametre->getTMaxmm();

    foreach($this->cambrures as $cambrure){
      $dSi = $dX*$this->getT(($cambrure->getX()+$dX/2)/$c,$tmmm);

      $yE = $cambrure->getYextrados();
      $yI = $cambrure->getYintrados();

      $S += $dSi;

      $sumIgz += $cambrure->getIgX() + $dSi * pow(($yE+$yI)/2 - $this->Yg,2);
    }

    $this->IgX = $sumIgz;
    $this->S = $S;
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
      $arrayXgDot = array();
      $arrayYgDot = array();
      $i=0;

      foreach($this->cambrures as $cambrure){
        
        $arrayX[$i] = $cambrure->getX();

        $arrayYextrados[$i] = $cambrure->getYextrados();
        $arrayYintrados[$i] = $cambrure->getYintrados();

        $i++;
      }
      $arrayYgDot[] = $this->Yg;
      $arrayXgDot[] = $this->Xg;

      //GRAPHIQUE
      $graph = new Graph($size, 0.4*$size);//le ratio est de 0,4 entre la hauteur et la largeur
      $graph->SetScale("intlin", 0, 0, 0, $arrayX[$i-1]);
      $graph->SetShadow();
      $theme_class=new UniversalTheme();

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
      $p1->SetColor($this->parametre->getColor());
      $p1->SetLegend('Y Extrados');

      // Deuxième courbe
      $p2 = new LinePlot($arrayYintrados, $arrayX);
      $graph->Add($p2);
      $p2->SetColor($this->parametre->getColor());
      $p2->SetLegend('Y Intrados');

      // Point G
      $p3 = new LinePlot($arrayYgDot, $arrayXgDot);
      $graph->Add($p3);
      $p3->setWeight(5);
      $p3->mark->SetType(MARK_X,'',100);
      $p3->SetLegend('Centre de gravité');
      
      //$graph->legend->SetFrameWeight(1);

      // Stockage de l'image
      $graph->Stroke($this->parametre->getFic_img());
    }
  }
}
?>
