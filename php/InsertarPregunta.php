<?php
include "ParametrosDB.php";

    $correo=$_POST["mail"];
    $pregunta=$_POST["enun"];
    $respCorr=$_POST["resp"];
    $inc1=$_POST["inc1"];
    $inc2=$_POST["inc2"];
    $inc3=$_POST["inc3"];
    $complej=$_POST["comp"];
    $tema=$_POST["tem"];
	
    if(filter_var($correo, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[a-z]*[0-9]{3}@ikasle.ehu.eus/")))==false) {
		echo "La dirección de correo introducida no es valida";
		echo "<br>";
	}
	
	if($complej<0 || $complej>5){
		echo "La complejjidad no está entre 0 y 5";
		echo "<br>";
	}
	
	if(strlen($correo)===0 || strlen($pregunta)===0 || strlen($respCorr)===0 || strlen($inc1)===0 ||strlen($inc2)===0 ||strlen($inc3)===0 || strlen($complej)===0 || strlen($tema)===0){
        echo "Los campos obligatorios no pueden estar vacíos";
		echo "<br>";
	}
       
    $link = new mysqli($server, $user, $pass, $basededatos);
    if($link->connect_error){
        die("La conexión falló:" . $link->connect_error);
    }
      $sql = "INSERT INTO Preguntas (Email, Enunciado, RespuestaC, Incorrecta1, Incorrecta2, Incorrecta3, Complejidad, Tema) VALUES ('$correo', '$pregunta', '$respCorr', '$inc1', '$inc2', '$inc3', $complej, '$tema')";
  echo $sql;
    if(!mysqli_query($link, $sql)){
        die(mysqli_error($link));
		
    }else{
        echo "<p>Los datos se han introducido correctamente</p>";
    }
    mysqli_close($link);
    echo "<a href='VerPreguntas.php'>Ver Preguntas</a>"
    ?>
    