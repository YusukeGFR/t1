<?php
include_once("../funciones.php");
if (!isset($_POST["fila"])) {
    $arrayAvion = [
        1 =>  [1=>"L",2=>"L",3=>"L",4=>"L",],
        2 =>  [1=>"L",2=>"L",3=>"L",4=>"L",],
        3 =>  [1=>"L",2=>"L",3=>"L",4=>"L",],
        4 =>  [1=>"L",2=>"L",3=>"L",4=>"L",],
        5 =>  [1=>"L",2=>"L",3=>"L",4=>"L",],
        6 =>  [1=>"L",2=>"L",3=>"L",4=>"L",],
        7 =>  [1=>"L",2=>"L",3=>"L",4=>"L",],
        8 =>  [1=>"L",2=>"L",3=>"L",4=>"L",],
        9 =>  [1=>"L",2=>"L",3=>"L",4=>"L",],
        10 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        11 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        12 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        13 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        14 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        15 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        16 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        17 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        18 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        19 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        20 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        21 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        22 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        23 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        24 => [1=>"L",2=>"L",3=>"L",4=>"L",],
        25 => [1=>"L",2=>"L",3=>"L",4=>"L",],
    ];
    $cadenaArrayAvion = array_a_cadenaurl($arrayAvion);
    $cadena = tablaAvion($arrayAvion);
    $imprimirValores = "";
} else {
    $cadenaAvion = $_POST["array"];
    $arrayAvion = cadenaurl_a_array($cadenaAvion);
    $fila = $_POST["fila"];
    $columna = $_POST["columna"];

    if ($arrayAvion[$fila][$columna]==="L") {
        $arrayAvion[$fila][$columna]="R";
        $imprimirValores = "<p>Usted ha hecho una reserva para el asiento: {$fila} - {$columna}</p>";
    } else {
        $arrayAvion[$fila][$columna]="L";
        $imprimirValores = "<p>Usted ha cancelado la reserva para el asiento: {$fila} - {$columna}</p>";
    }
    $cadena = tablaAvion($arrayAvion);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <h1>Reserve su asiento!</h1>
    <?= $imprimirValores ?>
    <?= $cadena ?>
</body>
</html>