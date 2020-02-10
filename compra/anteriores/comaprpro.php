<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>AÑADIR PRODUCTO A ALMACEN - Nombre del alumno</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 
    $productos = obtenerproducto($db);
    $almacenes = ObtenerAlmacen($db);
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
    <label for="almacen">almacenes:</label>
	<select name="almacen">
		<?php foreach($almacenes as $almacen) : ?>
			<option> <?php echo $almacen ?> </option>
		<?php endforeach; ?>
	</select>
	<br>
    <div class="form-group">
        Cantidad <input type="text" name="cantidad" placeholder="cantidad" class="form-control">
        </div>
        </div>
	</BR>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
$Numero=$_POST['almacen'];
$nombre=$_POST['producto'];
$cantidad=$_POST['cantidad'];
$idproducto=idproducto($nombre,$db);
alta($Numero,$idproducto,$cantidad,$db);
}
?>

<?php
// Funciones utilizadas en el programa
function alta($Numero,$idproducto,$cantidad,$db){
    $sql = "INSERT INTO ALMACENA VALUES('$Numero','$idproducto',$cantidad)";
    if(mysqli_query($db,$sql)===TRUE){
        echo "Se ha añadiddo correctamente";
    }else {
        $sql3="SELECT CANTIDAD FROM ALMACENA where '$Numero'=num_almacen and '$idproducto'=id_producto";
        $resultado=    mysqli_query($db,$sql3);
        $row = mysqli_fetch_assoc($resultado);
        $cantidad=$cantidad+$row['CANTIDAD'];

       $sql2= "UPDATE ALMACENA set CANTIDAD='$cantidad' where '$Numero'=num_almacen and '$idproducto'=id_producto";
       mysqli_query($db,$sql2);
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