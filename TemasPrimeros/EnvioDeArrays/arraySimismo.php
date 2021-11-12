<?php 

include_once "funcionesapoyo.php";

//PRIMERA VEZ
if (!isset($_POST["numero"])){
    $arrayDatos=[];
    $cadenaDatos=array_a_cadenaurl($arrayDatos);
    MostrarFormulario($cadenaDatos);
}
else if (isset($_POST["numero"]) && $_POST["numero"]!=0 ){//segunda y siguientes
    //recojo datos
    $numero=$_POST["numero"];
    $cadenaArray=$_POST["cadenaArray"];
    //convierto cadena a array
    $arrayDatos=cadenaurl_a_array($cadenaArray);
    //opero conm array
    $arrayDatos[]=$numero;
    //serializio
    $cadenaDatos=array_a_cadenaurl($arrayDatos);
    //mostrar info
    MostrarDatos($arrayDatos);
    MostrarFormulario($cadenaDatos,$numero);
    var_dump($arrayDatos);
}
else{ //condicion finalizacion
    $numero=$_POST["numero"];
    $cadenaArray=$_POST["cadenaArray"];
    $arrayDatos=cadenaurl_a_array($cadenaArray);   
    MostrarDatosFin($arrayDatos);
}

