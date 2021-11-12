<?php
$arrayPaises = ["Espanya","Francia","Reino Unido","USA"];
$arrayCapitales = ["Madrid","Paris","Londres","Washington DC"];
$resultado = "";

function devolverCapital($pais,$arrayPaises,$arrayCapitales) {

    for($i=0;$i<count($arrayPaises);$i++) {
        if($pais == $arrayPaises[$i]) {
            return $arrayCapitales[$i];
        }
    }
}


if (isset($_GET["paises"])) {
    $pais = $_GET["paises"];
    $capital = devolverCapital($pais,$arrayPaises,$arrayCapitales);
    $resultado .= "La capital de {$pais} es {$capital}";

}

?>

<form action="Paises.php" method="GET">
    <select name="paises" id="paises">
        <?php 
            for ($i=0;$i<count($arrayPaises);$i++) {
                $selected=(isset($_GET["paises"]) && $pais == $arrayPaises[$i])?"selected":"";
                echo "<option {$selected}>{$arrayPaises[$i]}</option>";
            }
        
        ?>
    </select>
    <input type="submit" value="Enviar" id="boton1" name="boton1"/>
</form>

<?= $resultado ?>