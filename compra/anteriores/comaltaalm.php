<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>ALTA Almacen - Nombre del alumno</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Aplicacion-->
<div class="card border-success mb-3" style="max-width: 30rem;">
<div class="card-header">Datos Producto</div>
<div class="card-body">
		<div class="form-group">
        Localidad de almacen <input type="text" name="Localidad" placeholder="Localidad" class="form-control">
        </div>

<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
$Localidad=$_POST['Localidad'];
$max=ObtenerID($db);
alta($Localidad,$max,$db);
}
?>

<?php
// Funciones utilizadas en el programa
function ObtenerID($db){
  $sql="SELECT MAX(NUM_ALMACEN) from ALMACEN ";
  $resultado = mysqli_query($db, $sql);
  if ($resultado) {
      while ($row = mysqli_fetch_assoc($resultado)) {
          $Maximo = $row['MAX(NUM_ALMACEN)'];
      }
  }
  if($Maximo==null){
      $Maximo=10;
  }else {
      $Maximo+=10;
  }
return $Maximo;
}
function alta($localidad,$max,$db){
    $sql = "INSERT INTO ALMACEN VALUES('$max','$localidad')";
    mysqli_query($db,$sql);
}
?>
</body>
</html>