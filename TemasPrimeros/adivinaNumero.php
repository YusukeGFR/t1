<?php 
    if(isset($_GET["num"])) { 
        $random = $_GET["randomNum"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<h1>Adivina el número!</h1>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
        <input type="number" name="num" id="num">
        <input type="submit" value="button">
        <input type="hidden" name="randomNum" value="<?= isset($random)?$random:rand(1,100); ?>">
    </form>
</body>
</html>

<?php 
    if(isset($_GET["num"])) {
        echo $random;
        $userNum = filter_var($_GET["num"], FILTER_SANITIZE_NUMBER_INT);
        if(filter_var($userNum, FILTER_VALIDATE_INT)) {
            echo "El numero es valido";
        } else {
            echo "El numero no es valido";
        }
    }





?>