<?php

class Deposito {    

    //Campos de la clase
    private float $diametro;
    private float $altura;
    private String $idDeposito;

    //Constructor sin parámetros auxiliar
    // public function __construct() { //Lo que hace es llamar al constructor con parámetros pasándole valores vacíos
    //     $this->$diametro = 0;
    //     $this->$altura = 0;
    //     $this->$idDeposito = 0;
    // } //Cierre del constructor


    //Constructor de la clase que pide los parámetros necesarios
    public function __construct (float $valor_diametro=0, float $valor_altura=0, String $valor_idDeposito="") {
        if ($valor_diametro > 0 && $valor_altura > 0) {            
            $this->diametro = $valor_diametro;
            $this->altura = $valor_altura;
            $this->idDeposito = $valor_idDeposito;
        } else {
            $this->diametro = 10;
            $this->altura = 5;
            $this->idDeposito = "000";
            echo "Creado depósito con valores por defecto diametro 10 metros altura 5 metros id 000";
        }   } //Cierre del constructor

    public function setValoresDeposito (String $valor_idDeposito, float $valor_diametro, float $valor_altura):void {
        $this->idDeposito = $valor_idDeposito;
        $this->diametro = $valor_diametro;
        $this->altura = $valor_altura;
        if ($valor_idDeposito =="" && $valor_diametro < 0 && $valor_altura < 0) {
            echo "Valores no admisibles. No se han establecido valores para el depósito";
            //Deposito (0.0f, 0.0f, ""); Esto no es posible. Un constructor no es un método y por tanto no podemos llamarlo
            $this->idDeposito = "";
            $this->diametro = 0;
            $this->altura = 0;
        }     
    } //Cierre del método

    public function getDiametro ():float { return $this->diametro; } //Método de acceso
    public function getAltura ():float { return $this->altura; } //Método de acceso
    public function getIdDeposito ():String { return $this->idDeposito; } //Método de acceso
    public function valorCapacidad ():float { //Método tipo función
        $capacidad = 0;
        $pi = 3.1416; //Si no incluimos la f el compilador considera que 3.1416 es double
        $capacidad = $pi * ($this->diametro/2) * ($this->diametro/2) * $this->altura;
        return $capacidad;
    }
}

$miDeposito = new Deposito(12,6,"123");
echo $miDeposito->getDiametro()."<br>";
echo $miDeposito->getAltura()."<br>";
echo $miDeposito->getIdDeposito()."<br>";
echo $miDeposito->valorCapacidad()."<br>";