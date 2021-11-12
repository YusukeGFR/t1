<?php
include_once("../funciones.php");

if (isset($_POST["boton1"])) {
    
    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $cadena = "";

    // echo "<pre>";
    // echo print_r($arrayEmpresa);
    // echo "</pre>";

} else if(isset($_POST["ver"])){
    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $VendedorElegido = $_POST["Vendedor"];
    $ProductoElegido = $_POST["Producto"];

    $arrayVendedor = $arrayEmpresa[$VendedorElegido];
    

    $cadena= "<table border='1'>
            <tr>
                <td></td>
                <td>{$ProductoElegido}</td>
            </tr>
            <tr>
                <td>{$VendedorElegido}</td>
                <td>$arrayVendedor[$ProductoElegido]</td>
            </tr>
          </table>";


}else {
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
    <h1>Página VendedorProducto</h1>
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
        <input type="submit" value="Ver" name="ver" id="ver">
        <input type="hidden" name="arrayEmpresa" id="arrayEmpresa" value="<?= $cadenaEmpresa ?>">
    </form>
    </div>
    <br>
    <?= $cadena ?>


</body>
</html>