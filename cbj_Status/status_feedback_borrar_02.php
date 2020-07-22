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
		$vname = "cbj_feedback";
		$vname = "`".$vname."`";

		global $id;
		$id = $_POST['id'];
		
		global $year;
		$year = $_POST['year'];
		global $ycod;
		$ycod = substr(trim($_POST['year']),-2,2);
		global $stat;
		$stat = $_POST['stat'];
		global $hidden;
		$hidden = $_POST['hidden'];
	
	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=4 class='BorderInf'>
						BORRADO EN ".strtoupper($vname)."
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
					<td class='BorderInfDch'>	
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
					<td  class='BorderInfDch'>"
						.$hidden.
					"</td>
				</tr>
				
			</table>
				
		";	
		
		$sqla = "DELETE FROM `$db_name`.$vname WHERE `year` = '$year'";
	
		if(mysqli_query($db, $sqla)){ 	borrart();
										borrard();
										borrare();
										print($tabla);
										ver_todo();
										ver_feedback();
			} else {
					print("* MODIFIQUE LA ENTRADA 114: ".mysqli_error($db));
					show_form ();
					global $texerror;
					$texerror = "\n\t ".mysqli_error($db);
			}
					
}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function borrard(){
	
		global $db_name;	
		global $sesionref;
		global $year;
		global $ycod;

		/* BORRAMOS DIRECTORIO Y ARCHIVOS INGRESOS => YEAR XXXX. */
					$dird1 = "../cbj_Docs/docingresos_".$year;
					if(file_exists($dird1)){	$dir1 = $dird1."/";
												$handle1 = opendir($dir1);
												while ($file1 = readdir($handle1))
														{if (is_file($dir1.$file1))
															{unlink($dir1.$file1);}
														}
												rmdir ($dird1);
												global $dd1;
												$dd1 = "\t- BORRADA: ".$dird1."/ \n";
												} else {print("");}

		/* BORRAMOS TABLA, DIRECTORIO Y ARCHIVOS GASTOS => YEAR XXXX. */
					$dird2 = "../cbj_Docs/docgastos_".$year;
					if(file_exists($dird2)){	$dir2 = $dird2."/";
												$handle2 = opendir($dir2);
												while ($file2 = readdir($handle2))
														{if (is_file($dir2.$file2))
															{unlink($dir2.$file2);}
														}
												rmdir ($dird2);
												global $dd2;
												$dd2 = "\t- BORRADA: ".$dird2."/ \n";
												} else {print("");}
	
	
	}

/////////////////////////////////////////////////////////////////////////////////////////////////

