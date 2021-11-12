<?php
include_once("../funciones.php");
$cadena = "";

if (isset($_POST["boton2"])) {

    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $form = "
    <p id='junto'> 
    <select name='seccion' id='seccion'>
        <option value='s1'>Sección 1</option>
        <option value='s2'>Sección 2</option>
        <option value='s3'>Sección 3</option>
        <option value='s4'>Sección 4</option>
        <option value='s5'>Sección 5</option>
    </select> 
    <input type='submit' value='Seleccionar ' name='verTrabajadores' id='verTrabajadores'> </p>
    <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='{$cadenaEmpresa}'>
    ";

} else if(isset($_POST["verTrabajadores"])) {

    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $seccion = $_POST["seccion"];
    $form = "
    <p> <select name='dni' id='dni'>";
        foreach($arrayEmpresa[$seccion] as $dni => $datos) {
            $form .= "<option value='{$dni}'>{$datos['nombre']}-{$dni}</option>";
        }
    $form .= "</select> </p>
    <p> <input type='submit' value='Seleccionar Trabajador' name='verTrabajador' id='verTrabajador'> </p>
    <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='{$cadenaEmpresa}'>
    <input type='hidden' name='seccion' id='seccion' value='{$seccion}'>";

} else if (isset($_POST["verTrabajador"])) {

    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $dni = $_POST["dni"];
    $seccion = $_POST["seccion"];
    $form = "
        <p id='junto'><select name='seccion' id='seccion'>
            <option value='s1'".($seccion=='s1'?'selected':'')." >Sección 1</option>
            <option value='s2'".($seccion=='s2'?'selected':'')." >Sección 2</option>
            <option value='s3'".($seccion=='s3'?'selected':'')." >Sección 3</option>
            <option value='s4'".($seccion=='s4'?'selected':'')." >Sección 4</option>
            <option value='s5'".($seccion=='s5'?'selected':'')." >Sección 5</option>
        </select> 
        <input type='submit' value='Seleccionar' name='verTrabajadores' id='verTrabajadores'> </p>
        <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='{$cadenaEmpresa}'>";

    $cadena = "
            <p align='center' style='padding-bottom:10px'> Mostrando datos de la sección ".ucfirst($seccion).".</p>
            <table border=1>
                <tr>
                    <td>DNI</td>
                    <td>{$dni}</td>
                </tr>";
            foreach($arrayEmpresa[$seccion][$dni] as $key => $value) {
                $cadena .= "<tr>
                                <td>";
                                if ($key=="sueldoB") {
                                    $cadena .= "Sueldo Bruto";
                                } else if ($key=="sueldoN") {
                                    $cadena .= "Sueldo Neto";
                                } else {
                                    $cadena .= ucfirst($key);
                                }
                $cadena .= "</td>
                                <td>".$value."</td>
                            </tr>";
            }
        $cadena .="</table>";

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
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Página Ver Trabajador</h1>

<?= menu_empresa($cadenaEmpresa) ?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="commonForm">
    
    <?= $form ?>
    
</form>

<div id="centered">
<p id="notice"><?= $cadena ?></p>
</div>
</body>
</html>