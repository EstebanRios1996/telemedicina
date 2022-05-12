<?php
session_start();
if (!$_SESSION){
	header('Location: BDS.php');
}
else{
	$nombreusuario=$_SESSION['nombreusuario'] ;
	$password=$_SESSION['password'];
	$servidor= "localhost";
	$db= "PSICOBRAIN";
	$conexion = new mysqli($servidor, $nombreusuario, $password, $db);
}
?>
<?php 
	if (isset($_POST['cerrar'])){
	session_destroy();
	session_commit();
	$_SESSION['nombreusuario'] ='';
	$_SESSION['password']='';
	header('Location: Inicio_sesion.php');
}
?>


<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
  <title>Datos Paciente</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="assets/LOGOCP.png" type="image/x-icon"/>

  <link rel="stylesheet" href="style5.css">


</head>

<body>

	<br/>
	<div align="center"><img src="assets/LOGO.png" width="110" height="100"></div>
	</div>
	<div align="center">
	<br/>
	<H1><font size = 5>Ingresar los datos del Paciente</font></H1>
	<br/>
	</div>
	<div align="center">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" id="crear_paciente" method="post">
	
	<p>
	<label> Cedula:
	<input class="controls" type="text" name="cedula" placeholder="cedula"/>
	</label>
	</p>
	
	<p>
	<label> Nombre:
	<input class="controls" type="text" name="nombre" placeholder="Nombres"/>
	<input class="controls" type="text" name="apellido" placeholder="Apellidos"/>
	</label>
	</p>
	<p>
	<label> Fecha de Nacimiento:
	<input class="controldate" type="date" id="start" name="fecha_nacimiento"
       min="1950-01-01" max="2019-12-31">
	<input class="controlp" type="number" name="edad" placeholder="Edad" name="edad"/>
	</label>
	<p>
	<label> Nombre de Representante:
	<input class="controlg" type="text" name="representante" placeholder="Nombres"/>
	</label>
	</p>
	
	<p>
	<label> Telefono:
	<input class="controls" type="text" name="telefono" placeholder="Telefono"/>
	</label>
	</p>
	
	<p>
	<label> Nivel:
	<input class="controlp" type="number" name="nivel" placeholder="nivel"/>
	</label>
	
	<label> Institucion:
	<input class="controlg" type="text" name="institucion" placeholder="institucion"/>
	</label>
	</p>
	
	
	<br/>
	<H1><font size = 5>Diagnostico</font></H1>
	<br/>

	<H4>Evaluaciones previas</H4>
	<p>
	<textarea class="controlg" type="text" name="eval_previa" placeholder="Evalucaiones previas" cols="50" rows="4"></textarea>
	</p>
	<H4>Terapia</H4>
	<p>
	<textarea class="controlg" type="text" name="terapia" placeholder="Terapia" cols="50" rows="4"></textarea>
	</p>
	
	<H4>Observaciones</H4>
	<p>
	<textarea class="controlg" type="text" name="observaciones" placeholder="Observaciones" cols="50" rows="4"></textarea>
	</p>
	
	<br/>
	<label> Control de Tareas:   
	SI <input type="radio" name="control_tareas" value="1" />
	</label>
	NO <input type="radio" name="control_tareas" value="0" />
	</label>
	</p>
	<br/><br/>
	
	<p>
	<label> Tiempo de terapia(minutos):
	<input class="controlp" type="text" name="tiempo_terapia_min" placeholder="Tiempo"/>
	
	<input class="controltime" type="time" name="horario" placeholder="Horario"/>
	</label>
	</p>
	
	<br/>
	<H1><font size = 5>Costo</font></H1>
	<br/>
	
	<p>
	<label> Costo por terapia $:
	<input class="controltime" type="number" name="costo_terapia" placeholder="costo_terapia"/>
	</label>
	</p>
	
<html>
<body>
<?php 
if (isset($_POST['Registrar_paciente'])){
    $servidor = "localhost";
    $nombreusuario = $_SESSION['nombreusuario'];
    $password = $_SESSION['password'];
    $db = "PSICOBRAIN";

    $conexion = new mysqli($servidor, $nombreusuario, $password, $db);

    if($conexion->connect_error){
        die("Conexión fallida: " . $conexion->connect_error);
            }
    if (strlen($_POST['control_tareas']) >= 0 && strlen($_POST['nombre']) >= 1 && strlen($_POST['apellido']) >= 1 && strlen($_POST['fecha_nacimiento']) >= 1 && strlen($_POST['edad']) >= 1 && strlen($_POST['representante']) >= 1 && strlen($_POST['telefono']) >= 1 && strlen($_POST['nivel']) >= 1 && strlen($_POST['institucion']) >= 1 && strlen($_POST['eval_previa']) >= 1 && strlen($_POST['terapia']) >= 1 && strlen($_POST['tiempo_terapia_min']) >= 1 && strlen($_POST['costo_terapia']) >= 1){
	$cedula = trim($_POST['cedula']);
	$nombre = trim($_POST['nombre']);
	$apellido = trim($_POST['apellido']);
	$fecha_nacimiento = trim($_POST['fecha_nacimiento']);
	$edad= trim($_POST['edad']);
	$representante = trim($_POST['representante']);
	$telefono = trim($_POST['telefono']);
	$nivel = trim($_POST['nivel']);
	$institucion = trim($_POST['institucion']);
	$eval_previa = trim($_POST['eval_previa']);
	$terapia = trim($_POST['terapia']);
	$observaciones = trim($_POST['observaciones']);
	$control_tareas = trim($_POST['control_tareas']);
	$tiempo_terapia_min = trim($_POST['tiempo_terapia_min']);
	$horario = trim($_POST['horario']);
	$costo_terapia = trim($_POST['costo_terapia']);
	
	$sql1 = "INSERT INTO PSICOBRAIN.PACIENTES_TBL(CEDULA,NOMBRE,APELLIDO, EDAD,FECHA_NACIMIENTO,REPRESENTANTE,TELEFONO,NIVEL,INSTITUCION, EVAL_PREVIA,TERAPIA,OBSERVACIONES,TIEMPO_TERAPIA_MIN,CONTROL_TAREAS,HORARIO,COSTO_TERAPIA) VALUES ('$cedula','$nombre','$apellido','$edad','$fecha_nacimiento','$representante','$telefono','$nivel','$institucion','$eval_previa','$terapia','$observaciones','$tiempo_terapia_min','$control_tareas','$horario','$costo_terapia');";
	 
	 
	if($conexion->query($sql1) === true){
	   ?> 
	    	<h5>¡Registrado correctamente!</h5>
	    	<?php header('Location: BDS.php');
		return; ?> 
	     }
	    	
	   <?php	
	}else{
	    die("Error al ingresar paciente: " . $conexion->error );
	   ?> 
	    	<h5>¡Intente nuevamente!</h5>
           <?php
	}
	$conexion->close();
    }else {
	   ?> 
	    	<h5>¡Por favor complete los campos!</h5>
           <?php
    }
}
	   ?>


</body>
</html>
	
	<input class="botons" type="submit" value="Registrar Paciente" name="Registrar_paciente">
	<a class="botons" href="BDS.php">Regresar</a>
	</form>
	
	</div>

</body>
