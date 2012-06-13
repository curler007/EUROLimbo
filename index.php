<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
	<link rel="icon" href="./favicon.png" type="image/png"/>
	<link rel="shortcut icon" href="./favicon.png" type="image/png"/>
<title>EURO 2012</title>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
	padding-top: 60px;
}
</style>
<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<!--GOOGLE Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-32407220-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
    <script>
				$(document).ready(function(){  	  									
					$("#formChat2").submit(function() { 		 		 		 		 		 		
						if($("#nombre2").val()!='' && $("#mensaje2").val()!='' && $("#nombre2").val()!='EUROLimbo'){		
							return true;
						}	 
						if($("#nombre2").val()==''|| $("#nombre2").val()=='EUROLimbo' ){
							$("#filesetusuario").attr("class","control-group error");
						}else{
							$("#filesetusuario").attr("class","");
						}
						if( $("#mensaje2").val()==''){
							$("#filesetmensaje").attr("class","control-group error");
						}else{
							$("#filesetmensaje").attr("class","");
						}	 				 		 			 	
						return false;
					});
				});
    </script>
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="#" style="vertical-align:top"><img src="./images/eurologo.png" height="20" style="vertical-align:top"> EURO<strong style="vertical-align:top">Limbo</strong> 2012</a>
				<ul class="nav">
					<li class="active"><a href="#">Home</a></li>
					<li  class="dropdown" id="menu1">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Partidos
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="./pages/faseGrupos.php">Fase de grupos</a></li>
							<li><a href="./pages/faseGrupos.php">Cuartos de final</a></li>
							<li><a href="./pages/semifinal.php">Semifinal</a></li>
							<li><a href="./pages/final.php">Final</a></li>
						</ul>
					</li>
					<li><a href="./pages/clasificacion.php">Clasificación</a></li>
				</ul>
			</div>
		</div>
	</div>


	<div class="container">
		<h1>EUROLimbo 2012</h1>
		<p>Una nueva manera de vivir la Eurocopa.</p>
	</div>
 
    <div class="container" style="height:200px;padding-top:40px;max-width:940px">

      <?
	include "./pages/conexion_bd.php";
	if($_POST["query"]==2){

		$usuario= $_POST["usuario"];
		$mensaje= $_POST["mensaje"];

		if($usuario=="EUROLimbo"){
			$usuario="EUROPenis";
			$mensaje="Intento de violaci&oacute;n de seguridad.";
		}else  if($usuario=="EUROLimbo_anopeludo"){
			 $usuario="EUROLimbo";
		}

		//else if (!preg_match('/^[a-z\d_]{4,28}$/i', $usuario)) {
		//	$usuario="EUROPenis";
		//	$mensaje="Intento de violaci&oacute;n de seguridad.";
		//}
		if (preg_match('/<(\s)*t/i', $mensaje)) {
			$usuario="EUROPenis";
			 $mensaje="Intento de violaci&oacute;n de seguridad.";
		}
		if(!mysql_query("INSERT INTO chat (USUARIO,MENSAJE,FECHA) VALUES ('$usuario', '$mensaje', now()) ")){
		//$query="UPDATE EURO2012.partidos set apostante='$culo' where id=14;";
		//$query="UPDATE EURO2012.partidos set apostante='aa' where id=14;";
		//mysql_close($mycon);
			die('Error: ' . mysql_error());
		}

		$_POST["query"]=0;
	}



			if($_POST["query"]==3){
			//Ejecutamos la sentencia SQL
	                    $result=mysql_query("SELECT  USUARIO as usuario,MENSAJE as mensaje,FECHA as fecha
                                        FROM chat
                                        ORDER BY ID DESC
                                        ");

			}else{
			//Ejecutamos la sentencia SQL
        	            $result=mysql_query("SELECT  USUARIO as usuario,MENSAJE as mensaje,FECHA as fecha
                                        FROM chat
                                        ORDER BY ID DESC
                                        LIMIT 50");

			}
         
                    ?>
        <table style="border-collapse: separate;">
            <tr>
                <td style="height: 20px;background-color:whiteSmoke;" align="center">
                <b>Chat</b>
			<a href=""><i class="icon-refresh"></i></a>
                </td>
            </tr>
            <tr>
            	<td style="display: block;display: table-cell;">
                <div style="height:200px;overflow: auto;width:100%;">
            <?
				echo '<table class="table-striped" style="width:100%;">';
				
				while ($row=mysql_fetch_array($result))
				{
					
					$date = date_create($row["fecha"]);
					echo '<tr>';
					if($row["usuario"]=="EUROLimbo"){
						echo '<td style="text-align:left">
						<div class="alert alert-info" style="padding: 0px 0px 0px 0px;margin-bottom: 0px;">
                                                        <span class="label label-warning">['.date_format($date, 'd/m/Y H:i').']</span>
                                                       <strong> '.$row["usuario"].':</strong> '.$row["mensaje"].' </div></td>';
					}else{
						echo '<td style="text-align:left">
							<span class="label label-info">['.date_format($date, 'd/m/Y H:i').']</span>
							<strong> '.$row["usuario"].':</strong> '.$row["mensaje"].' </td>';
					}
					//echo '<td>'.$row["usuario"].'</td>';
					//echo '<td>'.$row["mensaje"].'</td>';
					echo '</tr>	';
				}
				mysql_free_result($result);
				 if($_POST["query"]!=3){
				echo '<tr><td colspan="2" style="text-align:center">';
				echo '<div class="alert alert-success">';
				echo '<form action="" method="post">';
		
				echo '<input type="submit" class="btn btn-mini" value="Cargar todos los mensajes"/>';
				echo '<input type="hidden" name="query" value="3"/>';
				echo '</form></div></td></tr>';
				}
				echo '</table>';          
            
            ?>
            </div>
            <div style="display: block;">
            <form action="" method="post" class="well form-horizontal" id="formChat2">            
             <fieldset id="filesetusuario" style="display:inline;margin-bottom: 0px;"> 
				<input type="text" class="input-small" placeholder="Nombre" id="nombre2" name="usuario">
			</fieldset>   
			<fieldset id="filesetmensaje" style="display:inline;margin-bottom: 0px;"> 
				<input type="text" class="input-xxlarge" placeholder="Mensaje"  id="mensaje2" name="mensaje">
			</fieldset> 
			<input type="submit" class="btn" value="Enviar"/>		
			<input type="hidden" name="query" value="2"/>			
                
            </form> 
            </div>
            	</td>
            </tr>    
        </table>     
	</div>

	<!--container -->
	<script
		src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
