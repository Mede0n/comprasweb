<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cerrar Sesion</title>
</head>
<body>
    <br>
    <br>
    <br>
    <br>
    <?php
    session_start();
    session_unset();
    session_destroy();
    ?>
   <h1>Tu Sesion se ha cerrado correctamente</h1>
<a href="menu.html"> <button >Cerrar Sesion</button> </a>
</body>
</html>