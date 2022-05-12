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
<?php

if (isset($_GET["id"]) and $_GET["id"]<>""){
	$sql="SELECT * from userval_".$_GET["id"].";";
	$result=mysqli_query($conexion,$sql);
	if ($result== true ){
			 ?>
	
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
	
	<div style="text-align: right;">
		<div align="center"><img src="assets/LOGOUC.png" width="110" height="100">
		<br/><br/>
		<?php $codigo = $_GET["id"]; ?>
		<H1>Información del Paciente <?php echo $codigo; ?> <H1>
		</div>
	</div>
	<div align = center>

	<br/>
	<div id='container' style="height: 200px">
		<?php
		$data = array();
		while($mostrar=mysqli_fetch_array($result)){
			$data[] = $mostrar['ppm'];
		}
		?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(function () {
                var chart;
                $(document).ready(function() {
                    chart = new Highcharts.Chart({
                        chart: {
                            renderTo: 'container',
                            type: 'line',
                            marginRight: 130,
                            marginBottom: 25
                        },
			title:{
                                text:"Gráfica Temporal PPM"
                        },
			yAxis: {
			    title: {
				text: 'Pulsos por minuto'
			    }
			},
			credits: { 
				enabled: false 
			},
                        series: [{
                            name: 'Tiempo (s)',
                            data: [<?php echo join($data, ',') ?>]
                        }]
                    });
                });
            });

            </script>
	</div>

	<?php

	}else { ?>
		<p>Servicio interrumpido</p>
		<?php
	}
}else {?>
	<p>No se ha identificado cúal registro visualizar</p>
	<?php
}
?>
<br/><br/><br/>
<a class="botons" href="BDS.php"><font size="5">Regresar</font></a>
</div>
</body>
<body>
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>


    </body>
</html>

