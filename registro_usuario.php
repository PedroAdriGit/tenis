<?php
session_start();
if(isset($_POST['volver'])){

	//header("LOCATION: index.php");
	?><script> location.replace("index.php"); </script><?php

}


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
		<style>

body {
	display: flex;
	flex-flow: row wrap;
	width: auto;
	height: 100%;
	background-image: url('tenis.jpg');
	background-repeat: no-repeat;
	background-position: center center;
	background-attachment: fixed;
	background-size: cover;
	background-color: #464646;

}

label{
	color: white;
}
a{
	color: white;
}

table {
	position: relative;
	margin: 1.5rem;
    border-collapse: collapse;
    width: 80%;
    border-radius: 15px;
    box-shadow: 10px 10px 10px -2px rgba(0,0,0,1);


}

th, td {
    text-align: left;
    padding: 8px;
    
}

tr:nth-child(even){background-color: #3ffff2}
tr{
	background-color: #ffffff;

}

th {
    background-color: #4CAF50;
    color: white;
}


.button {
	display: inline-block;
  	margin: 1.5rem;
  	margin-bottom: 0;
  	/*margin-right: 50rem;*/
  	padding: 0.50rem 1rem;
	border: 0;
	border-radius: 0.317rem;
	background-color: #4CAF50;
	color: #fff;
	text-decoration: none;
	font-weight: 700;
	font-size: 1rem;
  	line-height: 1.5;
	cursor: pointer;
	-webkit-appearance: none;
	-webkit-font-smoothing: antialiased;
	width: 10rem;
	height: 2rem;
}

.button:hover {
	opacity: 0.85;
}

.button:active {
	box-shadow: inset 0 3px 4px hsla(0, 0%, 0%, 0.2);
}

.button:focus {
	outline: thin dotted #444;
	outline: 5px auto -webkit-focus-ring-color;
	outline-offset: -2px;
}




</style>

</head>
<body>

<form action="registro_usuario.php" method="POST">
<label>Nombre de usuario:</label><input class="button" type="text" name="usuario" value=""/><br>
<label>Contraseña:</label><input class="button" type="password" name="clave" value=""/><br>
<br>
<strong><label> Datos Personales </label></strong><br>
<br>
<label>Nombre:</label><input class="button" type="text" name="nombre" value=""/>
<label>Apellidos:</label><input  class="button" type="text" name="apellidos" value=""/>
<label>Telefono:</label><input class="button" type="text" name="telefono" value=""/><br>
<label>Email:</label><input class="button" type="text" name="email" value=""/>
<label>Edad:</label><input class="button" type="number" name="edad" value=""/><br>
<label>Nivel Tenis</label><select class="button" name="nivel_tenis">
  <option class="button" value="0">No Juega</option>
  <option class="button" value="1">Juega Pero no sabe Nada</option>
  <option class="button" value="2">Principiante</option>
  <option class="button" value="3">Nivel Medio</option>
  <option class="button" value="4">Nivel Alto</option>
  <option class="button" value="5">Competicion</option>
</select>
<label>Nivel Padel</label><select class="button" name="nivel_padel">
  <option class="button" value="0">No Juega</option>
  <option class="button" value="1">Juega Pero no sabe Nada</option>
  <option class="button" value="2">Principiante</option>
  <option class="button" value="3">Nivel Medio</option>
  <option class="button" value="4">Nivel Alto</option>
  <option class="button" value="5">Competicion</option>
</select><br>

<label>Sexo</label><select class="button" name="sexo">
  <option class="button" value="hombre">Hombre</option>
  <option class="button"  value="mujer">Mujer</option>
  <option class="button" value="otro">Otro</option>

</select><br>

<label>Es Socio ?</label><select class="button" name="socio">
  <option class="button" value="si">si</option>
  <option class="button" value="no">no</option>
</select><br>

<label>Disponibilidad Horaria</label><select class="button" name="disponibilidad">
  <option class="button" value="L-Vmornings">Lunes a viernes Mañana</option>
  <option class="button" value="L-Vevenings">Lunes a viernes Tardes</option>
  <option class="button" value="WeekendMornings">Fines de semana Mañana</option>
  <option class="button" value="WeekendEvenings">Fines de semana Tardes</option>

</select><br>

<label>Observaciones:</label><input class="button" type="text" name="observ" value=""/><br>

<br><br>
<input class="button" type="submit" name="volver" value="Volver"/>
<input class="button" type="submit" name="Registrar" value="Registrar"/>
</form>





<?php


function usuExiste($mConexion, $mConsulta){
	$resultado = mysqli_query($mConexion, $mConsulta);
	if(!$resultado){
		die("Error de consulta1");
	}

	$mres = mysqli_num_rows($resultado);

	return $mres;

}

function myDatabaseChanger($mConexion, $mConsulta){

	$resultado = mysqli_query($mConexion, $mConsulta);
	if(!$resultado){
		die("Error de consulta2" . mysqli_error($mConexion));
	}
	
	return true;

}





if(isset($_POST['Registrar'])){

	if($_POST['usuario']!="" && $_POST['clave']!=""){


		//Comprobamos que las claves sean iguales.
		
			//Comprobamos que el usuario no exista.
			$conexion = mysqli_connect("localhost", "jose", "josefa", "BD_TENIS_PEDROPABLO");
			if(!$conexion){
				die("Error conexion: " . mysqli_error());
			}
			$consultaUsu = "select username from usuarios where username='".$_POST['usuario']."'";

			if(usuExiste($conexion, $consultaUsu)){
				?><script type="text/javascript"> alert("El usuario ya existe"); </script> <?php
				die();
			}

			//Comprobamos que el telefono sea un numero.

			$mtelefono = $_POST['telefono'];

			if(!is_numeric($mtelefono)){
				?><script type="text/javascript"> alert("El telefono no es correcto"); </script> <?php
				die("");
			}


			$consultaInsert = "INSERT INTO usuarios (username, password) VALUES ("."'".$_POST['usuario']."', MD5('".$_POST['clave']."'))";

			//echo $consultaInsert;

			if(myDatabaseChanger($conexion, $consultaInsert)){
				
			}else{
				?><script type="text/javascript"> alert("ha ocurrido un error"); </script> <?php
				die("");
			}


			
			$consultaIdAcceso = "SELECT id_usuario from usuarios WHERE username ='" . $_POST['usuario'] .  "'";


			$idacceso = -1;
			$rs = mysqli_query($conexion, $consultaIdAcceso);
			if ($row = mysqli_fetch_row($rs)) {
				$idacceso = $row[0];
			}
			
			$consultaInsert2 = "INSERT INTO jugadores (nombre, apellidos, telefono, email, nivel_tenis, nivel_padel, edad, sexo, esSocio, disponibilidad, Observaciones, id_usuario) VALUES ("."'".$_POST['nombre']."', '".$_POST['apellidos']."', '".$_POST['telefono']."', '".$_POST['email']."', '".$_POST['nivel_tenis']."', '".$_POST['nivel_padel']."', '".$_POST['edad']."', '".$_POST['sexo']."', '".$_POST['socio']."', '".$_POST['disponibilidad']."', '".$_POST['observ']."', ".$idacceso.")";


			echo $consultaInsert2;


			if(myDatabaseChanger($conexion, $consultaInsert2)){
				?><script type="text/javascript"> alert("Registro completo, redireccionando..."); </script> <?php
				//header("LOCATION: index.php");
				?><script> location.replace("index.php"); </script><?php
			}

		





	}else{

		echo "introduzca todos los datos";

	}



}




?>

</body>
</html>
