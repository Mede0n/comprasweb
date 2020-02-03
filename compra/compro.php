<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Web compras</title>
	<style>
		.button {
    -webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;

    text-decoration: none;
    color: initial;
}
		</style>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>COMPRA- Nombre del alumno</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 
	$productos = obtenerproducto($db);
	if (isset($_COOKIE["Error"])) {
		echo $_COOKIE["Error"];
	}
	
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
    <div class="form-group">
        Unidades <input type="text" name="unidades" placeholder="unidades" class="form-control">
		</div>
		
        </div>
		<div><input type="submit" value="Alta Producto"></div>
	</form>
		<a href="menu2.php" class="button">Volver Menu</a>
<?php
} else { 
	session_start();
$nombre=$_POST['producto'];
$unidades=$_POST['unidades'];
if ($unidades!=null && $unidades!=0) {
$idproducto=idproducto($nombre,$db);
$suma=obtenercantidad($idproducto,$db);
//boton compra es header a otro php y boton añadir a otro 
if ($suma>=$unidades) {
	$procan=$_SESSION['procan'];
	$procan[0][]=$unidades;
	$procan[1][]=$idproducto;
	$_SESSION['procan']=$procan;
	header("Location: menu2.php");
}else {
	$mens = "STOCK NO DISPONIBLE";
	setcookie("Error", $mens, time()+10);
	header("Location: compro.php");
}
}
else  if($unidades==0){
	$mens = "Cantidad no seleccionada o igual a 0";
	setcookie("Error", $mens, time()+10);
	header("Location: compro.php");
}
}
?>

<?php
// Funciones utilizadas en el programa
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
function obtenercantidad($idproducto,$db){
    $producto = array();	
	$sql = "SELECT cantidad FROM ALMACENA where id_producto='$idproducto' ";
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$producto[] = $row['cantidad'];
		}
    }
    $suma=array_sum($producto);
	return $suma;
}
	




?>


</body>

</html>