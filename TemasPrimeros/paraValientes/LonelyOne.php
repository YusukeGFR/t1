<?php
$datos=[
    "Tierra Media" => [ 
        "Mordor" => [
            "OrcoCity" => [
                "habitantes" => [23000]
                ],
            "Minas Morgul" => [
                "habitantes" => [45000]
                ],
            "Barad Dur" => [
                "habitantes" => [12000]
                ],
        ],
        "Nasgul" => [
            "PlarcaCity" => [
                "habitantes" => [230000]
                ],
            "Minas Nasgul" => [
                "habitantes" => [450000]
                ],
            "Marac Rul" => [
                "habitantes" => [120000]
                ],
        ],
        "Rivendel" => [
            "BronceCity" => [
                "habitantes" => [230000]
                ],
            "Minas Rivel" => [
                "habitantes" => [450000]
                ],
            "Barad Dur" => [
                "habitantes" => [120000]
                ],
        ],
    ]
];
$datoPais='Tierra Media';

if (!isset($_GET["pais"]) || !isset($_GET["region"])) {

?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
    <select name="region"> 
    <?php 
        foreach($datos as $indice => $valor) {
            foreach($valor as $indice2 => $valor2) {
                echo "<option>{$indice2}</option>";
            }
        }
    ?>
    <input type="hidden" name="pais" value="<?=$datoPais?>">
    <input type="submit" value="Enviar">
    </select>
</form>

<?php

} else if(!isset($_GET["poblacion"])) {

    $poblacionCargar = $datos[$_GET["pais"]][$_GET["region"]];
    $paisCargar = $_GET["pais"];
    $regionCargar = $_GET["region"];
    ?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
    <select name="poblacion"> 
    <?php 
        foreach($poblacionCargar as $poblacion => $habitantes) {
            echo "<option>{$poblacion}</option>";
        }
    ?>
    <input type="hidden" name="pais" value="<?=$paisCargar?>">
    <input type="hidden" name="region" value="<?=$regionCargar?>">
    <input type="submit" value="Enviar">
    </select>
</form>
<?php
} else {

    $habitantesCargar = $datos[$_GET["pais"]][$_GET["region"]][$_GET["poblacion"]];
    $numeroCargar = $habitantesCargar["habitantes"][0];

    echo "Pais {$_GET['pais']}, region {$_GET['region']}, poblacion {$_GET['poblacion']}, habitantes {$numeroCargar}.";
}
?>



