<?php
include_once('pokemon.php');
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
    </form>
    <form action='paginaPrincipal.php' method='post'>
        <input type='submit' value='Desconectar' name='button5'>
    </form>";
    return $menu;
}

function imprimirTablaPokemons($correctLogin,$pokemons) {
    $linea = "<table border='1'>
        <tr>
            <td>Nº</td>
            <td>Nombre</td>
            <td>Ataque</td>
            <td>Defensa</td>
            <td>Tipo</td>
            <td>Nivel</td>
            <td>Imagen</td>
            <td>Imagen de Victoria</td>
            <td>Imagen de Derrota</td>
            <td>Modificar Imágenes</td>
        </tr>
        <?php";
        $supported_file = ['gif','jpg','jpeg','png'];

        foreach ($pokemons as $indice => $pokeObj) {
            $dibujado = false;
            $nombrePoke = $pokeObj->getNombre();

            $linea .= "<tr>";

            $linea .= "<td>".($indice+1)."</td>";

            $linea .= "<td > 
                        ".ucfirst($nombrePoke)."
                       </td>";

            $linea .= "
                <td> <p>{$pokeObj->getAtaque()}</p> </td>
                <td> <p>{$pokeObj->getDefensa()}</p> </td>
                <td> <p><img src='images/{$pokeObj->getTipo1()}.png'>";
            
            if ($pokeObj->getTipo2() !== "null") {
                $linea .= "<img src='images/{$pokeObj->getTipo2()}.png'></p></td>";
            } else {
                $linea .= "</p></td>";
            }

            $linea .= " <td> <p> {$pokeObj->getNivel()}</p> </td>";

            $linea .= "<td >";
            foreach($supported_file as $indice2 => $ext) {
                if (file_exists("pokemons/{$nombrePoke}/{$nombrePoke}.{$ext}")) {
                    $dibujado = true;
                    $linea .= "<img src='pokemons/{$nombrePoke}/{$nombrePoke}.{$ext}' >";
                }
            }
            if(!$dibujado) {
                $linea .= "<img src='pokemons/default.png' width='100px'>";
            }



            $linea .= " </td>
                        <td >";
            $dibujado = false;
            foreach($supported_file as $indice2 => $ext) {
                
                if (file_exists("pokemons/{$nombrePoke}/{$nombrePoke}V.{$ext}")) {
                    $dibujado = true;
                    $linea .= "<img src='pokemons/{$nombrePoke}/{$nombrePoke}V.{$ext}' >";
                }
            }
            if(!$dibujado) {
                $linea .= "<img src='pokemons/default.png' width='100px'>";
            }



            $linea .= " </td>
                        <td>";
            $dibujado = false;
            foreach($supported_file as $indice2 => $ext) {
                if (file_exists("pokemons/{$nombrePoke}/{$nombrePoke}D.{$ext}")) {
                    $dibujado = true;
                    $linea .= "<img src='pokemons/{$nombrePoke}/{$nombrePoke}D.{$ext}' >";
                }
            }
            if(!$dibujado) {
                $linea .= "<img src='pokemons/default.png' width='100px'>";
            }


            $linea .= " </td>";
            
            
            
            $linea .= "<td> 
                <form action='actualizarImagen.php' method='post'>
                    <input type='submit' value='Modificar / Añadir' name='update' id='update'>
                    <input type='hidden' value='{$nombrePoke}' name='name'>
                    <input type='hidden' value='{$correctLogin}' name='check'>
                </form>
            </td>";


            $linea .= "</tr>";
            
        }
        echo $linea;
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