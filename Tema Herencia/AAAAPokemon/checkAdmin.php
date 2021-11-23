<?php

if (isset($_POST["botonAdmin"])) {

    $loginMessage = "Introduzca las credenciales del administrador";
    $errorMessage = "";

} else if(isset($_POST["check"])) {
    
    $requestName = $_POST["requestName"];
    $requestPass = $_POST["requestPass"];
    $auth = false;

    $fp = fopen("admin/admin.txt","r");
    while ($admin = fscanf($fp,"%s\t%s")) {
        list($nombre, $contra) = $admin;
        if ($nombre === $requestName && $contra === $requestPass) {
            $auth = true;
        }
    }

    if ($auth) {
        header("location:adminApp.php");
    } else {
        $errorMessage = "Datos erróneos";
        $loginMessage = "Introduzca las credenciales del administrador";
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
    <title>Login Admin</title>
    <link rel="stylesheet" href="styleAdmin.css">
</head>
<body>
    <div class="form-container">
        <form action="checkAdmin.php" method="post">
            <p><?= $loginMessage ?></p>
            <p>Nombre</p>
            <input type="text" name="requestName" id="requestName">
            <p>Contraseña</p>
            <input type="password" name="requestPass" id="requestPass"> <br>
            <input type="submit" value="Iniciar Sesión" name="check" id="check">
            <p id="error"><?= $errorMessage ?></p>
        </form>
        <form action="index.php" method="post">
            <input type="submit" value="Volver">
        </form>
    </div>
</body>
</html>