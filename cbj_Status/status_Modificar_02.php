<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

					master_index();

			if ($_POST['oculto2']){	show_form();
									info_01();
					}
						elseif($_POST['oculto']){
											process_form();
											info_02();
							} else {
										show_form();
								}
				}
					else { require '../Inclu/table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
		global $db;
		global $db_name;	
	
		global $vname;
		$vname = "cbj_status";
		$vname = "`".$vname."`";

		global $id;
		$id = $_POST['id'];
		
		global $year;
		$year = $_POST['year'];
		$ycod = substr(trim($_POST['year']),-2,2);
		global $stat;
		$stat = $_POST['stat'];
		global $hidden;
		$hidden = $_POST['hidden'];

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=4 class='BorderInf'>
						MODIFICADO EN ".strtoupper($vname)."
					</th>
				</tr>
												
				<tr align='center'>
					<td class='BorderInfDch'>
						YEAR
					</td>
					<td class='BorderInfDch'>	
						CODE
					</td>
					<td class='BorderInfDch'>	
						STATUS
					</td>
					<td class='BorderInf'>	
						HIDDEN
					</td>
				</tr>
				<tr align='center'>
					<td  class='BorderInfDch'>"
						.$year.
					"</td>
					<td  class='BorderInfDch'>"
						.$ycod.
					"</td>
					<td  class='BorderInfDch'>"
						.$stat.
					"</td>
					<td  class='BorderInf'>"
						.$hidden.
					"</td>
				</tr>
				
			</table>
				
		";	
		
	$sqla = "UPDATE `$db_name`.$vname SET `year` = '$year', `ycod` = '$ycod', `stat` = '$stat', `hidden` = '$hidden' WHERE `year` = '$year'";
		
		if(mysqli_query($db, $sqla)){ print($tabla); 
										ver_todo();
					} else {
							print("* MODIFIQUE LA ENTRADA 111: ".mysqli_error($db));
									show_form ();
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
					}
					
}	

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
									EJERCCIOS STATUS ".mysqli_num_rows($qb).".
										</th>
									</tr>
									
									<tr align='center'>
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
										
										<th class='BorderInf'>
												HIDDEN
										</th>																			

									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){


			print (	"<tr align='center'>

						<td class='BorderInfDch' align='center'>
						".$rowb['id']."
						</td>

						<td class='BorderInfDch' align='center'>
						".$rowb['year']."
						</td>
	
						<td class='BorderInfDch' align='center'>
						".$rowb['ycod']."
						</td>
						
						<td class='BorderInfDch' align='center'>
						".$rowb['stat']."
						</td>

						<td class='BorderInf' align='center'>
						".$rowb['hidden']."
						</td>

					</tr>");
								} /* Fin del while.*/ 

									print("	</table> ");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */

	}	/* Final ver_todo(); */

/////////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){
	
	global $db;
	global $db_name;
	
	if($_POST['oculto2']){	$defaults = array (	'id' => $_POST['id'],
												'year' => $_POST['year'],	
												'ycod' => $_POST['ycod'],	
												'stat' => $_POST['stat'],
												'hidden' => $_POST['hidden'],
															);
						}
	elseif($_POST['oculto']){
		$defaults = $_POST;
		} else {
				$defaults = array (	'id' => $_POST['id'],
									'year' => $_POST['year'],	
									'ycod' => $_POST['ycod'],	
									'stat' => $_POST['stat'],
									'hidden' => $_POST['hidden'],	
													);
							   		}

	$stat = array (	'open' => 'STATE OPEN',
					'close' => 'STATE CLOSE',
										);
										
	$hidden = array (	'no' => 'HIDDEN NO',
						'si' => 'HIDDEN YES',
										);

////////////////////

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=4 class='BorderInf'>
								MODIFICAR STATUS EJERCICIO					
					</th>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>

			<tr>
					<td align='center'>						
						YEAR
					</td>
					<td align='center'>						
						CODE
					</td>
					<td align='center'>						
						STATUS
					</td>
					<td align='center'>						
						HIDDEN
					</td>
			</tr>
				<tr>
					<td>
	<input name='year' type='hidden' value='".$defaults['year']."' />".$defaults['year']."
	<input name='id' type='hidden' value='".$defaults['id']."' />
					</td>
					
					<td align='center'>
	<input name='ycod' type='hidden' value='".$defaults['ycod']."' />".$defaults['ycod']."
					</td>
						
					<td>

	<select name='stat'>");

						
				foreach($stat as $option => $stat1){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['stat']){
															print ("selected = 'selected'");
																								}
													print ("> $stat1 </option>");
												}	
						
	print ("</select>

					</td>
					<td>
	<select name='hidden'>");

						
				foreach($hidden as $option => $hidden1){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['hidden']){
															print ("selected = 'selected'");
																								}
													print ("> $hidden1 </option>");
												}	
						
	print ("</select>
				</td>
				
				</tr>
					
				<tr>
					<td colspan='4' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='MODIFICAR STATUS EJERCICIO' />
						<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
				
		</form>														
			
			</table>				
						"); 
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function info_01(){

	global $db;
	
	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
global $text;
$text = "\n- STATUS MODIFICAR SELECCIONADO ".$ActionTime.".\n\t ID: ".$_POST['id'].".\n\t YEAR: ".$_POST['year'].".\n\t STATUS: ".$_POST['stat'].".\n\t HIDDEN: ".$_POST['hidden'].".";

		$logdocu = $_SESSION['ref'];
		$logdate = date('Y_m_d');
		$logtext = $text."\n";
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

function info_02(){

	global $db;
	
	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
global $text;
$text = "\n- STATUS MODIFICADO ".$ActionTime.".\n\t ID: ".$_POST['id'].".\n\t YEAR: ".$_POST['year'].".\n\t STATUS: ".$_POST['stat'].".\n\t HIDDEN: ".$_POST['hidden'].".";

		$logdocu = $_SESSION['ref'];
		$logdate = date('Y_m_d');
		$logtext = $text."\n";
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

	function master_index(){
		
				require '../Inclu_MInd/Master_Index_Impuestos.php';
		
				} /* Fin funcion master_index.*/

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';

?>