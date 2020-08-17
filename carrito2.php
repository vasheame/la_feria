<?php
include 'array_column.php';
include 'conexion.php';
session_start();
$products_ids = array();
$total=0;

/**
 * Si se clickea el boton agregar se guarda en un array los datos asociados al producto
 */
if (filter_input(INPUT_POST, 'agregar')) {
	if (isset($_SESSION['shoppping_cart'])) {
		/**
		 * [$count el Contador es para saber si la sesión sigue activa]
		 * @var [type]
		 */
		$count = count($_SESSION['shoppping_cart']);

		$products_ids = array_column($_SESSION['shoppping_cart'], 'id');


		if (!in_array(filter_input(INPUT_GET, 'id'), $products_ids)) {
		$_SESSION['shoppping_cart'][$count] = array(
				/**
				 * Si el producto no existe aun en el array se crea
				 */
			'id' => filter_input(INPUT_GET, 'id'),
			'producto' => filter_input(INPUT_POST, 'producto'),
			'precio' => filter_input(INPUT_POST, 'precio'),
			'cantidad' => filter_input(INPUT_POST, 'cantidad')
		);
		}
		else {
			for ($i=0; $i < count($products_ids); $i++) { 
				if ($products_ids[$i] == filter_input(INPUT_GET, 'id')) {
					/**
					 * Cuando el producto si existe en el array se agrega más cantidad
					 */
					$_SESSION['shoppping_cart'][$i]['cantidad'] += filter_input(INPUT_POST, 'cantidad');
				}
			}
		}
	}
	else {
		$_SESSION['shoppping_cart'][0] = array(
			'id' => filter_input(INPUT_GET, 'id'),
			'producto' => filter_input(INPUT_POST, 'producto'),
			'precio' => filter_input(INPUT_POST, 'precio'),
			'cantidad' => filter_input(INPUT_POST, 'cantidad')
		);


	}
}

if(filter_input(INPUT_GET, 'action') == 'vender'){
		/**
		 * [$total2 Se recupera el valor de la suma de los productos]
		 * @var [type]
		 */
		$total2 = filter_input(INPUT_GET, 'id');

        if ($_SESSION["usuario"]== 'admin'){
         /**
          * [$sentenciaSql4 Si el usuario es admin queda registrado en la BBDD]
          * @var string
          */
		$sentenciaSql4="Insert into venta values(0,1,$total2,NOW())";   
		}
		if ($_SESSION["usuario"]== 'usuario') {
			/**
			 * [$sentenciaSql4 Si no queda registrado como user]
			 * @var string
			 */
		$sentenciaSql4="Insert into venta values(0,2,$total2,NOW())";	
		}
		if(!$respuesta=mysql_query($sentenciaSql4,$conexion)){}
		
		
			/**
			 * Se agregan los distintos producto a la base de datos, para esto se actualizan 2 tablas, la de ventas y la de detalle de venta.
			 * @var [type]
			 */
	foreach ($_SESSION['shoppping_cart'] as $key => $product) {

		$sentenciaSql2="select * from inventario where producto = '$product[producto]'";

		$respuesta=mysql_query($sentenciaSql2,$conexion) or die("Error en la db ".mysql_error());
		$row = mysql_fetch_array($respuesta);
		if ($row['producto'] == $product['producto']) {

		$nuevaCantidad = $row['cantidad'] - $product['cantidad'];

		if ($nuevaCantidad < 0) {
			
		}
		else {
			/**
			 * esta tabla solo recibe un update ya que se tienen que descontar los productos vendidos
			 * @var string
			 */
		$sentenciaSql="update inventario set cantidad=$nuevaCantidad where producto ='$product[producto]'";

		if(!$respuesta=mysql_query($sentenciaSql,$conexion)){

		}
		
		else {
			/**
			 * Se busca el ultimo dato ingresado para poder tener la id y que las tablas queden referidas
			 * @var string
			 */
				$sentenciaSql5="SELECT * FROM venta ORDER BY id DESC LIMIT 1;";
				$respuesta1=mysql_query($sentenciaSql5,$conexion) or die("Error en la db ".mysql_error());
				$row1 = mysql_fetch_array($respuesta1);

				$sentenciaSql3="Insert into detalleventa values(0,$row1[id],$product[id],$product[cantidad]);";

				if(!$respuesta=mysql_query($sentenciaSql3,$conexion)){}
				
	}
	}
	}
}
	unset($_SESSION['shoppping_cart']);
}
/**
 * Función que permite borrar productos del array creado anteriormente
 */
