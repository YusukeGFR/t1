<?php
// DNI -> Formato correcto, único y no vacio
// Nick -> Único y no vacio
// Contraseña -> No vacio
// Nombre -> Solo texto

include_once('funciones.php');

$array_clientes =[
    "11111111X" => ["nombre"=>"Luis",
                    "nick"=>"Luis",
                    "pass"=>"1234",
                    "sexo"=>"M"],

    "22222222J" => ["nombre"=>"Rosa",
                    "nick"=>"Rosa",
                    "pass"=>"1234",
                    "sexo"=>"F"],

    "33333333B" => ["nombre"=>"Edu",
                    "nick"=>"Edu",
                    "pass"=>"1234",
                    "sexo"=>"M"],
];



if (isset($_GET["alta"])) {

    // Recoger datos
    $nombre = $_GET["nombre"];
    $nick = $_GET["nick"];
    $pass = $_GET["pass"];
    $dni = $_GET["dni"];
    $sexo = $_GET["sexo"];
    $aficiones = $_GET["aficiones"];

    // Comprobar errores
    $error = false;
    $error = !dni($pass);


    /////// Comrobar campos únicos
    // DNI
    $error = isset($array_clientes[$dni]);
    // Nick
    foreach ($array_clientes as $dni => $cliente) {
        if(isset($clientes[$nick])) {
            $error = true;
        };
    };

    // Si hay errores no doy de alta, en caso contrario si
    if($error) {
        echo "Se han producido errores, el usuario {$nombre} no será dado de alta";
    } else {
        echo "El usuario {$nombre} ha sido dado de alta.";
    }



} else {
    echo "No se comos has llegado aqui, pero not on my watch.";
}