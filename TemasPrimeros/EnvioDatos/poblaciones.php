<?php
// $paises=["Espanya","Francia","USA","Italia"];
$poblaciones=[
    "Espanya" => ["Alicante" => ["Novelda","Elche","Aspe"],
                  "Murcia"   => ["Novelda","Elche","Aspe"],
                  "Valencia" => ["Novelda","Elche","Aspe"]
                ],
    "Tierra Media" => [ "Mordor" => ["OrcoCity","Minas Morgul","Barad Dur"],
                        "Gondor"  => ["Minas Tirith","Palathir","ElDelBar"],
                        "Rivendel"  => ["Novelda","Elche","Aspe"]],
];
if(!isset($_GET["region"])) {
    echo "Por favor seleccione la region<br>";
    echo "<a href='pain.php'> Seleccioar </a>";
} else {
    $region = $_GET["region"];
    $pais=$_GET["pain"];
    $poblacionesCargar= $poblaciones[$pais][$region];

?>
<form action="datos.php" method="get">
    <select name="poblacion">
        <?php
            for($i=0; $i<count($poblacionesCargar);$i++) {
                echo "<option>{$poblacionesCargar[$i]}</option>";
            }
        ?>
    </select>
    <input type="hidden" name="pain" value="<?= $pais?>">
    <input type="hidden" name="region" value="<?= $region?>">
    <input type="submit" value="Enviar">
</form>

<?php } ?>