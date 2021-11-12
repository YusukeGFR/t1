<?php
include_once("../funciones.php");

if (!isset($_POST["filaActual"])) {
    //Creacion del arrayTablero sin eventos
    $arraytablero = [
        1 => [
            1 => ["cornerTL" => "wall",],
            2 => ["wallT" => "wall",],
            3 => ["wallT" => "wall",],
            4 => ["wallT" => "wall",],
            5 => ["wallT" => "wall",],
            6 => ["wallT" => "wall",],
            7 => ["wallT" => "wall",],
            8 => ["wallT" => "wall",],
            9 => ["wallT" => "wall",],
            10 => ["wallT" => "wall",],
            11 => ["cornerTR" => "wall",],
        ],
        2 => [
            1 => [ "wallL" => "wall",],
            2 => ["floor" => "floor",],
            3 => ["floor" => "floor",],
            4 => ["floor" => "floor",],
            5 => ["floor" => "floor",],
            6 => ["floor" => "floor",],
            7 => ["floor" => "floor",],
            8 => ["floor" => "floor",],
            9 => ["floor" => "floor",],
            10 => ["floor" => "floor",],
            11 => ["wallR" => "wall",],
        ],
        3 => [
            1 => [
                "wallL" => "wall",
            ],
            2 => [
                "floor" => "floor",
            ],
            3 => [
                "floor" => "floor",
            ],
            4 => [
                "floor" => "floor",
            ],
            5 => [
                "floor" => "floor",
            ],
            6 => [
                "floor" => "floor",
            ],
            7 => [
                "floor" => "floor",
            ],
            8 => [
                "floor" => "floor",
            ],
            9 => [
                "floor" => "floor",
            ],
            10 => [
                "floor" => "floor",
            ],
            11 => [
                "wallR" => "wall",
            ],
        ],
        4 => [
            1 => [
                "wallL" => "wall",
            ],
            2 => [
                "floor" => "floor",
            ],
            3 => [
                "floor" => "floor",
            ],
            4 => [
                "floor" => "floor",
            ],
            5 => [
                "floor" => "floor",
            ],
            6 => [
                "floor" => "floor",
            ],
            7 => [
                "floor" => "floor",
            ],
            8 => [
                "floor" => "floor",
            ],
            9 => [
                "floor" => "floor",
            ],
            10 => [
                "floor" => "floor",
            ],
            11 => [
                "wallR" => "wall",
            ],
        ],
        5 => [
            1 => [
                "wallL" => "wall",
            ],
            2 => [
                "floor" => "floor",
            ],
            3 => [
                "floor" => "floor",
            ],
            4 => [
                "floor" => "floor",
            ],
            5 => [
                "floor" => "floor",
            ],
            6 => [
                "floor" => "floor",
            ],
            7 => [
                "floor" => "floor",
            ],
            8 => [
                "floor" => "floor",
            ],
            9 => [
                "floor" => "floor",
            ],
            10 => [
                "floor" => "floor",
            ],
            11 => [
                "wallR" => "wall",
            ],
        ],
        6 => [
            1 => [
                "wallL" => "wall",
            ],
            2 => [
                "floor" => "floor",
            ],
            3 => [
                "floor" => "floor",
            ],
            4 => [
                "floor" => "floor",
            ],
            5 => [
                "floor" => "floor",
            ],
            6 => [
                "floor" => "floor",
            ],
            7 => [
                "floor" => "floor",
            ],
            8 => [
                "floor" => "floor",
            ],
            9 => [
                "floor" => "floor",
            ],
            10 => [
                "floor" => "floor",
            ],
            11 => [
                "wallR" => "wall",
            ],
        ],
        7 => [
            1 => [
                "wallL" => "wall",
            ],
            2 => [
                "floor" => "floor",
            ],
            3 => [
                "floor" => "floor",
            ],
            4 => [
                "floor" => "floor",
            ],
            5 => [
                "floor" => "floor",
            ],
            6 => [
                "floor" => "floor",
            ],
            7 => [
                "floor" => "floor",
            ],
            8 => [
                "floor" => "floor",
            ],
            9 => [
                "floor" => "floor",
            ],
            10 => [
                "floor" => "floor",
            ],
            11 => [
                "wallR" => "wall",
            ],
        ],
        8 => [
            1 => [
                "wallL" => "wall",
            ],
            2 => [
                "floor" => "floor",
            ],
            3 => [
                "floor" => "floor",
            ],
            4 => [
                "floor" => "floor",
            ],
            5 => [
                "floor" => "floor",
            ],
            6 => [
                "floor" => "floor",
            ],
            7 => [
                "floor" => "floor",
            ],
            8 => [
                "floor" => "floor",
            ],
            9 => [
                "floor" => "floor",
            ],
            10 => [
                "floor" => "floor",
            ],
            11 => [
                "wallR" => "wall",
            ],
        ],
        9 => [
            1 => [
                "wallL" => "wall",
            ],
            2 => [
                "floor" => "floor",
            ],
            3 => [
                "floor" => "floor",
            ],
            4 => [
                "floor" => "floor",
            ],
            5 => [
                "floor" => "floor",
            ],
            6 => [
                "floor" => "floor",
            ],
            7 => [
                "floor" => "floor",
            ],
            8 => [
                "floor" => "floor",
            ],
            9 => [
                "floor" => "floor",
            ],
            10 => [
                "floor" => "floor",
            ],
            11 => [
                "wallR" => "wall",
            ],
        ],
        10 => [
            1 => [
                "cornerBL" => "wall",
            ],
            2 => [
                "wallB" => "wall",
            ],
            3 => [
                "wallB" => "wall",
            ],
            4 => [
                "wallB" => "wall",
            ],
            5 => [
                "gateL" => "wall",
            ],
            6 => [
                "currentPoss" => "currentPoss",
            ],
            7 => [
                "gateR" => "wall",
            ],
            8 => [
                "wallB" => "wall",
            ],
            9 => [
                "wallB" => "wall",
            ],
            10 => [
                "wallB" => "wall",
            ],
            11 => [
                "cornerBR" => "wall",
            ],
        ],
    ];
    // Inicialización de valores
    $filaInicial = 10;
    $columnaInicial = 6;
    $cordura = 40;
    $vidas = 4;
    $score = "<p>Cordura: ";
    for($i=0;$i<$cordura;$i++) {
        $score .= "<img src='images/staminaChunk.png' width='18' height='50'>";
    }
    $score .="</p>
              <p>Vidas: ";
    for($i=0;$i<$vidas;$i++) {
        $score .= "<img src='images/heart.png' width='50' height='50'>";
    }
    $score .="</p>";
    // $travelLog = "<p id='log'>Imprudentemente decides adentrarte a esta mazmorra en la cual apenas puedes ver tu propia nariz</p>";
    $imagen = "";
    $end = false;
    $mensaje = "";
    $imprimir = generarTablero($arraytablero,$filaInicial,$columnaInicial,$cordura,$vidas,$end);
} else {
    //Recogida de datos o inicialización de estos
    $cadenaTablero = $_POST["array"];
    $arraytablero = cadenaurl_a_array($cadenaTablero);
    $filaActual = $_POST["filaActual"];
    $columnaActual = $_POST["columnaActual"];
    $filaAnterior = $_POST["filaAnterior"];
    $columnaAnterior = $_POST["columnaAnterior"];
    $cordura = $_POST["cordura"];
    $vidas = $_POST["vidas"];
    $end = false;
    $imagen = "";
    $mensaje = "";



    // echo "<pre>";
    // echo print_r($arraytablero);
    // echo "</pre>";
    
    


    $cambio = "currentPoss";
    // Condicional de cambio de casilla actual
    $typeActual;
    foreach ($arraytablero[$filaActual][$columnaActual] as $type => $value) {
        if ($type == "enemy") {
            $cordura -= 2;
            $vidas--;
            if ($vidas > 0) {
                $cambio = "clashVictory";
            } else {
                $cambio = "clashDefeat";
            }
        } else if($value == "floor") {
            $cordura -= 1;
        }
        $typeActual = $type;
    }
    $arraytablero[$filaActual][$columnaActual] = [$cambio => $cambio];
   
    $cambio = "floorC";
    // Condicional de cambio de casilla anterior
    foreach ($arraytablero[$filaAnterior][$columnaAnterior] as $type => $value) {
        if ($type == "clashVictory") {
            $cambio = "defeatedEnemy";
        }
    }
    $arraytablero[$filaAnterior][$columnaAnterior] = [$cambio => $cambio];

    // Imprimir contador de vidas y cordura
    $score = "<p>Cordura: ";
    for($i=0;$i<$cordura;$i++) {
        $score .= "<img src='images/staminaChunk.png' width='18' height='50'>";
    }
    $score .="</p>
              <p>Vidas: ";
    for($i=0;$i<$vidas;$i++) {
        $score .= "<img src='images/heart.png' width='50' height='50'>";
    }
    $score .="</p>";

    // Comprobar si ha ganado el juego, si lo ha perdido o si el juego continua
    if($vidas == 0 || $cordura == 0) {
        // $imagen = "<img src='images/gameDefeat.png' id='endGame'>";
        $end = true;
        $mensaje = "<p>Has Perdido!</p>";
        $imprimir = tablaTablero($arraytablero,$filaActual,$columnaActual,$cordura,$vidas,$end);
    }
    if($typeActual == "treasure") {
        $imagen = "<img src='images/gameVictory.png' id='endGame'>";
        $mensaje = "<p>Has Ganado!</p>";
        $imprimir = "";
    } else {
        $imprimir = tablaTablero($arraytablero,$filaActual,$columnaActual,$cordura,$vidas,$end);
    }

    
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En busca del tesoro</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div id="celdaJuego">
        <?= $imprimir ?>
        <?= $imagen ?>
    </div>
    <div id="celdaDatos">
        <?= $mensaje ?>
        <?= $score ?>
    </div>
</body>
</html>