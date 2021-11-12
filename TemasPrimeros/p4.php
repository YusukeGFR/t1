<?php

$nA = "";
$nB = "";
$nC = "";
$cadena = "";

function eqPositivo($a, $b, $c){
    return ( -$b + sqrt(pow($b,2) - (4*$a*$c)) ) / (2*$a) ;
}

function eqNegativo($a, $b, $c){
    return ( -$b - sqrt(pow($b,2) - (4*$a*$c)) ) / (2*$a) ;
}

if (isset($_POST["boton1"])) {
    $error = false;
    $nA = $_POST["numeroA"];
    $nB = $_POST["numeroB"];
    $nC = $_POST["numeroC"];

    // control de errores
    if(!is_numeric($nA) || !is_numeric($nB) || !is_numeric($nC)) {
        $error = true;
        $cadena = "Se han de rellenar todos los campos con valores numéricos.";
    }

    if($nA == 0 && !$error) {
        $error = true;
        $cadena = "No se puede dividir entre 0";
    }

    if (is_numeric($nA) && is_numeric($nB) && is_numeric($nC)) {
        if (pow($nB,2) - (4*$nA*$nC) < 0) {
            $error = true;
           $cadena = "No se puede hacer la raiz de un numero negativo.";
        }
    }


    if (!$error) {
        $cadena .= "Soluciones: "+eqPositivo($nA, $nB, $nC);
        $cadena .=  " / "+eqNegativo($nA, $nB, $nC);
    }
}


?>

<html>
<head>
<h3>4ª práctica</h3>
</head>
<body>
<br>

<form action="p4.php" method="POST">
    Introduzca las variables de la equación:
    <br>
    <input type="text" id="numeroA" name="numeroA" value="<?= $nA?>"><br>
    <input type="text" id="numeroB" name="numeroB" value="<?= $nB?>"><br>
    <input type="text" id="numeroC" name="numeroC" value="<?= $nC?>"><br>
    <input type="submit" value="enviar" id="boton1" name="boton1" value="submit"><br><br>
</form>

<?= $cadena?>

</body>
</html>