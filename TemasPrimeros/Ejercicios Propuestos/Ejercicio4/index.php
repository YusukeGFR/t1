<?php
include_once('../funciones.php');
$cadena = "";

if (!isset($_POST["minutos"])) {

    $arrayGym = [];
    $cadenaGym = array_a_cadenaurl($arrayGym);
    $sesion = 0;

} else {

    $minutos = $_POST["minutos"];
    $cadenaGym = $_POST["cadenaGym"];
    $arrayGym = cadenaurl_a_array($cadenaGym);
    $sesion = $_POST["sesion"];
    $cadena = "";

    if ($minutos == 0) {
        $totalC = 0;
        $totalM = 0;
        foreach($arrayGym as $sesion => $valores) {
            $sesion += 1;
            $cadena .= "<p><strong>Sesion {$sesion}:</strong>";
            foreach($valores as $minuto => $caloria)
                $cadena .= " {$caloria} calorias en {$minuto} minutos.</p>";
                $totalC += $caloria;
                $totalM += $minuto;
        }
        $cadena .= "<p>Se han quemado un total de {$totalC} calorías en {$totalM} minutos.</p>";

    } else if ($minutos > 0) {
        $caloriasSesion = 0;
        for($i = 1; $i <= $minutos; $i++) {

            switch ($i) {
                case 1:
                    $caloriasSesion += 2;
                    break;
                case $i>=2&&$i<=10:
                    $caloriasSesion += 3;
                    break;
                case $i>=11&&$i<=20:
                    $caloriasSesion += 4;
                    break;
                case $i>=21&&$i<=30:
                    $caloriasSesion += 5;
                    break;
                case $i>=31&&$i<=40:
                    $caloriasSesion += 6;
                    break;
                case $i>=41&&$i<=50:
                    $caloriasSesion += 7;
                    break;
                case $i>=51&&$i<=60:
                    $caloriasSesion += 8;
                    break;
                default:
                    $caloriasSesion = 0;
                    $cadena = "Error, no se puede hacer ejercicio más de 1 hora seguida.";
                    break;
            }
        }

        if ($caloriasSesion !== 0) {
            $arrayGym[$sesion] = [$minutos => $caloriasSesion];
            $sesion++;
        }
        
        $cadenaGym = array_a_cadenaurl($arrayGym);
        
    } else {
        $cadena = "Error, solo números positivos.";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method='post'>
        Introduce los minutos ejercitados en esta sesion (0 para terminar): 
        <input type='text' name='minutos' id='minutos'>
            <input type='submit' value='enviar'>
        <input type='hidden' name='cadenaGym' id='cadenaGym' value='<?= $cadenaGym ?>'>
        <input type='hidden' name='sesion' id='sesion' value='<?= $sesion ?>'>
    </form>
    <?= $cadena ?>
</body>
</html>