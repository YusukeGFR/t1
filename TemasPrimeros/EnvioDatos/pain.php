<?php
$paises=["Espanya","Francia","USA","Italia","Tierra Media"];
?>
<form action="regiones.php" method="get">
    <select name="pain">
        <?php
            for($i=0; $i<count($paises);$i++) {
                echo "<option>{$paises[$i]}</option>";
            }
        ?>
    </select>
    <input type="submit" value="Enviar">
</form>