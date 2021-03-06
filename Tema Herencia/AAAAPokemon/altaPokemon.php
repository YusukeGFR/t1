<?php
include_once("funciones.php");
include_once("pokemon.php");
if(isset($_POST["check"])) {

    $correctLogin = $_POST["check"];
    $error = "";
    $mensaje = "";

    if (isset($_POST["new"])) {

        $pokemons = cadenaurl_a_array( file_get_contents("admin/pokemonsSerialized.txt") );
        $errorDatos = false;
        $nombre = $_POST["nombre"]??"";
        $nombre = trim($nombre);
        $ataque = $_POST["ataque"];
        $defensa = $_POST["defensa"];
        $tipo1 = $_POST["tipo1"];
        $tipo2 = $_POST["tipo2"];
        $nivel = $_POST["level"];

        // echo "<pre>";
        // echo print_r($pokemons);
        // echo "</pre>";

        foreach($pokemons as $indice => $pokeObj) {
            if ($pokeObj->getNombre() === $nombre) {
                $errorDatos = true;
            }
        }

        if ($nombre === "" || !soloLetras($nombre)) {
            $errorDatos = true;
        }

        if ($tipo1 === $tipo2) {
            $errorDatos = true;
        }

        if (!ctype_digit($ataque) || !ctype_digit($defensa)) {
            $errorDatos = true;
        }

        if ($errorDatos) {
            $error = "Ha ocurrido un error, el pokemon no se añadirá.";
        }else{
            $fp = fopen("admin/pokemons.txt","a");
            fwrite($fp,"{$nombre}-{$ataque}-{$defensa}-{$tipo1}-{$tipo2}-null-{$nivel}\n");
            fclose($fp);
            mkdir("pokemons/$nombre",755);
            $fp = fopen("pokemons/{$nombre}/.gitkeep","w");
            fclose($fp);
            $mensaje = "Pokemon dado de alta correctamente.";
            array_push($pokemons,new pokemon($nombre,$ataque,$defensa,$tipo1,$tipo2,"null",$nivel));
            $fp = fopen("admin/pokemonsSerialized.txt","w");
            fwrite($fp,array_a_cadenaurl($pokemons));
            fclose($fp);
        }
    }

} else {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Pokemon</title>
    <link rel="stylesheet" href="styleAdmin.css">
</head>
<body>
    <?= imprimirMenu($correctLogin) ?>
    <div class="form-container">
    <form action="altaPokemon.php" method="post">
        <p>Nombre del nuevo pokemon</p>
        <input type="text" name="nombre" id="nombre">
        <p>
            Ataque 
            <input type="number" name="ataque" id="ataque"><br> <br>
            Defensa 
            <input type="number" name="defensa" id="defensa"><br>
        </p>
        <p>Seleccion de Tipos</p>
        <p>
            Principal:
            <select name="tipo1" id="tipo1">
            <?php 
                $tipos = ["acero","agua","bicho","dragon","electrico","fantasma","fuego","hada","hielo","lucha","normal","planta","psiquico","roca","siniestro","tierra","veneno","volador"];
                foreach ($tipos as $tipo) {
                    echo "<option value='{$tipo}'>".ucfirst($tipo)."</option>";
                }
            ?>
            </select>
            Secundario:
            <select name="tipo2" id="tipo2">
            <?php 
                array_push($tipos,"");
                foreach ($tipos as $tipo) {
                    if ($tipo != "") {
                        echo "<option value='{$tipo}'>".ucfirst($tipo)."</option>";
                    } else {
                        echo "<option value='null' selected>".ucfirst($tipo)."</option>";
                    }
                    
                }
            ?>
            </select>
        </p>
        <p>Nivel de la etapa evolutiva</p>
        <p> 1<input type="radio" name="level" id="one" value="1" checked> 2<input type="radio" name="level" id="two" value="2"> 3<input type="radio" name="level" id="three" value="3"></p>
        <input type="submit" value="Registar" name="new" id="new">
        <input type="hidden" name="check" id="check" value="<?= $correctLogin ?>">
        <p id="error"><?= $error ?></p>
        <p id="notice"><?= $mensaje ?></p>
    </form>
    </div>
</body>
</html>