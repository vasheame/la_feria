<html>
  <head>
  <title>Menu Admin</title> 
   <meta charset="UTF-8">
    <title>Ejemplo Bootstrap</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">


</head>
<body>
	<div class="container">
<div class="card-deck">
<?php 
session_start();
/**
 * Solo el admin puede acceder a ciertas partes de la aplicación
 */
if ($_SESSION["usuario"]=='admin'){

echo '	

  <div class="card border-success mb-3">
  	<a href="buscarUsuario.php">
    <img src="usuario.jpeg" class="card-img-top" alt="...">
    </a>
    <div class="card-body">
      <h5 class="card-title">Usuarios</h5>
      <p class="card-text">Haga click en la imagen para ir al menu de Usuarios</p>
    
    </div>
  </div>';
   } ?>
  <div class="card border-success mb-3">
    <a href="carrito2.php">
    <img src="ventas2.jpeg" class="card-img-top" alt="...">
    </a>
    <div class="card-body">
      <h5 class="card-title">Ventas</h5>
      <p class="card-text">Haga click en la imagen para ir al menu de Ventas</p>
    
    </div>
  </div>
  <div class="card border-success mb-3">
    <a href="buscarProducto.php">
    <img src="inventario.jpeg" class="card-img-top" alt="...">
    </a>
    <div class="card-body">
      <h5 class="card-title">Inventario</h5>
      <p class="card-text">Haga click en la imagen para ir al menu de Inventario</p>
      
    </div>

  </div>

    
</div>
<div class="boton1">
    <a href="login2.php">
	<button type="button" class="btn btn-secondary float-right">Volver</button>
    </a>
    </div>
 
 
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>

  </body>
 </html>