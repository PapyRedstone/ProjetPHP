<?php

class Parametres{

    private $id;
    private $libelle;
    private $corde;
    private $tMaxPercent;
    private $tMaxmm;
    private $fMaxPercent;
    private $fMaxmm;
    private $nbPoints;
    private $date;

    function __toString()
    {
        return "$this->id, $this->libelle, $this->corde, $this->tMaxPercent, $this->tMaxmm, $this->fMaxPercent, $this->fMaxmm, $this->nbPoints, $this->date";
    }

    public function getId(){

        return $this->id;
    }

    public function getLibelle(){

        return $this->libelle;
    }

    public function getCorde(){

        return $this->corde;
    }

    public function getTMaxPercent(){

        return $this->tMaxPercent;
    }

    public function getTMaxmm(){

        return $this->tMaxmm;
    }

    public function getFMaxPercent(){

        return $this->fMaxPercent;
    }

    public function getFMaxmm(){

        return $this->fMaxmm;
    }

    public function getNbPoints(){

        return $this->nbPoints;
    }

    public function getDate(){

        return $this->date;
    }

}

?>
