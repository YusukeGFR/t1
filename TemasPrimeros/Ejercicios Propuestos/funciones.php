<?php 
// Ejercicio 1
function generaAbc() {
    $arrayAbc = [];
    for ($i=65;$i<=91;$i++) {
        if ($i==79) {
            $arrayAbc[$i-65] = "Ñ";
        } else if ($i >= 79){
            $arrayAbc[$i-65] = chr($i-1);  
        } else {
            $arrayAbc[$i-65] = chr($i);  
        }        
    }
    return $arrayAbc;
}
function cifrarCesarV1($cadena,$semilla) {
    $cadena = mb_strtoupper($cadena);
    $cifrado = "";
    $abc = generaAbc();
    $bandera = false;
    for($i=0;$i<strlen($cadena);$i++) {
        for($j=0;$j<count($abc) && !$bandera;$j++) {
            if ($cadena[$i] == $abc[$j]) {
                $cifrado .= $j+$semilla>26?$abc[($j+$semilla)%27]:$abc[$j+$semilla];
                $bandera = true;
            } if ($cadena[$i-1].$cadena[$i] == $abc[$j]) {
                $cifrado .= $j+$semilla>26?$abc[($j+$semilla)%27]:$abc[$j+$semilla];
                $bandera = true;
            }
        }
        if (!$bandera && $cadena[$i] != chr(195)) {
            $cifrado .= $cadena[$i];
        }
    $bandera = false;
    }
    return $cifrado;
}
function descifrarCesarV1($cadena,$semilla) {
    $cadena = mb_strtoupper($cadena);
    $descifrado = "";
    $abc = generaAbc();
    $bandera = false;
    for($i=0;$i<strlen($cadena);$i++) {
        for($j=0;$j<count($abc) && !$bandera;$j++) {
            if ($cadena[$i] == $abc[$j]) {

                $descifrado .= $j-$semilla<0?
                    $abc[($j-($semilla%27))]
                :
                    $abc[$j-$semilla];

                $bandera = true;
            } if ($cadena[$i-1].$cadena[$i] == $abc[$j]) {

                $descifrado .= $j-$semilla<0?
                    $abc[($j-($semilla%27))]
                :
                    $abc[$j-$semilla];
                $bandera = true;
            }
        }
        if (!$bandera && $cadena[$i] != chr(195)) {
            $descifrado .= $cadena[$i];
        }
    $bandera = false;
    }
    return $descifrado;
}
function cifrarCesarV2($cadena,$cadenaSemilla) {
    $cadena = mb_strtoupper($cadena);
    $cadenaSemilla = mb_strtoupper($cadenaSemilla);
    $cadenaSemilla = stringToArray($cadenaSemilla);
    $cifrado = "";
    $abc = generaAbc();
    $bandera = false;
    for($i=0;$i<strlen($cadena);$i++) {
        for($j=0;$j<count($abc) && !$bandera;$j++) {
            if ($cadena[$i] == $abc[$j]) {
                if(letraToNumero($cadenaSemilla[$i% count($cadenaSemilla)]) == null) {
                    $semilla = letraToNumero("Ñ");
                    array_splice($cadenaSemilla,$i,1);
                } else {
                    $semilla = letraToNumero($cadenaSemilla[$i% count($cadenaSemilla) ]);
                }
                $cifrado .= $j+$semilla>26?$abc[($j+$semilla)%27]:$abc[$j+$semilla];
                $bandera = true;
            } else if ($cadena[$i-1].$cadena[$i] == $abc[$j]) {
                if(letraToNumero($cadenaSemilla[$i% count($cadenaSemilla)]) == null) {
                    $semilla = letraToNumero("Ñ");
                    array_splice($cadenaSemilla,$i,1);
                } else {
                    $semilla = letraToNumero($cadenaSemilla[$i% count($cadenaSemilla) ]);
                }
                $cifrado .= $j+$semilla>26?$abc[($j+$semilla)%27]:$abc[$j+$semilla];
                $bandera = true;
            }
        }
        if (!$bandera && $cadena[$i] != chr(195)) {
            $cifrado .= $cadena[$i];
        }
    $bandera = false;
    }
    return $cifrado;
}
function descifrarCesarV2($cadena,$cadenaSemilla) {
    $cadena = mb_strtoupper($cadena);
    $cadenaSemilla = mb_strtoupper($cadenaSemilla);
    $cadenaSemilla = stringToArray($cadenaSemilla);
    $descifrado = "";
    $abc = generaAbc();
    $bandera = false;
    $volver = 0;
    for($i=0;$i<strlen($cadena);$i++) {
        for($j=0;$j<count($abc) && !$bandera;$j++) {
            if ($cadena[$i] == $abc[$j]) {
                if(letraToNumero($cadenaSemilla[$i% count($cadenaSemilla)]) == null) {
                    $semilla = letraToNumero("Ñ");
                    //Ocupaba dos espacios por eso SPLICE quita la siguiente posicion a la actual
                    array_splice($cadenaSemilla,$i,1);
                } else {
                    $semilla = letraToNumero($cadenaSemilla[$i% count($cadenaSemilla) ]) +$volver;
                }
                
                $descifrado .= $j-$semilla<0?
                    $abc[($j-($semilla%27)) + count($abc)]
                :
                    $abc[$j-$semilla];

                $bandera = true;
            } else if ($cadena[$i %strlen($cadena)].$cadena[($i+1) % strlen($cadena)] == $abc[$j]) {
                if(letraToNumero($cadenaSemilla[$i% count($cadenaSemilla)]) == null) {
                    $semilla = letraToNumero("Ñ");
                    //Ocupaba dos espacios por eso SPLICE quita la siguiente posicion a la actual
                    array_splice($cadenaSemilla,$i,1);
                } else {

                    $semilla = letraToNumero($cadenaSemilla[$i% count($cadenaSemilla)]);
                }
                $descifrado .= $j-($semilla+1)<0?
                $abc[($j-($semilla%27)) + count($abc)]
            :
                $abc[$j-$semilla];

                $bandera = true;
                $i++;
                $volver++;
            }
        }
        if (!$bandera && $cadena[$i] != chr(195)) {
            $descifrado .= $cadena[$i];
        }
    $bandera = false;
    }
    return $descifrado;
}
function letraToNumero($letra) {
    $abc = generaAbc();
    foreach($abc as $indice => $valor) {
        if ($valor == $letra) {
            return $indice+1;
        }
    }
    return null;
}
function stringToArray($cadena) {
    $array = [];
    for($i=0;$i< strlen($cadena); $i++) {
        $array[$i] = $cadena[$i];
    }
    return $array;
}
function soloLetras($in){
    if(preg_match('/^[a-zA-Z\s]+$/', $in)) return true;
    else return false;
}

