<?php
include_once("funciones.php");
include_once("pokemon.php");
include_once("usuario.php");
comprobacion();
$user = unserialize( $_SESSION["usuario"]);
$usuarios = cadenaurl_a_array(file_get_contents("admin/usuariosSerialized.txt"));
$cada10Jugadas ="";
$cada10Ganadas ="";
$cabezeraEnfrentamiento = "";
$matchResult = "";
$estadoActualUser = "";
$rondas = [];


if (isset($_POST["combatir"])) {

    $rivalChosen = $_POST["rival"];
    $equipoMio = $user->getMiEquipo();
    $supported_file = ['gif','jpg','jpeg','png'];
    $dibujado = false;
    $enfrentamientos = "";

    // Definir cual es el equipo del rival
    if ($rivalChosen === "aleatorio") {
        do {
            $rand = rand(0,count($usuarios)-1);
        } while($usuarios[$rand]->getNombre() === $user->getNombre());
        $equipoRival = $usuarios[$rand]->getMiEquipo();
        $rivalChosen = $usuarios[$rand]->getNombre();
    } else {
        foreach ($usuarios as $usuario) {
            if ($usuario->getNombre() === $rivalChosen) {
                $equipoRival = $usuario->getMiEquipo();
            }
        }
    }

    $cabezeraEnfrentamiento = "{$user->getNombre()}  VS  {$rivalChosen}";

    // echo "<pre>";
    // print_r($equipoMio[2]->getAtaque()+$equipoMio[2]->getDefensa());
    // echo "</pre>";
    $rondas = [];
    $rondasGanadas = 0;

    for ($i = 0; $i < 3; $i++) {
        $tipo1Mio = $equipoMio[$i]->getTipo1();
        $tipo2Mio = $equipoMio[$i]->getTipo2();
        $tipo1Rival = $equipoRival[$i]->getTipo1();
        $tipo2Rival = $equipoRival[$i]->getTipo2();
        $miRandom = rand(1,20);
        $rivalRandom = rand(1,20);
        $miBonusTipo = clash($tipo1Mio,$tipo2Mio,$tipo1Rival,$tipo2Rival);
        $rivalBonusTipo = clash($tipo1Rival,$tipo2Rival,$tipo1Mio,$tipo2Mio);
        
        // El valor de combate de mi pokemon
        $valorTotalMio = $equipoMio[$i]->getAtaque() + $equipoMio[$i]->getDefensa() + $miRandom;
        $valorTotalMio *= $miBonusTipo;

        // El valor de combate de su pokemon
        $valorTotalRival = $equipoRival[$i]->getAtaque() + $equipoRival[$i]->getDefensa() + $rivalRandom;
        $valorTotalRival *= $rivalBonusTipo;

        // Variables del resultado del enfrentamiento
        if ($valorTotalMio > $valorTotalRival) {
            $resultado = "ganado";
            $imagenMia = "V";
            $imagenRival = "D";
            $rondasGanadas++;
        } else {
            $resultado = "perdido";
            $imagenMia = "D";
            $imagenRival = "V";
        }
        // Header resultado enfrentamiento
        $enfrentamientos = "Combate ".($i+1)." tu pokemon ha {$resultado}!";

        // Mis datos
        $tusDatos = "";
        $dibujado = false;
        foreach($supported_file as $ext) {
            if (file_exists("pokemons/{$equipoMio[$i]->getNombre()}/{$equipoMio[$i]->getNombre()}.{$ext}") && !$dibujado) {
                $dibujado = true;
                $tusDatos .= "<p><img src='pokemons/{$equipoMio[$i]->getNombre()}/{$equipoMio[$i]->getNombre()}{$imagenMia}.{$ext}' ></p>";
            }
        }
        if(!$dibujado) {
            $tusDatos .= "<p><img src='pokemons/default{$imagenMia}.png' width='100px'></p>";
        }
        
        $tusDatos .= "<p>Aleatorio ({$miRandom}) + Ataque ({$equipoMio[$i]->getAtaque()}) + Defensa ({$equipoMio[$i]->getDefensa()}) </p>";
        $tusDatos .= "<p>Bonus Tipos: x{$miBonusTipo}</p>";
        $tusDatos .= "<p>Valor de Combate: ".floor($valorTotalMio)."</p>";

        // Datos Rival
        $rivalDatos = "";
        $dibujado = false;
        foreach($supported_file as $ext) {
            if (file_exists("pokemons/{$equipoRival[$i]->getNombre()}/{$equipoRival[$i]->getNombre()}.{$ext}") && !$dibujado) {
                $dibujado = true;
                $rivalDatos .= "<p><img src='pokemons/{$equipoRival[$i]->getNombre()}/{$equipoRival[$i]->getNombre()}{$imagenRival}.{$ext}' ></p>";
            }
        }
        if(!$dibujado) {
            $rivalDatos .= "<p><img src='pokemons/default{$imagenRival}.png' width='100px'></p>";
        }
        
        $rivalDatos .= "<p>Aleatorio ({$rivalRandom}) + Ataque ({$equipoRival[$i]->getAtaque()}) + Defensa ({$equipoRival[$i]->getDefensa()}) </p>";
        $rivalDatos .= "<p>Bonus Tipos: x{$rivalBonusTipo}</p>";
        $rivalDatos .= "<p>Valor de Combate: ".floor($valorTotalRival)."</p>";

        // Contruccion del html
        $ronda = "<h3>{$enfrentamientos}</h3>
                    <table border=1>
                    <tr>
                        <td>{$tusDatos}</td>
                        <td class='vs-image'> <img src='images/vs.png' width=100px> </td>
                        <td>{$rivalDatos}</td>
                    </tr>
                    </table>";

        // A??adir al array de rondas el resultado de la raonda actual
        array_push($rondas,$ronda);
    }

    // Aumentamos las partidas jugadas en 1 y, si se ha ganado, las ganadas en 1 tambien
    $user->setTotales(1);
    if ($rondasGanadas >= 2) {
        $matchResult = "Has ganado la partida!";
        $user->setGanadas(1);
    } else {
        $matchResult = "Has perdido la partida!";
    }

    // Cada 10 partidas ganadas se a??ade un token de evolucion al usuario
    if ($user->getGanadas() % 10 === 0 && $user->getGanadas() !== 0) {
        $user->setPokeEvoluciones(1);
        $cada10Ganadas = "Has obtenido un token de Evoluci??n para evolucionar uno de tus pokemons!";
    }

    // Cada 10 jugadas se le dar?? un pokemon de level 1 que no tenga
    if ($user->getTotales() % 10 === 0) {

        // Creo un array con todos los pokemons existentes
        $pokemons = cadenaurl_a_array( file_get_contents("admin/pokemonsSerialized.txt") );
        // Creo otro con los pokemons del usuario
        $misPokes = $user->getMisPokemons();

        // Y otro con los nombres de los pokemons del usuario
        $misPokesNombres = [];
        foreach($misPokes as $poke) {
            array_push($misPokesNombres,$poke->getNombre());
        }

        $pokesUno = [];
        foreach($pokemons as $indice => $pokemon) {
            if ($pokemon->getNivel() == 1 && in_array($pokemon->getNombre(),$misPokesNombres) == false) {
                array_push($pokesUno,$indice);
            }
        }

        if (count($pokesUno) != 0) {
            $rand = array_rand($pokesUno,1);
            $rand = $pokesUno[$rand];
        
            // Recorro el aray de usuarios para asignar al usuario actual el nuevo pokemon, aparte del usuario actual de session.
            foreach($usuarios as $indice => $usuario) {
                if($usuario->getNombre() === $user->getNombre()) {

                    // a??adimos el pokemons generado al array de los nuevos del usuario
                    array_push($misPokes,$pokemons[$rand]);
                    // Y se lo asignamos
                    $user->setMisPokemons($misPokes);
                    // Mostramos un mensaje
                    $cada10Jugadas = "<p>Has obtenido un pokemon nuevo! Su nombre es {$pokemons[$rand]->getNombre()}</p>";
                    $dibujado = false;
                    foreach($supported_file as $ext) {
                        if (file_exists("pokemons/{$pokemons[$rand]->getNombre()}/{$pokemons[$rand]->getNombre()}.{$ext}") && !$dibujado) {
                            $dibujado = true;
                            $cada10Jugadas .= "<p><img src='pokemons/{$pokemons[$rand]->getNombre()}/{$pokemons[$rand]->getNombre()}.{$ext}' ></p>";
                        }
                    }
                    if(!$dibujado) {
                        $cada10Jugadas .= "<p><img src='pokemons/default.png' width='100px'></p>";
                    }

                    // Actualizamos el usuario en el array de usuario y lo serializamos de nuevo.
                    $usuarios[$indice] = $user;
                    file_put_contents("admin/usuariosSerialized.txt",array_a_cadenaurl($usuarios));
                }
            }
        } else {
            $cada10Jugadas = "<p>Ya tienes todos los pokemons!</p>";
        }
    }

    $misPokes = $user->getMisPokemons();

    //Actualizamos el fichero de los pokemons del usuario
    $fp = fopen("users/{$user->getNombre()}/pokemons_usuario.txt","w");
    foreach($misPokes as $miPoke) {
        fwrite($fp,$miPoke->getNombre()."\n");
    }
    fclose($fp);


    // Actualizamos el fichero del usuario
    file_put_contents("users/{$user->getNombre()}/partidas.txt","{$user->getTotales()}-{$user->getGanadas()}-{$user->getPokeEvoluciones()}\n");

    // Informaci??n del usuario
    $estadoActualUser = "<--- Combates totales: {$user->getTotales()} --- Combates ganados: {$user->getGanadas()} --- Tokens de Evoluci??n: {$user->getPokeEvoluciones()} --->";
    // Actualizamos los datos del usuario que mandamos con SESSION
    $_SESSION["usuario"] = serialize($user);

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugar Partida</title>
    <link rel="stylesheet" href="styleUser.css">
</head>
<body>
<?= menuUsuario() ?>
    
<div class="battle">
    <div class="battle-form">
        <form action="jugar_partida.php" method="post">
            <p>Entrenador rival: 
                <select name="rival">
                    <option value="aleatorio">Aleatorio</option>
                <?php
                    foreach ($usuarios as $usuario) {
                        if ($usuario->getNombre() !== $user->getNombre()) {
                            echo "<option value='{$usuario->getNombre()}'>{$usuario->getNombre()}</option>";
                        }
                    }
                ?>
                </select> <br>
                <input type="submit" value="Combatir" name="combatir">
            </p> 
        </form>
    </div>
    <div class="battle-clash">
        <div id="resume"> 
            <h3><?= $matchResult ?></h3>
            
            <p><?= $cada10Jugadas ?></p> 
            
           
            <p> <?= $cada10Ganadas ?></p> 
            
            
            <p> <?= $estadoActualUser ?> </p> 
        </div>
        <hr>
        <br>
        <h2 id="match-title"><?= $cabezeraEnfrentamiento ?></h2>
        <br>
        <?php
            foreach($rondas as $ronda) {
                echo $ronda;
            }
        ?>
    </div>
</div>
</body>
</html>