if(filter_input(INPUT_GET, 'action') == 'delete'){

	foreach ($_SESSION['shoppping_cart'] as $key => $product) {
		if ($product['id']  == filter_input(INPUT_GET, 'id')) {
			unset($_SESSION['shoppping_cart'][$key]);
		}
	}

	$_SESSION['shoppping_cart'] = array_values($_SESSION['shoppping_cart']);
}


?>
<html>
  <head>
  <title>Datos Usuarios</title> 
   <meta charset="UTF-8">
    <title>Ejemplo Bootstrap</title>
   
<link rel="stylesheet" href="estilos.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>
 <body>
<div class="container">
  <?php
include 'conexion.php';

/**
 * [$sentenciaSql1 Se utiliza esta sentencia para recoger los datos de los productos y ponerlos en la pagina web]
 * @var string
 */
$sentenciaSql1="select * from inventario";
$respuesta=mysql_query($sentenciaSql1,$conexion) or die("Error en la db ".mysql_error());
	while ($product = mysql_fetch_assoc($respuesta)){
		?>
		<div class="col-sm-4 col-md-3">
			<form method="post" action="carrito2.php?action=add&id=<?php echo $product['id']; ?>">
				<div class="products">
					<img src="<?php echo $product['foto']; ?>" class="img-responsive"/>
					<h4 class="text-info"><?php echo $product['producto']; ?></h4>
					<h4><?php echo $product['precioVenta']; ?></h4>
					<input type="text" name="cantidad" class="form-control" value="1"/>
					<input type="hidden" name="producto" value="<?php echo $product['producto']; ?>" />
					<input type="hidden" name="precio" value="<?php echo $product['precioVenta']; ?>" />
					<input type="submit" name="agregar" class="btn btn-success" style="margin-top: 5px" value="agregar">

				</div>
			</form>
		</div>
  
 <?php
}

mysql_close($conexion);
?>


<div style="clear:both"></div>

<br />
<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group btn-group-lg" role="group" aria-label="First group">
  	<a href="listarVentas.php">
    <button type="button" class="btn btn-success">Listar Ventas</button>
	</a>
    <a href="calcularVentas.php">
    <button type="button" class="btn btn-success">Calcular Ventas Diarias</button>
	</a>
<a href="menuAdmin.php">
    <button type="button" class="btn btn-secondary float-right">Volver</button>
    </a>
  <br>
    
    
  </div>
  
<div class="table-responsive">
	<table class="table">
		<tr><th colspan="5"><h3>Detalle de la orden</h3></th></tr>
		<tr>
			<th width="40%">Nombre Producto</th>
			<th width="10%">Cantidad</th>
			<th width="20%">Precio</th>
			<th width="10%">Total</th>
			<th width="5%">Accion</th>
		</tr>
		<?php
		if (!empty($_SESSION['shoppping_cart'])) {
			
			$total = 0;

			foreach ($_SESSION['shoppping_cart'] as $key => $product) {
			?>
			<tr>
				<td><?php echo $product['producto']; ?></td>
				<td><?php echo $product['cantidad']; ?></td>
				<td>$ <?php echo $product['precio']; ?></td>
				<td>$ <?php echo number_format($product['cantidad'] * $product['precio'], 2); ?></td>
				<td>
					<a href="carrito2.php?action=delete&id=<?php echo $product['id']; ?>">
						<div class="btn-danger">Quitar</div>
					</a>
				</td>
			</tr>

			<?php 
					$total = $total + ($product['cantidad'] * $product['precio']);
			}
			?>
			<tr>
				<td colspan="3" align="right">Total</td>
				<td align="right">$ <?php echo number_format($total, 2); ?></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="5">
					<?php
						if (isset($_SESSION['shoppping_cart'])):
							if (count($_SESSION['shoppping_cart']) > 0):
							?>
							<a href="carrito2.php?action=vender&id=<?php echo $total; ?>" class="button1">Checkout</a>

							<?php endif; endif; ?> 
				</td>	
			</tr>
			<?php
		}
		?>
	</table>
</div>
    
</div>
</body>
</html>

		
		
			
		

</div>
			
				

</body>