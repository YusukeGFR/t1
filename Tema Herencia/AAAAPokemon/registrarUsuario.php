<?php
include_once("funciones.php");
include_once("usuario.php");
include_once("pokemon.php");
if(isset($_POST["check"])) {

    // $usuario1 = new usuario("nombre","123");

    $correctLogin = $_POST["check"];
    $error = "";
    $mensaje = "";
    if (isset($_POST["new"])) {

        $pokemons = cadenaurl_a_array(file_get_contents("admin/pokemonsSerialized.txt"));
        $yaExiste = false;
        $errorDatos = false;
        $newUser = trim($_POST["newUser"])??"";
        $newPass = trim($_POST["newPass"])??"";

        // Comprobar si el fichero existe, si es así se deserializa la información, sinó se lee el fichero
        $usuarios = [];
        if (file_exists("admin/usuariosSerialized.txt")) {
            $usuarios = cadenaurl_a_array(file_get_contents("admin/usuariosSerialized.txt"));
        } else {
            $fp = fopen("admin/users.txt","r");
            $i = 0;
            while ($user = fscanf($fp,"%s\t%s")) {
                list($nombre, $contra) = $user;
                $usuario = new Usuario($nombre,$contra);
                $usuarios[$i] = $usuario;
                $i++;
            }
            fclose($fp);
        }

        foreach($usuarios as $indice => $usuarioObj) {
            if ( strtolower($usuarioObj->getNombre()) === strtolower($newUser)) {
                $yaExiste = true;
            }
        }

        if($newUser === "" || !soloLetras($newUser)) {
            $errorDatos = true;
        }

        if($yaExiste) {
            $error = "El usuario ya existe";
        } else if($errorDatos) {
            $error = "Datos incompletos o erróneos";
        } else {
            $fp = fopen("admin/users.txt","a");
            fwrite($fp,"{$newUser}\t{$newPass}\n");
            fclose($fp);
            mkdir("users/{$newUser}",755);


            $usuarioNuevo = new Usuario($newUser,$newPass);

            $numerosRand = [];
            for($i=0; $i < 3; $i++) {
                do {
                    $numRand = rand(0,count($pokemons)-1);
                } while(in_array($numRand,$numerosRand) || $pokemons[$numRand]->getNivel() != 1);
                array_push($numerosRand,$numRand);
            }

            $equipoPrueba = [];
            $userPokemons = fopen("users/{$newUser}/pokemons_usuario.txt","a+");
            $userTeam = fopen("users/{$newUser}/equipo_usuario.txt","a+");
            foreach($numerosRand as $indice => $rand) {
                foreach($pokemons as $indice => $pokeObj) {
                    if($indice == $rand) {
                        array_push($equipoPrueba,$pokeObj);
                        $usuarioNuevo->setMiEquipo($equipoPrueba);
                        $usuarioNuevo->setMisPokemons($equipoPrueba);
                        fwrite($userPokemons, $pokeObj->getNombre()."\n" );
                        fwrite($userTeam, $pokeObj->getNombre()."\n" );
                    }
                }
            }
            fclose($userPokemons);
            fclose($userTeam);

            $usuarioNuevo->setTotales(0);
            $usuarioNuevo->setGanadas(0);
            $usuarioNuevo->setPokeEvoluciones(0);

            $fp = fopen("users/{$newUser}/partidas.txt","a+");
            fwrite($fp,"0 0 0");

            // echo "<pre>";
            // print_r($usuarioNuevo);
            // echo "</pre>";

            array_push($usuarios,$usuarioNuevo);
            file_put_contents("admin/usuariosSerialized.txt",array_a_cadenaurl($usuarios));
            $mensaje = "Usuario registrado correctamente.";
            
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
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="styleAdmin.css">
</head>
<body>
    <?= imprimirMenu($correctLogin) ?>
    <div class="form-container">
    <form action="registrarUsuario.php" method="post">
        <p>Nombre del nuevo usuario</p>
        <input type="text" name="newUser" id="newUser">
        <p>Contraseña del nuevo usuario</p>
        <input type="text" name="newPass" id="newPass"> <br>
        <input type="submit" value="Registar" name="new" id="new">
        <input type="hidden" name="check" id="check" value="<?= $correctLogin ?>">
        <p id="error"><?= $error ?></p>
        <p id="notice"><?= $mensaje ?></p>
    </form>
    </div>
</body>
</html>