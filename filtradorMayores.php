<?php

$conexion = mysqli_connect("localhost", "jose", "josefa", "BD_TENIS_PEDROPABLO");
if(!$conexion){
	die("Error de conexion a la BD");
}

function listaJugadores($conexion){
	$mconsulta = "SELECT * from jugadores WHERE edad > '18'";
	$resultado = mysqli_query($conexion, $mconsulta);
	if(!$resultado){
		die("Error consulta listaProductos");
	}



	$array_general = [];


	while($fila = mysqli_fetch_assoc($resultado)){

		$array_temp = [
					    "nombre" => $fila['nombre'],
					    "apellidos" => $fila['apellidos'],
					    "telefono" => $fila['telefono'],
					    "email" => $fila['email'],
					    "nivel_tenis" => $fila['nivel_tenis'],
					    "nivel_padel" => $fila['nivel_padel'],
					    "edad" => $fila['edad'],
					    "sexo" => $fila['sexo'],
					    "esSocio" => $fila['esSocio'],
					    "disponibilidad" => $fila['disponibilidad'],
					    "Observaciones" => $fila['Observaciones'],
					];

		$array_general[] =  $array_temp;
	}
	/////// PRUEBAS //////
		$mjson = json_encode($array_general);

				if (file_exists("jugadoresMayores.json")) { unlink ("jugadoresMayores.json"); }


		$mfile = fopen("jugadoresMayores.json", "c+");
		fwrite($mfile, $mjson);
		fclose($mfile);

}


listaJugadores($conexion);


?>
