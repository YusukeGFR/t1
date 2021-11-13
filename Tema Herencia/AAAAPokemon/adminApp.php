<?php
include_once("funciones.php");
$url = explode("/",$_SERVER['HTTP_REFERER']);
$last = $url[count($url)-1];

if ($last === "checkAdmin.php") {

    $correctLogin = true;

} else {
    header("location:paginaPrincipal.php");
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
    <?= imprimirMenu($correctLogin) ?>
</body>
</html>