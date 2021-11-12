<?php


class Animal{
    protected $patas;
    protected $alimentacion;

    public function __construct($patas, $alimentacion){
        $this->patas=$patas;
        $this->alimentacion=$alimentacion;
    }

    /**
     * Get the value of patas
     */
    public function getPatas()
    {
        return $this->patas;
    }

    /**
     * Set the value of patas
     *
     * @return  self
     */
    public function setPatas($patas)
    {
        $this->patas = $patas;

        return $this;
    }

    /**
     * Get the value of alimentacion
     */
    public function getAlimentacion()
    {
        return $this->alimentacion;
    }

    /**
     * Set the value of alimentacion
     *
     * @return  self
     */
    public function setAlimentacion($alimentacion)
    {
        $this->alimentacion = $alimentacion;

        return $this;
    }
}




?>