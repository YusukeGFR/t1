<?php
include_once  "funciones.php";
function MostrarFormulario(string $cadenaDatos, int $numero=0){
?>
<form action="<?=$_SERVER["PHP_SELF"] ?>" METHOD="POST">
nUMERO <INPUT TYPE="TEXT" name="numero" id="numero" value="<?=$numero?>">
<INPUT TYPE="HIDDEN" name="cadenaArray" id="cadenaArray" 
value="<?=$cadenaDatos?>">
<input type="submit">
</FORM>
<?php
}

function MostrarDatos($arrayTemperaturas){
    $total=0; $cantElementos=0;
    for ($i=0;$i<count ($arrayTemperaturas);$i++){
        $total+=$arrayTemperaturas[$i];
        $cantElementos++;
    }
    echo "La temperatura promedio es de: ".number_format($total/$cantElementos,2);

}
function MostrarDatosFin($arrayTemperaturas){
    $total=0; $cantElementos=0;
    for ($i=0;$i<count ($arrayTemperaturas);$i++){
        $total+=$arrayTemperaturas[$i];
        $cantElementos++;
        echo "La temperatura del día {$cantElementos} fue {$arrayTemperaturas[$i]}<br>";
    }
    echo "La temperatura promedio es de: ".number_format($total/$cantElementos,2);
    }

?>