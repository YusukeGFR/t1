<?php
if(isset($_POST["check"])) {

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
</head>
<body>
    
<table>
    <tr>
        <td>Imagen</td>
        <td>Imagen de Victoria</td>
        <td>Imagen de Derrota</td>
        <td>Datos</td>
        <td>Modificar</td>
    </tr>
    <?php

        // foreach ($pokemons as $indice => $pokeObj) {

        //     echo "<tr>";
        //     echo "<td><img src"




        //     echo "</tr>";

        // }

    ?>




</table>

</body>
</html>