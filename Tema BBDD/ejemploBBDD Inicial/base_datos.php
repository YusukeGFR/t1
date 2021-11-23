<?php
define("PASSWORD",""); //Esto dependerá del password claro
define("USUARIO","root");//usamos el root por comodidad, pero es poco seguro
define("BB_DD","pruebas");//base de datos creada con anterioridad
 
function conectar(){
$conexion=null;
  try{
	$opciones=  array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );	
    $conexion = new PDO('mysql:host=localhost;dbname=' . BB_DD, USUARIO, PASSWORD, $opciones);
    // tipo de base de datos
    // conexion 
    // nombre de base de datos
    // usuario / contraseña

  }catch(Exception $e){
	echo "Ocurrió algo con la base de datos: " . $e->getMessage();
  }
  return $conexion; //Es un objetos de conexion PDO
}

echo "<pre>";
print_r( conectar() );
echo "</pre>";





?>