<?php

class a{
    private $b = 456;
    function getB() {
        return $this->b;
    }
}

$ObjetoA = new a();

echo "el OBJETO {$ObjetoA->getB()}";

// Una sola línea de una función o una cadena. El igual sustituye al echo
// Las constantes no funcionan con las llaves, por lo demás estan funcionan casi siempre.
// Las constantes solo funcionan concatenando.
// Cualquier cosa distinta de 0, cadena vacía o null es verdadero
$texto = null;
if ($texto) {echo "entro";}
