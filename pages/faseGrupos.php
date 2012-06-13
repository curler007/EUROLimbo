<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="ISO-8859-1">
	<title>EURO 2012</title>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			padding-top: 60px;
		}
	</style>
	<link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
</head>
<body>
<?php include_once("analyticstracking.php") ?>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="#" style="vertical-align:top"><img src="../images/eurologo.png" height="20" style="vertical-align:top"> EURO<strong style="vertical-align:top">Limbo</strong> 2012</a>
				<ul class="nav">
					<li><a href="../">Home</a></li>
					<li class="dropdown active" id="menu1">
                    	<a class="dropdown-toggle" data-toggle="dropdown"  href="#">
                    		 Partidos
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu active">
							<li class="active"><a href="#">Fase de grupos</a></li>
							<li><a href="../pages/cuartos.php">Cuartos de final</a></li>
							<li><a href="../pages/semifinal.php">Semifinal</a></li>
							<li><a href="../pages/final.php">Final</a></li>
						</ul>
					</li>
                    <li><a href="../pages/clasificacion.php">Clasificación</a></li>
				</ul>
			</div>
		</div>
	</div>


<!--
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
				<ul class="nav nav-list">
					<li class="nav-header">Fase de Grupos</li>
					<li><a href="#"> <i class="icon-book"></i> Grupo A</a></li>
					<li><a href="#"> <i class="icon-book"></i> Grupo B</a></li>
					<li><a href="#"> <i class="icon-book"></i> Grupo C</a></li>
					<li><a href="#"> <i class="icon-book"></i> Grupo D</a></li>
				</ul>
			</div>-->
			<div class="span10">
				<div class="container">
					<h1>Fase de grupos</h1>
					<p>Una nueva manera de vivir la Eurocopa.</p>
					
<?
include "../pages/conexion_bd.php";
?>

