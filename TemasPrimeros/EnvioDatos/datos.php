<?php
// $paises=["Espanya","Francia","USA","Italia"];
$datos=[
    "Tierra Media" => [ "Mordor" => ["OrcoCity"     => ["Habitantes1","Habitantes2","Habitantes3"],
                                     "Minas Morgul" => ["Habitantes1","Habitantes2","Habitantes3"],
                                     "Barad Dur"    => ["Habitantes1","Habitantes2","Habitantes3"],
                                    ], 
                        "Gondor"  => ["Minas Tirith" => ["Habitantes1","Habitantes2","Habitantes3"],
                                      "Palathir"     => ["Habitantes1","Habitantes2","Habitantes3"],
                                      "ElDelBar"     => ["Habitantes1","Habitantes2","Habitantes3"],
                                     ],
                        "Rivendel"  => ["Novelda" => ["Habitantes1","Habitantes2","Habitantes3"],
                                        "Elche"   => ["Habitantes1","Habitantes2","Habitantes3"],
                                        "Aspe"    => ["Habitantes1","Habitantes2","Habitantes3"],
                                       ]
                      ],
];
if(!isset($_GET["poblacion"])) {
    echo "Por favor seleccione la poblacion<br>";
    echo "<a href='pain.php'> Seleccioar </a>";
} else {
    $pais=$_GET["pain"];
    $region = $_GET["region"];
    $poblacion = $_GET["poblacion"];
    $datosCargar= $datos[$pais][$region][$poblacion];

    if (isset($_GET["datos"])) {
        echo "Sus datos son:
        <ul>
            <li>Pais: {$pais}</li>
            <li>Region: {$region}</li>
            <li>Poblacion: {$poblacion}</li>
            <li>Datos: {$_GET['datos']}</li>
        </ul>";
    }
    

    

?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
    <select name="datos">
        <?php
            for($i=0; $i<count($datosCargar);$i++) {
                echo "<option>{$datosCargar[$i]}</option>";
            }
        ?>
    </select>
    <input type="hidden" name="pain" value="<?= $pais?>">
    <input type="hidden" name="region" value="<?= $region?>">
    <input type="hidden" name="poblacion" value="<?= $poblacion?>">
    <input type="submit" value="Enviar">
</form>

<?php } ?>