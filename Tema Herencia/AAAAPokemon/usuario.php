<?php
class Usuario {

    // Mis POkemons
    // Equipo
    // Partidas ganadas
    // Partidas perdidas
    // Evoluciones disponibles

    private $nombre;
    private $pass;
    private $miEquipo = [];
    private $misPokemons = [];
    private $totales;
    private $ganadas;
    private $pokeEvoluciones;

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

    public function getMiEquipo()
    {
        return $this->miEquipo;
    }

    public function setMiEquipo($miEquipo)
    {
        $this->miEquipo = $miEquipo;

        return $this;
    }

    public function getMisPokemons()
    {
        return $this->misPokemons;
    }

    public function setMisPokemons($misPokemons)
    {
        $this->misPokemons = $misPokemons;

        return $this;
    }

    public function getTotales()
    {
        return $this->totales;
    }

    public function setTotales($totales)
    {
        $this->totales = $totales;

        return $this;
    }

    public function getGanadas()
    {
        return $this->ganadas;
    }

    public function setGanadas($ganadas)
    {
        $this->ganadas = $ganadas;

        return $this;
    }

    public function getPokeEvoluciones()
    {
        return $this->pokeEvoluciones;
    }

    public function setPokeEvoluciones($pokeEvoluciones)
    {
        $this->pokeEvoluciones = $pokeEvoluciones;

        return $this;
    }
}

?>