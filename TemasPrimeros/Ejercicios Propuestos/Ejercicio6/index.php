<?php
include_once("../funciones.php");

$arrayEmpresa = [
    "s1" => [
        "74530432J" => [
            "nombre"=>"Paco",
            "apellido"=>"Hernandez",
            "horas"=>30,
            "sueldoB" => 180,
            "impuestos" => 18,
            "sueldoN" => 162,
        ],
        "74530432G" => [
            "nombre"=>"Kiko",
            "apellido"=>"Picolinos",
            "horas"=>30,
            "sueldoB" => 180,
            "impuestos" => 18,
            "sueldoN" => 162,
        ],
        
    ],
    "s2" => [
        "74530432J" => [
            "nombre"=>"Marta",
            "apellido"=>"Castle",
            "horas"=>30,
            "sueldoB" => 180,
            "impuestos" => 18,
            "sueldoN" => 162,
        ],
        "74530432G" => [
            "nombre"=>"Esther",
            "apellido"=>"Hefresa",
            "horas"=>30,
            "sueldoB" => 180,
            "impuestos" => 18,
            "sueldoN" => 162,
        ],
        
    ],
    "s3" => [
        "74530432J" => [
            "nombre"=>"Piolin",
            "apellido"=>"Bird",
            "horas"=>30,
            "sueldoB" => 180,
            "impuestos" => 18,
            "sueldoN" => 162,
        ],
        "74530432G" => [
            "nombre"=>"El Gato",
            "apellido"=>"Cat",
            "horas"=>30,
            "sueldoB" => 180,
            "impuestos" => 18,
            "sueldoN" => 162,
        ],
        
    ],
    "s4" => [
        "74530432J" => [
            "nombre"=>"Tontin",
            "apellido"=>"Second",
            "horas"=>30,
            "sueldoB" => 180,
            "impuestos" => 18,
            "sueldoN" => 162,
        ],
        "74530432G" => [
            "nombre"=>"Gruñon",
            "apellido"=>"Fourth",
            "horas"=>30,
            "sueldoB" => 180,
            "impuestos" => 18,
            "sueldoN" => 162,
        ],
        
    ],
    "s5" => [
        "74530432J" => [
            "nombre"=>"Faker",
            "apellido"=>"Ultima",
            "horas"=>30,
            "sueldoB" => 180,
            "impuestos" => 18,
            "sueldoN" => 162,
        ],
        "74530432G" => [
            "nombre"=>"Doublelift",
            "apellido"=>"Finders",
            "horas"=>30,
            "sueldoB" => 180,
            "impuestos" => 18,
            "sueldoN" => 162,
        ],
        
    ],
];
$cadenaEmpresa = array_a_cadenaurl($arrayEmpresa);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Página Principal</h1>
    
<?= menu_empresa($cadenaEmpresa) ?>


<!-- <pre>
    <?= print_r($arrayEmpresa) ?>
</pre> -->
<img src="indexImage.jpg" alt="Imagen Inicial">

</body>
</html>