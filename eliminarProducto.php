<?php
include 'conexion.php';

$producto=$_REQUEST['txtProducto'];
$cantidad=$_REQUEST['txtCantidad'];
$precioCompra=$_REQUEST['txtPrecioCompra'];
$precioVenta=$_REQUEST['txtPrecioVenta'];


if(empty($producto)     || 
   empty($cantidad) || 
   empty($precioCompra) || 
   empty($precioVenta))
      die("Error, debe ingresar todos los datos del alumno");

/**
 * [$sentenciaSql Otra manera de eliminar productos]
 * @var string
 */
$sentenciaSql="delete from inventario where producto='$producto'";

if(!$respuesta=mysql_query($sentenciaSql,$conexion)){
echo "Error: No se eliminaron los datos del Producto". mysql_error()." <br>";
sleep(1);
header('Location: buscarProducto.php');
}
else{
echo "Mensaje: Datos Datos eliminados correctamente";
sleep(1);
header('Location: buscarProducto.php');
mysql_close($conexion);
}
?>