<?php
include_once("../funciones.php");

if (isset($_POST["boton3"])) {
    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $cadena = "";

} else if(isset($_POST["ver"])) {
    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $ProductoElegido = $_POST["Producto"];
    $total = 0;

    $cadena= "<table border='1'>
            <tr>
                <td></td>
                <td>{$ProductoElegido}</td>
            </tr>";

    foreach ($arrayEmpresa as $vendedor => $producto) {
        $cadena .= " <tr>
                        <td>{$vendedor}</td>
                        <td>{$producto[$ProductoElegido]}</td>
                     </tr>";
        $total += $producto[$ProductoElegido];             
    };
    $cadena .= "<tr> 
                    <td> <strong>Total</strong></td>
                    <td><strong>{$total}</strong></td>
                </tr>
                </table>";

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
    <h1>Página TotalProducto</h1>
    <?= imprimir_menu($cadenaEmpresa) ?>

    <div id="submenu">

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        Seleccione un producto: <select name="Producto" id="Producto">
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
<?= $cadena ?>


</body>
</html>