<?php
include 'conexion.php';
session_start();
/**
 * Función creada para eliminar una fila de la tabla en cuestion
 * Recibe el id de la tabla, pero también elimina los datos de la otra tabla asacioda
 */
if(filter_input(INPUT_GET, 'action') == 'delete'){
$id = filter_input(INPUT_GET, 'id');

$sentenciaSql="delete from venta where id=$id";
$sentenciaSql3="delete from detalleVenta where idVenta=$id";

if(!$respuesta=mysql_query($sentenciaSql,$conexion))
echo "Error: No se eliminaron los datos del Producto". mysql_error()." <br>";
else {
   $sentenciaSql3="delete from detalleVenta where idVenta=$id";
    if(!$respuesta=mysql_query($sentenciaSql3,$conexion))
    echo "Error: No se eliminaron los datos del Producto". mysql_error()." <br>";
    else{
      mysql_close($conexion);
}
}
}
?>

<html>
  <head>
  <title>Datos Usuarios</title> 
   <meta charset="UTF-8">
    <title>Ejemplo Bootstrap</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<div class="container">
<?php
include 'conexion.php';

if(filter_input(INPUT_GET, 'action') == 'listar'){
  $fecha=$_REQUEST['fecha'];
$total = 0;
/**
 * [$sentenciaSql1 Sentencia usada para leer los datos de la tabla en la fecha en cuestión]
 * Mas adelante se calcula el total de ventas por día
 * @var string
 */
$sentenciaSql1="select * from venta where fecha='$fecha'";

$respuesta=mysql_query($sentenciaSql1,$conexion) or die("Error en la db ".mysql_error());

echo '<table class="table table-striped">';
echo  '<thead>';
echo    '<tr>';
echo      '<th scope="col">ID</th>';
echo      '<th scope="col">ID Usuario</th>';

echo      '<th scope="col">Fecha</th>';
echo      '<th scope="col">Productos</th>';
echo      '<th scope="col">Precio Venta</th>';
echo      '<th scope="col">Borrar?</th>';

echo    "</tr>";
echo  "</thead>";
echo  "<tbody>";

while ($row = mysql_fetch_array($respuesta)){

/**
 * [$sentenciaSql2 se leen los datos de la tabla detalleVenta para así mostrar la información con más detalle en esta tabla]
 * @var string
 */
$sentenciaSql2="select * from detalleVenta where idVenta=$row[id]";
$respuesta2=mysql_query($sentenciaSql2,$conexion) or die("Error en la db ".mysql_error()); 

  echo     '<tr>';
  echo    '<th scope="row">'.$row['id'].'</th>';
  echo    "<td>".$row['idUsuario']."</td>";
  
  echo    "<td>".$row['fecha']."</td>";
  echo "<td>";
  while ($row2 = mysql_fetch_array($respuesta2)) {

   $sentenciaSql5="select * from inventario where id=$row2[idProducto]"; 
   $respuesta5=mysql_query($sentenciaSql5,$conexion) or die("Error en la db ".mysql_error());
   $row5 = mysql_fetch_array($respuesta5);


   echo "".$row2['cantidad']." x ".$row5['producto'];
   echo "</br>";
   
  }            
  echo "</td>";
  echo    "<td>".$row['precioVenta']."</td>";
  if  ($_SESSION["usuario"]=='admin'){
  echo "<td>";
  echo        "<a href='listarVentas.php?action=delete&id=".$row['id']."'>";
  echo         "<div class='btn-danger'>eliminar</div>";
  echo        "</a>";
  echo      "</td>";
 }
  echo  "</tr>"; 
$total = $total + $row['precioVenta'];

}
echo  "  </tbody>";
echo "</table>";

mysql_close($conexion);

if ($total==0) {
  echo "<div class='alert alert-secondary' role='alert'>";
echo  "No se registraron ventas ese dia";
echo "</div>";
}else {
echo "<div class='alert alert-secondary' role='alert'>";
echo  "El Total del dia es: ".$total;
echo "</div>";
}
  
}





else{ 
  /**
   * [$sentenciaSql1 La misma sentencia anterior pero para todos los datos no por día]
   * @var string
   */
$sentenciaSql1="select * from venta ORDER by id DESC";  
$respuesta=mysql_query($sentenciaSql1,$conexion) or die("Error en la db ".mysql_error());

echo '<table class="table table-striped">';
echo  '<thead>';
echo    '<tr>';
echo      '<th scope="col">ID</th>';
echo      '<th scope="col">ID Usuario</th>';

echo      '<th scope="col">Fecha</th>';
echo      '<th scope="col">Productos</th>';
echo      '<th scope="col">Precio Venta</th>';
echo      '<th scope="col">Borrar?</th>';

echo    "</tr>";
echo  "</thead>";
echo  "<tbody>";

while ($row = mysql_fetch_array($respuesta)){

$sentenciaSql2="select * from detalleVenta where idVenta=$row[id]";
$respuesta2=mysql_query($sentenciaSql2,$conexion) or die("Error en la db ".mysql_error()); 

  echo     '<tr>';
  echo    '<th scope="row">'.$row['id'].'</th>';
  echo    "<td>".$row['idUsuario']."</td>";
  
  echo    "<td>".$row['fecha']."</td>";
  echo "<td>";
  while ($row2 = mysql_fetch_array($respuesta2)) {

   $sentenciaSql5="select * from inventario where id=$row2[idProducto]"; 
   $respuesta5=mysql_query($sentenciaSql5,$conexion) or die("Error en la db ".mysql_error());
   $row5 = mysql_fetch_array($respuesta5);


   echo "".$row2['cantidad']." x ".$row5['producto'];
   echo "</br>";
   
  }            
  echo "</td>";
  echo    "<td>".$row['precioVenta']."</td>";
  if ($_SESSION["usuario"]=='admin'){
  echo "<td>";
  echo        "<a href='listarVentas.php?action=delete&id=".$row['id']."'>";
  echo         "<div class='btn-danger'>eliminar</div>";
  echo        "</a>";
  echo      "</td>";
 }
  echo  "</tr>"; 


}
echo  "  </tbody>";
echo "</table>";

mysql_close($conexion);
}
?>
<div class="boton1">
<a href="carrito2.php">
    <button type="button" class="btn btn-secondary float-right">Volver</button>
</a>
</div>

</div>
</body>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>

  
 </html>