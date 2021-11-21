<?php
include_once("funciones.php");
include_once("pokemon.php");
if(isset($_POST["check"])) {

    $arrayResults = [];
    $correctLogin = $_POST["check"];
    $pokemons = cadenaurl_a_array( file_get_contents("admin/pokemonsSerialized.txt") );
    $name = $_POST["name"];
    $modificando = "Modificando imágenes para ". ucfirst($name);
    if (isset($_FILES["principal"])) {

        $supported_file = ['gif','jpg','jpeg','png'];
        $arrayImgs = ["principal" => "{$name}","victoria" => "{$name}V","derrota" => "{$name}D"];
        $arrayResults = [];
        foreach ($arrayImgs as $tipo => $imagen) {
            $temporal = $_FILES["{$tipo}"]["tmp_name"];
            $parts = explode(".",$_FILES["{$tipo}"]["name"]);
            $ext = $parts[count($parts)-1];

            if (in_array($ext,$supported_file)) {
                $destino = "pokemons/{$name}/{$imagen}.{$ext}";
                $directorio = opendir("pokemons/{$name}");
                while($archivo = readdir($directorio)) {
                    if(strpos($archivo,$imagen) !== false) {
                        unlink("pokemons/{$name}/{$archivo}");
                    }
                }
                if (move_uploaded_file($temporal, $destino) ) {
                    array_push($arrayResults,"Imagen {$tipo} subida con éxito!");
                } else {
                    array_push($arrayResults,"Error en la imagen {$tipo}, no se actualizará.");
                }
            } else {
                if ($ext !== "") {
                    array_push($arrayResults,"Error en la imagen {$tipo}, formato erróneo.");
                }
            }
        }

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
    <title>Actualizar Imagenes</title>
    <link rel="stylesheet" href="styleAdmin.css">
</head>
<body>
<?= imprimirMenu($correctLogin) ?>

    <div class="form-container">
        <p id="notice"> <?= $modificando ?> </p>
        <form action="actualizarImagen.php" method="post" enctype="multipart/form-data">
        <p> Imagen Principal <input type="file" name="principal"> </p>
        <p> Imagen Victoria <input type="file" name="victoria"> </p>
        <p> Imagen Derrota <input type="file" name="derrota"> </p>
        <p> <input type="submit" value="Actualizar"> </p>
        <input type='hidden' value='<?=$correctLogin?>' name='check'>
        <input type='hidden' value='<?=$name?>' name='name'>
        </form>
    

<?php
for($i = 0; $i < count($arrayResults);$i++) {
    echo "<p id='notice'>".$arrayResults[$i]."</p>";
}
?>
</div>
</body>
</html>