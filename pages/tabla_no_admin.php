<?
while ($row=mysql_fetch_array($result)) {
	$date = date_create($row["fecha"]);
	echo '<tr>';
	echo '<td style="text-align:center">';
	echo '<a class="btn btn-info" data-toggle="collapse" data-target="#comment'.$row["id"].'" href="#'.$row["id"].'">';
	if($row["comentario"]==''){
		echo '<i class="icon-minus icon-white"></i>';
	}else{
		echo '<i class="icon-plus icon-white"></i>';
	}
	echo '</a>';
	echo '</td>';
	echo '<td style="text-align:center">'.date_format($date, 'd/m/Y H:i');' ';
	$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
	$fecha_actual_24 = strtotime(date("d-m-Y H:i:00",time()))+72000;
	$fecha_partido = strtotime($row["fecha"]);
//echo '<!--';
//echo $fecha_actual;
//echo '--'; 
//echo $fecha_actual_24;
//echo '--';
//echo $fecha_partido ;
//echo '--';
//echo strtotime($row["fecha"]);
//echo '-->';
	if($fecha_partido>$fecha_actual && $fecha_partido < $fecha_actual_24){
		echo ' <span class="badge badge-warning"><i class="icon-fire icon-white"></i> </span>';
	}
	echo '</td>';
	echo '<td style="text-align:center"><img src="../images/'
		.$row["band_local"].'" width="20"> '
		.$row["partido"].' <img src="../images/'
		.$row["band_visit"].'" width="20"></td>';
	echo '<td style="text-align:center"><strong>'.$row["resultado"].'</strong></td>';
	echo '<td style="text-align:center"><strong>'.$row["apuesta"].' </strong>';
	if($row["resultado"]!="" && $row["apuesta"]!=""){
		if($row["resultado"]!= $row["apuesta"]){
			echo ' <span class="badge badge-important">
				<i class="icon-remove icon-white"></i> </span>';
		}else{
			echo '<span class="badge badge-success">
				<i class="icon-ok icon-white"></i> </span>';
		}
	}
	echo '</td>';
	echo '<td style="text-align:center">'.$row["apostante"].'</td>';
	echo '<td style="text-align:center">'.$row["ganancia"].'</td>';
	echo '</tr>	';
	echo '<tr >';
	echo '<td colspan = "7" style="padding: 0px 0px 0px 0px">'; 
	echo '<div id ="comment'.$row["id"].'" class="collapse" style="margin-bottom:0px;margin-left:10px;margin-right:10px;border-radius:0px 0px 4px 4px;background-color: #D9EDF7"> ';
  	echo '<p style="margin-left:10px"> '.$row["comentario"].'</p></div></td></tr>';
}mysql_free_result($result);
						

?>
