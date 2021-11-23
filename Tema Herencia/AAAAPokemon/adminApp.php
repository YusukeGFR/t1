<?php
include_once("funciones.php");
include_once("pokemon.php");
$url = explode("/",$_SERVER['HTTP_REFERER']);
$last = $url[count($url)-1];

if ($last === "checkAdmin.php") {

    $correctLogin = true;
    $pokemons = [];

    $fp = fopen("admin/pokemons.txt","r");
        while (! feof($fp)) {
            $line = fgets($fp);
            $datos = explode("-",$line);
            if (count($datos) > 1) {
                array_push($pokemons,new pokemon($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6]));
            }
        }
    fclose($fp);

    file_put_contents("admin/pokemonsSerialized.txt",array_a_cadenaurl($pokemons));

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
    <title>Admin Side</title>
    <link rel="stylesheet" href="styleAdmin.css">
</head>
<body>
    <?= imprimirMenu($correctLogin) ?>

    <div id="explicacion"> 
        <h2>Explicación</h2> 
        <h3 class="explanation_title">Registrar Usuario</h3>
        <p class="explanation_text">
            -En esta sección se registran los usuarios, donde cada uno tiene su nick, el cual no se puede repetir. <br>
            -Estos usuarios empiezan con 3 pokemons de nivel aleatorios, los cuales pasarán a formar parte de su equipo al solo tener 3.
        </p>
        <h3 class="explanation_title">Alta Pokemon</h3>
        <p class="explanation_text">
            -En esta sección se dan de alta los pokemons, cada uno se identifica con su nombre. <br>
            -Cada pokemon tiene su valor de ataque y defensa, así como su/s tipo/s y su nivel en la etapa evolutiva.
        </p>
        <h3 class="explanation_title">Definir Evolución</h3>
        <p class="explanation_text">
            -En esta sección se definen las evoluciones de los pokemons. <br>
            -Solo un pokemon puede ser la evolución de otro.
        </p>
        <h3 class="explanation_title">Ver Pokemons</h3>
        <p class="explanation_text">
            -En esta sección se muestran todos los pokemons, así como poder cambiar las imágenes de estos, estableciendo cualquiera de las 3 independientemente del resto.
        </p>
    </div>
</body>
</html>