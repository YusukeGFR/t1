<?php
include_once("usuario.php");
include_once("funciones.php");
    $loginMessage = "Introduzca sus credenciales de usuario: ";
    $errorMessage = "";

if (isset($_POST["checkUser"])) {
    $user = $_POST["requestUser"];
    $pass = $_POST["requestPass"];
    $correct = false;

    $fp = fopen("admin/users.txt","r");
    while (! feof($fp)) {
        $line = trim(fgets($fp));
        $datos = explode("\t",$line);
        if ($datos[0] == $user && $datos[1] == $pass) {
            $correct = true;
        }
    }
    fclose($fp);

    if (!$correct) {
        $errorMessage = "Usuario o contraseña incorrectos";
    } else {
        $usuarios = cadenaurl_a_array(file_get_contents("admin/usuariosSerialized.txt"));
        foreach($usuarios as $indice => $usuario) {
            if($usuario->getNombre() == $user) {
                // echo "<pre>";
                // print_r($usuario);
                // echo "</pre>";
                session_start();
                $_SESSION["usuario"] = serialize($usuario);
                header("location:inicio_usuario.php");
            }
        }
        
    }
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="styleUser.css">
</head>
<body>
    <h1>Login Usuario</h1>
    <div class="form-container1">
        <form action="checkUser.php" method="post">
            <p><?= $loginMessage ?></p>
            <p>Nombre</p>
            <input type="text" name="requestUser" id="requestUser">
            <p>Contraseña</p>
            <input type="password" name="requestPass" id="requestPass">
            <div> <input type="submit" value="Iniciar Sesión" name="checkUser" id="checkUser"></div>
            <p id="error"><?= $errorMessage ?></p>
        </form>
        <form action="index.php" method="post">
<<<<<<< HEAD
            <input type="submit" value="Volver">
=======
            <div><input type="submit" value="Volver" name="volver"></div>
>>>>>>> 0b4d10a2aa514d9a6987ce85bbce2981c46710fc
        </form>
    </div>
</body>
</html>