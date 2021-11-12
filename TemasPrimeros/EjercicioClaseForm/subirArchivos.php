<?php

if (isset($_POST["usuario"]) && $_POST["usuario"] != "") {

    $usuario = $_POST["usuario"];
    $fotos = $_FILES["fotos"];
    $cvv = $_FILES["cvv"];

    if (!file_exists($usuario)) {
        mkdir($usuario,0777,true);
        mkdir($usuario."/fotos",0777,true);
        mkdir($usuario."/cvv",0777,true);
    } 
    
    if(isset($_FILES["fotos"]) && $_FILES["fotos"]["name"] != "") {



    } else {
        header("Location:form.php");
    }

    if(isset($_FILES["cvv"]) && $_FILES["cvv"]["name"] != "") {



    } else {
        header("Location:form.php");
    }




} else {
    header("Location:form.php");
}




?>
