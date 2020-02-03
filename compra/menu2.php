<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EmpInicio</title>
</head>
<header>    <h1>

        <?php
        session_start();
     echo  $_SESSION['nombre'];
        ?>
</h1>
<h3 style="float:right;position:relative;bottom:90px;">
<form action="cerrarsesion.php" method="post">
<div><input type="submit" value="Cerrar Sesion"></div>
	</form></h3>
</header>
<body>
    <nav>
        <ul>
<li><a href="compro.php">Comprar producto </a></li>
<li><a href="consulta.php">Consultar tus compras antiguas </a></li>
<li><a href="carro.php">Consulta Carro de la Compra </a></li>
<li><a href="comprafin.php">Terminar Compra </a></li>
            
        </ul>
    </nav>
</body>
</html>