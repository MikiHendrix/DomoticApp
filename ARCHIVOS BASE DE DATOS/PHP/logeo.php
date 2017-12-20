<?php

$user = 'arduino';
$password = 'arduino';
$db = 'arduino';
$host = 'localhost';
$port = 8888;

$con=mysqli_connect("$host","$user","$password","$db");


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
	
	$nombre = $_POST['nombre'];
	$password = $_POST['password'];

	$result=mysqli_query($con,"SELECT * FROM usuarios WHERE nombre='{$nombre}' AND password='{$password}'");

	$num_rows = mysqli_num_rows($result);

	if ($num_rows > 0){

		echo "1";

	}else{
		echo "0";
	}  



?>

