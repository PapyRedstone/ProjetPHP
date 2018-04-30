<?php
//ALEXANDRE
class Cambrure {
  private $id;
  private $x;
  private $f;
  private $t;
  private $yIntrados;
  private $yExtrados;
  private $idParam;
  private $igX;
  private $xGDot;
  private $yGDot;

  function __toString(){
    return "x= $this->x, f(x) = $this->f, t(x) = $this->t, Yintra = $this->yIntrados, Yextra = $this->yExtrados, Igx = $this->igX";
  }

  function getX(){
    return $this->x;
  }
  function getF(){
    return $this->f;
  }
  function getT(){
    return $this->t;
  }
  function getYintrados(){
    return $this->yIntrados;
  }
  function getYextrados(){
    return $this->yExtrados;
  }
  function getIdParam(){
    return $this->idParam;
  }
  function getIgx(){
    return $this->igX;
  }
  function getId(){
    return $this->id;
  }

  function getXgDot(){
    return $this->xGDot;
  }

  function getYgDot(){
    return $this->yGDot;
  }


}
?>
