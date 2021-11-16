<?php
class Usuario {

    // Mis POkemons
    // Equipo
    // Partidas ganadas
    // Partidas perdidas
    // Evoluciones disponibles

    private $nombre;
    private $pass;
    private $equipo;

    public function __construct($nombre,$pass) {
        $this->nombre= $nombre;
        $this->pass= $pass;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }
}

?>