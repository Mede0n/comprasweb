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
        User <input type="text" name="user" placeholder="user" class="form-control">
        </div>
        <div class="form-group">
        Password <input type="text" name="password" placeholder="password" class="form-control">
        </div>

		</BR>
<?php
	echo '<div><input type="submit" value="Alta Cliente"></div>
	</form>';
} else {
    $user=$_POST['user']; 
    $verdad=false;
    $pass=$_POST['password'];
    $sql="SELECT nombre , passwor from CLIENTE ";
    $resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			if($user==$row['nombre'] and $pass==$row['passwor']){
                $verdad=true;
            }
		}
    }
    if($verdad){
        session_start();
        $procan[0]=$cantidad;
        $procan[1]=$producto;
        $_SESSION['nombre']=$user;
        $_SESSION['procan']=$procan;
        header("Location: menu2.php");
    }else {
        header("Location: entrar.php");
    }
    
}
?>

</body>

</html>