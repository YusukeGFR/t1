<?php

include_once("funcionesApoyo.php");

$arrayUsuarios = [
    "Rosa" => "1234",
    "Carmen" => "1234",
    "Andrés" => "1234",
    "Jesus" => "1234",
    "Maria" => "1234",
    "Paco" => "1234",
    "Juan" => "1234",
];

$cadenaArray = array_a_cadenaurl($arrayUsuarios);

?>
<form action="ver_usuario.php" method="post">
    <input type="submit" value="VER">
    <input type="HIDDEN" name="usuarios" id="usarios" value="<?= $cadenaArray ?>" >
</form>