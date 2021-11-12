<?php
include_once("../funciones.php");

if (isset($_POST["boton2"])) {
    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $cadena = "";

} else if(isset($_POST["ver"])) {
    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $VendedorElegido = $_POST["Vendedor"];
    
    $arrayVendedor = $arrayEmpresa[$VendedorElegido];
    $total = 0;

    $cadena= "<table border='1'>
            <tr>
                <td></td>
                <td>{$VendedorElegido}</td>
            </tr>";

    foreach ($arrayVendedor as $producto => $vendido) {
        $cadena .= " <tr>
                        <td>{$producto}</td>
                        <td>{$vendido}</td>
                     </tr>";
        $total += $vendido;
    };
    $cadena .= " <tr> 
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
    <h1>Página TotalVendedor</h1>
    <?= imprimir_menu($cadenaEmpresa) ?>

    <div id="submenu">

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        Seleccione un vendedor: <select name="Vendedor" id="Vendedor">
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
        <input type="submit" value="Ver" name="ver" id="ver">
        <input type="hidden" name="arrayEmpresa" id="arrayEmpresa" value="<?= $cadenaEmpresa ?>">
    </form>
    </div>
<?= $cadena ?>


</body>
</html>