// Todos //
function array_a_cadenaurl($array) {

    //Primero Transformamos el array en una cadena de texto
         $cadenatmp = serialize($array);
    //Codificamos dicha cadena en formato URL para enviar correctamente
    // los caracteres especiales
         $cadena = urlencode($cadenatmp);
    //devolvemos la cadena codificada
         return $cadena;
} 
function cadenaurl_a_array($texto) {
    // Esto lo hacemos por si está vacía la cadena no me cree un array
    // con una posición vacía
            $array = array();
            if($texto != "") {
    // Antes de descodificar hay que quitar cualquier \ contrabarra     
                $texto = stripslashes($texto);
    // Decodifico de formato URL a texto plano
                $texto = urldecode($texto);
    // Ahora a partir de la cadena genero un array
                $array = unserialize($texto);
            }
            return $array;   
}
function serializarArray($array,$separadorElementos="||",$separadorIndice="**"){
    $cadena="";
    foreach($array as $i => $valor){
        $cadena.=$i.$separadorIndice.$valor.$separadorElementos;
    }
    return $cadena;
}

// Ejercicio 3
function dibujaPiramide($num){
    $piramide = "<table>";

    for ($i = 1; $i <= $num; $i++) {
        $piramide .= "<tr>";

        // Espacios al principio
        for ($k = $num; $k > $i; $k--) {
            $piramide .= "<td> </td>";
        }
        // De mayor a menor hasta 2
        for ($j = $i; $j >= 2; $j--) {
            $piramide .= "<td style='text-align:center'>{$j}</td>";
        }
        // De menor, desde 1, a mayor
        for ($l = 1; $l <= $i; $l++) {
            $piramide .= "<td style='text-align:center'>{$l}</td>";
        }
        // Espacios al final
        for ($k = $i; $k < $num; $k++) {
            $piramide .= "<td> </td>";
        }


        $piramide .= "</tr>";
    }
    $piramide .= "</table>";
    
    return $piramide;
}


