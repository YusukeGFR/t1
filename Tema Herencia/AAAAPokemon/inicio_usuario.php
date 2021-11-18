<?php
include_once("funciones.php");
if (isset($_POST["checkUser"])) {

    $user = $_POST["requestUser"];
    $pass = $_POST["requestPass"];
    $correct = false;

    $fp = fopen("admin/users.txt","r");
    while (! feof($fp)) {
        $line = fgets($fp);
        $datos = explode("\t",$line);
        if ($datos[0] == $user && $datos[1] == $pass) {
            $correct = true;
        }
    }
    fclose($fp);

    if (!$correct) {
        header("location:checkUser.php?error=Usuario o contraseña incorrectos");
    } else {
        $menu = menuUsuario($user);
    }


} else {
    header("location:paginaPrincipal.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Usuario</title>
</head>
<body>
    <?= $menu ?>
    <hr>
</body>
</html>