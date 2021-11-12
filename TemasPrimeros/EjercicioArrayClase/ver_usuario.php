<?php

include_once("funcionesApoyo.php");

if (isset($_POST["usuarios"])) {

    $cadenaArray = $_POST["usuarios"];
    $arrayUsuarios = cadenaurl_a_array($cadenaArray);

    if (isset($_POST["borrar"])) {
        $usuarioBorrar = $_POST["usuarioBorrar"];
        unset($arrayUsuarios[$usuarioBorrar]);
    }

    if (isset($_POST["actualizar"])) {
        $usuarioActualizar = $_POST["usuario"];
        $passActualizar = $_POST["pass"];
        // $arrayUsuarios[]
        echo "<pre>";
        print_r($arrayUsuarios[$usuarioActualizar]);
        echo "</pre>";
    }

    MostrarTabla($arrayUsuarios);


} else {
    header("location:ver.php");
}


?>