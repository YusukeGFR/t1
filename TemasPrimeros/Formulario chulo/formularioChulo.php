<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Dar de alta usuarios</h1>
    <form action="comprobar.php" method="get">
    Nombre: <input type="text" name="nombre" id="nombre"> <br>
    Nick: <input type="text" name="nick" id="nick"> <br>
    Contraseña: <input type="text" name="pass" id="pass"> <br>
    DNI: <input type="text" name="dni" id="dni"> <br>
    Sexo: <label> Masculino <input type="radio" name="sexo" id="sexo" value="M" checked> </label>
          <label> Femenino <input type="radio" name="sexo" id="sexo" value="F"> </label> <br>

    Aficiones: <label> Coches <input type="checkbox" name="aficiones[]" id="coches" value="coches"> </label>
               <label> Deporte <input type="checkbox" name="aficiones[]" id="deporte" value="deporte"> </label> <br>
               <label> Fiesta <input type="checkbox" name="aficiones[]" id="fiesta" value="fiesta"> </label>
               <label> Sofing <input type="checkbox" name="aficiones[]" id="sofing" value="sofing"> </label>
    <br>
    <input type="submit" value="Dar de Alta" name="alta" id="alta">
            </form>
</body>
</html>