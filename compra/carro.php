<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finalizar Compra</title>
</head>
<body>
    <br>
    <br>
    <br>
    <br>
    <?php   
    
    include "conexion.php";
    session_start();
    $cantidad=$_SESSION['procan'][0];
    $producto=$_SESSION['procan'][1];
    for ($i=0; $i < sizeof($cantidad); $i++) { 
        $total=todos($producto[$i],$db);
        $precio=$total[0];
        $nom=$total[1];
       $precio=$precio*$cantidad[$i];
       //Preguntar a sobre borrar y de uno a uno
       echo "<a href='carro2.php'> ";
       echo "Producto ".$nom." Cantidad ".$cantidad[$i]." Precio  ".$precio;
       echo "</a>";
       echo "<br>";
    }
    ?>
    <li><a href="menu2.php">Volver Menu </a></li>
    <li><a href="limpiarlista.php">Vaciar Carro </a></li>
    <?php
    function todos($producto,$db){
        $sql = "SELECT precio ,nombre FROM producto where '$producto'=id_producto";
        $resultado = mysqli_query($db, $sql);
        if ($resultado) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $precio = $row['precio'];
                $nombre = $row['nombre'];
            }
        }
        $total[1]=$nombre;
        $total[0]=$precio;
        return $total;
    }
    ?>

</body>
</html>