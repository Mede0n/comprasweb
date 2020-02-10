<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>Consultar Los productos por almacen - Nombre del alumno</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 
    $productos = obtenerproducto($db);
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Aplicacion-->
<div class="card border-success mb-3" style="max-width: 30rem;">
<div class="card-header">Datos Producto</div>
<div class="card-body">
        <label for="producto">productos:</label>
	<select name="producto">
		<?php foreach($productos as $producto) : ?>
			<option> <?php echo $producto ?> </option>
		<?php endforeach; ?>
	</select>
	<br>
        </div>
	</BR>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
$nombre=$_POST['producto'];
$idproducto=idproducto($nombre,$db);
mostraralmacen($idproducto,$db);
}
?>

<?php
// Funciones utilizadas en el programa
function mostraralmacen($idproducto,$db){
    $sql = "SELECT cantidad , num_almacen FROM almacena where '$idproducto'=id_producto";
    $resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
            echo "Almacen ".$row['num_almacen']."=";
        echo   $row['cantidad'];
        echo "<br>";
		}
	}
}
function idproducto($nombre,$db){
    $sql = "SELECT id_producto FROM producto where '$nombre'=nombre";
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$idproducto = $row['id_producto'];
		}
	}
    return $idproducto;
}
function obtenerproducto($db){
    $producto = array();	
	$sql = "SELECT nombre FROM producto";
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$producto[] = $row['nombre'];
		}
	}
	return $producto;
}


	




?>



</body>

</html>