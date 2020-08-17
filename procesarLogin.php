<?php
include 'conexion.php';

$user=$_REQUEST['txtUser'];
$pass=$_REQUEST['txtPass'];
session_start();


if(empty($user)     || 
   empty ($pass)) 
   
die("Error, debe ingresar todos los datos del usuario");

$sentenciaSql="select * from usuario where nombreUsuario = '$user' and password = '$pass'";

$respuesta=mysql_query($sentenciaSql,$conexion) or die("Error en la db ".mysql_error());
$row = mysql_fetch_array($respuesta);
/**
 * Si el usuario es admin, se inicia una sesión para saberlo
 */
if ($row['nombreUsuario'] == $user && $row['password'] == $pass) {
	if ($row['tipo'] == "admin") {
		echo "Bienvenido ".$row['nombreUsuario'];
		$_SESSION["usuario"]="admin";
		sleep(1);
		header('Location: menuAdmin.php');
	} else {
		/**
		 * si el usuario no es admin se inicia otro tipo de sesión
		 */
	echo "Bienvenido ".$row['nombreUsuario'];
	$_SESSION["usuario"]="usuario";
	sleep(1);
		header('Location: menuAdmin.php');
	}
} else {
	/**
	 * si no coincide se le devuelve a la pantalla de login
	 */
	echo "Login fallido";
	
	sleep(1);
	header('Location: login2.php');
}
mysql_close($conexion);


?>