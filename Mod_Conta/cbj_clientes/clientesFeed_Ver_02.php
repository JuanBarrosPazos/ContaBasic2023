<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

	global $nombre;		$nombre = isset($_POST['Nombre']);
	global $apellido;	$apellido = isset($_POST['Apellidos']);
							
	if(isset($_POST['oculto2'])){	process_form();
									info();
										}
								
	} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	
	global $nombre;			$nombre = isset($_POST['Nombre']);
	global $apellido; 		$apellido = isset($_POST['Apellidos']);
	global $sesionref; 		$sesionref = $_SESSION['ref'];
	$sesionref = strtolower($sesionref);
	
	print("<table align='center' width=490px>
				<tr>
					<th colspan=3  class='BorderInf'>PAPELERA DATOS DEL CLIENTE</th>
				</tr>
				<tr>
					<td width=140px>ID</td><td>".$_POST['id']."</td>
					<td rowspan='5' align='center' width='180px'>
		<img src='../cbj_Docs/img_clientes/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
				<tr>
					<td>REFERENCIA</td><td>".$_POST['ref']."</td>
				</tr>
				<tr>
					<td>RAZON SOCIAL</td><td>".$_POST['rsocial']."</td>
				</tr>				
				<tr>
					<td>Tipo Documento:</td><td>".$_POST['doc']."</td>
				</tr>				
				<tr>
					<td>N&uacute;mero:</td><td>".$_POST['dni']." ".$_POST['ldni']."</td>
				</tr>				
				<tr>
					<td>MAIL</td><td colspan='2'>".$_POST['Email']."</td>
				</tr>
				<tr>
					<td>Direcci&oacute;n:</td><td colspan='2'>".$_POST['Direccion']."</td>
				</tr>
				<tr>
					<td>Tel&eacute;fono 1:</td><td colspan='2'>".$_POST['Tlf1']."</td>
				</tr>
				<tr>
					<td>Tel&eacute;fono 2:</td><td colspan='2'>".$_POST['Tlf2']."</td>
				</tr>
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
						<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
							<input type='submit' value='CERRAR VENTANA' class='botonverde' />
							<input type='hidden' name='oculto2' value=1 />
						</form>
					</td>
				</tr>
			</table>");

	} // FIN process_form()
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $db;
		
	$ActionTime = date('H:i:s');
	
	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	global $text;
	$text = "\n- CLIENTES DETALLES ".$ActionTime.".\n\tID: ".$_POST['id'].".\n\tR. Social: ".$_POST['rsocial'].".\n\tDNI: ".$_POST['dni'].$_POST['ldni'].".\n\tReferencia: ".$_POST['ref'].".";

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

	require '../Inclu/Conta_Footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>