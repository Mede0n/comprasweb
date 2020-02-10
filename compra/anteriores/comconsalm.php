<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>Mostrar productos que tiene un almacen - Nombre del alumno</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 
    $almacenes = ObtenerAlmacen($db);
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Aplicacion-->
<div class="card border-success mb-3" style="max-width: 30rem;">
<div class="card-header">Datos Producto</div>
<div class="card-body">
 
    <label for="almacen">almacenes:</label>
	<select name="almacen">
		<?php foreach($almacenes as $almacen) : ?>
			<option> <?php echo $almacen ?> </option>
		<?php endforeach; ?>
	</select>

	</BR>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
$Numero=$_POST['almacen'];
mostrarproductos($Numero,$db);
}
?>

<?php
// Funciones utilizadas en el programa
function mostrarproductos($Numero,$db) {
    $producto = array();
    $sql = "SELECT id_producto FROM almacena where '$Numero'=num_almacen";
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
           $prod= $row['id_producto'];
            $sql2 = "SELECT nombre FROM producto where '$prod'=id_producto";
            $resultado2 = mysqli_query($db, $sql2);
            $row2= mysqli_fetch_assoc($resultado2);
            echo "El producto ".$row2['nombre']." Tiene la id ";
           echo  $row['id_producto'];
           echo "<br>";
        }
    }
}
function ObtenerAlmacen($db){
    $almacen = array();	
	$sql = "SELECT NUM_ALMACEN FROM almacen";
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$almacen[] = $row['NUM_ALMACEN'];
		}
	}
	return $almacen;
}


	




?>



</body>

</html>