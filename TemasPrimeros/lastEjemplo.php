<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Prueba de subir fichero</title>
</head>
<body>
<form action="subirfichero.php" method="post" enctype="multipart/form-data">
Fichero: <input type="file" name="fichero[]" id="fichero" multiple="multiple"/>
<br />
<input type="submit" value="Enviar" />
</form>
</body>
</html>