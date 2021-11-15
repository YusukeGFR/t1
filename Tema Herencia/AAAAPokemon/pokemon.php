<?php

class pokemon {

    private $nombre;
    private $ataque;
    private $defensa;
    private $tipo1;
    private $tipo2;
    private $preEvo;
    private $nextEvo;
    private $nivel;

    public function __construct($nombre,$ataque,$defensa,$tipo1,$tipo2,$preEvo,$nextEvo,$nivel) {

        $this->nombre = $nombre;
        $this->ataque = $ataque;
        $this->defensa = $defensa;
        $this->tipo1 = $tipo1;
        $this->tipo2 = $tipo2;
        $this->preEvo = $preEvo;
        $this->nextEvo = $nextEvo;
        $this->nivel = $nivel;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getAtaque()
    {
        return $this->ataque;
    }

    public function setAtaque($ataque)
    {
        $this->ataque = $ataque;

        return $this;
    }

    public function getDefensa()
    {
        return $this->defensa;
    }

    public function setDefensa($defensa)
    {
        $this->defensa = $defensa;

        return $this;
    }

    public function getTipo1()
    {
        return $this->tipo1;
    }
 
    public function setTipo1($tipo1)
    {
        $this->tipo1 = $tipo1;

        return $this;
    }

    public function getTipo2()
    {
        return $this->tipo2;
    }

    public function setTipo2($tipo2)
    {
        $this->tipo2 = $tipo2;

        return $this;
    }

    public function getPreEvo()
    {
        return $this->preEvo;
    }

    public function setPreEvo($preEvo)
    {
        $this->preEvo = $preEvo;

        return $this;
    }

    public function getNextEvo()
    {
        return $this->nextEvo;
    }

    public function setNextEvo($nextEvo)
    {
        $this->nextEvo = $nextEvo;

        return $this;
    }

    public function getNivel()
    {
        return $this->nivel;
    }

    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }
}

?>