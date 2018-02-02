<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<style>

body {
	width: auto;
	height: 100%;
	background-image: url('tenis.jpg');
	background-repeat: no-repeat;
	background-position: center center;
	background-attachment: fixed;
	background-size: cover;
	background-color: #464646;

}

span{
	color: white;
}
a{
	color: white;
}

table {
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



<header>
<?php

if(isset($_GET['desconectar'])){
	session_destroy();

	?><script> location.replace("index.php"); </script><?php
}



?>




<?php
//Hacemos el login

$conexion = mysqli_connect("localhost", "jose", "josefa", "BD_TENIS_PEDROPABLO");
if(!$conexion){
	die("Error de conexion a la BD");
}


function compruebaUsu($conexion, $nombre, $clave){


		$mconsulta = "SELECT username_admin from login_admin where username_admin='".$nombre."' and password_admin =MD5(".$clave.")";
	
		$resultado = mysqli_query($conexion, $mconsulta);
		if(!$resultado){
			die("Error consulta compruebaUSU" . mysqli_error($conexion));
		}else{
			$res = mysqli_num_rows($resultado);

			return $res;
		}

	return false;
	
}






$nombre = "";
$clave = "";

if(isset($_POST['usuario'])){
	$nombre = $_POST['usuario'];
}
if(isset($_POST['clave'])){
	$clave = $_POST['clave'];
}


if(isset($_POST['enviarLogin']) && $nombre === ""){
	//echo "El campo Usuario no puede estar vacio <br>";
	?><script type="text/javascript"> alert("El campo Usuario no puede estar vacio "); </script> <?php
}
if(isset($_POST['enviarLogin']) && $clave === ""){
	//echo "El campo Clave no puede estar vacio <br>";
	?><script type="text/javascript"> alert("El campo Clave no puede estar vacio "); </script> <?php
}

if(isset($_POST['enviarLogin']) && $nombre != "" && $clave != ""){

	if(compruebaUSU($conexion, $nombre, $clave)){
		$_SESSION['usu'] = $nombre;
		
		//header("Location: verCarrito.php");
		?><script> location.replace("index.php"); </script><?php
	}else{
		?><script type="text/javascript"> alert("El usuario no existe"); </script> <?php
		//echo "El usuario no existe";
	}

}


if(isset($_POST['enviarRegistro'])){
	?><script> location.replace("registro_usuario.php"); </script><?php
}


if(isset($_SESSION['usu'])){

	echo  "<span id='saludo'>Bienvenido: <strong>" . $_SESSION['usu']."</strong> - <a href='index.php?desconectar=1'>Salir</a> </span>";




function listaJugadores($conexion){
	$mconsulta = "SELECT * from jugadores ORDER BY id_jugador";
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

	echo '<form action="index.php" method="POST">  <input class="button" type="submit" id="btnusuRegistro" name="enviarRegistro" value="Registrar Nuevo"/> </form>';




	/////// PRUEBAS //////
		$mjson = json_encode($array_general);

		if (file_exists("jugadores.json")) { unlink ("jugadores.json"); }


		$mfile = fopen("jugadores.json", "c+");
		fwrite($mfile, $mjson);
		fclose($mfile);

}



?>

<?php
	



listaJugadores($conexion);
echo '<form action="filtrado.html" method="POST">  <input class="button" type="submit" id="btnFiltro" name="enviaFiltro" value="Filtrar Datos Automaticos"/>  </form>';
echo '<form action="filtradoPersonalizado.php" method="POST">  <input class="button" type="submit" id="btnFiltro" name="enviaFiltro" value="Filtrar Datos Manual"/>  </form>';



}else{

	echo '<div><form action="index.php" method="POST">
<input class="button" id="txtusu" placeholder="Usuario" type="text" name="usuario" value=""/>
<input class="button" id="txtpass" placeholder="Contraseña" type="password" name="clave" value=""/>

<input class="button" type="submit" id="btnusu" name="enviarLogin" value="Entrar"/>
</form></div>';


}

?>


</header>

<span id="prueba"></span>




<table >
    <tbody id="tbody"></tbody>
</table>





<?php




?>


<script type="text/javascript">
	
	
var url = "http://localhost/tenis/PEDROPABLO/Proyecto_Tenis/jugadores.json";

var jsonFile = new XMLHttpRequest();
    jsonFile.open("GET",url,true);
    jsonFile.send();

    jsonFile.onreadystatechange = function() {
        if (jsonFile.readyState== 4 && jsonFile.status == 200) {


		var marray = JSON.parse(jsonFile.responseText);


		var globalCounter = 0;
		var tbody = document.getElementById('tbody');

		var th = "<tr> <th>Nombre</th> <th>Apellidos</th> <th>Telefono</th> <th>email</th> <th>Nivel Tenis</th> <th>Nivel Padel</th> <th>Edad</th> <th>Sexo</th> <th>Socio</th> <th>Disponibilidad</th> <th>Observaciones</th></tr>";
		tbody.innerHTML += th;
		for (var i = 0; i < marray.length; i++) {
		    var tr = "<tr>";


		    tr += "<td>" + marray[i].nombre + "</td>" + "<td>" + marray[i].apellidos + "</td>" + "<td>" + marray[i].telefono + "</td>" + "<td>" + marray[i].email + "</td>" + "<td>" + marray[i].nivel_tenis + "</td>" + "<td>" + marray[i].nivel_padel + "</td>" + "<td>" + marray[i].edad + "</td>" + "<td>" + marray[i].sexo + "</td>" + "<td>" + marray[i].esSocio + "</td>" + "<td>" + marray[i].disponibilidad + "</td>" + "<td>" + marray[i].Observaciones + "</td>";
		    tr += "</tr>";

		    tbody.innerHTML += tr;
		}

        }
     }
</script>
</body>
</html>
