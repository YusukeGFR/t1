<?php
include_once("../funciones.php");

if (isset($_POST["boton4"])) {
    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $cadena = tablaBalanceEmpresa($arrayEmpresa);
    $cadena2 = "";

} else if(isset($_POST["modificar"])) {
    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $VendedorElegido = $_POST["Vendedor"];
    $ProductoElegido = $_POST["Producto"];
    $nuevoValor = $_POST["nuevoValor"];

    if (is_numeric($nuevoValor)) {
        $nuevoValor=intval($nuevoValor);
        if ($nuevoValor > 0) {
            $cadena2 = "Se ha modificado el valor de {$ProductoElegido} para {$VendedorElegido} a {$_POST['nuevoValor']}";
        } else {
            $cadena2 = "Se han de introducir valores numéricos positivos";
        }
    } else {
        $nuevoValor=$arrayEmpresa[$VendedorElegido][$ProductoElegido];
        $cadena2 = "Se han de introducir valores numéricos positivos";
    }

    $arrayEmpresa[$VendedorElegido][$ProductoElegido] = $nuevoValor;
    $arrayVendedor = $arrayEmpresa[$VendedorElegido];
    $cadena = tablaBalanceEmpresa($arrayEmpresa);
    $cadenaEmpresa = array_a_cadenaurl($arrayEmpresa);

    

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
<h1>Página Modificar</h1>
<?= imprimir_menu($cadenaEmpresa) ?>
<div id="submenu">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <select name="Vendedor" id="Vendedor">
                <?php 
                    foreach ($arrayEmpresa as $vendedor => $producto) {
                        if ($VendedorElegido == $vendedor) {
                            echo "<option selected>".$vendedor."</option>";
                        } else {
                            echo "<option>".$vendedor."</option>";
                        }
                        
                    }
                ?>
            </select>
            <select name="Producto" id="Producto">
                <?php 
                    $primero = array_key_first($arrayEmpresa);
                    $producto = $arrayEmpresa[$primero];
                    foreach ($producto as $nombre => $cantidad) {
                        if ($ProductoElegido == $nombre) {
                            echo "<option selected>".$nombre."</option>";
                        } else {
                            echo "<option>".$nombre."</option>";
                        }
                    }
                ?>
            </select>
            <input type="number" name="nuevoValor" id="nuevoValor">
            <input type="submit" value="Modificar" name="modificar" id="modificar">
            <input type="hidden" name="arrayEmpresa" id="arrayEmpresa" value="<?= $cadenaEmpresa ?>">
    </form>
</div>
<p id="result"><?= $cadena2 ?></p>

<?= $cadena ?>

</body>
</html>