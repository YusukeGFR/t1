<?php

include_once("../EnvioDeArrays/funciones.php");

function MostrarFormulario(string $cadenaUsuario, int $numero=0){
?>
<form action="añadirUsuario.php" method="get">
    Usuario <input type="text" name="usuario" id="usuario"> <br>
    Contraseña <input type="text" name="contraseña" id="contraseña"> <br>
    <input type="submit" value="Añadir" name="anyadir" id="anyadir">
    <INPUT TYPE="HIDDEN" name="usuariosArray" id="usuariosArray" value="<?=$cadenaUsuario?>">
    <input type="submit" value="Ver" name="ver" id="ver">
</form>
<?php
}



function MostrarTabla($arrayUsuarios) {

    $cadena = "<table border='1'>
                <th>Nombre</th>
                <th>Pass</th>
                <th></th>
                <th></th>"; 
    foreach ($arrayUsuarios as $usu => $pass) {
        $cadena .= "<tr>
                    <td>{$usu}</td>
                    <td>{$pass}</td>
                    <td align='center'>";
        $cadena .= generarBotonBorrar($usu,$arrayUsuarios);
        $cadena .= "</td><td align='center'>";
        $cadena .= generarBotonActualizar($usu,$arrayUsuarios);
        $cadena .= "</td></tr>";
    }
    $cadena .= "</table>";
    echo $cadena;

}

function generarBotonBorrar(string $usuario, $arrayUsuarios) {
    $cadenaBorar="";
    $cadenaArray = array_a_cadenaurl($arrayUsuarios);
    $cadenaBorar .= '

    <form action='. $_SERVER["PHP_SELF"] .' method="post">
    <input type="submit" name="borrar" id="borrar" value="Borrar">
    <input type="HIDDEN" name="usuarios" id="usarios" value='.$cadenaArray.' >
    <input type="HIDDEN" name="usuarioBorrar" id="usuarioBorrar" value='.$usuario.' >
    </form>
    ';
    
    return $cadenaBorar;
}

function generarBotonActualizar(string $usuario, $arrayUsuarios) {
    $cadenaBorar="";
    $cadenaArray = array_a_cadenaurl($arrayUsuarios);
    $cadenaBorar .= '

    <form action="actualizar.php" method="post">
    <input type="submit" name="actualizar" id="actualizar" value="Update">
    <input type="HIDDEN" name="usuarios" id="usarios" value='.$cadenaArray.' >
    <input type="HIDDEN" name="usuarioActualizar" id="usuarioActualizar" value='.$usuario.' >
    </form>
    ';
    
    return $cadenaBorar;
}