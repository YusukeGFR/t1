<?php 
$stringMaquina = "";
$eleccion = "Tijeras";
$cadena = "";

$arrayPartidas= [
    "Piedra" => [
        "Piedra"=>"EMPATE",
        "Papel"=>"DERROTA",
        "Tijeras"=>"VICTORIA",
        "Lagarto"=>"VICTORIA",
        "Spock"=>"DERROTA",
    ],
    "Papel" => [
        "Piedra"=>"VICTORIA",
        "Papel"=>"EMPATE",
        "Tijeras"=>"DERROTA",
        "Lagarto"=>"DERROTA",
        "Spock"=>"VICTORIA",
    ],
    "Tijeras" => [
        "Piedra"=>"DERROTA",
        "Papel"=>"VICTORIA",
        "Tijeras"=>"EMPATE",
        "Lagarto"=>"VICTORIA",
        "Spock"=>"DERROTA",
    ],
    "Lagarto" => [
        "Piedra"=>"EMPATE",
        "Papel"=>"VICTORIA",
        "Tijeras"=>"DERROTA",
        "Lagarto"=>"EMPATE",
        "Spock"=>"VICTORIA",
    ],
    "Spock" => [
        "Piedra"=>"VICTORIA",
        "Papel"=>"DERROTA",
        "Tijeras"=>"VICTORIA",
        "Lagarto"=>"DERROTA",
        "Spock"=>"EMPATE",
    ]
];

function quienGana($jugador,$maquina,$reglas) {
    return $reglas[$jugador][$maquina];
}

function generaJugada() {
    $eleccion = rand(0,4);
    $array= ["Tijeras","Papel","Piedra","Lagarto","Spock"];
    return $array[$eleccion];
}

if (isset($_POST["boton1"])) { 
    $jugador = $_POST["eleccion"];
    $maquina = generaJugada();
    $stringMaquina = "La máquina saca: ".$maquina;
    $cadena .= quienGana($jugador,$maquina,$arrayPartidas);

}

?>

<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>

<h2>Piedra Papel Tijeras</h2>

<form action="<?= $_SERVER["PHP_SELF"]?>" method="POST">
    <select id="eleccion" name="eleccion">
        <option value=Tijeras <?=($eleccion=="Tijeras")?"selected":""?>>Tijeras</option>
        <option value=Papel <?=($eleccion=="Papel")?"selected":""?>>Papel</option>
        <option value=Piedra <?=($eleccion=="Piedra")?"selected":""?>>Piedra</option>
        <option value=Lagarto <?=($eleccion=="Lagarto")?"selected":""?>>Lagarto</option>
        <option value=Spock <?=($eleccion=="Spock")?"selected":""?>>Spock</option>
    </select>
    <input type="submit" value="JUGAR" id="boton1" name="boton1"/>
</form>

<?= $stringMaquina?>
<br>
<?php 
    echo isset($_POST["boton1"])?$cadena:"";
    
?>


</body>
</html>