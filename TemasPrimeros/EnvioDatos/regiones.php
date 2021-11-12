<?php
// $paises=["Espanya","Francia","USA","Italia"];
$regiones=[
    "Espanya" => ["Alicante","Murcia","Valencia"],
    "Francia" => ["LaDelQueso","LaDelVino","Normandia"],
    "USA" => ["Ohio","Wyoming","Texas"],
    "Italia" => ["Toscana","Piaomonte","Valoria"],
    "Tierra Media" => ["Mordor","Gondor","Rivendel"],
];
if(!isset($_GET["pain"])) {
    echo "Por favor seleccione el pais<br>";
    echo "<a href='pain.php'> Seleccioar </a>";
} else {
    $pais = $_GET["pain"];
    $regionesCargar= $regiones[$pais];

?>
<form action="poblaciones.php" method="get">
    <select name="region">
        <?php
            for($i=0; $i<count($regionesCargar);$i++) {
                echo "<option>{$regionesCargar[$i]}</option>";
            }
        ?>
    </select>
    <input type="hidden" name="pain" value="<?= $pais?>">
    <input type="submit" value="Enviar">
</form>

<?php } ?>