<?php
include_once "animal.php";


class Gato extends Animal {

    private $nivel_silencio;
    
    protected $property;

    public function __construct($property)
    {
        $this->property = $property;
    }

    
    

    /**
     * Get the value of nivel_silencio
     */ 
    public function getNivel_silencio()
    {
        return $this->nivel_silencio;
    }

    /**
     * Set the value of nivel_silencio
     *
     * @return  self
     */ 
    public function setNivel_silencio($nivel_silencio)
    {
        $this->nivel_silencio = $nivel_silencio;

        return $this;
    }
}












?>