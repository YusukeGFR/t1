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
        <td>Nombre</td>
        <td>Imagen</td>
        <td>Imagen de Victoria</td>
        <td>Imagen de Derrota</td>
        <td>Datos</td>
        <td>Modificar</td>
    </tr>
    <?php
        $linea = "";
        $supported_file = ['gif','jpg','jpeg','png'];

        foreach ($pokemons as $indice => $pokeObj) {
            $dibujado = false;
            $nombrePoke = $pokeObj->getNombre();

            $linea = "<tr>";

            $linea .= "<td width='100px' height='100px'> 
                        ".ucfirst($nombrePoke)."
                       </td>";

            $linea .= "<td width='100px' height='100px'>";
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
                        <td width='100px' height='100px'>";
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
                        <td width='100px' height='100px'>";
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


            $linea .= " </td>
                        <td>";
            
            $linea .= " <p>Ataque: {$pokeObj->getAtaque()}</p>
                        <p>Defensa: {$pokeObj->getDefensa()}</p>
                        <p>Tipo: <img src='images/{$pokeObj->getTipo1()}.png'>";
                        
                        if ($pokeObj->getTipo2() !== "null") {
                            $linea .= "<img src='images/{$pokeObj->getTipo2()}.png'></p>";
                        } else {
                            $linea .= "</p>";
                        }
            $linea .= " <p>Nivel: {$pokeObj->getNivel()}</p>";
            


            $linea .= "</td>
                        </tr>";
            echo $linea;
        }

    ?>




</table>

</body>
</html>