<html>
  <head>

    <?php
    include 'conexion.php';
    session_start();
    /**
     * Función utilizada para eliminar filas segun el id ingresado
     */
  if(filter_input(INPUT_GET, 'action') == 'delete'){
  $id = filter_input(INPUT_GET, 'id');

  $sentenciaSql="delete from usuario where id=$id";
  

  if(!$respuesta=mysql_query($sentenciaSql,$conexion))
  echo "Error: No se eliminaron los datos del Producto". mysql_error()." <br>";
  else {
      
      mysql_close($conexion);
}
}

?>
  <title>Datos Usuarios</title> 
   <meta charset="UTF-8">
    <title>Ejemplo Bootstrap</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
</head>
<div class="container">
<?php
include 'conexion.php';

/**
 * [$sentenciaSql1 Sentencia utilizada para leer los datos de la tabla]
 * @var string
 */
$sentenciaSql1="select * from usuario";

$respuesta=mysql_query($sentenciaSql1,$conexion) or die("Error en la db ".mysql_error());

echo '<table class="table table-striped">';
echo  '<thead>';
echo    '<tr>';
echo      '<th scope="col">#</th>';
echo      '<th scope="col">Nombre Usuario</th>';
echo      '<th scope="col">Password</th>';
echo      '<th scope="col">Mail</th>';
echo      '<th scope="col">Tipo de Usuario</th>';
echo      '<th scope="col">Eliminar</th>';

echo    "</tr>";
echo  "</thead>";
echo  "<tbody>";

while ($row = mysql_fetch_array($respuesta)){


 
  echo     '<tr>';
  echo    '<th scope="row">'.$row['id'].'</th>';
  echo    "<td>".$row['nombreUsuario']."</td>";
  echo    "<td>".$row['password']."</td>";
  echo    "<td>".$row['mail']."</td>";
  echo    "<td>".$row['tipo']."</td>";
  if ($_SESSION["usuario"]=='admin'){
  echo "<td>";
  echo        "<a href='listarUsuario.php?action=delete&id=".$row['id']."'>";
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
    <a href="buscarUsuario.php">
<button type="button" class="btn btn-secondary float-right">Volver</button>    </a>
    </div>

  </div>
<body>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>

  </body>
 </html>