// Ejercicio 5
function imprimir_menu($cadenaEmpresa) {
    return "
    <div id='menu'>
        <form action='VendedorProducto.php' method='post'>
            <input type='submit' value='VendedorProducto' name='boton1'>
            <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='$cadenaEmpresa'>
        </form>
        <form action='TotalVendedor.php' method='post'>
            <input type='submit' value='TotalVendedor' name='boton2'>
            <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='$cadenaEmpresa'>
        </form>
        <form action='TotalProducto.php' method='post'>
            <input type='submit' value='TotalProducto' name='boton3'>
            <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='$cadenaEmpresa'>
        </form>
        <form action='Modificar.php' method='post'>
            <input type='submit' value='Modifica' name='boton4'>
            <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='$cadenaEmpresa'>
        </form>
        <form action='BalanceEmpresa.php' method='post'>
            <input type='submit' value='Balance de la Empresa' name='boton5'>
            <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='$cadenaEmpresa'>
        </form>
    </div>";
}
function tablaBalanceEmpresa($arrayEmpresa) {
    $productos = reset($arrayEmpresa);
    $totalesProductos = [];

    for ($i=0; $i < count($productos) ; $i++) { 
        array_push($totalesProductos,0);
    }

    //Inicio de tabla
    $cadena = "<table border='1'>
                <tr>
                    <td></td>";
    
    // Primera linea de productos con el total al final
    foreach ($productos as $nombre => $ventas) {
        $cadena .= "<td>{$nombre}</td>";
    }
    $cadena .= "<td><strong>Totales Vendedor</strong></td>
                </tr>";


    
    $balanceTotal = 0;
    // Cada linea siguiente de Vendedor - productos... - total
    foreach($arrayEmpresa as $vendedor => $arrayProductos) {
        $cadena .= "<tr>
                        <td>$vendedor</td>"; 
        
        $total = 0;
        $pos = 0;
        foreach($arrayProductos as $producto => $cantidad) {
            $totalesProductos[$pos] += $cantidad;
            $cadena .= "<td>$cantidad</td>";
            $total += $cantidad;
            $pos++;
        }
        $cadena .= "<td>$total</td></tr>";
        $balanceTotal += $total;
    }

    $cadena .= "<tr>
                <td><strong>Totales Producto</strong></td>";
    foreach ($totalesProductos as $cantidad) {
        $cadena .= "<td>{$cantidad}</td>";
    }
    

    //Final de tabla
    $cadena .= "<td>$balanceTotal</td></tr></table>";


    return $cadena;
}

