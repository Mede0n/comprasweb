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
    
    session_start();
    $procan=$_SESSION['procan'];
    $user=$_SESSION['nombre'];
    $nif=obtenerdni($user,$db);
    $mostrar="";
    for ($i=0; $i < sizeof($procan[0]); $i++) { 
        $nombre=producto($procan[1][$i],$db);
        $poder=obtenerdispo($procan[1][$i],$procan[0][$i],$db);
        if($poder){
alta($nif,$procan[1][$i],$procan[0][$i],$db);       
        } 
        else {
            $mostrar= $mostrar."Error en la compra del producto ".$nombre." con la cantidad ".$procan[0][$i]."<br>";
        }
    }
    session_unset();
    $acant=array();
    $apro=array();
    $procan[0]=$acant;
    $procan[1]=$apro;
    $_SESSION['nombre']=$user;
    $_SESSION['procan']=$procan;
    
    echo $mostrar;
    echo "<a href='menu2.php'>Volver al menu </a>";
    echo "<br>";
    echo "<a href='cerrarsesion.php'>Cerrar Sesion</a>";

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
    function producto($id,$db){
        $sql = "SELECT nombre FROM producto where '$id'=id_producto";
        $resultado = mysqli_query($db, $sql);
        if ($resultado) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $nombre = $row['nombre'];
            }
        }
        return $nombre;
    }
    function obtenerdispo($idproducto,$cantidad,$db){
        $producto = array();	
        $sql = "SELECT cantidad FROM ALMACENA where id_producto='$idproducto' ";
        $resultado = mysqli_query($db, $sql);
        if ($resultado) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $producto[] = $row['cantidad'];
            }
        }
        $suma=array_sum($producto);
        if($suma>=$cantidad){
$poder=true;

        }else {
            $poder=false;
        }
        return $poder;
    }
    function alta($nif,$idproducto,$unidades,$db){
        $fecha=gmdate('Y-m-d');
        $sql = "INSERT INTO COMPRA VALUES('$nif','$idproducto','$fecha','$unidades')";
        mysqli_query($db,$sql);
        $sql2= "SELECT cantidad,num_almacen from almacena where id_producto='$idproducto' ";
       $resultado= mysqli_query($db,$sql2);
       while ($row = mysqli_fetch_assoc($resultado)) {
        $cantidad[] = $row['cantidad'];
        $almacen[] = $row['num_almacen'];
    }
    $verdad=true;
    $i=0;
    while ($i < sizeof($almacen) && $verdad==true) {
        $unidades=$unidades-$cantidad[$i];
        if ($unidades>0) {
        $sql3= "UPDATE almacena set cantidad=0 where id_producto='$idproducto ' and num_almacen='$almacen[$i]' ";
        mysqli_query($db,$sql3);
        }else {
            $uni=abs($unidades);
            $sql3= "UPDATE almacena set cantidad='$uni' where id_producto='$idproducto ' and num_almacen='$almacen[$i]' ";
            mysqli_query($db,$sql3);
            $verdad=false;
        }
        $i++;
    }
    }
    ?>
</body>
</html>