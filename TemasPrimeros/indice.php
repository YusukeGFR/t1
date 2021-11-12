<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Prueba de lectura de directorio</title>
</head>
<body>
<?php
    $nomdir = './';
    echo "<h1>Contenido de $nomdir</h1>\n";
    $dir = opendir($nomdir);
    echo "<pre>\n";
    echo "<b>";
    echo str_pad("Nombre", 30); //str pad formatea a tamanyo fijo de 30
    echo str_pad("Fecha ult. mod.", 20);
    echo str_pad("Tamaño", 10);
    echo "</b></pre>\n";
    echo "<hr /><pre>\n";
 while(($fichero = readdir($dir)) != FALSE) {
     if ($fichero !== ".") {
         if (is_dir($fichero)) {
            echo "<a href='$fichero'>".str_pad($fichero,30)."</a>";
            echo str_pad(date("d/m/Y H:i" , filemtime( $fichero)), 20);
            echo "-";
         } else {
            echo str_pad(filesize( $fichero), 10);
         }
        echo "<br />\n";
     }
    
 }
 closedir($dir);
 echo "</pre><hr />\n";
?>

</body>
</html>