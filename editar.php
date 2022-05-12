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
  <title>Editar Informacion</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="assets/LOGOCP.png" type="image/x-icon"/>

  <link rel="stylesheet" href="style5.css">

<body>
<br/><br/>
<div align="center"><img src="assets/LOGO.png" width="110" height="100">
<br/><br/><br/>
<H1>Informacion del Paciente<H1>
</div>
	</div>
<div align = center>
<br/>
<?php

if (isset($_GET["id"]) and $_GET["id"]<>""){
	$sql="SELECT * from PACIENTES_TBL";
	$result=mysqli_query($conexion,$sql);
	if ($result == true ){
		$codigo = $_GET["id"];
		$sqlsel1 = "SELECT * FROM PSICOBRAIN.PACIENTES_TBL WHERE NRO_PAC='$codigo';";
		$sqlsel2 = "SELECT * FROM PSICOBRAIN.DIAGNOSTICO_TBL WHERE NRO_PAC='$codigo';";
		$sqlsel3 = "SELECT * FROM PSICOBRAIN.PAGOS_TBL WHERE NRO_PAC='$codigo';";
		$result1=mysqli_query($conexion,$sqlsel1);
		$mostrar1=mysqli_fetch_array($result1);
		
		$codigo = $mostrar1['NRO_PAC'];
		$cedula = $mostrar1['CEDULA'];
		$nombre = $mostrar1['NOMBRE'];
		$apellido = $mostrar1['APELLIDO'];
		$fecha_nacimiento = $mostrar1['FECHA_NACIMIENTO'];
		$edad= $mostrar1['EDAD'];
		$representante = $mostrar1['REPRESENTANTE'];
		$telefono = $mostrar1['TELEFONO'];
		$nivel = $mostrar1['NIVEL'];
		$institucion = $mostrar1['INSTITUCION'];
		$eval_previa = $mostrar1['EVAL_PREVIA'];
		$terapia = $mostrar1['TERAPIA'];
		$observaciones = $mostrar1['OBSERVACIONES'];
		$tiempo_terapia_min = $mostrar1['TIEMPO_TERAPIA_MIN'];
		$control_tareas = $mostrar1['CONTROL_TAREAS'];
		$horario = $mostrar1['HORARIO'];
		$costo_terapia = $mostrar1['COSTO_TERAPIA'];
		
	}else { ?>
		<p>Servicio interrumpido</p>
		<?php
	}
}elseif(isset($_POST['Actualizar_datos'])){
    $servidor = "localhost";
    $nombreusuario = $_SESSION['nombreusuario'];
    $password = $_SESSION['password'];
    $db = "PSICOBRAIN";
    $codigo = $_GET["id"];
    $conexion = new mysqli($servidor, $nombreusuario, $password, $db);

    if($conexion->connect_error){
        die("Conexión fallida: " . $conexion->connect_error);
            }
    if (strlen($_POST['nombre']) >= 1 && strlen($_POST['apellido']) >= 1 && strlen($_POST['fecha_nacimiento']) >= 1 && strlen($_POST['edad']) >= 1 && strlen($_POST['representante']) >= 1 && strlen($_POST['telefono']) >= 1 && strlen($_POST['nivel']) >= 1 && strlen($_POST['institucion']) >= 1 && strlen($_POST['eval_previa']) >= 1 && strlen($_POST['terapia']) >= 1 && strlen($_POST['tiempo_terapia_min']) >= 1 && strlen($_POST['costo_terapia']) >= 1){
	$codigo = trim($_POST['id']);
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
	 
	$sql1 = "UPDATE PACIENTES_TBL SET CEDULA='$cedula', NOMBRE='$nombre', APELLIDO='$apellido', EDAD='$edad', FECHA_NACIMIENTO='$fecha_nacimiento', REPRESENTANTE='$representante', TELEFONO='$telefono', NIVEL='$nivel', INSTITUCION='$institucion', EVAL_PREVIA='$eval_previa', TERAPIA='$terapia',OBSERVACIONES='$observaciones', CONTROL_TAREAS='$control_tareas', TIEMPO_TERAPIA_MIN='$tiempo_terapia_min', HORARIO='$horario', COSTO_TERAPIA='$costo_terapia' WHERE NRO_PAC='$codigo';";
	
	
	 
	if($conexion->query($sql1) === true){
	   ?> 
	    	<h3>¡Datos actualizados correctamente!</h3>
	    	<br/><br/>
	    	<font size = 4>
<a class="botons" href="BDS.php">Regresar</a>
</font>
<br/><br/>
	   <?php	 
	     }
	    	
	   	
	}else{
	    die("Error al ingresar paciente: " . $conexion->error );
	   ?> 
	    	<h5>¡Intente nuevamente!</h5>
           <?php
        }
}else {?>
	<p>No se ha identificado cúal registro visualizar</p>
	<?php
}
?>
<br/>
<font size="5">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" id="crear_paciente" method="post">
	
	<p>
	<label> ID:
	<input readonly="readonly" class="controlp" type="text" name="id" placeholder="cedula" value="<?php echo $codigo; ?>"/>
	</label>
	</p>
	
	<p>
	<label> Cedula:
	<input class="controls" type="text" name="cedula" placeholder="cedula" value="<?php echo $cedula; ?>"/>
	</label>
	</p>
	
	<p>
	<label> Nombre:
	<input class="controls" type="text" name="nombre" placeholder="Nombres" value="<?php echo $nombre; ?>"/>
	<input class="controls" type="text" name="apellido" placeholder="Apellidos" value="<?php echo $apellido; ?>"/>
	</label>
	</p>
	<p>
	<label> Fecha de Nacimiento:
	<input class="controldate" type="date" id="start" name="fecha_nacimiento"
       min="1910-01-01" max="2019-12-31" value="<?php echo $fecha_nacimiento; ?>">
	<input class="controlp" type="number" name="edad" placeholder="Edad" value="<?php echo $edad; ?>"/>
	</label>
	<p>
	<label> Nombre de Representante:
	<input class="controlg" type="text" name="representante" placeholder="Nombres" value="<?php echo $representante; ?>"/>
	</label>
	</p>
	
	<p>
	<label> Telefono:
	<input class="controls" type="text" name="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>"/>
	</label>
	</p>
	
	<p>
	<label> Nivel:
	<input class="controlp" type="number" name="nivel" placeholder="nivel" value="<?php echo $nivel; ?>"/>
	</label>
	
	<label> Institucion:
	<input class="controlg" type="text" name="institucion" placeholder="institucion" value="<?php echo $institucion; ?>"/>
	</label>
	</p>
	
	
	<br/>
	<H1><font size = 6>Diagnostico</font></H1>
	<br/>

	<H4>Evaluaciones previas</H4>
	<p>
	<textarea class="controlg" type="text" name="eval_previa" placeholder="Evalucaiones previas" cols="50" rows="4" ><?php echo $eval_previa; ?></textarea>
	</p>
	<H4>Terapia</H4>
	<p>
	<textarea class="controlg" type="text" name="terapia" placeholder="Terapia" cols="50" rows="4" ><?php echo $terapia; ?></textarea>
	</p>
	
	<H4>Observaciones</H4>
	<p>
	<textarea class="controlg" type="text" name="observaciones" placeholder="Observaciones" cols="50" rows="4"><?php echo $observaciones; ?></textarea>
	</p>
	
	<?php if( $control_tareas == "1"){
		$ctar = "SI";
	}elseif( $control_tareas == "0"){
		$ctar = "NO";
	}
	?>
	
	
	
	<br/>
	<label> Control de Tareas:   
	SI <input type="radio" name="control_tareas" value="1"<?php if($control_tareas == "1"){ echo 'checked="checked"'; } ?> />
	</label>
	NO <input type="radio" name="control_tareas" value="0"<?php  if($control_tareas == "0"){ echo 'checked="checked"'; }?> />
	</label>
	</p>
	<br/><br/>
	
	<p>
	<label> Tiempo de terapia(minutos):
	<input class="controlp" type="text" name="tiempo_terapia_min" placeholder="Tiempo" value="<?php echo $tiempo_terapia_min; ?>"/>
	
	<input class="controltime" type="time" name="horario" placeholder="Horario" value="<?php echo $horario; ?>"/>
	</label>
	</p>
	
	<br/>
	<H1><font size = 6>Costo</font></H1>
	<br/>
	
	<p>
	<label> Costo por terapia $:
	<input class="controltime" type="number" name="costo_terapia" placeholder="costo_terapia" value="<?php echo $costo_terapia; ?>"/>
	</label>
	</p>
	
<html>

	<font size = 6>
	<input class="botons" type="submit" value="Actualizar Datos" name="Actualizar_datos">
	</font>
	</form>
	</font>






<br/>
<font size = 4>
<a class="botons" href="BDS.php">Regresar</a>
</font>
</div>
</body>
</head>
</html>

