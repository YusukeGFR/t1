<?php

// $array = [12,4,5,4,6,5];
// unset($array[2]);
// var_dump($array);

// $array[] = 45;
// echo "<br>";
// var_dump($array);


function generarArray($num,$min,$max) {
    for($i=0; $i<$num;$i++) {
        for($j=0; $j<$num;$j++) {
            $array[$i][] = rand($min,$max);
        }
    }
    return $array;
}

$array = generarArray(12,1,10);
echo "<pre>";
print_r($array);
echo "</pre>";
?>