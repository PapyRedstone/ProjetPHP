<?php
class Cambrure {
  private $id;
  private $x;
  private $f;
  private $t;
  private $yIntrados;
  private $yExtrados;
  private $idParam;
  private $igX;

  function __toString(){
    return "x= $this->x, f(x) = $this->f, t(x) = $this->t, Yintra = $this->yintra, Yextra = $this->yextra, Igx = $this->Igx";
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
}
?>
