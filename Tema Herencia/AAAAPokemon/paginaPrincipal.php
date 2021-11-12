<?php

    $fp = fopen("admin/admin.txt","r");
    while ($admin = fscanf($fp,"%s\t%s")) {
        list($nombre, $contra) = $admin;
        echo $nombre." ".$contra;
    }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="admin.php" method="post">
        <input type="submit" value="Administrador" name="botonAdmin">
    </form>
    <form action="usuario.php" method="post">
        <input type="submit" value="Usuario" name="botonUsuario">
    </form>
</body>
</html>