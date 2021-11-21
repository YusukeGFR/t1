<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Pokemon VGC en PHP</h1>
    <div id="paginaPrincipal">
        <p>¿Quien eres?</p>
        <form action="checkAdmin.php" method="post">
            <input type="submit" value="Administrador" name="botonAdmin">
        </form>
        <form action="checkUser.php" method="post">
            <input type="submit" value="Usuario" name="botonUsuario">
        </form>
    </div>
</body>
</html>