<?php
class Cambrure {
  private $id;
  private $x;
  private $f;
  private $t;
  private $yintra;
  private $yextra;
  private $id_param;
  private $Igx;

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
  function getYintra(){
    return $this->yintra;
  }
  function getYextra(){
    return $this->yextra;
  }
  function getIdParam(){
    return $this->id_param;
  }
  function getIgx(){
    return $this->Igx;
  }
  function getId(){
    return $this->id;
  }
}
?>
