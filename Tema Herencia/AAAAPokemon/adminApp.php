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
                array_push($pokemons,new pokemon($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6],$datos[7]));
            }
        }
    fclose($fp);

    file_put_contents("admin/pokemonsSerialized.txt",array_a_cadenaurl($pokemons));

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
    <title>Document</title>
</head>
<body>
    <?= imprimirMenu($correctLogin) ?>
</body>
</html>