<?php
include_once("funciones.php");
include_once("pokemon.php");
include_once("usuario.php");
comprobacion();
    $user = unserialize( $_SESSION["usuario"]);
    $misPokemons = $user->getMisPokemons();
    $mensaje = "";

    if(isset($_POST["update"])) {
        $pokemon1 = $_POST["pokemon1"];
        $pokemon2 = $_POST["pokemon2"];
        $pokemon3 = $_POST["pokemon3"];
        $error = false;
        
        if ($pokemon1 === $pokemon2 || $pokemon2 === $pokemon3 || $pokemon1 === $pokemon3) {
            $error = true;
            $mensaje = "Error, no puedes tener dos pokemons iguales en tu equipo.";
        }

        if (!$error) {
            // Actualizamos los pokemons que hay en el fichero del usuario
            file_put_contents("users/{$user->getNombre()}/equipo_usuario.txt","{$pokemon1}\n{$pokemon2}\n{$pokemon3}\n");

            $nuevoEquipo = [];
            while (count($nuevoEquipo) !== 3) {
                foreach($misPokemons as $pokemon) {
                    if($pokemon1 === $pokemon->getNombre() && count($nuevoEquipo) == 0) {
                        array_push($nuevoEquipo,$pokemon);
                    }
                    if($pokemon2 === $pokemon->getNombre() && count($nuevoEquipo) == 1) {
                        array_push($nuevoEquipo,$pokemon);
                    }
                    if($pokemon3 === $pokemon->getNombre() && count($nuevoEquipo) == 2) {
                        array_push($nuevoEquipo,$pokemon);
                    }
                }
            }
            $user->setMiEquipo($nuevoEquipo);
            $_SESSION["usuario"] = serialize($user);

            $usuarios = cadenaurl_a_array(file_get_contents("admin/usuariosSerialized.txt"));

            foreach ($usuarios as $indice => $usuario) {
                if ($usuario->getNombre() === $user->getNombre()) {
                    $usuarios[$indice] = $user;
                }
            }
            file_put_contents("admin/usuariosSerialized.txt",array_a_cadenaurl($usuarios));

        }
    }
    $equipoPokemon = $user->getMiEquipo();
    $tabla = userPokes($equipoPokemon);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizar Equipo</title>
    <link rel="stylesheet" href="styleUser.css">
</head>
<body>
    <?= menuUsuario() ?>

    <div id="table_Equipo">
        <?= $tabla ?>
    </div>
    <div class="under-form">
        <form action="organizar_equipo.php" method="post">
            <p>
                Pokemon 1: 
                <?= desplegablesMisPokes($misPokemons,1,$equipoPokemon); ?>
                Pokemon 2:
                <?= desplegablesMisPokes($misPokemons,2,$equipoPokemon); ?>
                Pokemon 3: 
                <?= desplegablesMisPokes($misPokemons,3,$equipoPokemon); ?>
            </p>
            <input type="submit" value="Actualizar Equipo" name="update">
        </form>
    </div>
    <?= $mensaje ?>
</body>
</html>