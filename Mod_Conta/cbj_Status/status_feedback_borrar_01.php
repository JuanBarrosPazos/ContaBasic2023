<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

										master_index();
										ver_todo();
										info();
								
				} else { require '../Inclu/table_permisos.php'; }

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db; 		global $db_name;
	
	global $vname; 		$vname = "`".$_SESSION['clave']."statusfeedback`";

	$sqlb =  "SELECT * FROM $vname ORDER BY `year` ASC LIMIT 1 ";
	$qb = mysqli_query($db, $sqlb);

	if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			
			if(mysqli_num_rows($qb) == 0){
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS ".strtoupper($vname)."
												</font>
											</td>
										</tr>
									</table>");

				} else { 	print ("<table align='center'>
										<th colspan=6 class='BorderInf'>
									BORRAR FEEDBACK ".mysqli_num_rows($qb)." RESULTADOS.
									<br />
									UNICO EJERCICIO PERMITIDO.
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

	global $tabla1;

			print (	"<tr align='center'>

	<form name='modifica' action='status_feedback_borrar_02.php' method='POST'>
	
	<input name='sesion' type='hidden' value='".$sesion."' />

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
										<input type='submit' value='BORRAR FEEDBACK EJERCICIO' />
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
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaStatus;	$rutaStatus = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function info(){

	global $db;
	global $nombre;
	
	$orden = $_POST['Orden'];
	
	$nombre = "FEEDBACK TODOS LOS EJERCICIOS";	

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	global $text;
	$text = "\n- FEEDBACK BORRAR 1: ".$ActionTime.".\n\t Filtro => ".$nombre.".";
	
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

	require '../Inclu/Conta_Footer.php';
		
?>