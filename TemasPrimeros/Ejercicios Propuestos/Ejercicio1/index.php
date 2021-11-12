<?php
include_once('../funciones.php');

$imprimir = "";
$imprimirError = "";

if (isset( $_GET["buton"])) {

    $cadena = $_GET["cadena"];
    $semilla = $_GET["semilla"];
    $tCifrado = $_GET["tCifrado"];
    $accion = $_GET["accion"];
    if ($accion=="cifrar") {
        $imprimir = "Su mensaje cifrado es:<br><br><br>";
    } else {
        $imprimir = "Su mensaje descifrado es:<br><br><br>";
    }
    
    if ($cadena === "" && $semilla === "") {
        $imprimirError = "Introduzca algo antes de darle al botón";
        $imprimir = "";
    } else {
        if($accion == "cifrar") {
            if ($tCifrado == "V1") {
                if (ctype_digit($semilla) && $semilla >= 0 ) {
                    $imprimir .= cifrarCesarV1($cadena,$semilla);
                } else {
                    $imprimirError = "La semilla debe de ser un número entero positivo";
                    $imprimir = "";
                }
            } else {
                if (soloLetras($semilla)) {
                    $imprimir .= cifrarCesarV2($cadena,$semilla);
                } else {
                    $imprimirError = "La semilla debe de contener solo carácteres regulares.";
                    $imprimir = "";
                }
            }
        } else {
            if ($tCifrado == "V1") {
                if (ctype_digit($semilla) && $semilla >= 0) {
                    $imprimir .= descifrarCesarV1($cadena,$semilla);
                } else {
                    $imprimirError = "La semilla debe de ser un número entero positivo";
                    $imprimir = "";
                }
            } else {
                if (soloLetras($semilla) ) {
                    $imprimir .= descifrarCesarV2($cadena,$semilla);
                } else {
                    $imprimirError = "La semilla debe de contener solo carácteres regulares.";
                    $imprimir = "";
                }
            }
        }
    }


}

// echo "<pre>";
// echo print_r(generaAbc());
// echo "</pre>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cifrado César</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1> 🔑 Agencia de Espías Profesional (PSA) 🔑</h1>

    <div id="centered">
    <form action="<?php $_PHP_SELF ?>" method="GET">
        <p> Texto </p>
        <input type="text" id="cadena" name="cadena" placeholder="Su texto..." 
        value="<?= $cadena??""?>"/>

        <p> Semilla </p>
        <input type="text" id="semilla" name="semilla" placeholder="Su semilla..."
        value="<?= $semilla??""?>"/>

        <p> Acción </p>
        <select name="accion" id="accion">
            <?php 
            
            if (isset( $_GET["buton"])) {
                if ($accion == "cifrar") {
                    echo "<option value='cifrar' selected>Cifrar</option>
                    <option value='descifrar'>Descifrar</option>";
                } else {
                    echo "<option value='cifrar'>Cifrar</option>
                    <option value='descifrar' selected>Descifrar</option>";
                }
            } else {
                echo "<option value='cifrar'>Cifrar</option>
                <option value='descifrar'>Descifrar</option>";
            }

            ?>
        </select>

        <p> Tipo de cifrado </p>
        <select name="tCifrado" id="tCifrado">

            <?php 
            
            if (isset( $_GET["buton"])) {
                if ($tCifrado == "V2") {
                    echo "<option value='V2' selected>Cadena</option>
                    <option value='V1'>Numero</option>";
                } else {
                    echo "<option value='V2'>Cadena</option>
                    <option value='V1' selected>Numero</option>";
                }
            } else {
                echo "<option value='V2'>Cadena</option>
                <option value='V1' selected>Numero</option>";
            }

            ?>
        </select>
            <br>
    <input type="submit" value="Enviar" name="buton">
    </form>
</div>


    <div id="resultado"> 
        <p><?=$imprimir?></p>
    </div> 
    <div id="error">
        <p><?=$imprimirError?></p>
    </div>

</body>
</html>