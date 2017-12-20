<?php


$user = 'arduino';
$password = 'arduino';
$db = 'arduino';
$host = 'localhost';


$con=mysqli_connect("$host","$user","$password","$db");

// update data in mysql database

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());

}


$passwordAlarma = "0";
$nombre = $_POST['nombre'];
$password = $_POST['password'];



$result = mysqli_query($con,"SELECT alarma FROM usuarios WHERE nombre='{$nombre}' AND password='{$password}'");

		$num_rows = mysqli_num_rows($result);


	if ($num_rows > 0){

		
			while($row = $result->fetch_array())
  			{
		
       			$passwordAlarma = $row['alarma'];
  	
  			}


    


	}else{
		echo "0";
	}


		if ($passwordAlarma != null){

			echo $passwordAlarma;
			
		}else{

			echo "0";
		}


mysqli_close($con);


/*


1. Hago una select de todo.

2. Cojo solo la ultima fila.

3. Devuelvo todos los parámetros y los recibo en Android con json

4. Los paso a String y los muestro en Android. Desde el fragment Log.  */

?>
