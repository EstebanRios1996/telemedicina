<?php
session_start();
if (!$_SESSION){
	header('Location: Inicio_sesion.php');
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
<html>
<head>
	<title>Base de Datos</title>
	<link rel="stylesheet" href="style4.css">
	<link rel="icon" href="assets/LOGOUC.png" type="image/x-icon"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>BDS</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="BDS.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.3.3, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "Tesis",
		"logo": "images/LOGOTESIS1.png"
}</script>
    <meta name="theme-color" content="#232b79">
    <meta property="og:title" content="BDS">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
</head>
<body class="u-body">

<header class="u-clearfix u-header u-header" id="sec-a184"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="#" class="u-image u-logo u-image-1" data-image-width="862" data-image-height="771">
          <img src="assets/LOGOTESIS1.png" class="u-logo-image u-logo-image-1">
        </a>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>"  method="post"><input type="submit" value="Cerrar Sesión" name="cerrar" class="u-border-none u-btn u-button-style u-gradient u-hover-palette-1-dark-1 u-none u-btn-1"></input>
		</form>
        <h3 class="u-text u-text-default u-text-1">PulsiOxímetro</h3>
		<?php 
			$sql="SELECT * from datos;";
			$result=mysqli_query($conexion,$sql);
			if ($result== true ){
		 ?>
        <h6 class="u-text u-text-default u-text-2">Bienvenido 
			<?php 
				echo $nombreusuario."!";
			?></h6>
      </div></header>
	
	<div align="center">

	<H1><font size = 4>Pacientes Registrados</font></H1>
	
	</div>
	<br/>
	
	<section class="u-align-center u-clearfix u-section-1" id="sec-ffa8">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-align-center u-table u-table-responsive u-table-1">
          <table class="u-table-entity u-table-entity-1">
            <colgroup>
              <col width="19.9%">
              <col width="19.9%">
              <col width="19.9%">
              <col width="19.9%">
              <col width="20.4%">
            </colgroup>
            <thead class="u-align-center u-custom-color-1 u-table-header u-table-header-1">
              <tr style="height: 45px;">
                <th class="u-border-3 u-border-custom-color-1 u-custom-color-1 u-table-cell u-table-cell-1">ID</th>
                <th class="u-border-3 u-border-custom-color-1 u-table-cell u-table-cell-2">PPM</th>
                <th class="u-border-3 u-border-custom-color-1 u-table-cell u-table-cell-3">SPO2</th>
                <th class="u-border-3 u-border-custom-color-1 u-table-cell u-table-cell-4">Ver</th>
                <th class="u-border-3 u-border-custom-color-1 u-table-cell u-table-cell-5">Borrar</th>
              </tr>
            </thead>
            <tbody class="u-align-center u-table-body">
			  <?php 
		while($mostrar=mysqli_fetch_array($result)){
		 ?>
		<tr style="height: 44px;">
			<td class="u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-6"><?php echo $mostrar['id'] ?></td>
			<td class="u-border-1 u-border-grey-30 u-table-cell"><?php echo $mostrar['spo2_avg'] ?></td>
			<td class="u-border-1 u-border-grey-30 u-table-cell"><?php echo $mostrar['ppm_avg'] ?></td>
		
			<td class="u-border-1 u-border-grey-30 u-table-cell"><a href="ver.php?id=<?php echo $mostrar['id']?>"><img src="assets/ojo.png" width="25" height="25"/></a></td>
			
			
			<td class="u-border-1 u-border-grey-30 u-table-cell"><a href="borrar.php?id=<?php echo $mostrar['id']?>"><img src="assets/basurero.png" width="25" height="25"/></a></td>
			
		</tr>

		<?php 
		}
		?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
	
	

	<?php
		}
	?>
</body>
</html>

