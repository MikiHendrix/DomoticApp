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

	$result = mysqli_query($con,"SELECT * FROM usuarios WHERE nombre='{$nombre}' AND password='{$password}'");

		$num_rows = mysqli_num_rows($result);


$id_user = 0;

	if ($num_rows > 0){

					
			while($row = $result->fetch_array())
  			{
  			$id_user = $row['id'];
  				
  			}

	}else{
		echo "No existe el usuario";
	}


	if ($id_user > 0){

	$habitacion1 = $_POST['habitacion1'];
	$habitacion2 = $_POST['habitacion2'];
	$salon = $_POST['salon'];
	$temperatura = $_POST['temperatura'];

		$insert=mysqli_query($con,"INSERT INTO preferencias (id_user,nombre,habitacion1,habitacion2,salon,temperatura,fecha) VALUES ('$id_user','$nombre','$habitacion1','$habitacion2','$salon','$temperatura',CURRENT_TIMESTAMP())");


		if ($insert){

			echo "1";

		}else{

			echo "No insertado";

		}


	}else{

		echo "No existe la id";
	}



?>
