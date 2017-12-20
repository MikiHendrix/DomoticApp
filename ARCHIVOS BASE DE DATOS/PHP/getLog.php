<?php

$user = 'arduino';
$password = 'arduino';
$db = 'arduino';
$host = 'localhost';

$con=mysqli_connect("$host","$user","$password","$db");


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
  


$result = mysqli_query($con,"SELECT * FROM preferencias ORDER BY id DESC LIMIT 1");

		$num_rows = mysqli_num_rows($result);

$respuesta = array();

	if ($num_rows > 0){

					
			while($row = $result->fetch_array())
  			{
  			$respuesta['id'] = $row['id'];
  			$respuesta['id_user'] = $row['id_user'];
  			$respuesta['nombre'] = $row['nombre'];
  			$respuesta['habitacion1'] = $row['habitacion1'];
  			$respuesta['habitacion2'] = $row['habitacion2'];
  			$respuesta['salon'] = $row['salon'];
        $respuesta['temperatura'] = $row['temperatura'];
  			$respuesta['fecha'] = $row['fecha'];
  			}

  			print json_encode($respuesta);

	}else{
		echo "No hay logs";
	}


mysqli_close($con);




?>
