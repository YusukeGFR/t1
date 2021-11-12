<?php
// $array = [3,4,5,6];
// var_dump($array);
// unset($array[1]);
// // echo "<br>";
// echo "<table border=1>";
// echo "<th>Posicion</th><th>Valor</th>";
// foreach($array as $indice => $valor) {
//     echo "<tr><td>{$indice}</td><td>{$valor}</td></tr>";
// }
// echo "</table>";
// var_dump($array);

// echo "<pre>";
// print_r($array);
// echo "</pre>";

// echo "<table border=1>";
// echo "<th>Posicion</th><th>Valor</th>";
// for($i=0; $i<10;$i++) {
//     $array[$i] = rand(1,100);
// }
// echo "</table>"

// $array[35] = $array2 = [23,45,67];

function color($valor) {
    $colores = ["white","black","red","blue","pink"];
    //operador fusion tiene integrado un isset en la primera parte, 
    //si existe devulve el dato, sinó devuelve la segunda parte 
    return ($colores[$valor-1]) ?? "white";
}

function colorLetra($valor) {
    $colorLetra = "black";
    switch ($valor) {
        case 2: $colorLetra = "white"; break;
    }
    return $colorLetra;
}

function generarArray($num,$min,$max) {
    for($i=0; $i<$num;$i++) {
        for($j=0; $j<$num;$j++) {
            $array[$i][$j] = rand($min,$max);
        }
    }
    return $array;
}



function generarTabla($array) {
    echo "<table border=1>";
    for($i=0;$i<count($array);$i++) {
        echo "<tr>";
        for($j=0;$j<count($array[$i]);$j++) {
            $color = color($array[$i][$j]);
            $colorLetra = colorLetra($array[$i][$j]);
            echo "<td bgcolor='{$color}'><font color='{$colorLetra}'>
                    &nbsp &nbsp &nbsp
                    </font></td>";

        }
        echo "</tr>";
    }
    echo "</table>";
}

$array = generarArray(12,1,5);
generarTabla($array);

// echo "<pre>";
// print_r($array);
// echo "</pre>";

?>