function borrare(){
	
		global $db;
		global $db_name;	
		global $sesionref;
		global $year;
		global $ycod;
		
		$vname3 = "cbj_balanceg";
		$vname3 = "`".$vname3."`";
		$vname3 = strtolower($vname3);	
		$sql3 = "DELETE FROM `$db_name`.$vname3 WHERE `year` = '$year'";
		if(mysqli_query($db, $sql3)){} 
		else {print("* MODIFIQUE LA ENTRADA 182: ".mysqli_error($db));}

		$vname4 = "cbj_balancei";
		$vname4 = "`".$vname4."`";
		$vname4 = strtolower($vname4);	
		$sql4 = "DELETE FROM `$db_name`.$vname4 WHERE `year` = '$year'";
		if(mysqli_query($db, $sql4)){} 
		else {print("* MODIFIQUE LA ENTRADA 189: ".mysqli_error($db));}
	
		$vname5 = "cbj_balanced";
		$vname5 = "`".$vname5."`";
		$vname5 = strtolower($vname5);	
		$sql5 = "DELETE FROM `$db_name`.$vname5 WHERE `year` = '$year'";
		if(mysqli_query($db, $sql5)){} 
		else {print("* MODIFIQUE LA ENTRADA 198: ".mysqli_error($db));}


		global $fil;
		$fil = $ycod."/%";
		
		$vname6 = "cbj_gastos_pendientes";
		$vname6 = "`".$vname6."`";
		$vname6 = strtolower($vname6);	
		$sql6 = "DELETE FROM `$db_name`.$vname6 WHERE `factdate` LIKE '$fil' ";
		if(mysqli_query($db, $sql6)){} 
		else {print("* MODIFIQUE LA ENTRADA 207: ".mysqli_error($db));}

		$vname7 = "cbj_ingresos_pendientes";
		$vname7 = "`".$vname7."`";
		$vname7 = strtolower($vname7);	
		$sql7 = "DELETE FROM `$db_name`.$vname7 WHERE `factdate` LIKE '$fil' ";
		if(mysqli_query($db, $sql7)){} 
		else {print("* MODIFIQUE LA ENTRADA 215: ".mysqli_error($db));}

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

function borrart(){
	
		global $db;
		global $db_name;	
		global $sesionref;
		global $year;
		global $ycod;
		
		/* BORRAMOS TABLA INGRESOS => YEAR XXXX. */
		global $vname1;
		$vname1 = "cbj_ingresos_".$year;
		$vname1 = "`".$vname1."`";
		$sql1 = "DROP TABLE `$db_name`.$vname1 ";
		if(mysqli_query($db, $sql1)){ 
				} else {
					print("* MODIFIQUE LA ENTRADA 234: ".mysqli_error($db));
						}
	
		/* BORRAMOS TABLA  GASTOS => YEAR XXXX. */
		global $vname2;
		$vname2 = "cbj_gastos_".$year;
		$vname2 = "`".$vname2."`";
		$sql2 = "DROP TABLE `$db_name`.$vname2 ";
		if(mysqli_query($db, $sql2)){ 
				} else {
					print("* MODIFIQUE LA ENTRADA 244: ".mysqli_error($db));
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
													NO HAY DATOS ".strtolower($vname)."

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

function ver_feedback(){
		
	global $db;
	global $db_name;
	
	global $vname;
	$vname = "cbj_feedback";
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
													NO HAY DATOS ".strtolower($vname)."
												</font>
											</td>
										</tr>
									</table>");

				} else { 	print ("<table align='center'>
										<th colspan=6 class='BorderInf'>
									FEEDBACK EJERCICIOS ".mysqli_num_rows($qb).".
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
										
										<th class='BorderInfDch'>
												HIDDEN
										</th>																			

										<th class='BorderInf'>
												DATE
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

						<td class='BorderInfDch' align='center'>
						".$rowb['hidden']."
						</td>

						<td class='BorderInf' align='center'>
						".$rowb['date']."
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
												'sesion' => $_POST['sesion'],
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
									'sesion' => $_POST['sesion'],
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
								BORRARDO TOTAL FEEDBACK EJERCICIO					
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
	<input name='sesion' type='hidden' value='".$defaults['sesion']."' />
					</td>
					
					<td align='center'>
	<input name='ycod' type='hidden' value='".$defaults['ycod']."' />".$defaults['ycod']."
					</td>
						
					<td align='center'>
	<input name='stat' type='hidden' value='".$defaults['stat']."' />".$defaults['stat']."
					</td>

					<td align='center'>
	<input name='hidden' type='hidden' value='".$defaults['hidden']."' />".$defaults['hidden']."
					</td>

				</tr>
					
				<tr>
					<td colspan='4' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='ELIMINAR FEEDBACK EJERCICIO' />
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
$text = "\n- FEEDBACK ELIMINAR SELECCIONADO ".$ActionTime.".\n\t ID: ".$_POST['id'].".\n\t YEAR: ".$_POST['year'].".\n\t STATUS: ".$_POST['stat'].".\n\t HIDDEN: ".$_POST['hidden'].".";

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
$text = "\n- FEEDBACK ELIMINADO ".$ActionTime.".\n\t ID: ".$_POST['id'].".\n\t YEAR: ".$_POST['year'].".\n\t STATUS: ".$_POST['stat'].".\n\t HIDDEN: ".$_POST['hidden'].".";

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