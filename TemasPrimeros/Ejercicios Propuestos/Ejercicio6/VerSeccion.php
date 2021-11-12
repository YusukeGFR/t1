<?php
include_once("../funciones.php");
$cadena = "";
$cadenaEmpresa = "";
$form = "";

if (isset($_POST["boton3"])) {

    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $form = " 
        <p id='junto'><select name='seccion' id='seccion'>
            <option value='s1'>Sección 1</option>
            <option value='s2'>Sección 2</option>
            <option value='s3'>Sección 3</option>
            <option value='s4'>Sección 4</option>
            <option value='s5'>Sección 5</option>
        </select> 
        <input type='submit' value='Seleccionar' name='verSeccion' id='verSeccion'> </p>
        <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='{$cadenaEmpresa}'>";

} else if(isset($_POST["verSeccion"])) {

    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $seccion = $_POST["seccion"];
    $form = "
        <p id='junto'><select name='seccion' id='seccion'>
            <option value='s1'".($seccion=='s1'?'selected':'')." >Sección 1</option>
            <option value='s2'".($seccion=='s2'?'selected':'')." >Sección 2</option>
            <option value='s3'".($seccion=='s3'?'selected':'')." >Sección 3</option>
            <option value='s4'".($seccion=='s4'?'selected':'')." >Sección 4</option>
            <option value='s5'".($seccion=='s5'?'selected':'')." >Sección 5</option>
        </select> 
        <input type='submit' value='Seleccionar' name='verSeccion' id='verSeccion'> </p>
        <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='{$cadenaEmpresa}'>";

    $cadena = mostrarSeccion($arrayEmpresa,$seccion);

} else if(isset($_POST["modificar_x"])) {

    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $seccion = $_POST["seccion"];
    $dni = $_POST["dni"];

    $form = "
        <p> Sección: <input type='text' name='seccion' id='seccion' value='{$seccion}' readonly> </p> 
        <p> DNI: <input type='text' name='dni' id='dni' value='{$dni}' readonly> </p> 
        <p> Nuevo nombre: <input type='text' name='nombre' id='nombre'> </p> 
        <p> Nuevo apellido: <input type='text' name='apellido' id='apellido'> </p> 
        <p> Horas: <input type='text' name='horas' id='horas'> </p> 
        <p> <input type='submit' value='Modificar Trabajador' name='modificarTrabajador' id='modificarTrabajador'> </p>
        <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='{$cadenaEmpresa}'>";

    

} else if(isset($_POST["modificarTrabajador"])) {

    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $dni = $_POST["dni"];
    $seccion = $_POST["seccion"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $horas = $_POST["horas"];


    if ($horas > 50) {
        $cadena = "Error, horas máximas en 50. Vuelva a intentarlo.";
    } else {
        if ($horas != "" && $nombre != "" && $apellido != "" && validar_dni($dni) 
            && $horas >= 0 && $horas <= 50 && ctype_digit($horas)) {
            $arrayEmpresa[$seccion][$dni]["nombre"] = $nombre;
            $arrayEmpresa[$seccion][$dni]["apellido"] = $apellido;
            $arrayEmpresa[$seccion][$dni]["horas"] = $horas;
            $arrayEmpresa[$seccion][$dni]["sueldoB"] = calc_sueldoB($horas);
            $arrayEmpresa[$seccion][$dni]["impuestos"] = calc_impuestos($arrayEmpresa[$seccion][$dni]["sueldoB"]);
            $arrayEmpresa[$seccion][$dni]["sueldoN"] = $arrayEmpresa[$seccion][$dni]["sueldoB"] - $arrayEmpresa[$seccion][$dni]["impuestos"];
            $cadena = "Se han modificado los datos correctamente";
            $cadenaEmpresa = array_a_cadenaurl($arrayEmpresa);

            $cadena = mostrarSeccion($arrayEmpresa,$seccion);
            
            $form = "
                <p id='junto'><select name='seccion' id='seccion'>
                    <option value='s1'".($seccion=='s1'?'selected':'')." >Sección 1</option>
                    <option value='s2'".($seccion=='s2'?'selected':'')." >Sección 2</option>
                    <option value='s3'".($seccion=='s3'?'selected':'')." >Sección 3</option>
                    <option value='s4'".($seccion=='s4'?'selected':'')." >Sección 4</option>
                    <option value='s5'".($seccion=='s5'?'selected':'')." >Sección 5</option>
                </select> 
                <input type='submit' value='Seleccionar' name='verSeccion' id='verSeccion'> </p>
                <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='{$cadenaEmpresa}'>";
        } else {
            $cadena = "Error, campos vacíos o inválidos";

            $form = "
                <p> Sección: <input type='text' name='seccion' id='seccion' value='{$seccion}' readonly> </p> 
                <p> DNI: <input type='text' name='dni' id='dni' value='{$dni}' readonly> </p> 
                <p> Nuevo nombre: <input type='text' name='nombre' id='nombre'> </p> 
                <p> Nuevo apellido: <input type='text' name='apellido' id='apellido'> </p> 
                <p> Horas: <input type='text' name='horas' id='horas'> </p> 
                <p> <input type='submit' value='Modificar Trabajador' name='modificarTrabajador' id='modificarTrabajador'> </p>
                <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='{$cadenaEmpresa}'>";
        }
    }


} else if(isset($_POST["eliminar_x"])) {

    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $dni = $_POST["dni"];
    $seccion = $_POST["seccion"];

    unset($arrayEmpresa[$seccion][$dni]);
    $cadenaEmpresa = array_a_cadenaurl($arrayEmpresa);

    $cadena = mostrarSeccion($arrayEmpresa,$seccion);
    $form = "
        <p id='junto'><select name='seccion' id='seccion'>
            <option value='s1'".($seccion=='s1'?'selected':'')." >Sección 1</option>
            <option value='s2'".($seccion=='s2'?'selected':'')." >Sección 2</option>
            <option value='s3'".($seccion=='s3'?'selected':'')." >Sección 3</option>
            <option value='s4'".($seccion=='s4'?'selected':'')." >Sección 4</option>
            <option value='s5'".($seccion=='s5'?'selected':'')." >Sección 5</option>
        </select> 
        <input type='submit' value='Seleccionar' name='verSeccion' id='verSeccion'> </p>
        <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='{$cadenaEmpresa}'>";
}  else {
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

<h1>Página Ver Seccion</h1>

<?= menu_empresa($cadenaEmpresa) ?>


    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="commonForm">
        
        <?= $form ?>
        
    </form>

<div id="centered">
<p id="notice"><?= $cadena ?></p>
</div>
    
</body>
</html>