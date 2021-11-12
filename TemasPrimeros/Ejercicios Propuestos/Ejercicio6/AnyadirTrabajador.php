<?php
include_once("../funciones.php");
$cadena = "";

if (isset($_POST["boton1"])) {

    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);

} else if(isset($_POST["crear"])) {

    $cadenaEmpresa = $_POST["arrayEmpresa"];
    $arrayEmpresa = cadenaurl_a_array($cadenaEmpresa);
    $dni = $_POST["dni"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $horas = $_POST["horas"];
    $seccion = $_POST["seccion"];
    // echo $dni." ".$nombre." ".$apellido." ".$seccion;

    if (array_key_exists($dni,$arrayEmpresa[$seccion]) ) {
        $horasTotales = $arrayEmpresa[$seccion][$dni]["horas"] + $horas;

        if ($horas == "" || $nombre == "" || $apellido == "" || !validar_dni($dni) || $horas <= 0 || $horasTotales > 50 || !ctype_digit($horas)) {
            $cadena = "Datos cumplimentados erróneos, cumplimente los datos de nuevos";
        } else if($arrayEmpresa[$seccion][$dni]["nombre"] != $nombre || $arrayEmpresa[$seccion][$dni]["apellido"] != $apellido) {
            $cadena = "El DNI utilizado pertenece a un usuario con distinto nombre o apellido, utilice su propio DNI o suplemente correctamente sus datos.";
        } else {
            $sueldoB = calc_sueldoB($horasTotales);
            $impuestos = calc_impuestos($sueldoB);
            $sueldoN = $sueldoB - $impuestos;
            $arrayEmpresa[$seccion][$dni]["horas"] = $horasTotales;
            $arrayEmpresa[$seccion][$dni]["sueldoB"] = $sueldoB;
            $arrayEmpresa[$seccion][$dni]["impuestos"] = $impuestos;
            $arrayEmpresa[$seccion][$dni]["sueldoN"] = $sueldoN;
            $cadenaEmpresa = array_a_cadenaurl($arrayEmpresa);
            $cadena = "Usuario actualizado con éxito";
        }

    } else {
        if ($horas != "" && $nombre != "" && $apellido != "" && validar_dni($dni) && $horas >= 0 && $horas <= 50 && ctype_digit($horas)) {
            $sueldoB = calc_sueldoB($horas);
            $impuestos = calc_impuestos($sueldoB);
            $sueldoN = $sueldoB - $impuestos;
    
            $arrayEmpresa[$seccion][$dni] = ["nombre"=>$nombre,
                                             "apellido"=>$apellido,
                                             "horas"=>$horas,
                                             "sueldoB"=>$sueldoB,
                                             "impuestos"=>$impuestos,
                                             "sueldoN"=>$sueldoN,
                                            ];
            $cadenaEmpresa = array_a_cadenaurl($arrayEmpresa);
            $cadena = "Usuario añadido con éxito";
        } else {
            $cadena = "Error, campos vacíos o inválidos";
        }
        
    }




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

<h1>Página Añadir Trabajador</h1>

<?= menu_empresa($cadenaEmpresa) ?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="commonForm">
    <p> DNI: <input type="text" name="dni" id="dni"> </p> 
    <p> Nombre: <input type="text" name="nombre" id="nombre"> </p> 
    <p> Apellido: <input type="text" name="apellido" id="apellido"> </p> 
    <p> Horas: <input type="text" name="horas" id="horas"> </p> 
    <p> Sección: 
    <select name="seccion" id="seccion">
            <option value="s1">Sección 1</option>
            <option value="s2">Sección 2</option>
            <option value="s3">Sección 3</option>
            <option value="s4">Sección 4</option>
            <option value="s5">Sección 5</option>
    </select> </p> 
    <p> <input type="submit" value="Añadir Trabajador" name="crear" id="crear"> </p>
    <input type="hidden" name="arrayEmpresa" id="arrayEmpresa" value="<?= $cadenaEmpresa ?>">
</form>

<p id="notice"><?= $cadena ?></p>
    
</body>
</html>