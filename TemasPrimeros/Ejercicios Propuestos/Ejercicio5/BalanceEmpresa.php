<?php
include_once("../funciones.php");

if (isset($_POST["boton5"])) {
    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $cadena = tablaBalanceEmpresa($arrayEmpresa);
} else {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Página Balance Empresa</h1>
    <?= imprimir_menu($cadenaEmpresa) ?>
    <?= $cadena ?>
</body>
</html>