<?php
include 'conexion.php';

$producto=$_REQUEST['txtProducto'];
$cantidad=$_REQUEST['txtCantidad'];
$precioCompra=$_REQUEST['txtPrecioCompra'];
$precioVenta=$_REQUEST['txtPrecioVenta'];
$medida=$_REQUEST['txtMedida'];


/**
 * Tienen que estar todos los datos para poder hacer una actualización
 */
if(empty($producto)     || 
   empty ($cantidad) || 
   empty ($precioCompra) || 
   empty($precioVenta))
die("Error, debe ingresar todos los datos del producto");
/**
 * Se actualizan los datos de un producto a elección
 * @var string
 */
$sentenciaSql="update inventario set producto='$producto', cantidad='$cantidad', precioCompra='$precioCompra', precioVenta='$precioVenta', medida='$medida'  where producto ='$producto'";

if(!$respuesta=mysql_query($sentenciaSql,$conexion)){
echo "Error: No se modificaron los datos ". mysql_error()." <br>";
sleep(1);
header('Location: buscarProducto.php');
}
else{
echo "Mensaje: Datos modificados correctamente";
sleep(1);
header('Location: buscarProducto.php');
mysql_close($conexion);
}
?>
