<?php
include_once("funciones.php");
include_once("pokemon.php");
include_once("usuario.php");
if(isset($_POST["check"])) {

    $correctLogin = $_POST["check"];
    $mensajeError = "";

    if(isset($_POST["define"])) {
        
        $pokemons = cadenaurl_a_array( file_get_contents("admin/pokemonsSerialized.txt") );
        $usuarios = cadenaurl_a_array( file_get_contents("admin/usuariosSerialized.txt") );
        $firstName = explode("-",$_POST["first"])[0];
        $firstLevel = explode("-",$_POST["first"])[1];
        $secondName = explode("-",$_POST["second"])[0];
        $secondLevel = explode("-",$_POST["second"])[1];

        $datos = [];
        $error = false;
        $content = file_get_contents("admin/pokemons.txt");
        $lines = explode("\n",$content);
        // unset($lines[count($lines)-1]);
        // echo "<pre>";
        // print_r($lines);
        // echo "</pre>";
        if ($firstLevel >= $secondLevel || $firstLevel+1 != $secondLevel) {
            $error = true;
        }
        for($i = 0; $i < count($lines); $i++) {
            $datos = explode("-",$lines[$i]);
            
            if ($datos[0] === $firstName) {
                $datos[6] = $secondName;
            }
            if ($datos[0] === $secondName) {
                $datos[5] = $firstName;
            }
            $lines[$i] = implode("-",$datos);
        }

        foreach ($pokemons as $indice => $pokeObj) {
            if ($pokeObj->getNombre() === $firstName ) {
                $pokeObj->setNextEvo($secondName);
            }

            if ($pokeObj->getNombre() === $secondName ) {
                $pokeObj->setPreEvo($firstName);
            }
        }

        foreach ($usuarios as $usuario) {

            $miEquipo = $usuario->getMiEquipo();
            $misPokemons = $usuario->getMisPokemons();

            foreach ($miEquipo as $pokemon) {
                if ($pokemon->getNombre() === $firstName ) {
                    $pokemon->setNextEvo($secondName);
                }
                if ($pokemon->getNombre() === $secondName ) {
                    $pokemon->setPreEvo($firstName);
                }
            }
            foreach ($misPokemons as $pokemon) {
                if ($pokemon->getNombre() === $firstName ) {
                    $pokemon->setNextEvo($secondName);
                }
                if ($pokemon->getNombre() === $secondName ) {
                    $pokemon->setPreEvo($firstName);
                }
            }

        }


        if ($error) {
            $mensajeError = "Error, vuelva a intentarlo.";
        } else {
            $aImprimir = implode("\n",$lines);
            file_put_contents("admin/pokemons.txt",$aImprimir);

            $fp = fopen("admin/pokemonsSerialized.txt","w");
            fwrite($fp,array_a_cadenaurl($pokemons));
            fclose($fp);

            $fp = fopen("admin/usuariosSerialized.txt","w");
            fwrite($fp,array_a_cadenaurl($usuarios));
            fclose($fp);

        }

    }


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
    <title>Definir Evolucion</title>
</head>
<body>
    <?= imprimirMenu($correctLogin) ?>
    <hr>
    <form action="definirEvolucion.php" method="post">
            <?php
                $hayDatos1 = false;
                $cadena = " <p>Defina la evolución de un pokemon</p>
                            <p><select name='first' id='first'>";
                $fp = fopen("admin/pokemons.txt","r");
                while (! feof($fp)) {
                    $datos = explode("-",fgets($fp));
                    if (count($datos) !== 1) {
                        $nombrePoke = $datos[0];
                        $nextEvo = $datos[6];
                        $nivel = $datos[7];
                        if ($nivel != 3 && $nombrePoke != "") {
                            $cadena .= "<option value='{$nombrePoke}-{$nivel}'>".ucfirst($nombrePoke)." - {$nivel}</option>";
                            $hayDatos1 = true;
                        }
                    }
                }
                fclose($fp);
                $cadena .= "</select>➞
                            <select name='second' id='second'>";
                $hayDatos2 = false;
                $fp = fopen("admin/pokemons.txt","r");
                while (! feof($fp)) {
                    $datos = explode("-",fgets($fp));
                    if (count($datos) !== 1) {
                        $nombrePoke = $datos[0];
                        $preEvo = $datos[5];
                        $nivel = $datos[7];
                        if ($nivel != 1 && $nombrePoke != "") {
                            $cadena .= "<option value='{$nombrePoke}-{$nivel}'>".ucfirst($nombrePoke)." - {$nivel}</option>";
                            $hayDatos2 = true;
                        }
                    }
                }
                fclose($fp);
                $cadena .= "</select> 
                            </p>
                            <input type='submit' value='Definir' name='define' id='define'>";
        
                if ($hayDatos1 && $hayDatos2) {
                    echo $cadena;
                } else {
                    echo "<p>No hay datos suficientes para definir una Evolución.</p>";
                }
            ?>
           
        
        <input type="hidden" name="check" id="check" value="<?= $correctLogin ?>">
        <p><?= $mensajeError ?></p>
    </form>
</body>
</html>