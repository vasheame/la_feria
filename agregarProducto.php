<?php
include 'conexion.php';

$producto=$_REQUEST['txtProducto'];
$cantidad=$_REQUEST['txtCantidad'];
$precioCompra=$_REQUEST['txtPrecioCompra'];
$precioVenta=$_REQUEST['txtPrecioVenta'];
$medida=$_REQUEST['txtMedida'];

$producto = trim($producto);
/**
 * Función para quitar tildes, mas abajo tambien se realiza un trim, es para que el usuario no tenga problemas manejando los productos
 * @param  [String] Se ingresa una valor
 * @return [String] Retorna un valor sin tildes
 */
function quitar_tildes($cadena) {
$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}

$productonew = quitar_tildes($producto);
$productonew = strtolower($productonew);


if(empty($producto)     || 
   empty ($cantidad) || 
   empty ($precioCompra) || 
   empty($precioVenta))
die("Error, debe ingresar todos los datos del producto");

/**
 * Se consulta la BBDD para no enviar un dato repetido
 * @var string
 */
$sentenciaSql1="select * from inventario where producto = '$productonew'";

$respuesta=mysql_query($sentenciaSql1,$conexion) or die("Error en la db ".mysql_error());
$row = mysql_fetch_array($respuesta);
if ($row['producto'] == $producto) {

	$nuevaCantidad = $row['cantidad'] + $cantidad;
/**
 * Si el producto se encuentra ya ingresado se actualiza la cantidad, al sumarle la cantidad ingresa ahora
 * @var string
 */
	$sentenciaSql="update inventario set producto='$productonew', cantidad=$nuevaCantidad, precioCompra=$precioCompra, precioVenta=$precioVenta where producto ='$producto'";

	if(!$respuesta=mysql_query($sentenciaSql,$conexion)){
	echo "Error: No se insertaron los datos ". mysql_error()." <br>";
	sleep(1);
	header('Location: buscarProducto.php');
	}
	else {
	sleep(1);
	header('Location: buscarProducto.php');
	}
	}
	else {
		/**
		 * Si el producto no existe se ingresa un nuevo producto
		 * @var string
		 */
	$sentenciaSql="Insert into inventario values(0,'$productonew',$cantidad,$precioCompra,$precioVenta, 'sinimagen.jpg','$medida')";

	if(!$respuesta=mysql_query($sentenciaSql,$conexion)){
	echo "Error: No se insertaron los datos ". mysql_error()." <br>";
	sleep(1);
	header('Location: buscarProducto.php');
	}
	else {
	echo "Mensaje: Datos Insertados correctamente";
	sleep(1);
	header('Location: buscarProducto.php');
	}
	}



mysql_close($conexion);
?>