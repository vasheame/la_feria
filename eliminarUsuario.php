<?php
include 'conexion.php';

$user=$_REQUEST['txtUser'];
$pass=$_REQUEST['txtPass'];
$mail=$_REQUEST['txtMail'];
$tipo=$_REQUEST['txtTipo'];


if(empty($user)     || 
   empty($pass) || 
   empty($mail) || 
   empty($tipo))
      die("Error, debe ingresar todos los datos del alumno");
 /**
  * [$sentenciaSql Sentencia utilizada para eliminar productos segun el usuario]
  * @var string
  */
$sentenciaSql="delete from usuario where nombreUsuario='$user'";

if(!$respuesta=mysql_query($sentenciaSql,$conexion)){
echo "Error: No se eliminaron los datos del Usuario". mysql_error()." <br>";
sleep(1);
		header('Location: buscarUsuario.php');
	}
else{
echo "Mensaje: Datos Datos eliminados correctamente";
sleep(1);
		header('Location: buscarUsuario.php');
mysql_close($conexion);
}
?>