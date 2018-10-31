<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='../estilos/login.css' />
  </head>
  <body>
	<div id="divIniSes">
		<form class="flogin" action="Login.php" method="post">
			<h2 class="h2">Para iniciar sesión</h2>
			<div class="datosLogin">
				<label> Email: </label>
				<input type="email" name="email" size="21" class="IniSes"/>
			</div>
			<br><br>
			
			<div class="datosLogin">
				<label> Contraseña: </label>
				<input type="password" name="pass" class="IniSes"/>
			</div>
			
			<div id="submit">
				<input type="submit" id="IniButton" name="IniciarSesion" value="Iniciar Sesion"/>
			</div>
		</form>
	</div>
	<?php
	include "ParametrosDB.php";
	
	if(isset($_POST['email'])){
		 $link = new mysqli($server, $user, $pass, $basededatos) or die(mysqli_connect_error());
		 $email=$_POST['email']; $password=$_POST['pass'];
		 $veri1 = "Select * from usuarios where email  = '".$email."'";
         $result = mysqli_query($link, $veri1);
		 $cont= mysqli_num_rows($result); //Se verifica el total de filas devueltas
		 mysqli_close($link); //cierra la conexion
		 
	if($cont==1){
		echo("<script> alert ('BIENVENIDO AL SISTEMA:". $email . "')</script>");
		echo ("Login correcto<p> <a href='../Html/layout.html?op=preguntas'>Puede insertar
		preguntas</a></p>");
		} else {
			echo ("Par&aacute;metros de login incorrectos<p><a href='Login.php'>Puede intentarlo de nuevo</a>");
		}
	}
	?>
	</body>
</html>
