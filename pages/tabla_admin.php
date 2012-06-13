				 <?
                  //TABLA ADMIN
					  //Mostramos los registros
							while ($row=mysql_fetch_array($result))
							{
								$date = date_create($row["fecha"]);
							echo ' <form><tr>';
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
							
							//Ganancia
							echo '<td><input type="text" name="ganancia" value="'.$row["ganancia"].'" style ="width:80px"> </td>';
							
							//echo '<td><input type="text" name="id" value="'.$row["id"].'" style ="width:20px"> <input type="submit"</td>';
							echo '<td>'.$row["id"].' <input type="submit"></td>';
							//hidden QUERY
							echo '<input type="hidden" name="id" value="'.$row["id"].'">';
							echo '<input type="hidden" name="query" value="1">';
							echo '<input type="hidden" name="admin" value="anopeludo">';
							echo '</tr>
							<tr>
								<td colspan="8"><input type="text" name="comentario" value="'.$row["comentario"].'" class="span8" placeholder="Comentario"  style="text-align:center"> </td>
							</tr>
							
							</form>';
							}
							mysql_free_result($result);
//INSERT
							echo '<form><tr> ';
							//Fecha
							echo '<td style="text-align:center"><input type="text" name="fecha" value="" style ="width:80px"></td>';
							//Partido
							echo '<td style="text-align:center">
							<input type="text" name="band_local" class="span1" placeholder="Band. Local" value="" >
							<input type="text" name="partido" value=""  class="span2" placeholder="Partido">
							<input type="text" name="band_visit" value="" class="span1" placeholder="Band. Visitante">
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
				
							//Ganancia
							echo '<td><input type="text" name="ganancia" value="" style ="width:80px"> </td>';
							
							//echo '<td><input type="text" name="id" value="'.$row["id"].'" style ="width:20px"> <input type="submit"</td>';
							echo '<td> <input type="submit"></td>';
							//hidden QUERY
							echo '<input type="hidden" name="id" value="">';
							echo '<input type="hidden" name="fase" value="GRUPOA">';
							echo '<input type="hidden" name="query" value="2">';
							echo '<input type="hidden" name="admin" value="anopeludo">';
							echo '</tr>
							<tr>
								<td colspan="8"><input type="text" name="comentario" value="" placeholder="Comentario"  class="span8" style="text-align:center"> </td>
							</tr>
							
							</form>';
                            ?>