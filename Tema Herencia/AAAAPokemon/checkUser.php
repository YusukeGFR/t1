<?php
if (isset($_POST["botonUsuario"])) {

    $loginMessage = "Introduzca sus credenciales de usuario: ";
    $errorMessage = "";

} else if (isset($_GET["error"])) {

    $loginMessage = "Introduzca sus credenciales de usuario: ";
    $errorMessage = $_GET["error"];

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
    <title>User Login</title>
</head>
<body>
    <form action="inicio_usuario.php" method="post">
        <p><?= $loginMessage ?></p>
        <p>Nombre</p>
        <input type="text" name="requestUser" id="requestUser">
        <p>Contraseña</p>
        <input type="password" name="requestPass" id="requestPass">
        <input type="submit" value="Iniciar Sesión" name="checkUser" id="checkUser">
        <p><?= $errorMessage ?></p>
    </form>
</body>
</html>