<?php

$user = 'arduino';
$password = 'arduino';
$db = 'arduino';
$host = 'localhost';

$con=mysqli_connect("$host","$user","$password","$db");


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
	
	$nombre = $_POST['nombre'];
	$password = $_POST['password'];


	$result=mysqli_query($con,"SELECT * FROM usuarios WHERE nombre='{$nombre}' AND password='{$password}'");

	$num_rows = mysqli_num_rows($result);

	if ($num_rows == 1){

		echo "Ya existe este usuario";

	}else{
		

		$insert=mysqli_query($con,"INSERT INTO usuarios (nombre,password) VALUES ('$nombre','$password')");

		if ($insert){

			echo "1";

		}else{

			echo "No Insertado";

		}

	}  


			
	
		
	

?>

