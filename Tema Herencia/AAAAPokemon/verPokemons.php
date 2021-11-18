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
</head>
<body>
<?= imprimirMenu($correctLogin) ?>
    <hr>
<table border="1">
    <tr>
        <td>Nº</td>
        <td>Nombre</td>
        <td>Ataque</td>
        <td>Defensa</td>
        <td>Tipo</td>
        <td>Nivel</td>
        <td>Imagen</td>
        <td>Imagen de Victoria</td>
        <td>Imagen de Derrota</td>
        <td>Modificar Imágenes</td>
    </tr>
    <?php
        $linea = "";
        $supported_file = ['gif','jpg','jpeg','png'];

        foreach ($pokemons as $indice => $pokeObj) {
            $dibujado = false;
            $nombrePoke = $pokeObj->getNombre();

            $linea = "<tr>";

            $linea .= "<td> {$indice}</td>";

            $linea .= "<td > 
                        ".ucfirst($nombrePoke)."
                       </td>";

            $linea .= "
                <td> <p>{$pokeObj->getAtaque()}</p> </td>
                <td> <p>{$pokeObj->getDefensa()}</p> </td>
                <td> <p><img src='images/{$pokeObj->getTipo1()}.png'>";
            
            if ($pokeObj->getTipo2() !== "null") {
                $linea .= "<img src='images/{$pokeObj->getTipo2()}.png'></p></td>";
            } else {
                $linea .= "</p></td>";
            }

            $linea .= " <td> <p> {$pokeObj->getNivel()}</p> </td>";

            $linea .= "<td >";
            foreach($supported_file as $indice2 => $ext) {
                if (file_exists("pokemons/{$nombrePoke}/{$nombrePoke}.{$ext}")) {
                    $dibujado = true;
                    $linea .= "<img src='pokemons/{$nombrePoke}/{$nombrePoke}.{$ext}' >";
                }
            }
            if(!$dibujado) {
                $linea .= "<img src='pokemons/default.png' width='100px'>";
            }



            $linea .= " </td>
                        <td >";
            $dibujado = false;
            foreach($supported_file as $indice2 => $ext) {
                
                if (file_exists("pokemons/{$nombrePoke}/{$nombrePoke}V.{$ext}")) {
                    $dibujado = true;
                    $linea .= "<img src='pokemons/{$nombrePoke}/{$nombrePoke}V.{$ext}' >";
                }
            }
            if(!$dibujado) {
                $linea .= "<img src='pokemons/default.png' width='100px'>";
            }



            $linea .= " </td>
                        <td>";
            $dibujado = false;
            foreach($supported_file as $indice2 => $ext) {
                if (file_exists("pokemons/{$nombrePoke}/{$nombrePoke}D.{$ext}")) {
                    $dibujado = true;
                    $linea .= "<img src='pokemons/{$nombrePoke}/{$nombrePoke}D.{$ext}' >";
                }
            }
            if(!$dibujado) {
                $linea .= "<img src='pokemons/default.png' width='100px'>";
            }


            $linea .= " </td>";
            
            
            
            $linea .= "<td> 
                <form action='actualizarImagen.php' method='post'>
                    <input type='submit' value='Modificar / Añadir' name='update' id='update'>
                    <input type='hidden' value='{$nombrePoke}' name='name'>
                    <input type='hidden' value='{$correctLogin}' name='check'>
                </form>
            </td>";


            $linea .= "</tr>";
            echo $linea;
        }

    ?>




</table>

</body>
</html>