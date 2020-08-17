<?php
$dbhost="localhost";  
$dbusuario="root"; 
$dbpassword="usbw"; 
$db="feria";        
if (!($conexion = mysql_connect($dbhost,
 $dbusuario, $dbpassword)))
   die(mysql_error());
   
if (!mysql_select_db($db, $conexion))
   die(mysql_error());
?>