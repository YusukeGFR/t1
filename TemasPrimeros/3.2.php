<?php
$cadena = "El perro de San Roque no tiene rabo";

function countLetras($cadena) {
    $longitud = strlen(trim($cadena));
    $numLetras = 0;
    for($pos = 0; $pos < $longitud; $pos++) {
        if($cadena[$pos] != " ") {
            $numLetras++;
        }
    }
    return  $numLetras;
}

function countPalabras($cadena) {
    $longitud = strlen(trim($cadena));
    if ($longitud == 0) {
        $numPalabras = 0;
    } else {
        $numPalabras = 1;
    }
    
    for($pos = 0; $pos < $longitud; $pos++) {
        if($cadena[$pos] == " ") {
            $numPalabras++;
        }
    }
    return  $numPalabras;
}




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= countLetras($cadena) ?>
    <br>
    <?= countPalabras($cadena) ?>
</body>
</html>