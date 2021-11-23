<?php
include_once('pokemon.php');
function imprimirMenu($correctLogin) {
    $menu = "
    <div id='adminMenu'>
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
    </form>
    </div>";
    return $menu;
}

function menuUsuario() {
    $menu = "
    <div id='userMenu'>
        <form action='ver_mis_pokemons.php' method='post'>
            <input type='submit' value='Ver mis Pokémons' name='button1'>
        </form>

        <form action='organizar_equipo.php' method='post'>
            <input type='submit' value='Organizar mi Equipo' name='button2'>
        </form>

        <form action='jugar_partida.php' method='post'>
            <input type='submit' value='Jugar Partida' name='button3'>
        </form>

        <form action='poke_evolucionar.php' method='post'>
            <input type='submit' value='Evolucionar un Pokémon' name='button4'>
        </form>
        <form action='desconectar.php' method='post'>
            <input type='submit' value='Desconectar' name='button5'>
        </form>
    </div>";
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
        if (($indice+1) % 6 == 0 && $indice != 0) {
            $tabla .= "</tr><tr>";
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

    $bono = 1.0;
    $misTipos = [$tipo1Propio,$tipo2Propio];
    $rivalTipos = [$tipo1Rival,$tipo2Rival];

    foreach($misTipos as $miTipo) {
        switch($miTipo) {
            case "acero": 
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono -= 0.15; break;
                        case "agua": $bono -= 0.15; break;
                        case "electrico": $bono -= 0.15; break;
                        case "fuego": $bono -= 0.15; break;
                        case "hada": $bono += 0.15; break;
                        case "hielo": $bono += 0.15;  break;
                        case "roca": $bono += 0.15; break;
                        default: break;
                    }
                }
                break;
            case "agua": 
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "agua": $bono -= 0.15; break;
                        case "dragon": $bono -= 0.15; break;
                        case "fuego": $bono += 0.15; break;
                        case "planta": $bono -= 0.15; break;
                        case "roca": $bono += 0.15; break;
                        case "tierra": $bono += 0.15; break;
                        default: break;
                    }
                }
                break;
            case "bicho":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono -= 0.15; break;
                        case "fantasma": $bono -= 0.15; break;
                        case "fuego": $bono -= 0.15; break;
                        case "hada": $bono -= 0.15; break;
                        case "lucha": $bono -= 0.15; break;
                        case "planta": $bono += 0.15; break;
                        case "psiquico": $bono += 0.15; break;
                        case "siniestro": $bono += 0.15; break;
                        case "veneno": $bono -= 0.15; break;
                        case "volador": $bono -= 0.15; break;
                        default: break;
                    }
                }
                break;
            case "dragon":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono -= 0.15; break;
                        case "dragon": $bono += 0.15; break;
                        case "hada": $bono -= 0.15; break;
                        default: break;
                    }
                }
                break;
            case "electrico":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "agua": $bono += 0.15; break;
                        case "dragon": $bono -= 0.15; break;
                        case "electrico": $bono -= 0.15; break;
                        case "planta": $bono -= 0.15; break;
                        case "tierra": $bono -= 0.15; break;
                        case "volador": $bono += 0.15; break;
                        default: break;
                    }
                }
                break;
            case "fantasma":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "fantasma": $bono += 0.15; break;
                        case "normal": $bono -= 0.15; break;
                        case "psiquico": $bono += 0.15; break;
                        case "siniestro": $bono -= 0.15; break;
                        default: break;
                    }
                }
                break;
            case "fuego":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono += 0.15; break;
                        case "agua": $bono -= 0.15; break;
                        case "bicho": $bono += 0.15; break;
                        case "dragon": $bono -= 0.15; break;
                        case "fuego": $bono -= 0.15; break;
                        case "hielo": $bono += 0.15; break;
                        case "planta": $bono += 0.15; break;
                        case "roca": $bono -= 0.15; break;
                        default: break;
                    }
                }
                break;
            case "hada":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono -= 0.15; break;
                        case "dragon": $bono += 0.15; break;
                        case "fuego": $bono -= 0.15; break;
                        case "lucha": $bono += 0.15; break;
                        case "siniestro": $bono += 0.15; break;
                        case "veneno": $bono -= 0.15; break;
                        default: break;
                    }
                }
                break;
            case "hielo":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono -= 0.15; break;
                        case "agua": $bono -= 0.15; break;
                        case "dragon": $bono += 0.15; break;
                        case "fuego": $bono -= 0.15; break;
                        case "hielo": $bono -= 0.15; break;
                        case "planta": $bono += 0.15; break;
                        case "tierra": $bono += 0.15; break;
                        case "volador": $bono += 0.15; break;
                        default: break;
                    }
                }
                break;
            case "lucha":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono += 0.15; break;
                        case "bicho": $bono -= 0.15; break;
                        case "fantasma": $bono -= 0.15; break;
                        case "hada": $bono -= 0.15; break;
                        case "hielo": $bono += 0.15; break;
                        case "normal": $bono += 0.15; break;
                        case "psiquico": $bono -= 0.15; break;
                        case "roca": $bono += 0.15; break;
                        case "siniestro": $bono += 0.15; break;
                        case "veneno": $bono -= 0.15;  break;
                        case "volador": $bono -= 0.15; break;
                        default: break;
                    }
                }
                break;
            case "normal":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono -= 0.15; break;
                        case "fantasma": $bono -= 0.15; break;
                        case "roca": $bono -= 0.15; break;
                        default: break;
                    }
                }
                break;
            case "planta":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono -= 0.15; break;
                        case "agua": $bono += 0.15; break;
                        case "bicho": $bono -= 0.15; break;
                        case "dragon": $bono -= 0.15; break;
                        case "fuego": $bono -= 0.15; break;
                        case "planta": $bono -= 0.15; break;
                        case "roca": $bono += 0.15; break;
                        case "tierra": $bono += 0.15; break;
                        case "veneno": $bono -= 0.15; break;
                        case "volador": $bono -= 0.15; break;
                        default: break;
                    }
                }
                break;
            case "psiquico":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono -= 0.15; break;
                        case "lucha": $bono += 0.15; break;
                        case "psiquico": $bono -= 0.15; break;
                        case "siniestro":$bono -= 0.15;  break;
                        case "veneno": $bono += 0.15; break;
                        default: break;
                    }
                }
                break;
            case "roca": 
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono -= 0.15; break;
                        case "bicho": $bono += 0.15; break;
                        case "fuego": $bono += 0.15; break;
                        case "hielo": $bono += 0.15; break;
                        case "tierra": $bono -= 0.15; break;
                        case "volador": $bono += 0.15; break;
                        default: break;
                    }
                }
                break;
            case "siniestro":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "fantasma": $bono += 0.15; break;
                        case "hada": $bono -= 0.15; break;
                        case "lucha": $bono -= 0.15; break;
                        case "psiquico": $bono += 0.15; break;
                        case "siniestro": $bono -= 0.15; break;
                        default: break;
                    }
                }
                break;
            case "tierra":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono += 0.15; break;
                        case "bicho": $bono -= 0.15; break;
                        case "electrico": $bono += 0.15; break;
                        case "fuego": $bono += 0.15; break;
                        case "planta": $bono -= 0.15; break;
                        case "roca": $bono += 0.15; break;
                        case "veneno": $bono += 0.15; break;
                        case "volador": $bono -= 0.15; break;
                        default: break;
                    }
                }
                break;
            case "veneno":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono -= 0.15; break;
                        case "fantasma": $bono -= 0.15; break;
                        case "hada": $bono += 0.15; break;
                        case "planta": $bono += 0.15; break;
                        case "roca": $bono -= 0.15; break;
                        case "tierra": $bono -= 0.15; break;
                        case "veneno": $bono -= 0.15; break;
                        default: break;
                    }
                }
                break;
            case "volador":
                foreach ($rivalTipos as $rivalTipo) {
                    switch($rivalTipo) {
                        case "acero": $bono -= 0.15; break;
                        case "bicho": $bono += 0.15; break;
                        case "electrico": $bono -= 0.15; break;
                        case "lucha": $bono += 0.15; break;
                        case "planta": $bono += 0.15; break;
                        case "roca": $bono -= 0.15; break;
                        default: break;
                    }
                }
                break;
            default: break;
        }
    }
    
    return $bono;
}
