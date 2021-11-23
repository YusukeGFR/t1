<?php
include_once "base_datos.php";
$conexion=conectar();
$sentencia = $conexion->query("SELECT * FROM personas;");
$personas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!--Recordemos que podemos intercambiar HTML y PHP como queramos-->
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Tabla de ejemplo</title>
	<style>
	table, th, td {
	    border: 1px solid black;
        border-collapse: collapse;
	}
	</style>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Género</th>
			</tr>
		</thead>
		<tbody>
			<!--
				Atención aquí, sólo esto cambiará
				Pd: no ignores las llaves de inicio y cierre {}
			-->
			<?php foreach($personas as $persona){ ?>
			<tr>
				<td><?php echo $persona->id ?></td>
				<td><?= $persona->nombre ?></td>
				<td><?php echo $persona->apellidos ?></td>
				<td><?= $persona->sexo ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</body>
</html>