// Ejercicio 6
function menu_empresa($cadenaEmpresa) {
    return "
    <div id='menu'>
        <form action='AnyadirTrabajador.php' method='post'>
            <input type='submit' value='Añadir Trabajador' name='boton1'>
            <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='$cadenaEmpresa'>
        </form>
        <form action='VerTrabajador.php' method='post'>
            <input type='submit' value='Var Trabajador' name='boton2'>
            <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='$cadenaEmpresa'>
        </form>
        <form action='VerSeccion.php' method='post'>
            <input type='submit' value='Ver Sección' name='boton3'>
            <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='$cadenaEmpresa'>
        </form>
        <form action='ModificarTrabajador.php' method='post'>
            <input type='submit' value='Modificar Trabajador' name='boton4'>
            <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='$cadenaEmpresa'>
        </form>
    </div>";
}
function calc_sueldoB($horas) {
    $sueldoB = 0;

    for($i = 1; $i <= $horas; $i++) {
        switch ($i) {
            case $i<=30:
                $sueldoB += 6;
                break;
            case $i>30&&$i<=40:
                $sueldoB += 9;
                break;
            default:
                $sueldoB += 12;
                break;
        }
    }
    return $sueldoB;
}
function calc_impuestos($sueldoB) {
    $impuestos = 0;

    if ($sueldoB > 180) {
        $sueldo = $sueldoB-180;
        $impuestos += (18 + ($sueldo/15));
    } else {
        $impuestos += $sueldoB/10;
    }
    return $impuestos;
}
function validar_dni($dni){
    $letra = substr($dni, -1);
    $numeros = substr($dni, 0, -1);
    if ( strlen($letra) == 1 && strlen ($numeros) == 8 ){
      return true;
    }else{
      return false;
    }
}
function mostrarSeccion($arrayEmpresa,$seccion) {
    $cadenaEmpresa = array_a_cadenaurl($arrayEmpresa);
    $cadena = "
    <table border=1>
        <tr>
            <td>DNI</td>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>Horas</td>
            <td>Sueldo Bruto</td>
            <td>Impuestos</td>
            <td>Sueldo Neto</td>
            <td colspan=2>Acciones</td>
            </tr>";
    $horasTotal = 0;
    $brutoTotal = 0;
    $impuestos = 0;
    $netoTotal = 0;
    foreach ($arrayEmpresa[$seccion] as $dni => $datos) {
    $cadena .= "<tr>
                    <td> $dni </td>";
    foreach ($datos as $key => $value) {
        $cadena .= "<td> $value </td>";
        switch ($key) {
            case 'horas':
                $horasTotal += $value;
                break;
            case 'sueldoB':
                $brutoTotal += $value;
                break;
            case 'impuestos':
                $impuestos += $value;
                break;
            case 'sueldoN':
                $netoTotal += $value;
                break;
        }
    }
    $cadena .= "
        <td> 
            <form action='VerSeccion.php' method='post'>
                <input type='image' name='modificar' src='pencil.png' width=30 height=30 alt='modificar'>
                <input type='hidden' name='seccion' id='seccion' value='{$seccion}'>
                <input type='hidden' name='dni' id='dni' value='{$dni}'>
                <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='{$cadenaEmpresa}'>
            </form>
        </td>
        <td> 
            <form action='VerSeccion.php' method='post'>
                <input type='image' name='eliminar' src='trash.png' width=30 height=30 alt='eliminar'>
                <input type='hidden' name='seccion' id='seccion' value='{$seccion}'>
                <input type='hidden' name='dni' id='dni' value='{$dni}'>
                <input type='hidden' name='arrayEmpresa' id='arrayEmpresa' value='{$cadenaEmpresa}'>
            </form>
        </td>
    </tr>";
    }

    $cadena .= "
    <tr>
        <td colspan=3> <strong>Totales</strong> </td>
        <td> {$horasTotal} </td>
        <td> {$brutoTotal} </td>
        <td> {$impuestos} </td>
        <td> {$netoTotal} </td>
    </tr>

    </table>";
    return $cadena;
}

// Ejercicio 7 
function tablaAvion($arrayAvion) {
    $cadenaAvion = array_a_cadenaurl($arrayAvion);
    $cadena = "<table border='1'>";
    foreach($arrayAvion as $fila => $asientos) {
        $cadena .= "<tr>";
        foreach($asientos as $columna => $estado) {
            $cadena .= "<td>
                        <form action='{$_SERVER['PHP_SELF']}' method='post'>";
            $estado==="L"?$cadena.="<input type='image' width='30px' height='30px' src='AsientoLibre.jpg' alt='Libre' name='imageButton'>"
                         :$cadena.="<input type='image' width='30px' height='30px'  src='AsientoReservado.jpg' alt='Reservado' name='imageButton'>";              
            $cadena .= "<input type='hidden' name='fila' value='{$fila}'>
                        <input type='hidden' name='columna' value='{$columna}'>
                        <input type='hidden' name='array' value='{$cadenaAvion}'>
                        </form>
                        </td>";
        }
        $cadena .= "</tr>";
    }
    $cadena .= "</table>";
    return $cadena;
}

