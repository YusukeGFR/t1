<?php
include_once("funciones.php");
if(isset($_POST["check"])) {

    $correctLogin = $_POST["check"];
    $error = "";
    if (isset($_POST["new"])) {

        $usuarios = [];
        $yaExiste = false;
        $newUser = $_POST["newUser"];
        $newPass = $_POST["newPass"];

        $fp = fopen("admin/users.txt","r");
        while ($admin = fscanf($fp,"%s\t%s")) {
            list($nombre, $contra) = $admin;
            $usuarios[$nombre] = $contra;
        }
        fclose($fp);

        foreach($usuarios as $currentUsuario => $currentPass) {
            if ($currentUsuario === $newUser) {
                $yaExiste = true;
            }
        }

        if($yaExiste) {
            $error = "El usuario ya existe";
        } else {
            $fp = fopen("admin/users.txt","a");
            fwrite($fp,"{$newUser}\t{$newPass}\n");
            fclose($fp);
            mkdir("users/{$newUser}");
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
    <title>Document</title>
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
    </form>
</body>
</html>