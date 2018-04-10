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
        return $this->id, $this->libelle, $this->corde, $this->tMaxPercent, $this->tMaxmm, $this->fMaxPercent, $this->fMaxmm, $this->nbPoints, $this->date;
    }
}

?>