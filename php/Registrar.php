<html>
	<head>
		<meta name="tipo_contenido" content="text/html" http-equiv="content-type" charset="utf-8">
		<title>Preguntas</title>
		<link rel='stylesheet' type='text/css' href='../estilos/registro.css' />
	</head>
		<body>
			<div id="divForm" align="center">
			  
				<h2>Rellene el formulario de registro</h2>
					<form id="fregistrar" name="fregistrar" method="post" action="Registrar.php">
						<div class="datosRegistro">
							<label>Introduzca su correo electrónico:*</label>
							<input type="text" id="corr" name="mail" class="datos" required>
							<br><br>
						</div>
					  
						<div class="datosRegistro">
							<label>Introduzca su nombre y apellidos:*</label>
							<input type="text" id="nom" name="nom" class="datos" required>
							<br><br>
						</div>
					  
						<div class="datosRegistro">
							<label>Introduzca su contraseña:*</label>
							<input type="password" id="pass" name="pass" class="datos" required>
							<br><br>
						</div>
					  
						<div class="datosRegistro">
							<label>Repetir Contraseña:*</label>
							<input type="password" id="pass1" name="pass1" class="datos" required>
							<br><br>
						</div>
				  
						<input type="submit" id="subm" name="subm" value="Registrarse">
					</form>
			</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"> </script>
        <script>
				
               function validarCorreo(){
                  var correo=$("#corr").val();
                  var correoER= new RegExp("[a-z]*[0-9]{3}@ikasle.ehu.eus");
                  var test=correoER.test(correo);
                  return test;
                }
				
				function validarNombre(){
                  var nom = $("#nom").val();
                  var nombreER= new RegExp("[A-Z][a-z]+[ ][A-Z][a-z]+([ ][A-Za-z])*");
                  var test1=nombreER.test(nom);
                  return test1;
                }
				
                    
                $("#fregistrar").submit(function (){
                    
                    var correo=$("#corr").val();
					var nom = $("#nom").val();
                    var contr = $("#pass").val();
                    var repContr = $("#pass1").val();
                    
                    if(!validarCorreo()){
                         alert("El correo tiene que ser de la universidad")
                       return false;
                    }
					
					if(!validarNombre()){
                         alert("El formato del nombre es incorrecto. Ejemplo: Luis Moles; Luis Moles Rodriguez") //Iniciales en mayúsculas obligatorio
                       return false;
                    }
                    if(contr.length<8){
                        alert("La contraseña debe contener al menos 8 carácteres")
                        return false; 
                    }
                    if(contr!=repContr){
						alert("Las contraseñas no coinciden");
						return false;
					}
                      return true;
                });
        </script>
	</body>

		
		<?php
		
		include "ParametrosDB.php";
			if (isset($_POST["mail"])){
				if(empty($_POST["nom"]) || empty($_POST["pass"]))
				{
				   die("Error");
					
				} else{

					 $nombre = $_POST["nom"];
	                 $email = $_POST['mail'];
	                 $password = $_POST['pass'];
	                 
					 $link = new mysqli($server, $user, $pass, $basededatos);
					 if ($link->connect_error) {
                        die("La conexion falló: " . $link->connect_error);
                     } 
					$veri = "Select * from usuarios where email  = '".$email."'";
                    $result = mysqli_query($link, $veri);
                    $row = mysqli_fetch_assoc($result);
                       if(mysqli_num_rows ($result)==1){
                            die("El usuario ya está registrado");
                        }
					
					//Insertamos los valores en la base de datos.
					//$hash = sha1($password);
					//unset($password);
					$sql = "INSERT INTO usuarios (nombre,email,pass) VALUES ('$nombre','$email','$password')";
	                  if(!mysqli_query($link, $sql)){
                            die('Ha ocurrido algo inesperado');
                        }

	                    mysqli_close($link);
						
	                    header('location:Login.php');
	                }
				}
?>
</html>

		