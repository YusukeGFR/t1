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
<<<<<<< HEAD
    <div class="form-container">
=======
    <h1>Login Admin</h1>
    <div class="form-container1">
>>>>>>> 0b4d10a2aa514d9a6987ce85bbce2981c46710fc
        <form action="checkAdmin.php" method="post">
            <p><?= $loginMessage ?></p>
            <p>Nombre</p>
            <input type="text" name="requestName" id="requestName">
            <p>Contraseña</p>
            <input type="password" name="requestPass" id="requestPass"> 
            <div> <input type="submit" value="Iniciar Sesión" name="check" id="check"></div>
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