<?php

$user = 'arduino';
$password = 'arduino';
$db = 'arduino';
$host = 'localhost';

$con=mysqli_connect("$host","$user","$password","$db");

// update data in mysql database

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}else{

}


$nombre = $_POST['nombre'];
$password = $_POST['password'];
$newPassword = $_POST['newPassword'];



$result=mysqli_query($con, "UPDATE usuarios SET password='{$newPassword}' WHERE nombre='{$nombre}' AND password='{$password}'");



	//var_dump (mysqli_affected_rows($con)); var_dump devuelve integer 

	if (mysqli_affected_rows($con) == 1)
	{
		echo "1";

	}
	else
	{
		echo "no actualizados";
	}
	

	if (!$result) {
    echo mysql_errno() . ": " . mysql_error() . "\n";
    die();
	}
?>

