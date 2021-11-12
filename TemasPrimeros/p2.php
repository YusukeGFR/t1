<?php

function tablasMulti($num) {
        echo "Tabla del $num <br>";
        echo "<table border=1>";
        for($j = 1; $j<=10; $j++) {
            echo "<tr>";
            if($j%2==0) {
                echo "<td bgcolor='black'> <font color='white'>$num x $j </font></td>";
                echo "<td bgcolor='black'> <font color='white'>".($num*$j)."</td> </tr>";
            } else {
                echo "<tr> <td>$num x $j </td>";
                echo "<td >".($num*$j)."</td>";
            }
            echo "</tr>";
        }
        echo "</table> <br>";
}

?>

<html>
<head>
<h3>2ª práctica</h3>
</head>
<body>
<br>
<?php

$numero= $_POST["numero"];
tablasMulti($numero);
?>

</body>
</html>
