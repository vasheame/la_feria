<html>
  <head>
  <title>Datos Usuarios</title> 
   <meta charset="UTF-8">
    <title>Ejemplo Bootstrap</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
  <?php
  // Declaro VARIABLES GLOBALES
  $producto="";
  $cantidad="";
  $precioCompra="";
  $precioVenta="";
  session_start();
  
  /**
   * Función que busca los datos en la bbdd
   * @param  [String] $producto, se ingresa el nombre del producto
   * @return [array] Retorna el resto de los datos del producto
   */
  function buscarDatos($producto)
  {	
    $host_db="localhost:3307";
    $user="root";
    $password="usbw";
    $db="feria";        
    if (!$conexion = mysql_connect($host_db, 
	$user, $password))
    die(mysql_error());
	mysql_select_db($db, $conexion);
	include "conexion.php";
   $consulta = "select * from inventario
   where producto = '$producto'";
   if ($result=mysql_query($consulta,$conexion))
   { 
    $numRow=mysql_num_rows($result);
					 
	if($numRow==0){
	  die("No existen datos asociados al Producto:$producto.");
		sleep(3);
		header('Location: buscarProducto.php');
	}
	else
	{
	   while ($row = mysql_fetch_array($result))
	   {  
        global $cantidad;// recupero variables global
        global $precioCompra;
		global $precioVenta;// recupero variables global
		
	    $cantidad=$row['cantidad'];
        $precioCompra=$row['precioCompra'];
        $precioVenta=$row['precioVenta'];
        
        

	   }
    }
	mysql_close($conexion);
   }
  else
    die("Error, en query".mysql_error());
 }
?>  

<script language="JavaScript">
	/**
	 * Función que envia a la pagina de modificar
	 * pasando los datos por la funcion de validación primero
	 */
    function modificar()
      { 
      	if (validacion()==0) {
	    document.formulario.action=
		"modificarProducto.php";
		document.formulario.submit();
		}
	  }
	  /**
	   * Función que envia a la pagina de agregar los datos
	   * pasando por la validación
	   */
	function agregar()
      { 
      	if (validacion()==0){
	    document.formulario.action=
		"agregarProducto.php";
		document.formulario.submit();
		}
	  }  
	  /**
	   * Función que envia a la pagina de listar
	   */
	function listar()
      { 
      	
	    document.formulario.action=
		"listarProducto.php";
		document.formulario.submit();
		
	  }   
    function eliminar()
      {
	   res=prompt("Esta seguro de Borrar [y/n]","")
	   if (res=="y" || res=="Y")
	     {    document.formulario.action="eliminarProducto.php";
	      document.formulario.submit();
         }		 
	  }
	function validacion() {
 		valor = document.getElementById("txtProducto").value;
			if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
				alert('[ERROR] Debe escribir un Producto');
  			return 1;
		} 
  
		valor1 = document.getElementById("txtCantidad").value;
			if( isNaN(valor1) ) {
				alert('[ERROR] Debe escribir solo numeros');
  			return 1;
		} 
		valor2 = document.getElementById("txtPrecioVenta").value;
			if( isNaN(valor2) ) {
				alert('[ERROR] Debe escribir solo numeros');
  			return 1;
		} 
		valor3 = document.getElementById("txtPrecioCompra").value;
			if( isNaN(valor3) ) {
				alert('[ERROR] Debe escribir solo numeros');
  			return 1;
		} 
			return 0;
		}
  // Si el script ha llegado a este punto, todas las condiciones
 
		
</script>
</head>
<body>

<?php	
/**
 * Función que realiza la busqueda al clickear en boton buscar
 */
	  if(isset($_REQUEST['accion']) && 
	  !empty($_REQUEST['accion']))
	     {
		   $accion=$_REQUEST['accion'];
		   if ($accion=="Buscar")
		     {
               $producto=$_REQUEST['txtProducto'];
			   if(!empty($producto) &&!($producto == "")) {
                       buscarDatos($producto);
					    
			   } else {
			        echo "Error, ... ingrese Producto";
			        sleep(1);
             		header('Location: buscarUsuario.php');
			    }
			   
			 }
		 }
	  
	?>

<div class="container">
	
    

    <form name='formulario'
	      id='formulario'
	      method='POST' 
	      action= 'buscarProducto.php'
	      >

	      <div class="form-group row">
    <label for="txtProducto" class="col-sm-2 col-form-label">Producto</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="txtProducto" name="txtProducto" placeholder="producto" value=<?php echo $producto ?>>
      
    </div>
  </div>
  <div class="form-group row">
    <label for="txtCantidad" class="col-sm-2 col-form-label">Cantidad</label>
    <div class="col-sm-10">
      <input type="number" class="form-control"  id="txtCantidad" name="txtCantidad" placeholder="Cantidad" value=<?php echo $cantidad ?>>
    </div>
  </div>
  <div class="form-group row">
   <label for="txtPrecioCompra" class="col-sm-2 col-form-label">Precio Compra</label>
    <div class="col-sm-10">
      <input type="number" class="form-control"  id="txtPrecioCompra" name="txtPrecioCompra" placeholder="$$$" value=<?php echo $precioCompra ?>>
      
    </div>
  </div>
  <div class="form-group row">
   <label for="txtPrecioVenta" class="col-sm-2 col-form-label">Precio Venta</label>
    <div class="col-sm-10">
      <input type="number" class="form-control"  id="txtPrecioVenta" name="txtPrecioVenta" placeholder="$$$" value=<?php echo $precioVenta ?>>
      
    </div>
  </div>
   <div class="form-group row">
 <div class="col-auto my-1">
      <label class="mr-sm-2" for="inlineFormCustomSelect">Seleccione el tipo de medida: </label>
      <select class="custom-select mr-sm-2" id="txtMedida" name="txtMedida">
        <option selected>Choose...</option>
        <option value="Kilogramos">Kilogramos</option>
        <option value="Unidades">Unidades</option>
        
      </select>
    </div>
</div>



 			<input type='button' 
		       name='accion'
			   value='Agregar'
			   OnClick='JavaScript:agregar();'
			   class="btn btn-success">
	
			   <button type="submit" name='accion'
			   value='Buscar' class="btn btn-success">Buscar</button>  

		     <input type='button' 
		       name='accion'
			   value='Borrar'
			    <?php 
         		if ($_SESSION["usuario"]!='admin'){
         		echo 'disabled="disabled"';
         		}
         		?> 
			   OnClick='JavaScript:eliminar();'
			   class="btn btn-success">
			 <input type='button' 
		       name='accion'
			   value='Modificar'
			   <?php 
         		if ($_SESSION["usuario"]!='admin'){
         		echo 'disabled="disabled"';
         		}
         		?> 
			   OnClick='JavaScript:modificar();'
			   class="btn btn-success">
			 <input type='button' 
		       name='accion'
			   value='Listar'
			   OnClick='JavaScript:listar();'
			   class="btn btn-success">

			   <a href="stock.php">
   			 <button type="button" class="btn btn-success">Stock critico</button>
				</a>
	
  </form>
  <div class="boton1">
	<a href="menuAdmin.php">
    <button type="button" class="btn btn-secondary float-right">Volver</button>
	</a>
	</div>
  

  </div>

 
 
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>

  </body>
 </html>