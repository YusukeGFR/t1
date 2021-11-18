<?php
include_once("funciones.php");
include_once("pokemon.php");
if (isset($_POST["user"])) {

    $user = $_POST["user"];
    $pokemons = cadenaurl_a_array( file_get_contents("admin/pokemonsSerialized.txt") );

    $ficheroPokes = fopen("users/{$user}/pokemons_usuario.txt","r");
    $columna = 1;

    $tabla = "<table border=1>
                <tr>";
    while (! feof($ficheroPokes)) {
        $pokemon = fgets($ficheroPokes);
        $pokemon = substr($pokemon,0,strlen($pokemon)-1);
        if (strlen($pokemon) > 0) {
            foreach($pokemons as $indice => $pokeObj) {
                $nomPokeObj = $pokeObj->getNombre();
                if($pokemon == $nomPokeObj ) {
                    $supported_file = ['gif','jpg','jpeg','png'];
                    $tabla .= " <td>
                                    <p>".ucfirst( $nomPokeObj )."</p>";
                                    
                    foreach($supported_file as $indice2 => $ext) {
                        if (file_exists("pokemons/{$nomPokeObj}/{$nomPokeObj}.{$ext}")) {
                            $dibujado = true;
                            $tabla .= "<p><img src='pokemons/{$nomPokeObj}/{$nomPokeObj}.{$ext}' ></p>";
                        }
                    }
                    if(!$dibujado) {
                        $tabla .= "<p><img src='pokemons/default.png' width='100px'></p>";
                    }
    
                    $tabla .= "     <p>Ataque: {$pokeObj->getAtaque()}</p>
                                    <p>Defensa: {$pokeObj->getDefensa()}</p>
                                    <p>Tipos:<img src='images/{$pokeObj->getTipo1()}.png'> ";
                    if ($pokeObj->getTipo2() !== "null") {
                        $tabla .= "<img src='images/{$pokeObj->getTipo2()}.png'>";
                    }
                    $tabla .=      "</p>
                                    <p>Nivel: {$pokeObj->getNivel()}</p>
                                    <p>Evoluciona en: ";
                    $pokeObj->getNextEvo()=="null"? $tabla .= "Ninguno": $tabla.= ucfirst($pokeObj->getNextEvo());
                    $tabla .= "</p>";
    
                    $tabla .= "</td>";
                }
            }
        }
        if ($columna % 5 == 0) {
            $tabla .= "</tr></tr>";
        }
        $columna++;
    }
    $tabla .= "     </tr>
                </table>";

} else {
    header("location:checkUser.php");
}


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
    <?= menuUsuario($user) ?>
    <hr>
    <?= $tabla ?>
</body>
</html>