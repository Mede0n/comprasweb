<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Limpiar</title>
</head>
<body>
    <br>
    <br>
    <br>
    <br>
    <?php
    session_start();
    $user=$_SESSION['nombre'];
    session_unset();
    $acant=array();
    $apro=array();
    $procan[0]=$acant;
    $procan[1]=$apro;
    $_SESSION['nombre']=$user;
    $_SESSION['procan']=$procan;
 
    ?>
   <h1>Se ha limpiado el carro</h1>
<a href="menu2.php"> <button >Volver a menu</button> </a>
</body>
</html>