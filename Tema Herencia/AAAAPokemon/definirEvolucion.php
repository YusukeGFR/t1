<?php
include_once("funciones.php");
include_once("pokemon.php");
include_once("usuario.php");
if(isset($_POST["check"])) {

    $correctLogin = $_POST["check"];
    $mensaje = "";

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

        // Bucle para asignar al pokemon seleccionado le evolución seleccionada en el fichero
        for($i = 0; $i < count($lines); $i++) {
            $datos = explode("-",$lines[$i]);
            if (count($datos) > 1) {
                if ($datos[5] === $secondName) {
                    $datos[5] = "null";
                }
                if ($datos[0] === $firstName) {
                    $datos[5] = $secondName;
                }
            }
            $lines[$i] = implode("-",$datos);
        }

        // Bucle para asignar al pokemon seleccionado le evolución seleccionada en el serialized
        foreach ($pokemons as $indice => $pokeObj) {
            if ($pokeObj->getNextEvo() === $secondName) {
                $pokeObj->setNextEvo("null");
            }
            if ($pokeObj->getNombre() === $firstName ) {
                $pokeObj->setNextEvo($secondName);
            }
        }

        foreach ($usuarios as $usuario) {
            $miEquipo = $usuario->getMiEquipo();
            $misPokemons = $usuario->getMisPokemons();
            foreach ($miEquipo as $pokemon) {
                if ($pokemon->getNextEvo() === $secondName) {
                    $pokemon->setNextEvo("null");
                }
                if ($pokemon->getNombre() === $firstName ) {
                    $pokemon->setNextEvo($secondName);
                }
            }
            foreach ($misPokemons as $pokemon) {
                if ($pokemon->getNextEvo() === $secondName) {
                    $pokemon->setNextEvo("null");
                }
                if ($pokemon->getNombre() === $firstName ) {
                    $pokemon->setNextEvo($secondName);
                }
            }
        }


        if ($error) {
            $mensaje = "Error, vuelva a intentarlo.";
        } else {
            $aImprimir = implode("\n",$lines);
            file_put_contents("admin/pokemons.txt",$aImprimir);

            $fp = fopen("admin/pokemonsSerialized.txt","w");
            fwrite($fp,array_a_cadenaurl($pokemons));
            fclose($fp);

            $fp = fopen("admin/usuariosSerialized.txt","w");
            fwrite($fp,array_a_cadenaurl($usuarios));
            fclose($fp);

            $mensaje = "Ahora ".ucfirst($firstName)." evolucionará a ".ucfirst($secondName).".<br> 
            <p id='small_Notice'>Aquellos pokemons que préviamente evolucionasen a ".ucfirst($secondName)." 
            ya no evolucionarán a este.</p>";
            
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
    <title>Definir Evolucion</title>
    <link rel="stylesheet" href="styleAdmin.css">
</head>
<body>
    <?= imprimirMenu($correctLogin) ?>
    <div class="form-container">
    <form action="definirEvolucion.php" method="post">
            <?php
                $hayDatos1 = false;
                $cadena = " <p id='notice'>Defina la evolución de un pokemon</p>
                            <p id='notice'> <select name='first' id='first'>";
                $fp = fopen("admin/pokemons.txt","r");
                while (! feof($fp)) {
                    $datos = explode("-",fgets($fp));
                    if (count($datos) !== 1) {
                        $nombrePoke = $datos[0];
                        $nivel = $datos[6];
                        if ($nivel != 3 && $nombrePoke != "") {
                            $cadena .= "<option value='{$nombrePoke}-{$nivel}'>".ucfirst($nombrePoke)." - {$nivel}</option>";
                            $hayDatos1 = true;
                        }
                    }
                }
                fclose($fp);
                $cadena .= "</select> evoluciona a 
                            <select name='second' id='second'>";
                $hayDatos2 = false;
                $fp = fopen("admin/pokemons.txt","r");
                while (! feof($fp)) {
                    $datos = explode("-",fgets($fp));
                    if (count($datos) !== 1) {
                        $nombrePoke = $datos[0];
                        $nivel = $datos[6];
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
        <p id='notice'><?= $mensaje ?></p>
    </form>
    </div>
</body>
</html>