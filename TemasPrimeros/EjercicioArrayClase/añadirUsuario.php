<?php 

include_once("funcionesApoyo.php");

if (!isset($_GET["usuario"])) { // primera vez
    $arrayUsuario = [];
    $cadenausuario = array_a_cadenaurl($arrayUsuario);
    MostrarFormulario($cadenausuario);
} else { // siguientes
    $usuario = $_GET["usuario"]; //recoger datos
    $contra = $_GET["contraseña"];
    $usuariosCadena = $_GET["usuariosArray"];
    MostrarFormulario($cadenausuario);
    $usuariosArray = cadenaurl_a_array($usuariosCadena); // deserializar

    if(!isset($usuariosArray[$usuario])) {
        $usuariosArray[$usuario] = $contra;
    }

    echo "<pre>";
    print_r($usuariosArray);
    echo "</pre>";
    


}


?>

