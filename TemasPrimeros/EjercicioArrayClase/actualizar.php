<?php

include_once("funcionesApoyo.php");

if (isset($_POST["actualizar"])) {

    $cadenaArray = $_POST["usuarios"];
    $arrayUsuarios = cadenaurl_a_array($cadenaArray);
    $usuarioActualizar = $_POST["usuarioActualizar"];

?>
<p>Actualizando el usuario <?= $usuarioActualizar ?></p>
<form action="ver_usuario.php" method="post">
    Nombre <input type="text" name="usuario" id="usuario" value="<?= $usuarioActualizar ?>">
    Pass <input type="text" name="pass" id="pass" value="<?= $arrayUsuarios[$usuarioActualizar] ?>">
    <input type="submit" name="actualizar" id="actualizar" value="Actualizar">
    <input type="HIDDEN" name="usuarios" id="usarios" value="<?= $cadenaArray ?>" >
</form>

<?php
}else {
 
    header("location:ver.php");
}

?>