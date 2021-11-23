<?php
include_once("funciones.php");
include_once("pokemon.php");
include_once("usuario.php");
comprobacion();
$user = unserialize( $_SESSION["usuario"]);
$misPokemons = $user->getMisPokemons();
$miEquipo = $user->getMiEquipo();
$numEvoluciones = $user->getPokeEvoluciones();
$pokemonsCanEvolute = 0;
$showEvolution = "";


if (isset($_POST["evolucionar"])) {
    $numEvoluciones--;
    $chosen = explode("-",$_POST["pokeChosen"])[0];
    $evolucion = explode("-",$_POST["pokeChosen"])[1];

    // echo $chosen;
    // echo $evolucion;
    

    // Array con todos los pokemons existentes
    $pokemons = cadenaurl_a_array( file_get_contents("admin/pokemonsSerialized.txt") );
    $evolucionObj;
    foreach ($pokemons as $pokemon) {
        if ($pokemon->getNombre() === $evolucion) {
            $evolucionObj = $pokemon;
        }
    }

    // echo "<pre>";
    // print_r($evolucion);
    // echo "</pre>";
    
    // Actualizar mis pokemons
    foreach($misPokemons as $indice => $miPokemon) {
        if ($miPokemon->getNombre() === $chosen) {
            $misPokemons[$indice] = $evolucionObj;
        }
    }
    $user->setMisPokemons($misPokemons);

    // Actualizar mi equipo
    foreach($miEquipo as $indice => $miPokemon) {
        if ($miPokemon->getNombre() === $chosen) {
            $miEquipo[$indice] = $evolucionObj;
        }
    }
    $user->setMiEquipo($miEquipo);

    // Actualizar tokens evoluciones
    $user->setPokeEvoluciones(-1);


    // Actualizar fichero pokemons_usuario.txt
    $fp = fopen("users/{$user->getNombre()}/pokemons_usuario.txt","r");
    $content = "";
    while (! feof($fp)) {
        $line = substr(fgets($fp),0,-1);
        if ($line == $chosen) {
            $line = $evolucion;
        }
        if (strlen($line) > 1) {
            $content .= $line."\n";
        }
    }
    fclose($fp);
    file_put_contents("users/{$user->getNombre()}/pokemons_usuario.txt",$content);

    // Actualizar fichero equipo_usuario.txt
    $fp = fopen("users/{$user->getNombre()}/equipo_usuario.txt","r");
    $content = "";
    while (! feof($fp)) {
        $line = substr(fgets($fp),0,-1);
        if ($line == $chosen) {
            $line = $evolucion;
        }
        if (strlen($line) > 1) {
            $content .= $line."\n";
        }
    }
    fclose($fp);
    file_put_contents("users/{$user->getNombre()}/equipo_usuario.txt",$content);


    
    // Actualizar fichero partidas.txt
    $fp = fopen("users/{$user->getNombre()}/partidas.txt","w");
    $content = "{$user->getTotales()}-{$user->getGanadas()}-{$user->getPokeEvoluciones()}\n";
    fwrite($fp,$content);
    fclose($fp);


    // Mostrar visualmente que pokemon esta evolucionando en otro
    $supported_file = ['gif','jpg','jpeg','png'];
    $showEvolution = "<p>".ucfirst($chosen)." ha evolucionado a ".ucfirst($evolucion)."!</p>
                        <div>";

    $dibujado = false;
    foreach($supported_file as $ext) {
        if (file_exists("pokemons/{$chosen}/{$chosen}.{$ext}") && !$dibujado) {
            $dibujado = true;
            $showEvolution .= "<img src='pokemons/{$chosen}/{$chosen}.{$ext}' >";
        }
    }
    if(!$dibujado) {
        $showEvolution .= "<img src='pokemons/default.png' width='100px'>";
    }
    
    $showEvolution .=  "🡆";

    $dibujado = false;
    foreach($supported_file as $ext) {
        if (file_exists("pokemons/{$evolucion}/{$evolucion}.{$ext}") && !$dibujado) {
            $dibujado = true;
            $showEvolution .= "<img src='pokemons/{$evolucion}/{$evolucion}.{$ext}' >";
        }
    }
    if(!$dibujado) {
        $showEvolution .= "<img src='pokemons/default.png' width='100px'>";
    }
    
    $showEvolution .= "</div>";

    // Actualizar array de usuarios
    $usuarios = cadenaurl_a_array(file_get_contents("admin/usuariosSerialized.txt"));
    foreach($usuarios as $indice => $usuario) {
        if($usuario->getNombre() === $user->getNombre()) {
            $usuarios[$indice] = $user;
        }
    }
    file_put_contents("admin/usuariosSerialized.txt",array_a_cadenaurl($usuarios));

    // Actualizar la sesion actual
    $_SESSION["usuario"] = serialize($user);
}

foreach($misPokemons as $miPokemon) {
    if ($miPokemon->getNextEvo() !== "null") {
        $pokemonsCanEvolute++;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evolucionar</title>
    <link rel="stylesheet" href="styleUser.css">
</head>
<body>
<?= menuUsuario() ?>

<div class="battle">
    <div class="battle-form">
        <div class="info">
        <h4>Evolucionar un pokemon costará 1 token de evolución</h4>
        <h3>Tokens disponibles: <?=$numEvoluciones?></h4>
        <?php 
            if($numEvoluciones > 0 && $pokemonsCanEvolute !== 0) { ?>
        <form action="poke_evolucionar.php" method="post">
            <select name="pokeChosen">
                <?php
                foreach($misPokemons as $miPokemon) {
                    if ($miPokemon->getNextEvo() !== "null") {
                        echo "<option value='{$miPokemon->getNombre()}-{$miPokemon->getNextEvo()}'>{$miPokemon->getNombre()} 🡆 {$miPokemon->getNextEvo()}</option>";
                    }
                }
                ?>
            </select>
            <input type="submit" value="Evolucionar" name="evolucionar">
        </form>
            
        <?= $showEvolution ?>
    <?php 
        }
        if ($numEvoluciones === 0) {
            echo $showEvolution;
            echo "<h4>No tienes tokens de evolucion! Gana partidas para conseguir tokens!</h4>";
        }
        if ($pokemonsCanEvolute === 0) {
            echo $showEvolution;
            echo "<h4>No tienes ningún pokemon que pueda evolucionar! Juega partidas para conseguir pokemons nuevos!</h4>";
        }
    ?>
    </div>
</div>
</body>
</html>