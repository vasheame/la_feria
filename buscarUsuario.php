<html>
  <head>
  <title>Datos Usuarios</title> 
   <meta charset="UTF-8">
    <title>Ejemplo Bootstrap</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
  <?php
  // Declaro VARIABLES GLOBALES
  $user1="";
  $pass="";
  $mail="";
  $tipo="";
  
  /**
   * Función utilizada para buscar usuarios
   * @param  [String] Se ingresa el usuario a buscar
   * @return [array] Retorna los otros datos del usuario
   */
  function buscarDatos($user1)
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
   $consulta = "select * from usuario
   where nombreUsuario = '$user1'";
   if ($result=mysql_query($consulta,$conexion))
   { 
    $numRow=mysql_num_rows($result);
					 
	if($numRow==0){
	  die("No existen datos asociados al Usuario:$user1.");
    sleep(3);
    header('Location: buscarUsuario.php');
  }
	else
	{
	   while ($row = mysql_fetch_array($result))
	   {  
        global $pass;// recupero variables global
        global $mail;
		global $tipo;// recupero variables global
		
	    $pass=$row['password'];
        $mail=$row['mail'];
        $tipo=$row['tipo'];
        
        

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
   * Función que envia los datos hacia la pagina que los modifica
   * Pasando por la funcion para validar primero
   */
    function modificar()
      { 
      	if (validacion()==0) {
	    document.formulario.action=
		"modificarUsuario.php";
		document.formulario.submit();
		}
	  }
    /**
   * Función que envia los datos hacia la pagina que los agrega
   * Pasando por la funcion para validar primero
   */
	function agregar()
      { 
      	if (validacion()==0){
	    document.formulario.action=
		"agregarUsuario.php";
		document.formulario.submit();
		}
  }
  /**
   * Función que envia a la pagina de listar
   */
    function listar()
      { 
        
      document.formulario.action="listarUsuario.php";
    document.formulario.submit();
    
    } 
	  /**
     * Función que envia los datos hacia la pagina de eliminar, preguntando si esta seguro
     */
    function eliminar()
      {
	   res=prompt("Esta seguro de Borrar [y/n]","")
	   if (res=="y" || res=="Y")
	     {    document.formulario.action="eliminarUsuario.php";
	      document.formulario.submit();
         }		 
	  }
    /**
     * Función que valida los datos, recibe los datos del formulario y los valida segun el caso
     */
	function validacion() {
 		valor = document.getElementById("txtUser").value;
			if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
				alert('[ERROR] Debe escribir un nombre de Usuario');
  			return 1;
		} 
  
		valor1 = document.getElementById("txtPass").value;
			if( valor1.length <= 5 ) {
				alert('[ERROR] Debe escribir una contraseña de 6 o mas caracteres');
  			return 1;
		} 
		valor2 = document.getElementById("txtTipo").value;
			if( valor2 != "admin" && valor2 != "user" ) {
				alert('[ERROR] Debe escribir admin o user (con minusculas)');
  			return 1;
		} 

    valor3 = document.getElementById("txtMail").value;
    if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor3)){
     
        } else {
        alert("[ERROR] La dirección de email es incorrecta!.");
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
 * Funcion que realiza la busqueda al clickear el submit del formulario
 */
	  if(isset($_REQUEST['accion']) && 
	  !empty($_REQUEST['accion']))
	     {
		   $accion=$_REQUEST['accion'];
		   if ($accion=="Buscar")
		     {
               $user1=$_REQUEST['txtUser'];
			   if(!empty($user1) &&!($user1 == "")) {
                       buscarDatos($user1);
					    
			   } else {
			        echo "Error, ... ingrese Usuario";
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
	      action= 'buscarUsuario.php'
	      >

	      <div class="form-group row">
    <label for="txtUser" class="col-sm-2 col-form-label">Nombre de Usuario</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="txtUser" name="txtUser" placeholder="Usuario" value=<?php echo $user1 ?>>
      
    </div>
  </div>
  <div class="form-group row">
    <label for="txtPass" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control"  id="txtPass" name="txtPass" placeholder="Password" value=<?php echo $pass ?>>
    </div>
  </div>
  <div class="form-group row">
   <label for="txtMail" class="col-sm-2 col-form-label">Mail</label>
    <div class="col-sm-10">
      <input type="mail" class="form-control"  id="txtMail" name="txtMail" placeholder="Mail" value=<?php echo $mail ?>>
      
    </div>
  </div>
  <div class="form-group row">
   <label for="txtUser" class="col-sm-2 col-form-label">Tipo de Usuario</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  id="txtTipo" name="txtTipo" placeholder="Usuario" value=<?php echo $tipo ?>>
      
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
			   OnClick='JavaScript:eliminar();'
			   class="btn btn-success">
			 <input type='button' 
		       name='accion'
			   value='Modificar'
			   OnClick='JavaScript:modificar();'
			   class="btn btn-success">
       <input type='button' 
           name='accion'
         value='Listar'
         OnClick='JavaScript:listar();'
         class="btn btn-success">
	
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