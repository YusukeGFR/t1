<?php
include_once("funciones.php");
include_once("usuario.php");
include_once("pokemon.php");
comprobacion();
    $menu = menuUsuario();
    // echo "<pre>";
    // print_r($user);
    // echo "</pre>";


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