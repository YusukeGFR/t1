<?php
include_once('../funciones.php');
$creada = "";

if (isset($_POST['num'])) {
    $num = $_POST['num'];
    if ($num > 2) {
        $creada = dibujaPiramide($num);
    } else {
        $creada = "El número ha de ser superior a 2";
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
    Introduce la Altura de la Piramide: <input type="text" name="num" id="num" value="0">
    <input type="submit" value="Crear">
</form>
    <?= $creada ?>
</body>
</html>

