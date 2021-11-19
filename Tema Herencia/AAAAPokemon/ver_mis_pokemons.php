<?php
include_once("funciones.php");
include_once("pokemon.php");
include_once("usuario.php");
comprobacion();
    $user = unserialize( $_SESSION["usuario"]);
    $misPokemons = $user->getMisPokemons();
    // echo "<pre>";
    // print_r($misPokemons);
    // echo "</pre>";

    $tabla = "<table border=1>
                <tr>";
    
    foreach($misPokemons as $indice => $pokemon) {
        $nombrePoke = $pokemon->getNombre();
            $supported_file = ['gif','jpg','jpeg','png'];
            $tabla .= " <td>
                            <p>".ucfirst( $nombrePoke )."</p>";
                            
            foreach($supported_file as $ext) {
                if (file_exists("pokemons/{$nombrePoke}/{$nombrePoke}.{$ext}")) {
                    $dibujado = true;
                    $tabla .= "<p><img src='pokemons/{$nombrePoke}/{$nombrePoke}.{$ext}' ></p>";
                }
            }
            if(!$dibujado) {
                $tabla .= "<p><img src='pokemons/default.png' width='100px'></p>";
            }

            $tabla .= "     <p>Ataque: {$pokemon->getAtaque()}</p>
                            <p>Defensa: {$pokemon->getDefensa()}</p>
                            <p>Tipos:<img src='images/{$pokemon->getTipo1()}.png'> ";
            if ($pokemon->getTipo2() !== "null") {
                $tabla .= "<img src='images/{$pokemon->getTipo2()}.png'>";
            }
            $tabla .=      "</p>
                            <p>Nivel: {$pokemon->getNivel()}</p>
                            <p>Evoluciona en: ";
            $pokemon->getNextEvo()=="null"? $tabla .= "Ninguno": $tabla.= ucfirst($pokemon->getNextEvo());
            $tabla .= "</p>";

            $tabla .= "</td>";
        if ($indice % 5 == 0 && $indice != 0) {
            $tabla .= "</tr></tr>";
        }
    }
    
    $tabla .= "     </tr>
                </table>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver mis pokemons</title>
</head>
<body>
    <?= menuUsuario() ?>
    <hr>
    <?= $tabla ?>
</body>
</html>