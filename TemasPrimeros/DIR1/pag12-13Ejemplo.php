<html>
<head>
<title>Pruebas</title>
</head>
<body>
<?php
class Tabla {
 private $mat;
 private $cantFilas;
 private $cantColumnas;
 private $color;
 private $fondo;
 public function __construct($fi,$co,$color,$fondo) {
    $this->cantFilas=$fi;
    $this->cantColumnas=$co;
    $this->color=$color;
    $this->fondo=$fondo;
    $this->mat=array();
 }

 public function cargar($fila,$columna,$valor) {
    $this->mat[$fila][$columna]=$valor;
 }

 public function inicioTabla() {
    echo '<table border="1" bgcolor="'.$this->fondo.'">';
 }

 private function inicioFila() {
    echo '<tr>';
 }

 private function mostrarCelda($fi,$co){
    echo '<td><font color="'.$this->color.'">'.$this->mat[$fi][$co].'</font></td>';
 }

 private function finFila(){
     echo '</tr>';
 }

 private function finTabla() {
    echo '</table>';
 }

 public function mostrar(){
    $this->inicioTabla();
    for($f=1;$f<=$this->cantFilas;$f++) {
        $this->inicioFila();
        for($c=1;$c<=$this->cantColumnas;$c++) {
            $this->mostrarCelda($f,$c);
        }
    $this->finFila();
    }
    $this->finTabla();
 }
}

$tabla1=new Tabla(2,3,"white","black");
$tabla1->cargar(1,1,"1");
$tabla1->cargar(1,2,"2");
$tabla1->cargar(1,3,"3");
$tabla1->cargar(2,1,"4");
$tabla1->cargar(2,2,"5");
$tabla1->cargar(2,3,"6");
$tabla1->mostrar();
?>
</body>
</html>