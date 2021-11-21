<?php
include_once("funciones.php");
include_once("pokemon.php");
if(isset($_POST["check"])) {

    $correctLogin = $_POST["check"];
    $pokemons = cadenaurl_a_array( file_get_contents("admin/pokemonsSerialized.txt") );



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
    <title>Ver Pokemons</title>
    <link rel="stylesheet" href="styleAdmin.css">
</head>
<body>
    <?= imprimirMenu($correctLogin) ?>
    
    <div id="table_Pokemons">
        <?= imprimirTablaPokemons($correctLogin,$pokemons)?>
    </div>



</table>

</body>
</html>