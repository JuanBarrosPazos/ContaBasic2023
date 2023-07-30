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
	$orden = '`iva` ASC';
	
	global $vname;
	$vname = "cbj_impuestos";
	$vname = "`".$vname."`";

	$sqlb =  "SELECT * FROM $vname ORDER BY $orden ";
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
										<th colspan=4 class='BorderInf'>
									TIPOS % IMPUESTOS ".mysqli_num_rows($qb)." RESULTADOS.
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
												ID
										</th>																			
										
										<th class='BorderInfDch'>
												VALUE %
										</th>																			
										
										<th class='BorderInfDch'>
												NAME
										</th>																			
										
										<th class='BorderInf'>
										</th>
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){

if($rowb['iva'] != 0.00){

			print (	"<tr align='center'>

	<form name='modifica' action='Impuestos_Modificar_02.php' method='POST'>

						<td class='BorderInfDch' align='center'>
	<input name='id' type='hidden' value='".$rowb['id']."' />".$rowb['id']."
						</td>

						<td class='BorderInfDch' align='center'>
	<input name='iva' type='hidden' value='".$rowb['iva']."' />".$rowb['iva']."
						</td>
	
						<td class='BorderInfDch' align='center'>
	<input name='name' type='hidden' value='".$rowb['name']."' />".$rowb['name']."
						</td>
						
						<td class='BorderInf' align='right'>
										<input type='submit' value='MODIFICAR % IMPUESTOS' />
										<input type='hidden' name='oculto2' value=1 />
						</td>
																			
		</form>
					</tr>");
	}
								} /* Fin del while.*/ 

									print("	</table> ");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */

	}	/* Final ver_todo(); */

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu_MInd/Master_Index_Impuestos.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function info(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;
	global $orden;
	
	$orden = $_POST['Orden'];
	
	if ($_POST['todo']){$nombre = "TODOS LOS IMPUESTOS ".$orden;};	

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	global $text;
	$text = "\n- IMPUESTOS MODIFICAR BUSCAR: ".$ActionTime.".\n\t Filtro => ".$nombre.".";
	
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