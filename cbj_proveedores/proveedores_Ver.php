<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

	master_index();

	require 'Inc_Logica_01.php';
	
} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	require 'Inc_Show_Form_01_Val.php';

	return $errors;

		} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	
	global $nombre;
	global $apellido;
	
	$nombre = isset($_POST['Nombre']);
	$apellido = isset($_POST['Apellidos']);
	
	show_form();
	
	if ($_POST['rsocial'] == ''){$rso = 'ññ';}
	else{$rso = "%".$_POST['rsocial']."%";}
	global $rsocial;
	$rsocial = $_POST['rsocial'];
	
	if ($_POST['dni'] == ''){$dni = 'ññ';}
	else{$dni = $_POST['dni'];}
	global $dnie;
	$dnie = $_POST['dni'];
	
	if ($_POST['ref'] == ''){$ref = 'ññ';}
	else{$ref = $_POST['ref'];}
	global $refer;
	$refer = $_POST['ref'];
	
	$orden = $_POST['Orden'];
		
	global $vname;
	$vname = "cbj_proveedores";
	$vname = "`".$vname."`";

$sqlc =  "SELECT * FROM $vname WHERE `ref` = '$ref' OR `dni` = '$dni' OR `rsocial` LIKE '$rso' ORDER BY $orden ";
 	
	$qc = mysqli_query($db, $sqlc);
	
	if(!$qc){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."</br></br>");
			
		} else {
			
			if(mysqli_num_rows($qc)== 0){
							print ("<table align='center' style=\"border:0px\">
										<tr>
											<td align='center'>
												<font color='#FF0000'>
														NINGÚN DATO SE CIÑE A ESTOS CRITERIOS.
													</br>
														INTENTELO CON OTROS PARÁMETROS.
												</font>
											</td>
										</tr>
									</table>");

				} else { 	
							print ("<table align='center'>
									<tr>
										<th colspan=6 class='BorderInf'>
									PROVEEDORES : ".mysqli_num_rows($qc).".
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											REFERENCIA
										</th>
										
										<th class='BorderInfDch'>
											DNI
										</th>
										
										<th class='BorderInfDch'>
											RAZON SOCIAL
										</th>
										
										<th class='BorderInf'>
											
										</th>
										
										<th class='BorderInf'>
											
										</th>
										
									</tr>");
			
			while($rowc = mysqli_fetch_assoc($qc)){
 			
			print (	"<tr align='center'>
									
<form name='ver' action='proveedores_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=550px,height=420px')\">

						<td align='left' class='BorderInfDch'>
		<input name='id' type='hidden' value='".$rowc['id']."' />".$rowc['id']."
						</td>

						<td align='left' class='BorderInfDch'>
		<input name='ref' type='hidden' value='".$rowc['ref']."' />".$rowc['ref']."
						</td>
							
						<td align='left' class='BorderInfDch'>
		<input name='dni' type='hidden' value='".$rowc['dni']."' />".$rowc['dni'].$rowc['ldni']."
		<input name='ldni' type='hidden' value='".$rowc['ldni']."' />
						</td>

						<td align='left' class='BorderInfDch'>
		<input name='rsocial' type='hidden' value='".$rowc['rsocial']."' />".$rowc['rsocial']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='myimg' type='hidden' value='".$rowc['myimg']."' />
<img src='../cbj_Docs/img_proveedores/".$rowc['myimg']."' height='40px' width='30px' />
						</td>
												
		<input name='doc' type='hidden' value='".$rowc['doc']."' />
		<input name='Email' type='hidden' value='".$rowc['Email']."' />
		<input name='Direccion' type='hidden' value='".$rowc['Direccion']."' />
		<input name='Tlf1' type='hidden' value='".$rowc['Tlf1']."' />
		<input name='Tlf2' type='hidden' value='".$rowc['Tlf2']."' />
						
			<td colspan=2 align='center' class='BorderInf'>
							<input type='submit' value='VER DETALLES' />
							<input type='hidden' name='oculto2' value=1 />
			</td>
										
	</form>
										
			</tr>");
					
								} /* Fin del while.*/ 

						print("</table>");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final process_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){

	global $titulo;
	$titulo = "VER PROVEEDORES";

	require 'Inc_Show_Form_01.php';

	}	/* Fin show_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	global $db;

	global $vname;
	$vname = "cbj_proveedores";
	$vname = "`".$vname."`";
	$orden = $_POST['Orden'];
	$sqlb =  "SELECT * FROM $vname ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);
	
if(!$qb){
print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>");
									
				} else { 	
							
							print ("<table align='center'>
									<tr>
										<th colspan=6 class='BorderInf'>
									PROVEEDORES : ".mysqli_num_rows($qb).".
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											REFERENCIA
										</th>
										
										<th class='BorderInfDch'>
											DNI
										</th>
										
										<th class='BorderInfDch'>
											RAZON SOCIAL
										</th>
										
										<th class='BorderInf'>
											
										</th>
										
										<th class='BorderInf'>
											
										</th>
										
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){
 			

			print (	"<tr align='center'>
									
<form name='ver' action='proveedores_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=590px,height=420px')\">

						<td align='left' class='BorderInfDch'>
		<input name='id' type='hidden' value='".$rowb['id']."' />".$rowb['id']."
						</td>

						<td align='left' class='BorderInfDch'>
		<input name='ref' type='hidden' value='".$rowb['ref']."' />".$rowb['ref']."
						</td>
							
						<td align='left' class='BorderInfDch'>
		<input name='dni' type='hidden' value='".$rowb['dni']."' />".$rowb['dni'].$rowb['ldni']."
		<input name='ldni' type='hidden' value='".$rowb['ldni']."' />
						</td>

						<td align='left' class='BorderInfDch'>
		<input name='rsocial' type='hidden' value='".$rowb['rsocial']."' />".$rowb['rsocial']."
						</td>
						
						<td class='BorderInfDch'>
		<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
<img src='../cbj_Docs/img_proveedores/".$rowb['myimg']."' height='40px' width='30px' />
						</td>
												
		<input name='doc' type='hidden' value='".$rowb['doc']."' />
		<input name='Email' type='hidden' value='".$rowb['Email']."' />
		<input name='Direccion' type='hidden' value='".$rowb['Direccion']."' />
		<input name='Tlf1' type='hidden' value='".$rowb['Tlf1']."' />
		<input name='Tlf2' type='hidden' value='".$rowb['Tlf2']."' />
						
			<td colspan=2 align='center' class='BorderInf'>
							<input type='submit' value='VER DETALLES' />
							<input type='hidden' name='oculto2' value=1 />
			</td>
										
	</form>
										
			</tr>");
					
					} /* Fin del while.*/ 

						print("</table>");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final er_todo(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
				require '../Inclu_MInd/Master_Index_Proveedores.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $db;
	global $orden;
	
	$orden = $_POST['Orden'];
	
	if (isset($_POST['todo'])){$filtro = "\n\tFiltro => TODOS LOS PROVEEDORES ".$orden;}
	else{$filtro = "\n\tFiltros: \n\tR. Social: ".$_POST['rsocial'].".\n\tDNI: ".$_POST['dni'].@$_POST['ldni'].".\n\tReferencia: ".$_POST['ref'].".";}

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	global $text;
	$text = "\n- PROVEEDORES BUSCAR ".$ActionTime.$filtro;

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y-m-d');
	$logtext = $text."\n";
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>