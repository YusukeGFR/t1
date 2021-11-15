<?php

function imprimirMenu($correctLogin) {
    $menu = "
    <form action='registrarUsuario.php' method='post'>
        <input type='submit' value='Registrar Usuario' name='button1'>
        <input type='hidden' name='check' value='$correctLogin'>
    </form>

    <form action='altaPokemon.php' method='post'>
        <input type='submit' value='Alta Pokemon' name='button2'>
        <input type='hidden' name='check' value='$correctLogin'>
    </form>

    <form action='definirEvolucion.php' method='post'>
        <input type='submit' value='Definir Evolución' name='button3'>
        <input type='hidden' name='check' value='$correctLogin'>
    </form>

    <form action='verPokemons.php' method='post'>
        <input type='submit' value='Ver Pokemons' name='button4'>
        <input type='hidden' name='check' value='$correctLogin'>
    </form>";
    return $menu;
}

function soloLetras($in){
    if(preg_match('/^[a-zA-Z\s]+$/', $in)) return true;
    else return false;
}

function array_a_cadenaurl($array) {

    //Primero Transformamos el array en una cadena de texto
         $cadenatmp = serialize($array);
    //Codificamos dicha cadena en formato URL para enviar correctamente
    // los caracteres especiales
         $cadena = urlencode($cadenatmp);
    //devolvemos la cadena codificada
         return $cadena;
} 
function cadenaurl_a_array($texto) {
    // Esto lo hacemos por si está vacía la cadena no me cree un array
    // con una posición vacía
            $array = array();
            if($texto != "") {
    // Antes de descodificar hay que quitar cualquier \ contrabarra     
                $texto = stripslashes($texto);
    // Decodifico de formato URL a texto plano
                $texto = urldecode($texto);
    // Ahora a partir de la cadena genero un array
                $array = unserialize($texto);
            }
            return $array;   
}