<?php
function MostrarFormulario($cadenaDatos){
?>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
        Usuario <input type="text" name="usuario" id="usuario">
        Contraseña <input type="password" name="contraseña" id="contraseña">
        <input type="hidden" name="cadenaArray" id="cadenaArray" value="<?= $cadenaDatos ?>">
        <input type="submit">
    </form>
<?php
}
function MostrarDatos($cadenaDatos){
?>
    <form action="lista.php" method="POST">
        <input type="submit" value="Ver Usuarios">
        <input type="hidden" name="usuario" id="usuario" value="<?= $cadenaDatos ?>">
    </form>
<?php
}
function GenerarTablaUsuarios($arrayUsuarios){
$cadena="";
$cadena.="<table>";
$cadena.="<th>Usuarios</th><th>Password</th>";
foreach($arrayUsuarios as $usuario =>$password){
$cadena.="<tr><td>{$usuario}</td><td>{$password}</td><td>";
$cadena.=GenerarBotonBorrar($arrayUsuarios,$usuario);
$cadena.="</td><td>";
$cadena.=GenerarBotonActualizar($arrayUsuarios,$usuario);
$cadena.="</td></tr>";
}
$cadena.="</table>";
echo $cadena;
}
function GenerarBotonBorrar($arrayUsuarios, $usuario){
    $cadenaArray=array_a_cadenaurl($arrayUsuarios);
    $cadenaBoton = "";
    $cadenaBoton .= "
    <form action='{$_SERVER['PHP_SELF']}' method='POST'>
    <input type='image' width='30px' height='30px' name='borrar' id='borrar' src='delete.jpeg' alt='borrar'>
    <input type='hidden' name='usuario' id='usuario' value='$cadenaArray'>
    <input type='hidden' name='usuarioBorrar' id='usuarioBorrar' value='$usuario'>
    <input type='submit' name='submit' id='submit' value='Borrar'>
    </form>
";
    return $cadenaBoton;
}
function GenerarBotonActualizar($arrayUsuarios,$usuario){
    $cadenaArray=array_a_cadenaurl($arrayUsuarios);
    $cadenaBoton = "";
    $cadenaBoton .= "
    <form action='actualizar.php' method='POST'>
    <input type='image' width='30px' height='30px' name='actualizar' id='actualizar' src='edit.jpeg' alt='actualizar'>
    <input type='hidden' name='usuario' id='usuario' value='$cadenaArray'>
    <input type='hidden' name='usuarioActualizar' id='usuarioActualizar' value='$usuario'>
    </form>
";
    return $cadenaBoton;
}
