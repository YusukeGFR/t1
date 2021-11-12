<html>
 <head>
 <title>Ejemplo de cadenas en PHP 7</title>
 </head>
 <body>
 <?php
 // Strlen()
 echo "<strong>Ejemplo de Strlen()</strong>
<br>".strlen("12345")."<br>";
 echo "<hr>";
 // Explode()
 $pieza = "una-dos-tres-cuatro-cinco";
 $piezas = explode("-", $pieza);
 echo "<strong>Ejemplo de Explode()</strong> <br>";
 foreach($piezas as $individuales)
 {
 echo $individuales."<br>";
 }
 echo "<hr>";
 // Substr()
 $cadenaSubstr = "Hola mundo. Esta es una cadena a evaluar.";
 echo "<strong>Ejemplo de Substr()</strong> <br>";
 $cadenaSubstr = substr($cadenaSubstr, 4, 10);
 echo $cadenaSubstr."<br>";
 echo "<hr>";
 // Chop()
 echo "<strong>Ejemplo de Chop()</strong> <br>";
 $cadenaChop = "Hola mundo ";
 echo "<pre>";
 echo chop($cadenaChop);
 echo "</pre >";

 echo "<hr>";
 // Strpos()
 echo "<strong>Ejemplo de Strpos()</strong> <br>";
 $cadenaStrpos = 'Hola mundo. Esta es una cadena a evaluar.';
 $encontrar = 'mundo';
 $pos = strpos($cadenaStrpos, $encontrar);
 if ($pos === false)
 {
 echo "Ops! la cadena <i>$encontrar</i> no fue encontrada en la
cadena <strong>$cadenaStrpos</strong>.";
 }
 else
 {
 echo "La cadena <i>$encontrar</i> fue encontrada en la cadena
<strong>$cadenaStrpos</strong> y existe en la posición
<strong>$pos</strong>.";
 }
 echo "<hr>";
 // Str_replace()
 echo "<strong>Ejemplo de Str_replace()</strong> <br>";
 $vocales = array("a", "e", "i", "o", "A", "E", "I", "O");
 $cadenSTRreplace = "Hola mundo. Esta es una cadena a evaluar.";
 $reemplazador = array("4", "3", "1", "0", "4", "3", "1", "0");
 $cadenSTRreplace = str_replace($vocales , $reemplazador,
$cadenSTRreplace);
 echo $cadenSTRreplace."<br>";
 echo "<hr>";
 // Ucfirst()
 echo "<strong>Ejemplo de Ucfirst()</strong> <br>";
 $cadenaUCfirst = 'hola mundo';
 $cadenaUCfirst = ucfirst($cadenaUCfirst);
 echo $cadenaUCfirst."<br>";
 echo "<hr>";
 // Ucwords()
 echo "<strong>Ejemplo de Ucwords()</strong> <br>";
 $cadenaUcwords = 'hola mundo';
 $cadenaUcwords = ucwords($cadenaUcwords);
 echo $cadenaUcwords."<br>";
 echo "<hr>";
 // Strtolower()
 echo "<strong>Ejemplo de Strtolower()</strong> <br>";
 $cadenaStrtolower = 'HOLA MUNDO';
 $cadenaStrtolower = strtolower($cadenaStrtolower);
 echo $cadenaStrtolower."<br>";
 echo "<hr>";
 // Strtoupper()
 echo "<strong>Ejemplo de Strtoupper()</strong> <br>";
 $cadenaStrtoupper = 'hola mundo';
 $cadenaStrtoupper = strtoupper($cadenaStrtoupper);
 echo $cadenaStrtoupper."<br>";
 echo "<hr>";
 // Trim()
 echo "<strong>Ejemplo de Trim()</strong> <br>";
 $cadenaTrim = " Hola mundo ";
 echo "<pre>";
 echo trim($cadenaTrim);
 echo "</pre >";
 echo "<hr>";
 // Md5()
 echo "<strong>Ejemplo de md5()</strong> <br>";
 $cadenaMD5 = "Cadena cualquiera";
 $cadenaMD5 = md5($cadenaMD5);
 echo $cadenaMD5."<br>";
 echo "<hr>";
 // Nl2br()
 echo "<strong>Ejemplo de Nl2br()</strong> <br>";
 $cadenaNl2br = "Hola\nmundo\nHTML";
 echo "<pre>";
 $cadenaNl2br = nl2br($cadenaNl2br);
 echo $cadenaNl2br;
 echo "</pre >";
 echo "<hr>";
 ?>
 </body>
 </html