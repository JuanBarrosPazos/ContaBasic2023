<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

										master_index();
										ver_todo();
										info();
								
				} else { require '../Inclu/table_permisos.php'; }

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	global $db_name;
	
	global $vname;
	$vname = "cbj_status";
	$vname = "`".$vname."`";

	$sqlb =  "SELECT * FROM $vname ORDER BY `year` DESC ";
	$qb = mysqli_query($db, $sqlb);

	if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			
			if(mysqli_num_rows($qb) == 0){
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>");

				} else { 	print ("<table align='center'>
										<th colspan=6 class='BorderInf'>
									MODIFICAR EJERCCIOS STATUS ".mysqli_num_rows($qb)." RESULTADOS.
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
												ID
										</th>																			
										
										<th class='BorderInfDch'>
												YEAR
										</th>																			
										
										<th class='BorderInfDch'>
												ICOD
										</th>																			
										
										<th class='BorderInfDch'>
												STATE
										</th>																			
										
										<th class='BorderInfDch'>
												HIDDEN
										</th>																			

										<th class='BorderInf'>
										</th>
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){


			print (	"<tr align='center'>

	<form name='modifica' action='status_Modificar_02.php' method='POST'>

						<td class='BorderInfDch' align='center'>
	<input name='id' type='hidden' value='".$rowb['id']."' />".$rowb['id']."
						</td>

						<td class='BorderInfDch' align='center'>
	<input name='year' type='hidden' value='".$rowb['year']."' />".$rowb['year']."
						</td>
	
						<td class='BorderInfDch' align='center'>
	<input name='ycod' type='hidden' value='".$rowb['ycod']."' />".$rowb['ycod']."
						</td>
						
						<td class='BorderInfDch' align='center'>
	<input name='stat' type='hidden' value='".$rowb['stat']."' />".$rowb['stat']."
						</td>

						<td class='BorderInfDch' align='center'>
	<input name='hidden' type='hidden' value='".$rowb['hidden']."' />".$rowb['hidden']."
						</td>

						<td class='BorderInf' align='right'>
										<input type='submit' value='MODIFICAR STATUS EJERCICIO' />
										<input type='hidden' name='oculto2' value=1 />
						</td>
																			
		</form>
					</tr>");
								} /* Fin del while.*/ 

									print("	</table> ");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */

	}	/* Final ver_todo(); */

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu_MInd/Master_Index_status.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function info(){

	global $db;
	global $nombre;
	
	$orden = $_POST['Orden'];
	
	$nombre = "STATUS TODOS LOS EJERCICIOS";	

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	global $text;
	$text = "\n- STATUS MODIFICAR 1 BUSCAR: ".$ActionTime.".\n\t Filtro => ".$nombre.".";
	
	$logdocu = $_SESSION['ref'];
	$logdate = date('Y-m-d');
	$logtext = $text."\n";
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>