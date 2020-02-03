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
    if (!isset($_POST) || empty($_POST)) { 
    echo '<form action="" method="post">';
    
    ?>
    <div class="form-group">
        Fecha Entrada <input type="date" name="fecha_e" placeholder="fecha" class="form-control">
        </div>
        <div class="form-group">
        Fecha Fin <input type="date" name="fecha_f" placeholder="fecha" class="form-control">
        </div>
        </div>
        <div><input type="submit" value="Consultar Compras"></div>
        <a href="menu2.php"> Volver a menu </a>
	</form>
    <?php   
     
    
      }  else {
    session_start();
    $user=$_SESSION['nombre'];
    $fechae=$_POST['fecha_e'];
$fechaf=$_POST['fecha_f'];
    $nif=obtenerdni($user,$db);
    $sql="SELECT id_producto,fecha_compra,unidades from COMPRA where '$nif'=nif and fecha_compra>='$fechae' and fecha_compra<='$fechaf'";
    $resultado = mysqli_query($db, $sql);
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "producto = ".$row['id_producto']." fecha = ".$row['fecha_compra']." unidades = ".$row['unidades'];
            echo "<br>";
        }
    }
    echo "<a href='menu2.php'>Volver al menu </a>";
}
    function obtenerdni($user,$db){
        $sql = "SELECT nif FROM cliente where '$user'=nombre";
        $resultado = mysqli_query($db, $sql);
        if ($resultado) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $nif = $row['nif'];
            }
        }
        return $nif;
    }
    ?>
</body>
</html>