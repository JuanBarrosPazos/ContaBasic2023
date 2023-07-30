<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';

	require '../Inclu/sqld_query_fetch_assoc.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

 			print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
			master_index();

			if ($_POST['oculto2']){
					show_form();
					info_01();
								}
						elseif($_POST['borra']){
										process_form();
										info_02();
							} else {
										show_form();
									}
				} else { require '../Inclu/table_permisos.php'; } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
		print("<table align='center' style='margin-top:10px'>
		
				<tr>
					<th colspan=3 class='BorderInf'>
						HA BORRADO AL PROVEEDOR.
					</th>
				</tr>
								
				<tr>
					<td>
						RAZON SOCIAL
					</td>
					<td>"
						.$_POST['rsocial'].
					"</td>
					<td rowspan='4'>
<img src='../cbj_Docs/img_proveedores/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						DOCUMENTO
					</td>
					<td>"
						.$_POST['doc'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						NUMERO
					</td>
					<td>"
						.$_POST['dni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						CONTROL
					</td>
					<td>"
						.$_POST['ldni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						MAIL
					</td>
					<td colspan='2'>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
					<td>
						REFERENCIA
					</td>
					<td colspan='2'>"
						.$_POST['ref'].
					"</td>
				</tr>
				
				<tr>
					<td>
						PAIS
					</td>
					<td colspan='2'>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						TELEFONO 1
					</td>
					<td>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>
						TELEFONO 2
					</td>
					<td colspan='2'>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
								
			</table>" );

		global $db;
		global $db_name;	
	
		global $vname;
		$vname = "cbj_proveedores";
		$vname = "`".$vname."`";

	$sql = "DELETE FROM `$db_name`.$vname WHERE $vname.`id` = '$_POST[id]' LIMIT 1 ";
	
	if(mysqli_query($db, $sql)){
		
		$destination_file = "../cbj_Docs/img_proveedores/".$_POST['myimg'];
		if( file_exists($destination_file)){unlink($destination_file);}
		
		} else {	print("</br>
					<font color='#FF0000'>
					* MODIFIQUE LA ENTRADA 157: </font></br> ".mysqli_error($db))."
					</br>";
						show_form ();
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
					}
	
			}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form(){
	
	$_SESSION['xid'] = $_POST['id'];

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=3 class='BorderInf'>

							BORRARÁ EL PROVEEDOR
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						ID
					</td>
					<td>
<input type='hidden' name='id' value='".$_POST['id']."' />".$_POST['id']."
					</td>
					<td rowspan='4' align='center'>
<input type='hidden' name='myimg' value='".$_POST['myimg']."' />
<img src='../cbj_Docs/img_proveedores/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
					
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						REFERENCIA
					</td>
					<td>
<input type='hidden' name='ref' value='".$_POST['ref']."' />".$_POST['ref']."
					</td>
				</tr>
					
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						RAZON SOCIAL
					</td>
					<td>
<input type='hidden' name='rsocial' value='".$_POST['rsocial']."' />".$_POST['rsocial']."
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						DOCUMENTO
					</td>
					<td>
					
<input type='hidden' name='doc' value='".$_POST['doc']."' />".$_POST['doc']."

					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
							NÚMERO
					</td>
					<td colspan=2>
<input type='hidden' name='dni' value='".$_POST['dni']."' />".$_POST['dni']."
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							CONTROL
					</td>
					<td colspan=2>
<input type='hidden' name='ldni' value='".$_POST['ldni']."' />".$_POST['ldni']."
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							MAIL
					</td>
					<td colspan=2>
<input type='hidden'' name='Email' value='".$_POST['Email']."' />".$_POST['Email']."
					</td>
				</tr>	
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							DIRECCIÓN
					</td>
					<td colspan=2>
<input type='hidden' name='Direccion' value='".$_POST['Direccion']."' />".$_POST['Direccion']."
					</td>
				</tr>
				
				<tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							TELÉFONO 1
					</td>
					<td colspan=2>
<input type='hidden' name='Tlf1' value='".$_POST['Tlf1']."' />".$_POST['Tlf1']."
					</td>
				</tr>
				
				<tr>
					<tr>
					<td>
						<font color='#FF0000'>*</font>
							TELEÉFONO 2
					</td colspan=2>
					<td>
<input type='hidden' name='Tlf2' value='".$_POST['Tlf2']."' />".$_POST['Tlf2']."
					</td>
				</tr>
				
				<tr>
					<td colspan='3'  align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='BORRAR DATOS' />
						<input type='hidden' name='borra' value=1 />
						
					</td>
					
				</tr>
				
		</form>														
			
			</table>				
					"); /* Fin del print */
	
	}	/* Fin show_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
				require '../Inclu_MInd/Master_Index_Proveedores.php';
		
				} /* Fin funcion master_index.*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_01(){

	global $db;
	global $orden;

	$ActionTime = date('H:i:s');
	
	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}

	global $text;
	$text = "\n- PROVEEDORES GASTO ELIMINAR SELECCIONADO ".$ActionTime.".\n\tID: ".$_SESSION['xid'].".\n\tR. Social: ".$_POST['rsocial'].".\n\tDNI: ".$_POST['dni'].$_POST['ldni'].".\n\tReferencia: ".$_POST['ref'].".\n\tEmail: ".$_POST['Email'].".\n\tDireccion: ".$_POST['Direccion'].".\n\tTlf 1: ".$_POST['Tlf1'].".\n\tTlf 2: ".$_POST['Tlf2'].".";			

	global $texerror;
	$logdocu = $_SESSION['ref'];
	$logdate = date('Y-m-d');
	$logtext = $text.$texerror."\n";
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_02(){

	global $db;
	global $orden;

	$ActionTime = date('H:i:s');
	
	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}

	global $text;
	$text = "\n- PROVEEDORES GASTO ELIMINADO ".$ActionTime.".\n\tID: ".$_SESSION['xid'].".\n\tR. Social: ".$_POST['rsocial'].".\n\tDNI: ".$_POST['dni'].$_POST['ldni'].".\n\tReferencia: ".$_POST['ref'].".\n\tEmail: ".$_POST['Email'].".\n\tDireccion: ".$_POST['Direccion'].".\n\tTlf 1: ".$_POST['Tlf1'].".\n\tTlf 2: ".$_POST['Tlf2'].".";			

	global $texerror;
	$logdocu = $_SESSION['ref'];
	$logdate = date('Y-m-d');
	$logtext = $text.$texerror."\n";
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