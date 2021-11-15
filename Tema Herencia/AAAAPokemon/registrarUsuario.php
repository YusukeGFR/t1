<?php
include_once("funciones.php");
include_once("usuario.php");
if(isset($_POST["check"])) {

    // $usuario1 = new usuario("nombre","123");

    $correctLogin = $_POST["check"];
    $error = "";
    $mensaje = "";
    if (isset($_POST["new"])) {

        $usuarios = [];
        $yaExiste = false;
        $errorDatos = false;
        $newUser = trim($_POST["newUser"])??"";
        $newPass = trim($_POST["newPass"])??"";

        $fp = fopen("admin/users.txt","r");
        $i = 0;
        while ($user = fscanf($fp,"%s\t%s")) {
            list($nombre, $contra) = $user;
            $usuario = new Usuario($nombre,$contra);
            $usuarios[$i] = $usuario;
            $i++;
        }
        fclose($fp);

        // echo "<pre>";
        // print_r($usuarios);
        // echo "</pre>";
        foreach($usuarios as $indice => $usuarioObj) {
            if ($usuarioObj->getNombre() === $newUser) {
                $yaExiste = true;
            }
        }

        if($newUser === "" || !soloLetras($newUser)) {
            $errorDatos = true;
        }

        if($yaExiste) {
            $error = "El usuario ya existe";
        } else if($errorDatos) {
            $error = "Datos incompletos";
        } else {
            $fp = fopen("admin/users.txt","a");
            fwrite($fp,"{$newUser}\t{$newPass}\n");
            fclose($fp);
            mkdir("users/{$newUser}",755);
            $fp = fopen("users/{$newUser}/.gitkeep","w");
            fclose($fp);
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
</head>
<body>
    <?= imprimirMenu($correctLogin) ?>
    <hr>
    <form action="registrarUsuario.php" method="post">
        <p>Nombre del nuevo usuario</p>
        <input type="text" name="newUser" id="newUser">
        <p>Contraseña del nuevo usuario</p>
        <input type="text" name="newPass" id="newPass">
        <input type="submit" value="Registar" name="new" id="new">
        <input type="hidden" name="check" id="check" value="<?= $correctLogin ?>">
        <p><?= $error ?></p>
        <p><?= $mensaje ?></p>
    </form>
</body>
</html>