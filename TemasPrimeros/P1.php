<html>
<?php

function sacarXmas($valor1, $valor2, $valor3) {
    if ($valor1 == 0) {
        return "No se puede dividir entre 0";
    }
    $res = pow($valor2,2) - 4 * $valor1 * $valor3;
    if ($res < 0) {
        return "No se puede hacer la raiz cuadrada de un número negativo";
    }
    return (-$valor2 + sqrt($res)) / (2*$valor1);
}

function sacarXmenos($valor1, $valor2, $valor3) {
    if ($valor1 == 0) {
        return "No se puede dividir entre 0";
    }
    $res = pow($valor2,2) - 4 * $valor1 * $valor3;
    if ($res < 0) {
        return "No se puede hacer la raiz cuadrada de un número negativo";
    }
    return (-$valor2 - sqrt($res)) / (2*$valor1);
}
?>

<head>
esto es el head
</head>
<body>
<br>
<strong>
    <?php
echo sacarXmenos(1,4,4);
echo "\n";
echo sacarXmas(1,4,4);
    ?>
</strong>
</body>

</html>