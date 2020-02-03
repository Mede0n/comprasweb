<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>ALTA CATEGORÍAS - Nombre del alumno</h1>
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
<div class="card-header">Datos Categoría</div>
<div class="card-body">
		<div class="form-group">
        NIF <input type="text" name="nif" placeholder="nif" class="form-control">
        </div>
		<div class="form-group">
        NOMBRE  <input type="text" name="nombre" placeholder="nombre" class="form-control">
        </div>
        <div class="form-group">
        APELLIDO <input type="text" name="apellido" placeholder="apellido" class="form-control">
        </div>
        <div class="form-group">
        Codigo Postal <input type="text" name="cp" placeholder="cp" class="form-control">
        </div>
        <div class="form-group">
        Direccion <input type="text" name="direccion" placeholder="direccion" class="form-control">
        </div>
        <div class="form-group">
        Ciudad <input type="text" name="ciudad" placeholder="ciudad" class="form-control">
        </div>

		</BR>
<?php
	echo '<div><input type="submit" value="Alta Cliente"></div>
	</form>';
} else { 
$nif=$_POST['nif'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$cp=$_POST['cp'];
$direccion=$_POST['direccion'];
$ciudad=$_POST['ciudad'];
if(!empty($nif)){
    $bool=comprobar($nif,$db);
if ($bool==true) {
 altas($nif,$nombre,$apellido,$cp,$direccion,$ciudad,$db);
}
}else {
    echo "error dni vacio";
}
	
}
?>

<?php
// Funciones utilizadas en el programa
function altas ($nif,$nombre,$apellido,$cp,$direccion,$ciudad,$db){
    $pass=strrev($apellido);
   $pass=strtolower($pass);
$sql = "INSERT INTO CLIENTE VALUES('$nif','$nombre','$apellido','$cp','$direccion','$ciudad','$pass')";
if(mysqli_query($db,$sql)===TRUE){
    header("Location: entrar.php");
}else {
    echo "Fallo el dni esta repetido";
}
}
function comprobar($nif,$db){
    $bool=true;
    if (strlen($nif)==9) {
       $nif2=substr($nif,0,8);
       if (is_numeric($nif2)){
            $nif3=substr($nif,8,1);
            if (!ctype_alpha($nif3)) {
                echo "El ultimo valor tiene que ser una letra";
               $bool=false;
            }
       } else {
        echo "Las 8 primeras apariciones tienes que ser digitos";
        $bool=false;
       }
    }
    else {
        echo "Esta mal tu dni en la longitud";
        $bool=false;
    }
    return $bool;
}
?>

</body>

</html>