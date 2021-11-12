<?php
include "funciones.php";
$array_clientes=[
// "11111111X"=>["nombre"=>"Luis","nick"=>"Luis","pass"=>"123","sexo"=>"M"],
// "22222222J"=>["nombre"=>"Rosa","nick"=>"Rosa","pass"=>"123","sexo"=>"F"],
// "33333333B"=>["nombre"=>"Edu","nick"=>"Edu","pass"=>"123","sexo"=>"M"]
];

$fp = fopen("datos.txt","a+");
while ($cliente = fscanf($fp,"%s\t%s\t%s\t%s\t%s")) {
	$array_clientes += [$cliente[0] => ["nombre" => $cliente[1],"nick"=>$cliente[2],"pass"=>$cliente[3],"sexo"=>$cliente[4] ] ];
}

echo "<pre>";
echo print_r($array_clientes);
echo "</pre>";









if(isset($_GET['dni'])){
//RECOGER DATOS
	$dni=$_GET['dni'];
	$nombre=$_GET['nombre'];
	$nick=$_GET['nick'];
	$pass=$_GET['pass'];
	$sexo=$_GET['sexo'];

	$aficiones = isset($_GET["aficiones"]) ? $_GET["aficiones"] : [];
	$aficiones = $_GET["aficiones"] ?? [];
	
	var_dump($aficiones);
//COMPRUEBO ERRORES CAMPOS VACIOS
	$errores=false;
	$array_errores=[];
	$array_Novacios=["dni","nombre","nick","pass"];
	$array_Unico=["nick"];
	for($i=0;$i<count($array_Novacios);$i++){
		$campo=$array_Novacios[$i];
		if (empty($_GET[$campo])){
			$errores=true;
			$array_errores[]=["campo"=>$array_Novacios[$i],
						"mensaje"=>"El campo ".$array_Novacios[$i]. " no puede estar vacio"];
		}
	}
//COMPRUEBO ERRORES CAMPOS UNICOS
	if(isset($array_clientes[$dni])){//Existe el dni
		$errores=true;
		$array_errores[]=["campo"=>"dni",
						"mensaje"=>"El dni no es unico"];
	}

	foreach ($array_clientes as $indice => $fila) {
		for($i=0;$i<count($array_Unico);$i++){
			$campo=$array_Unico[$i];
			if ($fila[$campo]==$_GET[$campo]){
				$errores=true;
				$array_errores[]=["campo"=>$array_Unico[$i],
				"mensaje"=> "Error, el campo ".$array_Unico[$i]. " está repetido"];
			}
		}
	}
	$cadena_errores=array_a_cadena($array_errores);
	$array_datos=["dni"=>$dni,"nombre"=>$nombre,"nick"=>$nick,"pass"=>$pass,"sexo"=>$sexo,"aficiones"=>$aficiones];
	$cadena_datos= array_a_cadena($array_datos);
	if($errores) //echo "error";
		header("location:formulario.php?datos=".$cadena_datos."&errores=".$cadena_errores);
	else{//DOY DE ALTA
		fwrite($fp,"\n$dni\t$nombre\t$nick\t$pass\t$sexo");
		fclose($fp);
		$array_clientes[$dni]=["nombre"=>$nombre,"nick"=>$nick,"pass"=>$pass,"sexo"=>$sexo];
		var_dump ($array_clientes);
	}


}else{
	echo "Tas pasao de listo. Tira patras.";
}



?>