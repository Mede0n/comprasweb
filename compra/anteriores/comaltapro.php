<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>ALTA PRODUCTOS - Nombre del alumno</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 
    $categorias = obtenercategoria($db);
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Aplicacion-->
<div class="card border-success mb-3" style="max-width: 30rem;">
<div class="card-header">Datos Producto</div>
<div class="card-body">
		<div class="form-group">
        ID PRODUCTO <input type="text" name="idproducto" placeholder="idproducto" class="form-control">
        </div>
		<div class="form-group">
        NOMBRE PRODUCTO <input type="text" name="nombre" placeholder="nombre" class="form-control">
        </div>
		<div class="form-group">
        PRECIO PRODUCTO <input type="text" name="precio" placeholder="precio" class="form-control">
        </div>
        <div>
        <label for="categoria">Categorias:</label>
	<select name="categoria">
		<?php foreach($categorias as $categoria) : ?>
			<option> <?php echo $categoria ?> </option>
		<?php endforeach; ?>
	</select>
	<br>
        </div>
	</BR>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
$idproducto=$_POST['idproducto'];
$nombre=$_POST['nombre'];
$precio=$_POST['precio'];
$cates=$_POST['categoria'];
$sql3 = "SELECT id_categoria FROM categoria WHERE nombre = '$cates'";
$catego = $db->query($sql3);
if ( $catego ) {
while ($row = mysqli_fetch_assoc($catego)) {
        $cate = $row['id_categoria'];
    }
    }
crearproducto($idproducto,$nombre,$precio,$cate,$db);	
}
?>

<?php
// Funciones utilizadas en el programa
function obtenercategoria($db){
    $categoria = array();	
	$sql = "SELECT nombre FROM categoria";
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$categoria[] = $row['nombre'];
		}
	}
	return $categoria;
}
function crearproducto($id,$nom,$pre,$cate,$db){
    $sql = "INSERT INTO producto VALUES('$id','$nom','$pre','$cate')";
    mysqli_query($db,$sql);
}


	




?>



</body>

</html>