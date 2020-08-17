<?php
include 'conexion.php';

$user=$_REQUEST['txtUser'];
$pass=$_REQUEST['txtPass'];
$mail=$_REQUEST['txtMail'];
$tipo=$_REQUEST['txtTipo'];



if(empty($user)     || 
   empty ($pass) || 
   empty ($mail) || 
   empty($tipo))
die("Error, debe ingresar todos los datos del usuario");

/**
 * Se actualizan los datos del usuario
 * @var string
 */
$sentenciaSql="update usuario set nombreUsuario='$user', password='$pass', mail='$mail', tipo='$tipo' where nombreUsuario ='$user'";

if(!$respuesta=mysql_query($sentenciaSql,$conexion)){
echo "Error: No se modificaron los datos ". mysql_error()." <br>";
sleep(1);
		header('Location: buscarUsuario.php');
}
else {
echo "Mensaje: Datos modificados correctamente";
sleep(1);
		header('Location: buscarUsuario.php');
mysql_close($conexion);}
?>