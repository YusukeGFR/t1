<?php
include_once "base_datos.php";
$conexion=conectar();
//Salir si alguno de los datos no está presente
if(!isset($_POST["nombre"]) || !isset($_POST["apellidos"]) || !isset($_POST["sexo"])) exit(); //también podríamos hacerlo así
//Si todo va bien, se ejecuta esta parte del código...
 
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$sexo = $_POST["sexo"];
/*	Al incluir el archivo "base_datos.php", todas sus variables están
	a nuestra disposición. Por lo que podemos acceder a ellas tal como si hubiéramos copiado y pegado el código
*/
$sentencia = $conexion->prepare("INSERT INTO persona(nombre, apellidos, sexo) VALUES (?, ?, ?);"); // puedes poner directamente los valores, pero no es seguro
$resultado = $sentencia->execute([$nombre, $apellidos, $sexo]); // Los valores pasados así los sustituye en las "?"
// Conexion para preparar
// Sentencia para ejecutar

/*Pasar en el mismo orden de los ? execute devuelve un booleano. True en caso de que todo vaya bien, falso en caso contrario.*/
//Así podriamos evaluar
if($resultado === TRUE) echo "Insertado correctamente";
else echo "Algo salió mal. Por favor verifica que la tabla exista";
?>
