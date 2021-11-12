<?php
include_once "Usuarios.php";
if (isset ($_POST["usuario"])){
    $arrayUsuarios=cadenaurl_a_array($_POST["usuario"]);
    if(isset($_POST["borrar_x"])){
        $usuarioBorrar=$_POST["usuarioBorrar"];
        unset ($arrayUsuarios[$usuarioBorrar]);
        echo "El usuario {$usuarioBorrar} ha sido borrado";
    }
    GenerarTablaUsuarios($arrayUsuarios);
}else{
    header("location:Usuarios.php");
}