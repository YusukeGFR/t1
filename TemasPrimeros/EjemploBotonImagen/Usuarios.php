<?php
include_once "funcionesUsuarios.php";
include_once "funciones.php";
//Primera vez
if (!isset($_POST["usuario"]) && !isset($_POST["contraseña"])) {
    $arrayDatos = [];
    $cadenaDatos = array_a_cadenaurl($arrayDatos);
    MostrarFormulario($cadenaDatos);
    MostrarDatos($cadenaDatos);
} else if (isset($_POST["usuario"]) && isset($_POST["contraseña"])) {
    //recojo Datos
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];
    $cadenaArray = $_POST["cadenaArray"];
    //convierto a Array
    $arrayDatos = cadenaurl_a_array($cadenaArray);
    //opero con array
    if (!isset($arrayDatos[$usuario])) {
        $arrayDatos[$usuario] = $contraseña;
    } else {
        echo "El usuario introducido ya existe";
    }
    //serializo
    $cadenaDatos = array_a_cadenaurl($arrayDatos);
    //muestro datos
    // MostrarDatos($arrayDatos);
    MostrarFormulario($cadenaDatos);
    MostrarDatos($cadenaDatos);
    var_dump($arrayDatos);
}