<? 
	if($_GET["query"]==1){
		
		//echo $_GET["query"].'<br>';
	
		$resultado= $_GET["resultado"];
		$apuesta= $_GET["apuesta"];
		$apostante= $_GET["apostante"];
		$cuota= $_GET["cuota"];
		$ganancia= $_GET["ganancia"];
		$id=$_GET["id"];
		$comentario=$_GET["comentario"];
		
		$result= mysql_query("UPDATE partidos set 
			apostante='$apostante',
			resultado='$resultado',
			apuesta='$apuesta',
			cuota='$cuota',
			ganancia='$ganancia',
			comentario='$comentario'
			 WHERE id=$id;");
		//$query="UPDATE EURO2012.partidos set apostante='$culo' where id=14;";
		//$query="UPDATE EURO2012.partidos set apostante='aa' where id=14;";
		//mysql_close($mycon);
		echo 'Query ejecutada con resultado='.$result.'<br>';
		
	}elseif($_GET["query"]==2){
		
		echo $_GET["query"].'<br>';
		
		$fecha= $_GET["fecha"];
		$band_local= $_GET["band_local"];
		$band_visit= $_GET["band_visit"];
		$partido= $_GET["partido"];
		$resultado= $_GET["resultado"];
		$apuesta= $_GET["apuesta"];
		$apostante= $_GET["apostante"];
		$cuota= $_GET["cuota"];
		$ganancia= $_GET["ganancia"];
		$fase= $_GET["fase"];
		$id=$_GET["id"];
		$comentario=$_GET["comentario"];
		
		if(!mysql_query("INSERT INTO partidos
	(PARTIDO,FECHA,RESULTADO,APOSTANTE,APUESTA,CUOTA,GANANCIA,FASE,BAND_LOCAL,BAND_VISIT,COMENTARIO)
	VALUES ('$partido', '$fecha', '$resultado', '$apostante', '$apuesta', '$cuota', '$ganancia','$fase','$band_local', '$band_visit', '$comentario') ")){
		//$query="UPDATE EURO2012.partidos set apostante='$culo' where id=14;";
		//$query="UPDATE EURO2012.partidos set apostante='aa' where id=14;";
		//mysql_close($mycon);
		
	  die('Error: ' . mysql_error());
	  }
		echo 'Query ejecutada con resultado='.$result.'<br>';
		
	}
?>
<!-- GRUPO A-->

	        <?
                    //Ejecutamos la sentencia SQL
                    $result=mysql_query("SELECT  ID as id,FECHA as fecha, PARTIDO as partido, RESULTADO as resultado, 
										APUESTA as apuesta, APOSTANTE as apostante, CUOTA as cuota, GANANCIA as ganancia, 
										BAND_LOCAL as band_local, BAND_VISIT as band_visit, COMENTARIO as comentario  
                                        FROM partidos 
                                        WHERE FASE='GRUPOA' 
                                        ORDER BY FECHA ASC");
                    ?>
					<h3>Grupo A</h3>
					<table class="table table-bordered">
						<thead>
							<tr>
							<?
								if($_GET["admin"]=="anopeludo"){
									echo '<th style="text-align:center">Fecha del partido</th>';
								}else{
									echo '<th style="text-align:center" colspan="2">Fecha del partido</th>';
								}
							?>								
			          <th style="text-align:center">Partido</th>
								<th style="text-align:center">Resultado</th>
								<th style="text-align:center">Apuesta</th>
								<th style="text-align:center">Apostante</th>
								<th style="text-align:center">Ganancia</th>
                                <? 
                                	if($_GET["admin"]=="anopeludo") echo '<th style="text-align:center">Id</th>';
								?>
							</tr>
						</thead>
						<tbody>
					  <? 
						if($_GET["admin"]=="anopeludo"){
							include "tabla_admin.php";		
						}else{
							include "tabla_no_admin.php";
						}
					?>
                 </tbody>
                </table>

<!-- GRUPO B-->
					<?
                    //Ejecutamos la sentencia SQL
                    $result=mysql_query("SELECT  ID as id,FECHA as fecha, PARTIDO as partido, RESULTADO as resultado, APUESTA as apuesta, APOSTANTE as apostante, CUOTA as cuota, GANANCIA as ganancia, BAND_LOCAL as band_local, BAND_VISIT as band_visit , COMENTARIO as comentario  
                                        FROM partidos
                                        WHERE FASE='GRUPOB' 
                                        ORDER BY FECHA ASC");
                    ?>
	        <h3>Grupo B</h3>
				  <table class="table table-bordered">
						<thead>
							<tr>
							<?
								if($_GET["admin"]=="anopeludo"){
									echo '<th style="text-align:center">Fecha del partido</th>';
								}else{
									echo '<th style="text-align:center" colspan="2">Fecha del partido</th>';
								}
							?>								
								<th style="text-align:center">Partido</th>
								<th style="text-align:center">Resultado</th>
								<th style="text-align:center">Apuesta</th>
								<th style="text-align:center">Apostante</th>
								<th style="text-align:center">Ganancia</th>
                                <? 
                                	if($_GET["admin"]=="anopeludo") echo '<th style="text-align:center">Id</th>';
								?>
							</tr>
						</thead>
						<tbody>
					  <? 
						if($_GET["admin"]=="anopeludo"){
							include "tabla_admin.php";							
						}else{
							include "tabla_no_admin.php";
						}
					?>
                 </tbody>
                </table>
<!-- GRUPO C-->
					<?
                    //Ejecutamos la sentencia SQL
                    $result=mysql_query("SELECT  ID as id,FECHA as fecha, PARTIDO as partido, RESULTADO as resultado, APUESTA as apuesta, APOSTANTE as apostante, CUOTA as cuota, GANANCIA as ganancia, BAND_LOCAL as band_local, BAND_VISIT as band_visit  , COMENTARIO as comentario  
                                        FROM partidos 
                                        WHERE FASE='GRUPOC' 
                                        ORDER BY FECHA ASC");
                    ?>
					<h3>Grupo C</h3>
				  <table class="table table-bordered">
						<thead>
							<tr>
							<?
								if($_GET["admin"]=="anopeludo"){
									echo '<th style="text-align:center">Fecha del partido</th>';
								}else{
									echo '<th style="text-align:center" colspan="2">Fecha del partido</th>';
								}
							?>								
								<th style="text-align:center">Partido</th>
								<th style="text-align:center">Resultado</th>
								<th style="text-align:center">Apuesta</th>
								<th style="text-align:center">Apostante</th>
								<th style="text-align:center">Ganancia</th>
                                <? 
                                	if($_GET["admin"]=="anopeludo") echo '<th style="text-align:center">Id</th>';
								?>
							</tr>
						</thead>
						<tbody>
					  <? 
						if($_GET["admin"]=="anopeludo"){
							include "tabla_admin.php";							
						}else{
							include "tabla_no_admin.php";
						}
					?>
                 </tbody>
                </table>
                    
<!-- GRUPO D-->
					<?
                    //Ejecutamos la sentencia SQL
                    $result=mysql_query("SELECT  ID as id,FECHA as fecha, PARTIDO as partido, RESULTADO as resultado, APUESTA as apuesta, APOSTANTE as apostante, CUOTA as cuota, GANANCIA as ganancia, BAND_LOCAL as band_local, BAND_VISIT as band_visit , COMENTARIO as comentario   
                                        FROM partidos 
                                        WHERE FASE='GRUPOD' 
                                        ORDER BY FECHA ASC");
                    ?>
					<h3>Grupo D</h3>
					<table class="table table-bordered">
						<thead>
							<tr>
							<?
								if($_GET["admin"]=="anopeludo"){
									echo '<th style="text-align:center">Fecha del partido</th>';
								}else{
									echo '<th style="text-align:center" colspan="2">Fecha del partido</th>';
								}
							?>								
								<th style="text-align:center">Partido</th>
								<th style="text-align:center">Resultado</th>
								<th style="text-align:center">Apuesta</th>
								<th style="text-align:center">Apostante</th>
								<th style="text-align:center">Ganancia</th>
                              <? 
                                	if($_GET["admin"]=="anopeludo") echo '<th style="text-align:center">Id</th>';
								?>
							</tr>
						</thead>
						<tbody>
					  <? 
						if($_GET["admin"]=="anopeludo"){
							include "tabla_admin.php";							
						}else{
							include "tabla_no_admin.php";
						}
					?>
                 </tbody>
                </table>                     
			  </div>
				<!--container -->
			</div>
		</div>
	</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

