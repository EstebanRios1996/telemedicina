<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style2.css">
  <title>Formulario Registro</title>
</head>
<body>
	  <section class="form-register">
	    <div align="center"><img src="assets/LOGO.png" width="70" height="65"></div><br/>
	    <h4>Registrarse</h4>
<html>
<body>
<?php 
if (isset($_POST['Registrar'])){
    $servidor = "localhost";
    $nombreusuario = "Admin";
    $password = "Passw0rd_1";
    $db = "PSICOBRAIN";

    $conexion = new mysqli($servidor, $nombreusuario, $password, $db);

    if($conexion->connect_error){
        die("Conexión fallida: " . $conexion->connect_error);
            }
    if (strlen($_POST['apellidos']) >= 1 && strlen($_POST['password']) >= 1&& strlen($_POST['nombres']) >= 1&& strlen($_POST['correo']) >= 1) {
	$nombre = trim($_POST['nombres']);
	$apellido = trim($_POST['apellidos']);
	$email = trim($_POST['correo']);
	$pass= trim($_POST['password']);
	$fechareg = date("d/m/y");
	$username = trim($_POST['username']);;
	$sql1 = "CREATE USER ".$username." IDENTIFIED WITH mysql_native_password BY '$pass';"; 
	$sql2 =	"GRANT ALL PRIVILEGES ON PSICOBRAIN.* TO '$username';";
	if($conexion->query($sql1) === true &&$conexion->query($sql2)=== true){
		$sql = "INSERT INTO USUARIOS_REGISTRADOS(User_name,Nombres,Apellidos,E_mail,Pass,Fecha_registro)
			VALUES ('$username','$nombre','$apellido','$email' ,'$pass','$fechareg');" ;
		if($conexion->query($sql) === true){
		   ?> 
		    	<h5>¡Registrado correctamente!</h5>
		   <?php
		}else{
		    die("Error al insertar datos: " . $conexion->error);
		}
	}else{
	    die("Error al crear usuario: " . $conexion->error );
	   ?> 
	    	<h5>¡Intente nuevamente!</h5>
		<p><a href="registro.php">Registrar cuenta</a></p>
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

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" id="crear_user" method="post">
		    <input class="controls" type="text" name="nombres" id="nombres" placeholder="Nombre">
		    <input class="controls" type="text" name="apellidos" id="apellidos" placeholder="Apellido">
		    <input class="controls" type="email" name="correo" id="correo" placeholder="Correo">
		    <input class="controls" type="text" name="username" id="username" placeholder="Nombre de Usuario">
		    <input class="controls" type="password" name="password" id="password" placeholder="Contraseña">
		    
	    	    <input class="botons" type="submit" value="Registrar" name="Registrar">
   		 </form>
	    <p><a href="Inicio_sesion.php">¿Ya tengo Cuenta?</a></p>
	  </section>
</body>
</html>
