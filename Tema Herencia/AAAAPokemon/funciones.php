<?php

function imprimirMenu($correctLogin) {
    $menu = "
    <form action='registrarUsuario.php' method='post'>
        <input type='submit' value='Registrar Usuario' id='button1'>
        <input type='hidden' name='$correctLogin'>
    </form>

    <form action='registrarUsuario.php' method='post'>
        <input type='submit' value='Alta Digimon' id='button1'>
        <input type='hidden' name='$correctLogin'>
    </form>

    <form action='registrarUsuario.php' method='post'>
        <input type='submit' value='Definir Evolución' id='button1'>
        <input type='hidden' name='$correctLogin'>
    </form>

    <form action='registrarUsuario.php' method='post'>
        <input type='submit' value='Ver Pokemons' id='button1'>
        <input type='hidden' name='$correctLogin'>
    </form>";
    return $menu;
}