<?php
include_once("funciones.php");
comprobacion();
$_SESSION["usuario"] = [];
session_destroy();
header("location:checkUser.php");