<?php

$n1 = "";
$n2 = "";
$operacion = "Sumar";
$cadena = "";

if (isset($_POST["boton1"])) {
    $n1=$_POST["n1"];
    $n2=$_POST["n2"];
    $operacion = $_POST["operacion"];
    $error = false;


    // comprobación de errores
    if ($n2 == 0 && $operacion =="Dividir") {
        $error = true;
        $cadena .= "No se puede dividir entre 0.";
    }

    if (!is_numeric($n1) || !is_numeric($n2)) {
        $error = true;
        $cadena .= "Se deben de completar todos los campos con valores numéricos.";
    }
    //

    if (!$error) {
        if($operacion == "sumar") {
            $resultado = $n1 + $n2;
        }else if($operacion == "restar") {
            $resultado = $n1 - $n2;
        }else if($operacion == "multiplicar") {
            $resultado = $n1 * $n2;
        }else if($operacion == "dividir") {
            $resultado = $n1 / $n2;
        }else {
            echo "Operación desconocida";
        }

        $cadena .= "El resultado de {$operacion} {$n1} y {$n2} es {$resultado}";
    }
}

?>

<form action="calc1.php" method="POST">
    Introduzca el número 1: <input type="text" id="n1" name="n1" value="<?= $n1 ?>"/>
    Introduzca el número 2: <input type="text" id="n2" name="n2" value="<?= $n2 ?>"/>

    <select id="operacion" name="operacion">
        <option <?=($operacion=="sumar")?"selected":""?>>sumar</option>
        <option <?=($operacion=="restar")?"selected":""?>>restar</option>
        <option <?=($operacion=="multiplicar")?"selected":""?>>multiplicar</option>
        <option <?=($operacion=="dividir")?"selected":""?>>dividir</option>
    </select>

    <input type="submit" value="CALCULAR" id="boton1" name="boton1"/>
</form>

<?= $cadena; ?>