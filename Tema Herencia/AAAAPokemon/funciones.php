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

function menuUsuario() {
    $menu = "
    <form action='ver_mis_pokemons.php' method='post'>
        <input type='submit' value='Ver mis Pokémons' name='button1'>
    </form>

    <form action='organizar_equipo.php' method='post'>
        <input type='submit' value='Organizar mi Equipo' name='button2'>
    </form>

    <form action='jugar_partida.php' method='post'>
        <input type='submit' value='Jugar Partida' name='button3'>
    </form>

    <form action='pokeevolucionar.php' method='post'>
        <input type='submit' value='Evolucionar un Pokémon' name='button4'>
    </form>
    <form action='paginaPrincipal.php' method='post'>
        <input type='submit' value='Desconectar' name='button5'>
    </form>";
    return $menu;
}

function comprobacion() {
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header("location:paginaPrincipal.php");
    }
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
            foreach($supported_file as $ext) {
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
            foreach($supported_file as $ext) {
                
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
            foreach($supported_file as $ext) {
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

function userPokes($pokemons) {
    
    $tabla = "<table border=1>
                <tr>";
    
    foreach($pokemons as $indice => $pokemon) {
        $nombrePoke = $pokemon->getNombre();
            $supported_file = ['gif','jpg','jpeg','png'];
            $tabla .= " <td>
                            <p>".ucfirst( $nombrePoke )."</p>";
                            
            foreach($supported_file as $ext) {
                if (file_exists("pokemons/{$nombrePoke}/{$nombrePoke}.{$ext}")) {
                    $dibujado = true;
                    $tabla .= "<p><img src='pokemons/{$nombrePoke}/{$nombrePoke}.{$ext}' ></p>";
                }
            }
            if(!$dibujado) {
                $tabla .= "<p><img src='pokemons/default.png' width='100px'></p>";
            }

            $tabla .= "     <p>Ataque: {$pokemon->getAtaque()}</p>
                            <p>Defensa: {$pokemon->getDefensa()}</p>
                            <p>Tipos:<img src='images/{$pokemon->getTipo1()}.png'> ";
            if ($pokemon->getTipo2() !== "null") {
                $tabla .= "<img src='images/{$pokemon->getTipo2()}.png'>";
            }
            $tabla .=      "</p>
                            <p>Nivel: {$pokemon->getNivel()}</p>
                            <p>Evoluciona en: ";
            $pokemon->getNextEvo()=="null"? $tabla .= "Ninguno": $tabla.= ucfirst($pokemon->getNextEvo());
            $tabla .= "</p>";

            $tabla .= "</td>";
        if ($indice % 5 == 0 && $indice != 0) {
            $tabla .= "</tr></tr>";
        }
    }
    
    $tabla .= "     </tr>
                </table>";
    return $tabla;
}

function desplegablesMisPokes($pokemons,$numero = 1,$pokesActuales) {

    $options = "<select name='pokemon{$numero}'>";
    foreach($pokemons as $indice => $pokemon) {
        $options .= "<option value='{$pokemon->getNombre()}'";
        foreach($pokesActuales as $indice2 => $pokeActual) {
            if($pokeActual->getNombre() === $pokemon->getNombre() && $numero-1 === $indice2) {
                $options .= " selected";
            }
        }
       $options .= ">{$pokemon->getNombre()}</option>";
    }
    $options .= "</select>";
    return $options;
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

function clash($tipo1Propio,$tipo2Propio,$tipo1Rival,$tipo2Rival){

    $multiplicador = 1.0;
    $misTipos = [$tipo1Propio,$tipo2Propio];
    $rivalTipos = [$tipo1Rival,$tipo2Rival];

    foreach($misTipos as $miTipo) {
        switch($miTipo) {
            case "acero": 
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador /= 2; break;
                        case "agua": $multiplicador /= 2; break;
                        case "electrico": $multiplicador /= 2; break;
                        case "fuego": $multiplicador /= 2; break;
                        case "hada": $multiplicador *= 2; break;
                        case "hielo": $multiplicador *= 2;  break;
                        case "roca": $multiplicador *= 2; break;
                        default: break;
                    }
                }
                break;
            case "agua": 
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "agua": $multiplicador /= 2; break;
                        case "dragon": $multiplicador /= 2; break;
                        case "fuego": $multiplicador *= 2; break;
                        case "planta": $multiplicador /= 2; break;
                        case "roca": $multiplicador *= 2; break;
                        case "tierra": $multiplicador *= 2; break;
                        default: break;
                    }
                }
                break;
            case "bicho":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador /= 2; break;
                        case "fantasma": $multiplicador /= 2; break;
                        case "fuego": $multiplicador /= 2; break;
                        case "hada": $multiplicador /= 2; break;
                        case "lucha": $multiplicador /= 2; break;
                        case "planta": $multiplicador *= 2; break;
                        case "psiquico": $multiplicador *= 2; break;
                        case "siniestro": $multiplicador *= 2; break;
                        case "veneno": $multiplicador /= 2; break;
                        case "volador": $multiplicador /= 2; break;
                        default: break;
                    }
                }
                break;
            case "dragon":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador /= 2; break;
                        case "dragon": $multiplicador *= 2; break;
                        case "hada": $multiplicador /= 4; break;
                        default: break;
                    }
                }
                break;
            case "electrico":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "agua": $multiplicador *= 2; break;
                        case "dragon": $multiplicador /= 2; break;
                        case "electrico": $multiplicador /= 2; break;
                        case "planta": $multiplicador /= 2; break;
                        case "tierra": $multiplicador /= 4; break;
                        case "volador": $multiplicador *= 2; break;
                        default: break;
                    }
                }
                break;
            case "fantasma":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "fantasma": $multiplicador *= 2; break;
                        case "normal": $multiplicador /= 4; break;
                        case "psiquico": $multiplicador *= 2; break;
                        case "siniestro": $multiplicador /= 2; break;
                        default: break;
                    }
                }
                break;
            case "fuego":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador *= 2; break;
                        case "agua": $multiplicador /= 2; break;
                        case "bicho": $multiplicador *= 2; break;
                        case "dragon": $multiplicador /= 2; break;
                        case "fuego": $multiplicador /= 2; break;
                        case "hielo": $multiplicador *= 2; break;
                        case "planta": $multiplicador *= 2; break;
                        case "roca": $multiplicador /= 2; break;
                        default: break;
                    }
                }
                break;
            case "hada":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador /= 2; break;
                        case "dragon": $multiplicador *= 2; break;
                        case "fuego": $multiplicador /= 2; break;
                        case "lucha": $multiplicador *= 2; break;
                        case "siniestro": $multiplicador *= 2; break;
                        case "veneno": $multiplicador /= 2; break;
                        default: break;
                    }
                }
                break;
            case "hielo":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador /= 2; break;
                        case "agua": $multiplicador /= 2; break;
                        case "dragon": $multiplicador *= 2; break;
                        case "fuego": $multiplicador /= 2; break;
                        case "hielo": $multiplicador /= 2; break;
                        case "planta": $multiplicador *= 2; break;
                        case "tierra": $multiplicador *= 2; break;
                        case "volador": $multiplicador *= 2; break;
                        default: break;
                    }
                }
                break;
            case "lucha":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador *= 2; break;
                        case "bicho": $multiplicador /= 2; break;
                        case "fantasma": $multiplicador /= 4; break;
                        case "hada": $multiplicador /= 2; break;
                        case "hielo": $multiplicador *= 2; break;
                        case "normal": $multiplicador *= 2; break;
                        case "psiquico": $multiplicador /= 2; break;
                        case "roca": $multiplicador *= 2; break;
                        case "siniestro": $multiplicador *= 2; break;
                        case "veneno": $multiplicador /= 2;  break;
                        case "volador": $multiplicador /= 2; break;
                        default: break;
                    }
                }
                break;
            case "normal":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador /= 2; break;
                        case "fantasma": $multiplicador /= 4; break;
                        case "roca": $multiplicador /= 2; break;
                        default: break;
                    }
                }
                break;
            case "planta":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador /= 2; break;
                        case "agua": $multiplicador *= 2; break;
                        case "bicho": $multiplicador /= 2; break;
                        case "dragon": $multiplicador /= 2; break;
                        case "fuego": $multiplicador /= 2; break;
                        case "planta": $multiplicador /= 2; break;
                        case "roca": $multiplicador *= 2; break;
                        case "tierra": $multiplicador *= 2; break;
                        case "veneno": $multiplicador /= 2; break;
                        case "volador": $multiplicador /= 2; break;
                        default: break;
                    }
                }
                break;
            case "psiquico":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador /= 2; break;
                        case "lucha": $multiplicador *= 2; break;
                        case "psiquico": $multiplicador /= 2; break;
                        case "siniestro":$multiplicador /= 4;  break;
                        case "veneno": $multiplicador *= 2; break;
                        default: break;
                    }
                }
                break;
            case "roca": 
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador /= 2; break;
                        case "bicho": $multiplicador *= 2; break;
                        case "fuego": $multiplicador *= 2; break;
                        case "hielo": $multiplicador *= 2; break;
                        case "tierra": $multiplicador /= 2; break;
                        case "volador": $multiplicador *= 2; break;
                        default: break;
                    }
                }
                break;
            case "siniestro":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "fantasma": $multiplicador *= 2; break;
                        case "hada": $multiplicador /= 2; break;
                        case "lucha": $multiplicador /= 2; break;
                        case "psiquico": $multiplicador *= 2; break;
                        case "siniestro": $multiplicador /= 2; break;
                        default: break;
                    }
                }
                break;
            case "tierra":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador *= 2; break;
                        case "bicho": $multiplicador /= 2; break;
                        case "electrico": $multiplicador *= 2; break;
                        case "fuego": $multiplicador *= 2; break;
                        case "planta": $multiplicador /= 2; break;
                        case "roca": $multiplicador *= 2; break;
                        case "veneno": $multiplicador *= 2; break;
                        case "volador": $multiplicador /= 4; break;
                        default: break;
                    }
                }
                break;
            case "veneno":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador /= 4; break;
                        case "fantasma": $multiplicador /= 2; break;
                        case "hada": $multiplicador *= 2; break;
                        case "planta": $multiplicador *= 2; break;
                        case "roca": $multiplicador /= 2; break;
                        case "tierra": $multiplicador /= 2; break;
                        case "veneno": $multiplicador /= 2; break;
                        default: break;
                    }
                }
                break;
            case "volador":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $multiplicador /= 2; break;
                        case "bicho": $multiplicador *= 2; break;
                        case "electrico": $multiplicador /= 2; break;
                        case "lucha": $multiplicador *= 2; break;
                        case "planta": $multiplicador *= 2; break;
                        case "roca": $multiplicador /= 2; break;
                        default: break;
                    }
                }
                break;
            default: break;
        }
    }
    
    return $multiplicador;
}
