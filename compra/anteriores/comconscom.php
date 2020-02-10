<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>AÑADIR PRODUCTO A cliente - Nombre del alumno</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 
    $clientes = Obtenercliente($db);
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Aplicacion-->
<div class="card border-success mb-3" style="max-width: 30rem;">
<div class="card-header">Datos Producto</div>
<div class="card-body">
    <label for="cliente">Clientes:</label>
	<select name="cliente">
		<?php foreach($clientes as $cliente) : ?>
			<option> <?php echo $cliente ?> </option>
		<?php endforeach; ?>
	</select>
	<br>
    <div class="form-group">
        Fecha Entrada <input type="fecha" name="fecha_e" placeholder="fecha" class="form-control">
        </div>
        <div class="form-group">
        Fecha Fin <input type="fecha" name="fecha_f" placeholder="fecha" class="form-control">
        </div>
        </div>
	</BR>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
$nif=$_POST['cliente'];
$fechae=$_POST['fecha_e'];
$fechaf=$_POST['fecha_f'];
obtenerCompras($nif,$fechae,$fechaf,$db);
}
?>

<?php
function obtenerCompras($nif,$fechae,$fechaf,$db){
$sql="SELECT id_producto from COMPRA where '$nif'=nif and fecha_compra>='$fechae' and fecha_compra<='$fechaf'";
$resultado=mysqli_query($db,$sql);
if ($resultado) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $id=$row['id_producto'];
        $sql2="SELECT nombre,precio from Producto where id_producto='$id'";
        $resultado2=mysqli_query($db,$sql2);
        $row2 = mysqli_fetch_assoc($resultado2);
        echo $nif." ".$id." ".$row2['nombre']." ".$row2['precio'];
        echo "<br>";
    }
}
}
function Obtenercliente($db){
    $cliente = array();	
	$sql = "SELECT nif FROM cliente";
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$cliente[] = $row['nif'];
		}
	}
	return $cliente;
}


	




?>



</body>

</html>