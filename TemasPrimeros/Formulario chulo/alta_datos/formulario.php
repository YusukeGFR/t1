<?php
include "funciones.php";
function DibujaErroresPorCampo($campo,$arrayErrores){
	$cadena="";
	for($i=0;$i<count($arrayErrores);$i++){
		if($campo==$arrayErrores[$i]["campo"]){
			$cadena=$cadena. $arrayErrores[$i]["mensaje"];
		}
	}
	return $cadena;
}
function DibujaAficiones($aficion,$arrayAficiones){
	for($i=0;$i<count($arrayAficiones);$i++){
		if($aficion==$arrayAficiones[$i]){
			return "CHECKED";
		}
	}
	return "";
}
$array_errores=[];
$arrayAficiones=[];
$array_datos=["dni"=>"","nombre"=>"","nick"=>"","pass"=>"","sexo"=>"M"];
$masculino="";
$femenino="CHECKED";
if($array_datos["sexo"]=="M"){
	$masculino="CHECKED";
	$femenino="";
}
if(isset($_GET['errores'])){
	$array_errores=cadena_a_array($_GET['errores']);
	$array_datos=cadena_a_array($_GET['datos']);
	$arrayAficiones=$array_datos["aficiones"];
	/*var_dump($array_errores);*/
	var_dump($array_datos);

}

?>
<form action="comprobar.php" method="GET">
Introduzca Nombre <input type="text" name="nombre" id="nombre" value="<?=$array_datos["nombre"]  ?>" ><div class='Error'>
 <?= DibujaErroresPorCampo("nombre",$array_errores)?></div>
<br>Introduzca Nick <input type="text" name="nick" id="nick" value="<?=$array_datos["nick"]  ?>" ><?= DibujaErroresPorCampo("nick",$array_errores)?><br>
Introduzca Contraseña <input type="text" name="pass" id='pass' ><?= DibujaErroresPorCampo("pass",$array_errores)?><br>
Introduzca dni <input type="text" name="dni" id='dni' value="" ><br>
Sexo:<label> Masculino <input type="radio" id="sexo" name="sexo" value="M" 
	<?= ($array_datos["sexo"]=="M")?"CHECKED":"";?>
 > </label>
<label>Femenino <input type="radio" id="sexo" name="sexo" value="F"
	<?= ($array_datos["sexo"]=="F")?"CHECKED":"";?>></label> <br>
¿ Cuales son tus aficiones?<br>
<table>
<tr>
<TD><label>Coches <input type="checkbox" id="coches" value="coches" name="aficiones[]" <?= DibujaAficiones("coches",$arrayAficiones) ?>></label></TD>
<TD><label>Deporte <input type="checkbox" id="deporte" value="deporte" name="aficiones[]" <?= DibujaAficiones("deporte",$arrayAficiones) ?>></label></TD>
</tr>
<TD><label>Fiesta <input type="checkbox" id="fiesta" value="fiesta" name="aficiones[]"  <?= DibujaAficiones("fiesta",$arrayAficiones) ?>  ></label></TD>
<TD><label>Sofing <input type="checkbox" id="sofing" value="sofing" name="aficiones[]"  <?= DibujaAficiones("sofing",$arrayAficiones) ?>   ></label></TD>
</tr>
</table>
<input type="submit" name="alta" id="alta" value="Dar de Alta">
</form>