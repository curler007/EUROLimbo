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
					<li class="dropdown" id="menu1">
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
		
		$result= mysql_query("UPDATE partidos set 
			apostante='$apostante',
			resultado='$resultado',
			apuesta='$apuesta',
			cuota='$cuota',
			ganancia='$ganancia'
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
		
		if(!mysql_query("INSERT INTO partidos
	(PARTIDO,FECHA,RESULTADO,APOSTANTE,APUESTA,CUOTA,GANANCIA,FASE,BAND_LOCAL,BAND_VISIT)
	VALUES ('$partido', '$fecha', '$resultado', '$apostante', '$apuesta', '$cuota', '$ganancia','$fase','$band_local', '$band_visit') ")){
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
								<th style="text-align:center">Cuota</th>
								<th style="text-align:center">Ganancia</th>
                                <? 
                                	if($_GET["admin"]=="anopeludo") echo '<th style="text-align:center">Id</th>';
								?>
							</tr>
						</thead>
						<tbody>
					  <? 
					  if($_GET["admin"]=="anopeludo"){
					  //TABLA ADMIN
					  //Mostramos los registros
							while ($row=mysql_fetch_array($result))
							{
								$date = date_create($row["fecha"]);
							echo '<tr> <form>';
							echo '<td style="text-align:center">'.date_format($date, 'd/m/Y H:i');'</td>';
							echo '<td style="text-align:center"><img src="../images/'
								.$row["band_local"].'" width="20"> '
								.$row["partido"].' <img src="../images/'
								.$row["band_visit"].'" width="20"></td>';
							
							//Resultado
							echo '<td>
							<select style="width:40px" name="resultado">
							<option value="">--</option>
                        	<option value="1"';
							if($row["resultado"]=='1') echo'selected';
							
							echo '>1</option>
					        <option value="x"';
							if($row["resultado"]=='x') echo'selected';
							echo '>X</option>
							<option value="2"';
							if($row["resultado"]=='2') echo'selected';
							echo '>2</option>
                        	</select>
							</td>';
							
							//Apuesta
							echo '<td>
							<select style="width:40px" name="apuesta">
							<option value="">--</option>
                        	<option value="1"';
							if($row["apuesta"]=='1') echo'selected';
							
							echo '>1</option>
					        <option value="x"';
							if($row["apuesta"]=='x') echo'selected';
							echo '>X</option>
							<option value="2"';
							if($row["apuesta"]=='2') echo'selected';
							echo '>2</option>
                        	</select>';
							echo'</td>';
							
							//Apostante
							echo '<td>
							<select style="width:80px" name="apostante">
							<option value="">--</option>
                        	<option value="Nano"';
							if($row["apostante"]=='Nano') echo'selected';
							echo '>Nano</option>
					        <option value="Tapia"';
							if($row["apostante"]=='Tapia') echo'selected';
							echo '>Tapia</option>
							<option value="Borja"';
							if($row["apostante"]=='Borja') echo'selected';
							echo '>Borja</option>
							<option value="Lucho"';
							if($row["apostante"]=='Lucho') echo'selected';
							echo '>Lucho</option>';
							echo '<option value="Zato"';
							if($row["apostante"]=='Zato') echo'selected';
							
							echo '>Zato</option>
					        <option value="Rulo"';
							if($row["apostante"]=='Rulo') echo'selected';
							echo '>Rulo</option>
							<option value="Poles"';
							if($row["apostante"]=='Poles') echo'selected';
							echo '>Poles</option>';
							echo '<option value="Matute"';
							if($row["apostante"]=='Matute') echo'selected';
							
							echo '>Matute</option>';
							
                        	echo '</select>';
							echo'</td>';
							
							//Cuota
							echo '<td><input type="text" name="cuota" value="'.$row["cuota"].'" style ="width:80px"> </td>';
							//Ganancia
							echo '<td><input type="text" name="ganancia" value="'.$row["ganancia"].'" style ="width:80px"> </td>';
							
							//echo '<td><input type="text" name="id" value="'.$row["id"].'" style ="width:20px"> <input type="submit"</td>';
							echo '<td>'.$row["id"].' <input type="submit"></td>';
							//hidden QUERY
							echo '<input type="hidden" name="id" value="'.$row["id"].'">';
							echo '<input type="hidden" name="query" value="1">';
							echo '<input type="hidden" name="admin" value="anopeludo">';
							echo '</form></tr>';
							}
							mysql_free_result($result);
//INSERT
							echo '<tr> <form>';
							//Fecha
							echo '<td style="text-align:center"><input type="text" name="fecha" value="" style ="width:80px"></td>';
							//Partido
							echo '<td style="text-align:center">
							Bandera Local<input type="text" name="band_local" value="" style ="width:80px">
							<br>Partido<input type="text" name="partido" value="" style ="width:80px">
							<br>Bandera Visitante<input type="text" name="band_visit" value="" style ="width:80px">
							</td>';
							
							//Resultado
							echo '<td>
							<select style="width:40px" name="resultado">
							<option value="">--</option>
                        	<option value="1">1</option>
					        <option value="x">X</option>
							<option value="2">2</option>
                        	</select>';
							echo'</td>';
							
							//Apuesta
							echo '<td>
							<select style="width:40px" name="apuesta">
							<option value="">--</option>
                        	<option value="1">1</option>
					        <option value="x">X</option>
							<option value="2">2</option>
                        	</select>';
							echo'</td>';
							
							//Apostante
							echo '<td>
							<select style="width:80px" name="apostante">
							<option value="">--</option>
                        	<option value="Nano"';
							if($row["apostante"]=='Nano') echo'selected';
							echo '>Nano</option>
					        <option value="Tapia"';
							if($row["apostante"]=='Tapia') echo'selected';
							echo '>Tapia</option>
							<option value="Borja"';
							if($row["apostante"]=='Borja') echo'selected';
							echo '>Borja</option>
							<option value="Lucho"';
							if($row["apostante"]=='Lucho') echo'selected';
							echo '>Lucho</option>';
							echo '<option value="Zato"';
							if($row["apostante"]=='Zato') echo'selected';
							
							echo '>Zato</option>
					        <option value="Rulo"';
							if($row["apostante"]=='Rulo') echo'selected';
							echo '>Rulo</option>
							<option value="Poles"';
							if($row["apostante"]=='Poles') echo'selected';
							echo '>Poles</option>';
							echo '<option value="Matute"';
							if($row["apostante"]=='Matute') echo'selected';
							
							echo '>Matute</option>';
							
                        	echo '</select>';
							echo'</td>';
							//Cuota
							echo '<td><input type="text" name="cuota" value="" style ="width:80px"> </td>';
							//Ganancia
							echo '<td><input type="text" name="ganancia" value="" style ="width:80px"> </td>';
							
							//echo '<td><input type="text" name="id" value="'.$row["id"].'" style ="width:20px"> <input type="submit"</td>';
							echo '<td> <input type="submit"></td>';
							//hidden QUERY
							echo '<input type="hidden" name="id" value="">';
							echo '<input type="hidden" name="fase" value="GRUPOA">';
							echo '<input type="hidden" name="query" value="2">';
							echo '<input type="hidden" name="admin" value="anopeludo">';
							echo '</form></tr>';
							
					  }else{
						  while ($row=mysql_fetch_array($result))
							{
								$date = date_create($row["fecha"]);
							echo '<tr>';
							echo '<td style="text-align:center">';
							echo '<a data-toggle="collapse" data-target="#comment'.$row["id"].'" href="#">';
							echo '<i class="icon-plus"></i>';
							echo '</a>';
							echo '</td>';
							echo '<td style="text-align:center">'.date_format($date, 'd/m/Y H:i');'</td>';
							echo '<td style="text-align:center"><img src="../images/'
								.$row["band_local"].'" width="20"> '
								.$row["partido"].' <img src="../images/'
								.$row["band_visit"].'" width="20"></td>';
							echo '<td style="text-align:center"><strong>'.$row["resultado"].'</strong></td>';
							echo '<td style="text-align:center"><strong>'.$row["apuesta"].'</strong></td>';
							echo '<td style="text-align:center">'.$row["apostante"].'</td>';
							echo '<td style="text-align:center">'.$row["cuota"].'</td>';
							echo '<td style="text-align:center">'.$row["ganancia"].'</td>';
							echo '</tr>	';
							echo '<tr >';
							echo '<td colspan = "8" style="padding: 0px 0px 0px 0px">'; 
							echo '<div id ="comment'.$row["id"].'" class="collapse" style="margin-bottom:0px;margin-left:10px;margin-right:10px;border-radius:0px 0px 4px 4px;background-color: #D9EDF7"> ';
						  	echo '<p style="margin-left:10px"> '.$row["comentario"].'</p></div></td></tr>';
							}mysql_free_result($result);
							}
							?>
 							 </tbody>
							  </table>

<!-- GRUPO B-->
					<?
                    //Ejecutamos la sentencia SQL
                    $result=mysql_query("SELECT  ID as id,FECHA as fecha, PARTIDO as partido, RESULTADO as resultado, APUESTA as apuesta, APOSTANTE as apostante, CUOTA as cuota, GANANCIA as ganancia, BAND_LOCAL as band_local, BAND_VISIT as band_visit 
                                        FROM partidos
                                        WHERE FASE='GRUPOB' 
                                        ORDER BY FECHA ASC");
                    ?>
	        <h3>Grupo B</h3>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th style="text-align:center">Fecha del partido</th>
								<th style="text-align:center">Partido</th>
								<th style="text-align:center">Resultado</th>
								<th style="text-align:center">Apuesta</th>
								<th style="text-align:center">Apostante</th>
								<th style="text-align:center">Cuota</th>
								<th style="text-align:center">Ganancia</th>
                                  <? 
                                	if($_GET["admin"]=="anopeludo") echo '<th style="text-align:center">Id</th>';
								?>
							</tr>
						</thead>
						<tbody>
						<?
						if($_GET["admin"]=="anopeludo"){
					  //TABLA ADMIN
					  //Mostramos los registros
							while ($row=mysql_fetch_array($result))
							{
								$date = date_create($row["fecha"]);
							echo '<tr> <form>';
							echo '<td style="text-align:center">'.date_format($date, 'd/m/Y H:i');'</td>';
							echo '<td style="text-align:center"><img src="../images/'
								.$row["band_local"].'" width="20"> '
								.$row["partido"].' <img src="../images/'
								.$row["band_visit"].'" width="20"></td>';
							
							//Resultado
							echo '<td>
							<select style="width:40px" name="resultado">
							<option value="">--</option>
                        	<option value="1"';
							if($row["resultado"]=='1') echo'selected';
							
							echo '>1</option>
					        <option value="x"';
							if($row["resultado"]=='x') echo'selected';
							echo '>X</option>
							<option value="2"';
							if($row["resultado"]=='2') echo'selected';
							echo '>2</option>
                        	</select>
							</td>';
							
							//Apuesta
							echo '<td>
							<select style="width:40px" name="apuesta">
							<option value="">--</option>
                        	<option value="1"';
							if($row["apuesta"]=='1') echo'selected';
							
							echo '>1</option>
					        <option value="x"';
							if($row["apuesta"]=='x') echo'selected';
							echo '>X</option>
							<option value="2"';
							if($row["apuesta"]=='2') echo'selected';
							echo '>2</option>
                        	</select>';
							echo'</td>';
							
							//Apostante
							echo '<td>
							<select style="width:80px" name="apostante">
							<option value="">--</option>
                        	<option value="Nano"';
							if($row["apostante"]=='Nano') echo'selected';
							echo '>Nano</option>
					        <option value="Tapia"';
							if($row["apostante"]=='Tapia') echo'selected';
							echo '>Tapia</option><option value="Borja"';
							if($row["apostante"]=='Borja') echo'selected';
							echo '>Borja</option>
							<option value="Lucho"';
							if($row["apostante"]=='Lucho') echo'selected';
							echo '>Lucho</option>';
							echo '<option value="Zato"';
							if($row["apostante"]=='Zato') echo'selected';
							
							echo '>Zato</option>
					        <option value="Rulo"';
							if($row["apostante"]=='Rulo') echo'selected';
							echo '>Rulo</option>
							<option value="Poles"';
							if($row["apostante"]=='Poles') echo'selected';
							echo '>Poles</option>';
							echo '<option value="Matute"';
							if($row["apostante"]=='Matute') echo'selected';
							
							echo '>Matute</option>';
							
                        	echo '</select>';
							echo'</td>';							//Cuota
							echo '<td><input type="text" name="cuota" value="'.$row["cuota"].'" style ="width:80px"> </td>';
							//Ganancia
							echo '<td><input type="text" name="ganancia" value="'.$row["ganancia"].'" style ="width:80px"> </td>';
							
							//echo '<td><input type="text" name="id" value="'.$row["id"].'" style ="width:20px"> <input type="submit"</td>';
							echo '<td>'.$row["id"].' <input type="submit"></td>';
							//hidden QUERY
							echo '<input type="hidden" name="id" value="'.$row["id"].'">';
							echo '<input type="hidden" name="query" value="1">';
							echo '<input type="hidden" name="admin" value="anopeludo">';
							echo '</form></tr>';
							}
							mysql_free_result($result);
							//INSERT
							echo '<tr> <form>';
							//Fecha
							echo '<td style="text-align:center"><input type="text" name="fecha" value="" style ="width:80px"></td>';
							//Partido
							echo '<td style="text-align:center">
							Bandera Local<input type="text" name="band_local" value="" style ="width:80px">
							<br>Partido<input type="text" name="partido" value="" style ="width:80px">
							<br>Bandera Visitante<input type="text" name="band_visit" value="" style ="width:80px">
							</td>';
							
							//Resultado
							echo '<td>
							<select style="width:40px" name="resultado">
							<option value="">--</option>
                        	<option value="1">1</option>
					        <option value="x">X</option>
							<option value="2">2</option>
                        	</select>';
							echo'</td>';
							
							//Apuesta
							echo '<td>
							<select style="width:40px" name="apuesta">
							<option value="">--</option>
                        	<option value="1">1</option>
					        <option value="x">X</option>
							<option value="2">2</option>
                        	</select>';
							echo'</td>';
							
							//Apostante
							echo '<td>
							<select style="width:80px" name="apostante">
							<option value="">--</option>
                        	<option value="Nano"';
							if($row["apostante"]=='Nano') echo'selected';
							echo '>Nano</option>
					        <option value="Tapia"';
							if($row["apostante"]=='Tapia') echo'selected';
							echo '>Tapia</option><option value="Borja"';
							if($row["apostante"]=='Borja') echo'selected';
							echo '>Borja</option>
							<option value="Lucho"';
							if($row["apostante"]=='Lucho') echo'selected';
							echo '>Lucho</option>';
							echo '<option value="Zato"';
							if($row["apostante"]=='Zato') echo'selected';
							
							echo '>Zato</option>
					        <option value="Rulo"';
							if($row["apostante"]=='Rulo') echo'selected';
							echo '>Rulo</option>
							<option value="Poles"';
							if($row["apostante"]=='Poles') echo'selected';
							echo '>Poles</option>';
							echo '<option value="Matute"';
							if($row["apostante"]=='Matute') echo'selected';
							
							echo '>Matute</option>';
							
                        	echo '</select>';
							echo'</td>';
							//Cuota
							echo '<td><input type="text" name="cuota" value="" style ="width:80px"> </td>';
							//Ganancia
							echo '<td><input type="text" name="ganancia" value="" style ="width:80px"> </td>';
							
							//echo '<td><input type="text" name="id" value="'.$row["id"].'" style ="width:20px"> <input type="submit"</td>';
							echo '<td> <input type="submit"></td>';
							//hidden QUERY
							echo '<input type="hidden" name="id" value="">';
							echo '<input type="hidden" name="fase" value="GRUPOB">';
							echo '<input type="hidden" name="query" value="2">';
							echo '<input type="hidden" name="admin" value="anopeludo">';
							echo '</form></tr>';
					  }else{
						   //Mostramos los registros
							while ($row=mysql_fetch_array($result))
							{
								$date = date_create($row["fecha"]);
							echo '<tr>';
							echo '<td style="text-align:center">'.date_format($date, 'd/m/Y H:i');'</td>';
							echo '<td style="text-align:center"><img src="../images/'
								.$row["band_local"].'" width="20"> '
								.$row["partido"].' <img src="../images/'
								.$row["band_visit"].'" width="20"></td>';
							echo '<td>'.$row["resultado"].'</td>';
							echo '<td>'.$row["apuesta"].'</td>';
							echo '<td>'.$row["apostante"].'</td>';
							echo '<td>'.$row["cuota"].'</td>';
							echo '<td>'.$row["ganancia"].'</td>';
							echo '</tr>	';
							}
							mysql_free_result($result);
					  }
                        ?>
						</tbody>
					</table>
<!-- GRUPO C-->
					<?
                    //Ejecutamos la sentencia SQL
                    $result=mysql_query("SELECT  ID as id,FECHA as fecha, PARTIDO as partido, RESULTADO as resultado, APUESTA as apuesta, APOSTANTE as apostante, CUOTA as cuota, GANANCIA as ganancia, BAND_LOCAL as band_local, BAND_VISIT as band_visit  
                                        FROM partidos 
                                        WHERE FASE='GRUPOC' 
                                        ORDER BY FECHA ASC");
                    ?>
					<h3>Grupo C</h3>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th style="text-align:center">Fecha del partido</th>
								<th style="text-align:center">Partido</th>
								<th style="text-align:center">Resultado</th>
								<th style="text-align:center">Apuesta</th>
								<th style="text-align:center">Apostante</th>
								<th style="text-align:center">Cuota</th>
								<th style="text-align:center">Ganancia</th>
                                  <? 
                                	if($_GET["admin"]=="anopeludo") echo '<th style="text-align:center">Id</th>';
								?>
							</tr>
						</thead>
						<tbody>
						<? 
						if($_GET["admin"]=="anopeludo"){
					  //TABLA ADMIN
					  //Mostramos los registros
							while ($row=mysql_fetch_array($result))
							{
								$date = date_create($row["fecha"]);
							echo '<tr> <form>';
							echo '<td style="text-align:center">'.date_format($date, 'd/m/Y H:i');'</td>';
							echo '<td style="text-align:center"><img src="../images/'
								.$row["band_local"].'" width="20"> '
								.$row["partido"].' <img src="../images/'
								.$row["band_visit"].'" width="20"></td>';
							
							//Resultado
							echo '<td>
							<select style="width:40px" name="resultado">
							<option value="">--</option>
                        	<option value="1"';
							if($row["resultado"]=='1') echo'selected';
							
							echo '>1</option>
					        <option value="x"';
							if($row["resultado"]=='x') echo'selected';
							echo '>X</option>
							<option value="2"';
							if($row["resultado"]=='2') echo'selected';
							echo '>2</option>
                        	</select>
							</td>';
							
							//Apuesta
							echo '<td>
							<select style="width:40px" name="apuesta">
							<option value="">--</option>
                        	<option value="1"';
							if($row["apuesta"]=='1') echo'selected';
							
							echo '>1</option>
					        <option value="x"';
							if($row["apuesta"]=='x') echo'selected';
							echo '>X</option>
							<option value="2"';
							if($row["apuesta"]=='2') echo'selected';
							echo '>2</option>
                        	</select>';
							echo'</td>';
							
							//Apostante
							echo '<td>
							<select style="width:80px" name="apostante">
							<option value="">--</option>
                        	<option value="Nano"';
							if($row["apostante"]=='Nano') echo'selected';
							echo '>Nano</option>
					        <option value="Tapia"';
							if($row["apostante"]=='Tapia') echo'selected';
							echo '>Tapia</option><option value="Borja"';
							if($row["apostante"]=='Borja') echo'selected';
							echo '>Borja</option>
							<option value="Lucho"';
							if($row["apostante"]=='Lucho') echo'selected';
							echo '>Lucho</option>';
							echo '<option value="Zato"';
							if($row["apostante"]=='Zato') echo'selected';
							
							echo '>Zato</option>
					        <option value="Rulo"';
							if($row["apostante"]=='Rulo') echo'selected';
							echo '>Rulo</option>
							<option value="Poles"';
							if($row["apostante"]=='Poles') echo'selected';
							echo '>Poles</option>';
							echo '<option value="Matute"';
							if($row["apostante"]=='Matute') echo'selected';
							
							echo '>Matute</option>';
							
                        	echo '</select>';
							echo'</td>';
							//Cuota
							echo '<td><input type="text" name="cuota" value="'.$row["cuota"].'" style ="width:80px"> </td>';
							//Ganancia
							echo '<td><input type="text" name="ganancia" value="'.$row["ganancia"].'" style ="width:80px"> </td>';
							
							//echo '<td><input type="text" name="id" value="'.$row["id"].'" style ="width:20px"> <input type="submit"</td>';
							echo '<td>'.$row["id"].' <input type="submit"></td>';
							//hidden QUERY
							echo '<input type="hidden" name="id" value="'.$row["id"].'">';
							echo '<input type="hidden" name="query" value="1">';
							echo '<input type="hidden" name="admin" value="anopeludo">';
							echo '</form></tr>';
							}
							mysql_free_result($result);
							//INSERT
							echo '<tr> <form>';
							//Fecha
							echo '<td style="text-align:center"><input type="text" name="fecha" value="" style ="width:80px"></td>';
							//Partido
							echo '<td style="text-align:center">
							Bandera Local<input type="text" name="band_local" value="" style ="width:80px">
							<br>Partido<input type="text" name="partido" value="" style ="width:80px">
							<br>Bandera Visitante<input type="text" name="band_visit" value="" style ="width:80px">
							</td>';
							
							//Resultado
							echo '<td>
							<select style="width:40px" name="resultado">
							<option value="">--</option>
                        	<option value="1">1</option>
					        <option value="x">X</option>
							<option value="2">2</option>
                        	</select>';
							echo'</td>';
							
							//Apuesta
							echo '<td>
							<select style="width:40px" name="apuesta">
							<option value="">--</option>
                        	<option value="1">1</option>
					        <option value="x">X</option>
							<option value="2">2</option>
                        	</select>';
							echo'</td>';
							
							//Apostante
							echo '<td>
							<select style="width:80px" name="apostante">
							<option value="">--</option>
                        	<option value="Nano"';
							if($row["apostante"]=='Nano') echo'selected';
							echo '>Nano</option>
					        <option value="Tapia"';
							if($row["apostante"]=='Tapia') echo'selected';
							echo '>Tapia</option><option value="Borja"';
							if($row["apostante"]=='Borja') echo'selected';
							echo '>Borja</option>
							<option value="Lucho"';
							if($row["apostante"]=='Lucho') echo'selected';
							echo '>Lucho</option>';
							echo '<option value="Zato"';
							if($row["apostante"]=='Zato') echo'selected';
							
							echo '>Zato</option>
					        <option value="Rulo"';
							if($row["apostante"]=='Rulo') echo'selected';
							echo '>Rulo</option>
							<option value="Poles"';
							if($row["apostante"]=='Poles') echo'selected';
							echo '>Poles</option>';
							echo '<option value="Matute"';
							if($row["apostante"]=='Matute') echo'selected';
							
							echo '>Matute</option>';
							
                        	echo '</select>';
							echo'</td>';
							//Cuota
							echo '<td><input type="text" name="cuota" value="" style ="width:80px"> </td>';
							//Ganancia
							echo '<td><input type="text" name="ganancia" value="" style ="width:80px"> </td>';
							
							//echo '<td><input type="text" name="id" value="'.$row["id"].'" style ="width:20px"> <input type="submit"</td>';
							echo '<td> <input type="submit"></td>';
							//hidden QUERY
							echo '<input type="hidden" name="id" value="">';
							echo '<input type="hidden" name="fase" value="GRUPOC">';
							echo '<input type="hidden" name="query" value="2">';
							echo '<input type="hidden" name="admin" value="anopeludo">';
							echo '</form></tr>';
					  }else{
						  //Mostramos los registros
							while ($row=mysql_fetch_array($result))
							{
								$date = date_create($row["fecha"]);
							echo '<tr>';
							echo '<td style="text-align:center">'.date_format($date, 'd/m/Y H:i');'</td>';
							echo '<td style="text-align:center"><img src="../images/'
								.$row["band_local"].'" width="20"> '
								.$row["partido"].' <img src="../images/'
								.$row["band_visit"].'" width="20"></td>';
							echo '<td>'.$row["resultado"].'</td>';
							echo '<td>'.$row["apuesta"].'</td>';
							echo '<td>'.$row["apostante"].'</td>';
							echo '<td>'.$row["cuota"].'</td>';
							echo '<td>'.$row["ganancia"].'</td>';
							echo '</tr>	';
							}
							mysql_free_result($result);
					  }
                        ?>
						</tbody>
					</table>
                    
<!-- GRUPO D-->
					<?
                    //Ejecutamos la sentencia SQL
                    $result=mysql_query("SELECT  ID as id,FECHA as fecha, PARTIDO as partido, RESULTADO as resultado, APUESTA as apuesta, APOSTANTE as apostante, CUOTA as cuota, GANANCIA as ganancia, BAND_LOCAL as band_local, BAND_VISIT as band_visit  
                                        FROM partidos 
                                        WHERE FASE='GRUPOD' 
                                        ORDER BY FECHA ASC");
                    ?>
					<h3>Grupo D</h3>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th style="text-align:center">Fecha del partido</th>
								<th style="text-align:center">Partido</th>
								<th style="text-align:center">Resultado</th>
								<th style="text-align:center">Apuesta</th>
								<th style="text-align:center">Apostante</th>
								<th style="text-align:center">Cuota</th>
								<th style="text-align:center">Ganancia</th>
                                  <? 
                                	if($_GET["admin"]=="anopeludo") echo '<th style="text-align:center">Id</th>';
								?>
							</tr>
						</thead>
						<tbody>
						<? 
						if($_GET["admin"]=="anopeludo"){
					  //TABLA ADMIN
					  //Mostramos los registros
							while ($row=mysql_fetch_array($result))
							{
								$date = date_create($row["fecha"]);
							echo '<tr> <form>';
							echo '<td style="text-align:center">'.date_format($date, 'd/m/Y H:i');'</td>';
							echo '<td style="text-align:center"><img src="../images/'
								.$row["band_local"].'" width="20"> '
								.$row["partido"].' <img src="../images/'
								.$row["band_visit"].'" width="20"></td>';
							
							//Resultado
							echo '<td>
							<select style="width:40px" name="resultado">
							<option value="">--</option>
                        	<option value="1"';
							if($row["resultado"]=='1') echo'selected';
							
							echo '>1</option>
					        <option value="x"';
							if($row["resultado"]=='x') echo'selected';
							echo '>X</option>
							<option value="2"';
							if($row["resultado"]=='2') echo'selected';
							echo '>2</option>
                        	</select>
							</td>';
							
							//Apuesta
							echo '<td>
							<select style="width:40px" name="apuesta">
							<option value="">--</option>
                        	<option value="1"';
							if($row["apuesta"]=='1') echo'selected';
							
							echo '>1</option>
					        <option value="x"';
							if($row["apuesta"]=='x') echo'selected';
							echo '>X</option>
							<option value="2"';
							if($row["apuesta"]=='2') echo'selected';
							echo '>2</option>
                        	</select>';
							echo'</td>';
							
							//Apostante
							echo '<td>
							<select style="width:80px" name="apostante">
							<option value="">--</option>
                        	<option value="Nano"';
							if($row["apostante"]=='Nano') echo'selected';
							echo '>Nano</option>
					        <option value="Tapia"';
							if($row["apostante"]=='Tapia') echo'selected';
							echo '>Tapia</option><option value="Borja"';
							if($row["apostante"]=='Borja') echo'selected';
							echo '>Borja</option>
							<option value="Lucho"';
							if($row["apostante"]=='Lucho') echo'selected';
							echo '>Lucho</option>';
							echo '<option value="Zato"';
							if($row["apostante"]=='Zato') echo'selected';
							
							echo '>Zato</option>
					        <option value="Rulo"';
							if($row["apostante"]=='Rulo') echo'selected';
							echo '>Rulo</option>
							<option value="Poles"';
							if($row["apostante"]=='Poles') echo'selected';
							echo '>Poles</option>';
							echo '<option value="Matute"';
							if($row["apostante"]=='Matute') echo'selected';
							
							echo '>Matute</option>';
							
                        	echo '</select>';
							echo'</td>';
							//Cuota
							echo '<td><input type="text" name="cuota" value="'.$row["cuota"].'" style ="width:80px"> </td>';
							//Ganancia
							echo '<td><input type="text" name="ganancia" value="'.$row["ganancia"].'" style ="width:80px"> </td>';
							
							//echo '<td><input type="text" name="id" value="'.$row["id"].'" style ="width:20px"> <input type="submit"</td>';
							echo '<td>'.$row["id"].' <input type="submit"></td>';
							//hidden QUERY
							echo '<input type="hidden" name="id" value="'.$row["id"].'">';
							echo '<input type="hidden" name="query" value="1">';
							echo '<input type="hidden" name="admin" value="anopeludo">';
							echo '</form></tr>';
							}
							mysql_free_result($result);
							//INSERT
							echo '<tr> <form>';
							//Fecha
							echo '<td style="text-align:center"><input type="text" name="fecha" value="" style ="width:80px"></td>';
							//Partido
							echo '<td style="text-align:center">
							Bandera Local<input type="text" name="band_local" value="" style ="width:80px">
							<br>Partido<input type="text" name="partido" value="" style ="width:80px">
							<br>Bandera Visitante<input type="text" name="band_visit" value="" style ="width:80px">
							</td>';
							
							//Resultado
							echo '<td>
							<select style="width:40px" name="resultado">
							<option value="">--</option>
                        	<option value="1">1</option>
					        <option value="x">X</option>
							<option value="2">2</option>
                        	</select>';
							echo'</td>';
							
							//Apuesta
							echo '<td>
							<select style="width:40px" name="apuesta">
							<option value="">--</option>
                        	<option value="1">1</option>
					        <option value="x">X</option>
							<option value="2">2</option>
                        	</select>';
							echo'</td>';
							
							//Apostante
							echo '<td>
							<select style="width:80px" name="apostante">
							<option value="">--</option>
                        	<option value="Nano"';
							if($row["apostante"]=='Nano') echo'selected';
							echo '>Nano</option>
					        <option value="Tapia"';
							if($row["apostante"]=='Tapia') echo'selected';
							echo '>Tapia</option><option value="Borja"';
							if($row["apostante"]=='Borja') echo'selected';
							echo '>Borja</option>
							<option value="Lucho"';
							if($row["apostante"]=='Lucho') echo'selected';
							echo '>Lucho</option>';
							echo '<option value="Zato"';
							if($row["apostante"]=='Zato') echo'selected';
							
							echo '>Zato</option>
					        <option value="Rulo"';
							if($row["apostante"]=='Rulo') echo'selected';
							echo '>Rulo</option>
							<option value="Poles"';
							if($row["apostante"]=='Poles') echo'selected';
							echo '>Poles</option>';
							echo '<option value="Matute"';
							if($row["apostante"]=='Matute') echo'selected';
							
							echo '>Matute</option>';
							
                        	echo '</select>';
							echo'</td>';
							//Cuota
							echo '<td><input type="text" name="cuota" value="" style ="width:80px"> </td>';
							//Ganancia
							echo '<td><input type="text" name="ganancia" value="" style ="width:80px"> </td>';
							
							//echo '<td><input type="text" name="id" value="'.$row["id"].'" style ="width:20px"> <input type="submit"</td>';
							echo '<td> <input type="submit"></td>';
							//hidden QUERY
							echo '<input type="hidden" name="id" value="">';
							echo '<input type="hidden" name="fase" value="GRUPOD">';
							echo '<input type="hidden" name="query" value="2">';
							echo '<input type="hidden" name="admin" value="anopeludo">';
							echo '</form></tr>';
					  }else{
						  //Mostramos los registros
							while ($row=mysql_fetch_array($result))
							{
								$date = date_create($row["fecha"]);
							echo '<tr>';
							echo '<td style="text-align:center">'.date_format($date, 'd/m/Y H:i');'</td>';
							echo '<td style="text-align:center"><img src="../images/'
								.$row["band_local"].'" width="20"> '
								.$row["partido"].' <img src="../images/'
								.$row["band_visit"].'" width="20"></td>';
							echo '<td>'.$row["resultado"].'</td>';
							echo '<td>'.$row["apuesta"].'</td>';
							echo '<td>'.$row["apostante"].'</td>';
							echo '<td>'.$row["cuota"].'</td>';
							echo '<td>'.$row["ganancia"].'</td>';
							echo '</tr>	';
							}
							mysql_free_result($result);
							mysql_close();
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

