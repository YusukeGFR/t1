<?php
$arrayPaises = [
    "Espanya" => "Madrid",
    "Francia" => "Paris",
    "Reino Unido" => "Londres",
    "USA" => "Washington DC",
];
$resultado = "";

function devolverCapital($pais,$arrayPaises) {

    // foreach($arrayPaises as $indice => $capital) {
    //     if($pais == $indice) {
    //         return $capital;
    //     }
    // }
    return $arrayPaises[$pais];
}


if (isset($_GET["paises"])) {
    $pais = $_GET["paises"];
    $capital = devolverCapital($pais,$arrayPaises);
    $resultado .= "La capital de {$pais} es {$capital}";

}

?>

<form action="PaisesAsociativos.php" method="GET">
    <select name="paises" id="paises">
        <?php 
            foreach ($arrayPaises as $i => $capital) {
                $selected=(isset($_GET["paises"]) && $pais == $i)?"selected":"";
                echo "<option {$selected}>{$i}</option>";
            }
        
        ?>
    </select>
    <input type="submit" value="Enviar" id="boton1" name="boton1"/>
</form>

<?= $resultado ?>