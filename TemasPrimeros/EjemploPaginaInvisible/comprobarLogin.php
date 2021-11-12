<?php 
$arrayUsuarios= [
    "Rosa" => "1234",
    "Ana" => "1234",
    "Yo" => "1234",
    "Marco" => "1234",
    "Aphelios" => "1234",
    "Jeje" => "1234",
    "El Bromas" => "1234",
    "Patata Valiente" => "1234",
];

if (!isset($_GET["usu"])) {
    header("location:login.php");
}
$usu = $_GET["usu"];
$pass = $_GET["pass"];
$encontrado=false;

if (isset($arrayUsuarios[$usu]) && $arrayUsuarios[$usu]==$pass) {
    header("location:app.php");
} else {
    header("location:login.php");
}