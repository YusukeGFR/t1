<html>
<head>
<title>Pruebas</title>
</head>
<body>
<?php
class Menu {
 private $enlaces=array();
 private $titulos=array();
 public function cargarOpcion($en,$tit)
 {
 $this->enlaces[]=$en;
 $this->titulos[]=$tit;
 }
 public function mostrarHorizontal() {
    for($f=0;$f<count($this->enlaces);$f++) {
        echo '<a href="'.$this->enlaces[$f].'">'.$this->titulos[$f].'</a>';
        echo "-";
    }
 }
 public function mostrarVertical() {
    for($f=0;$f<count($this->enlaces);$f++) {
        echo '<a href="'.$this->enlaces[$f].'">'.$this->titulos[$f].'</a>';
        echo "<br>";
    }
 }
}
$menu1=new Menu();
$menu1->cargarOpcion('http://www.google.com','Google');
$menu1->cargarOpcion('http://www.yahoo.com','Yhahoo');
$menu1->cargarOpcion('http://www.msn.com','MSN');
$menu1->mostrarHorizontal();
echo "<br><br>";
$menu1->mostrarVertical();
?>
</body>
</html>