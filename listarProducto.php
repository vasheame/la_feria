<html>
  <head>

  	<?php
		include 'conexion.php';
		session_start();
		/**
		 * Función creada para eliminar los datos de una fila
		 */
	if(filter_input(INPUT_GET, 'action') == 'delete'){
	$id = filter_input(INPUT_GET, 'id');

	$sentenciaSql="delete from inventario where id=$id";
	

	if(!$respuesta=mysql_query($sentenciaSql,$conexion))
	echo "Error: No se eliminaron los datos del Producto". mysql_error()." <br>";
	else {
	    echo "Mensaje: Datos Datos eliminados correctamente";
	    mysql_close($conexion);
}
}

?>
  <title>Datos Usuarios</title> 
   <meta charset="UTF-8">
    <title>Ejemplo Bootstrap</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<div class="container">
<?php
include 'conexion.php';
 /**
  * Se agrega esta opción para que muestre el stock critico solicitado por el usuario
  */
 if(filter_input(INPUT_GET, 'action') == 'listar'){
  $cant=$_REQUEST['cant'];
  $sentenciaSql1="select * from inventario where cantidad <= $cant";
 }
 else{
 /**
  * [$sentenciaSql1 Sentencia utilizada para recoger los datos y luego listarlos]
  * @var string
  */
 $sentenciaSql1="select * from inventario";
}
$respuesta=mysql_query($sentenciaSql1,$conexion) or die("Error en la db ".mysql_error());

echo      '<table class="table table-striped">';
echo      '<thead>';
echo      '<tr>';
echo      '<th scope="col">#</th>';
echo      '<th scope="col">Producto</th>';
echo      '<th scope="col">Cantidad</th>';
echo      '<th scope="col">Precio Compra</th>';
echo      '<th scope="col">Precio Venta</th>';
echo      '<th scope="col">Tipo de Stock</th>';
if ($_SESSION["usuario"]=='admin'){
echo      '<th scope="col">Borrar?</th>';
}

echo    "</tr>";
echo  "</thead>";
echo  "<tbody>";

while ($row = mysql_fetch_array($respuesta)){


 
  echo     '<tr>';
  echo    '<th scope="row">'.$row['id'].'</th>';
  echo    "<td>".$row['producto']."</td>";
  echo    "<td>".$row['cantidad']."</td>";
  echo    "<td>".$row['precioVenta']."</td>";
  echo    "<td>".$row['precioCompra']."</td>";
  echo    "<td>".$row['medida']."</td>";
    if ($_SESSION["usuario"]=='admin'){
  echo "<td>";
  echo        "<a href='listarProducto.php?action=delete&id=".$row['id']."'>";
  echo         "<div class='btn-danger'>eliminar</div>";
  echo        "</a>";
  echo      "</td>";
 }
  echo  "</tr>"; 


}
echo  "  </tbody>";
echo "</table>";

mysql_close($conexion);
?>

    <div class="boton1">
    <a href="buscarProducto.php">
    <button type="button" class="btn btn-secondary float-right">Volver</button>
    </a>
    </div>
</div>
<body>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>

  </body>
 </html>