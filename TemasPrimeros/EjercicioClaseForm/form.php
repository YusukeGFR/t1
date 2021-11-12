<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Prueba de subir fichero</title>
</head>
<body>
<form action="subirArchivos.php" method="post" enctype="multipart/form-data">
Usuario: <input type="text" name="usaurio" id="usuario" />
<br />
Fotos: <input type="file" name="fotos" id="fotos" accept="image/jpg, image/pjpg"/>
<br />
Curriculum: <input type="file" name="cvv" id="cvv" accept="image/pdf"/>
<input type="submit" value="Subir Archivos" />
</form>
</body>
</html>




