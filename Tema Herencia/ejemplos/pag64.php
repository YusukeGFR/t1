<?php
class A{
 private $objectB;
 private $valorA;
 public function __construct($valorA, $objectB){
 $this->objectB= $objectB;
 $this->valorA= $valorA;
 }
 public function __clone(){
 $this->objectB= clone ($this->objectB);
}
 public function setvalorA($nuevo){
 $this->valorA=$nuevo;
 }
 public function setobjectB($objectB){
 $this->objectB=$objectB;
}
 public function getobjectB(){
 return $this->objectB;
}
}
class B
{
 private $objectC;
 private $valorB;
 public function __construct($valorB, $objectC){
 $this->objectC= $objectC;
 $this->valorB= $valorB;
 }
 public function getobjectC(){
 return $this->objectC;
 }
 public function __clone(){
 $this->objectC= clone ($this->objectC);
}
}
class C{
 private $objectD;
 private $valorC;
 public function __construct($valorC, $objectD){
 $this->objectD= $objectD;
 $this->valorC= $valorC;
 }
 public function getobjectD(){
 return $this->objectD;
}
 public function __clone(){
 $this->objectD= clone ($this->objectD);
}
 public function setvalorC($nuevo){
 $this->valorC=$nuevo;
}
}
class D
{
 private $valorD;
 public function __construct($valorD){
 $this->valorD= $valorD;
 }
 public function __clone(){
 // $this->$objectE= clone ($this->ObjectE); No es necesario su
//definicion
 }
 public function setvalorD($nuevo){
 $this->valorD=$nuevo;
}
}
$objD=new D(1);
$objC= new C(2,$objD);
$objB= new B(3,$objC);
$objA= new A(4,$objB);
//CLONAMOS
$objClon=clone ($objA);
//Manipulo dos datos del Objeto Clon
// si consigo cambiarlos sin manipular el origianl
// es que el clon se ha realizado de manera correcta
$objClon->getobjectB()->getobjectC()->setvalorC(66);
$objClon->getobjectB()->getobjectC()->getobjectD()->setvalorD(33);
echo "Mostramos Original<BR>";
var_dump ($objA);
echo "<BR>Mostramos Clon Manipulado<BR>";
var_dump ($objClon);
?>
