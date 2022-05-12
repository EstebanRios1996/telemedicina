<?php
session_start();
if (!$_SESSION){
	header('Location: BDS.php');
}
else{
	$nombreusuario=$_SESSION['nombreusuario'] ;
	$password=$_SESSION['password'];
	$servidor= "localhost";
	$db= "prueba";
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
  <title>Borrado de Datos</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="assets/LOGOCP.png" type="image/x-icon"/>

  <link rel="stylesheet" href="style5.css">

<body>
<div align = center>
<br/><br/><br/><br/>
<?php

if (isset($_GET["id"]) and $_GET["id"]<>""){
	$sql="SELECT * from datos";
	$result=mysqli_query($conexion,$sql);
	if ($result == true ){
		$codigo = $_GET["id"];
		$sqldelete1 = "DELETE FROM prueba.datos WHERE id='$codigo';";

		if ($conexion->query($sqldelete1) === true){
			?>
			<H3>Registro eliminado</H3>
			<?php
		} else {
			?> <p>No se puede eliminar </p>
			<?php
		}
		$sqldelete2 = "DROP TABLE userval_".$codigo.";";

                if ($conexion->query($sqldelete2) === true){
                        ?>
                        <H3>Tabla Eliminada</H3>
                        <?php
                } else {
                        ?> <p>No se puede eliminar </p>
                        <?php
                }

	}else { ?>
		<p>Servicio interrumpido</p>
		<?php
	}
}else {?>
	<p>No se ha identificado cúal registro eliminar</p>
	<?php
}
?>
<br/><br/>
<a class="botons" href="BDS.php">Regresar</a>
</div>
</body>
</head>
</html>

