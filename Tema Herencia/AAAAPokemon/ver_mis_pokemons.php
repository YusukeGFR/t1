<?php
include_once("funciones.php");
include_once("pokemon.php");
include_once("usuario.php");
comprobacion();
    $user = unserialize( $_SESSION["usuario"]);
    $misPokemons = $user->getMisPokemons();
    $tabla = userPokes($misPokemons);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver mis pokemons</title>
    <link rel="stylesheet" href="styleUser.css">
</head>
<body>
    <?= menuUsuario() ?>

    <div id="table_Pokemons">
        <?= $tabla ?>
    </div>
</body>
</html>