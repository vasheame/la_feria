<?php
include 'conexion.php';

$user=$_REQUEST['txtUser'];
$pass=$_REQUEST['txtPass'];
$mail=$_REQUEST['txtMail'];
$tipo=$_REQUEST['txtTipo'];

/**
 * Se utiliza esta función para quitar los tildes y asi no tener problemas de datos similares
 * @param  [String]
 * @return [String]
 */
function quitar_tildes($cadena) {
$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}
$user = trim($user);
$user = quitar_tildes($user);


if(empty($user)     || 
   empty ($pass) || 
   empty($tipo))
die("Error, debe ingresar todos los datos del alumno");
/**
 * Se revisa si es que el usuario existe o no en los datos
 * @var string
 */
$sentenciaSql1="select * from usuario where nombreUsuario = '$user'";

$respuesta=mysql_query($sentenciaSql1,$conexion) or die("Error en la db ".mysql_error());
$row = mysql_fetch_array($respuesta);
if ($row['nombreUsuario'] == $user) {

	echo "El nombre de usuario ya esta en uso";
	sleep(1);
	header('Location: buscarUsuario.php');
	}
	else {
		/**
		 * Si no esta en uso se ingresa un usuario nuevo
		 * @var string
		 */
	$sentenciaSql="Insert into usuario values(0,'$user','$pass','$mail','$tipo')";

	if(!$respuesta=mysql_query($sentenciaSql,$conexion))
	echo "Error: No se insertaron los datos ". mysql_error()." <br>";
	else {
	echo "Mensaje: Datos Insertados correctamente";
	sleep(1);
	header('Location: buscarUsuario.php');
	}
	}



mysql_close($conexion);
?>