// Ejercicio 8
function tablaTablero($arrayTablero,$filaActual,$columnaActual,$cordura,$vidas,$end) {
    
    $cadenaTablero = array_a_cadenaurl($arrayTablero);
    $cadena = "<table>";

    foreach($arrayTablero as $fila => $columnas) {
        $cadena .= "<tr>";

        foreach($columnas as $columna => $datos) {
            foreach ($datos as $type => $value) {

                if( ( ($filaActual == $fila && (($columnaActual+1) == $columna || ($columnaActual-1) == $columna)) || 
                      ($columnaActual == $columna && (($filaActual+1) == $fila || ($filaActual-1) == $fila)) ) && 
                       $value != "wall" && $vidas >= 1 && $cordura >= 1) {
                    $cadena .= "<td>
                                <form action='{$_SERVER['PHP_SELF']}' method='post'>";
                    if ($value === "floor") {
                        $cadena .= "<input type='image' src='images/{$value}.png' alt='{$value}' width='87.5' height='87.5' name='imageButton'>";
                    } else {
                        $cadena .= "<input type='image' src='images/{$type}.png' alt='{$value}' width='87.5' height='87.5' name='imageButtton'>";
                    }
                    $cadena .=  "<input type='hidden' name='filaActual' value='{$fila}'>
                                 <input type='hidden' name='columnaActual' value='{$columna}'>
                                 <input type='hidden' name='filaAnterior' value='{$filaActual}'>
                                 <input type='hidden' name='columnaAnterior' value='{$columnaActual}'>
                                 <input type='hidden' name='array' value='{$cadenaTablero}'>
                                 <input type='hidden' name='cordura' value='{$cordura}'>
                                 <input type='hidden' name='vidas' value='{$vidas}'>
                                 </form>
                                 </td>";
                } else {
                    $cadena .= "<td>";
                    if ($value === "floor" && !$end) {
                        $cadena .= "<image src='images/{$value}.png' alt='{$value}' width='87.5' height='87.5'>";
                    } else {
                        $cadena .= "<image src='images/{$type}.png' alt='{$value}' width='87.5' height='87.5'>";
                    }
                    $cadena .= "</td>";
                }
            }
        }
        $cadena .= "</tr>";
    }

    $cadena .= "</table>";
    return $cadena;
}

function generarTablero($arrayTablero,$filaInicial,$columnaInicial,$cordura,$vidas,$end) {
    $arraySpawnsValidos = [
        2 => [0,0,0,0,2,3,4,5,6,7,8,9,10],
        3 => [0,0,0,0,2,3,4,5,6,7,8,9,10],
        4 => [0,0,0,0,2,3,4,5,6,7,8,9,10],
        5 => [0,0,0,0,2,3,4,5,6,7,8,9,10],
        6 => [0,0,0,0,2,3,4,5,6,7,8,9,10],
        7 => [0,0,0,0,2,3,4,5,6,7,8,9,10],
        8 => [0,0,0,0,2,3,4,8,9,10],
        9 => [0,0,0,0,2,3,4,8,9,10],
    ];
    
    do {
        $spawns = [
            2 => $arraySpawnsValidos[2][array_rand($arraySpawnsValidos[2])],
            3 => $arraySpawnsValidos[3][array_rand($arraySpawnsValidos[3])],
            4 => $arraySpawnsValidos[4][array_rand($arraySpawnsValidos[4])],
            5 => $arraySpawnsValidos[5][array_rand($arraySpawnsValidos[5])],
            6 => $arraySpawnsValidos[6][array_rand($arraySpawnsValidos[6])],
            7 => $arraySpawnsValidos[7][array_rand($arraySpawnsValidos[7])],
            8 => $arraySpawnsValidos[8][array_rand($arraySpawnsValidos[8])],
            9 => $arraySpawnsValidos[9][array_rand($arraySpawnsValidos[9])],
        ];
    } while ($spawns[2] === 0 && $spawns[3] === 0 && $spawns[4] === 0 && 
             $spawns[5] === 0 && $spawns[6] === 0 && $spawns[7] === 0 && 
             $spawns[8] === 0 && $spawns[9] === 0);
    
    
    $numEventos = 0;
    foreach ($spawns as $fila => $columna) {
        if ($columna !== 0) {
            $numEventos++;
        }
    }
    
    if ($numEventos === 1) {
        foreach ($spawns as $fila => $columna) {
            if ($columna !== 0) {
                $arrayTablero[$fila][$columna] = ["treasure"=>"floor"];
            }
        }
    } else {
        $treasure = rand(1,$numEventos);
        $i = 1;
        // Recorro arraySpawns para añadir los eventos al arrayTalero
        foreach ($spawns as $fila => $columna) {
    
    
            // Si no es un 0, es decir, si se tiene que generar algo en dicha linea
            if ($columna !== 0) {
                // Comprobar si la posición del tesoro es la del evento a incluir
                if ($i === $treasure) {
                    // si se cumple se añade el tesoro
                    $arrayTablero[$fila][$columna] = ["treasure" => "floor"];
                } else {
                    // en caso contrario seguimos añadiendo enemigos
                    $arrayTablero[$fila][$columna] = ["enemy" => "floor"];
                }
                $i++;
            }
            
            
        }
    
    }
    $imprimir = tablaTablero($arrayTablero,$filaInicial,$columnaInicial,$cordura,$vidas,$end);
    return $imprimir;
}