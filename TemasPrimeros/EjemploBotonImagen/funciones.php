<?php

function array_a_cadenaurl($array) {

//Primero Transformamos el array en una cadena de texto
     $cadenatmp = serialize($array);
//Codificamos dicha cadena en formato URL para enviar correctamente
// los caracteres especiales
     $cadena = urlencode($cadenatmp);
//devolvemos la cadena codificada
     return $cadena;
}
//Esta función recibe una cadena y devuelve un array
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
?>