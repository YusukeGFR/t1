<?php

function imprimirMenu($correctLogin) {
    $menu = "
    <form action='registrarUsuario.php' method='post'>
        <input type='submit' value='Registrar Usuario' name='button1'>
        <input type='hidden' name='check' value='$correctLogin'>
    </form>

    <form action='altaPokemon.php' method='post'>
        <input type='submit' value='Alta Pokemon' name='button2'>
        <input type='hidden' name='check' value='$correctLogin'>
    </form>

    <form action='definirEvolucion.php' method='post'>
        <input type='submit' value='Definir Evolución' name='button3'>
        <input type='hidden' name='check' value='$correctLogin'>
    </form>

    <form action='verPokemons.php' method='post'>
        <input type='submit' value='Ver Pokemons' name='button4'>
        <input type='hidden' name='check' value='$correctLogin'>
    </form>";
    return $menu;
}