<?php 

    $fechaText = "";
    $cadena = null;
    $fecha = "";
    
    $diasMaximos = ["01" => 31,
                    "02" => 28,
                    "03" => 31,
                    "04" => 30,
                    "05" => 31,
                    "06" => 30,
                    "07" => 31,
                    "08" => 31,
                    "09" => 30,
                    "10" => 31,
                    "11" => 30,
                    "12" => 31, 
                ];


    
    if (isset($_GET["buton"])) {

        $fecha = $_GET["fecha"];

        if (strlen($fecha) == 10) {
            $diaS = substr($fecha,0,2);
            $mesS = substr($fecha,3,2);
            $anyoS = substr($fecha,6,4);
            $bisiesto = false;
            $mesDos = false;

            if (is_numeric($anyoS)) {
                $anyoI = (int) $anyoS;
                if($anyoI > 0 && $anyoI < 3001) {
                    if(($anyoI%4 == 0 && $anyoI%100 != 0) || $anyoI%400 == 0 ) {
                        // echo "lo es lo es";
                        $bisiesto = true;
                    }
                } else {
                    $cadena = "El año no puede ser inferior a 1 ni superior a 3000.";
                }
            } else {
                $cadena = "Valor no numérico detectado";
            }

            if (is_numeric($mesS)) {
                $mesI = (int) $mesS;
                if($mesI > 0 && $mesI < 13) {
                    if($mesS === "02") {
                        // echo "mes dos";
                        $mesDos = true;
                    }
                } else {
                    $cadena = "El més no puede ser inferior a 1 ni superior a 12.";
                }
            } else {
                $cadena = "Valor no numérico detectado";
            }

            if (is_numeric($diaS)) {
                $diaI = (int) $diaS;
                if(($bisiesto && $mesDos)) {
                    if( $diaI < 0 || $diaI > 29) {
                        $cadena = "En los años bisiestos el més de Febrero ha de ir desde 1 hasta 29.";
                    }
                } else {
                    if( $diaI < 0 || $diaI > ($diasMaximos[$mesS])) {
                        $cadena = "Los días de ese més han de ir de 1 hasta {$diasMaximos[$mesS]}";
                    }
                }
            } else {
                $cadena = "Valor no numérico detectado";
            }


        } else {
            $cadena = "La fecha ha de respetar el formato DD-MM-YYYY";
        }
        
        if ($cadena === null) {
            $cadena = "<p>Fecha validada!</p>";
        } else {
            $cadena = "<p>".$cadena."</p>";
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
    
<form action="<?php $_PHP_SELF ?>" method="get">
    Introduzca una fecha: <input type="text" name="fecha" id="fecha" value="<?= $fecha ?>">
    <input type="submit" name="buton" id="buton" value="Comprobar">
</form>

<?= $cadena ?>

</body>
</html>