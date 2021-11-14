<?php
include_once("funciones.php");
if(isset($_POST["check"])) {

    $correctLogin = $_POST["check"];
    $error = "";

    if (isset($_POST["new"])) {




    }

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
    <hr>
    <form action="registrarUsuario.php" method="post">
        <p>Nombre del nuevo pokemon</p>
        <input type="text" name="newPokemon" id="newPokemon">
        <p>
            Ataque <input type="number" name="ataque" id="newPass">
            Defensa <input type="number" name="defensa" id="newPass">
        </p>
        <p>Seleccion de Tipos</p>
        <p>
            Principal:
            <select name="tipo1" id="tipo1">
            <?php 
                $tipos = ["acero","agua","bicho","dragon","electrico","fantasma","fuego","hada","hielo","lucha","normal","planta","psiquico","roca","siniestro","tierra","veneno","volador"];
                foreach ($tipos as $tipo) {
                    echo "<option value='{$tipo}'>".ucfirst($tipo)."</option>";
                }
            ?>
            </select>
            Secundario:
            <select name="tipo1" id="tipo1">
            <?php 
                array_push($tipos,"");
                foreach ($tipos as $tipo) {
                    if ($tipo != "") {
                        echo "<option value='{$tipo}'>".ucfirst($tipo)."</option>";
                    } else {
                        echo "<option value='null' selected>".ucfirst($tipo)."</option>";
                    }
                    
                }
            ?>
            </select>
        </p>
        <p>Nivel de la etapa evolutiva</p>
        <p> 1<input type="radio" name="level" id="one" value="1"> 2<input type="radio" name="level" id="two" value="2"> 3<input type="radio" name="level" id="three" value="3"></p>
        <input type="submit" value="Registar" name="new" id="new">
        <input type="hidden" name="check" id="check" value="<?= $correctLogin ?>">
        <p><?= $error ?></p>
    </form>
    <img src="pokemons/turtwig/turtwig.gif" alt="">
</body>
</html>