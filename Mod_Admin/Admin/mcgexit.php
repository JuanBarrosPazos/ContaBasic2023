<?php
session_start();
 
	require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_head.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

	global $userid;
	$userid = $_SESSION['id'];
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){
 		
		if (isset($_POST['salir'])){ UserLog();
							  		 salir();
								}
		elseif ($_POST['cerrar']){  master_index();
									desconex(); }

	} else { require '../Inclu/table_permisos.php';}
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function UserLog(){

	global $db; 	global $db_name; 	global $userid;
	
	global $dir; 	$dir = "../Users/".$_SESSION['ref']."/log";

	global $dateadout; 	$dateadout = date('Y-m-d H:i:s');

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$sqladout = "UPDATE `$db_name`.$table_name_a SET `lastout` = '$dateadout' WHERE $table_name_a.`id` = '$userid' LIMIT 1 ";
		
	if(mysqli_query($db, $sqladout)){ } else { 
		print("</br><font color='#FF0000'>* FATAL ERROR funcion admin_entrada(): </font></br> ".mysqli_error($db))."</br>";
			}
	
	global $text;
	$text = "!! CIERRE SESION USUARIO: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos']." => ".$dateadout.PHP_EOL."\t\tREFERENCIA: ".$_SESSION['ref']." NIVEL: ".$_SESSION['Nivel'].PHP_EOL;

	require 'log_write.php';

		// PASA LOG AL SISTEMA
		$ActionTime = date('H:i:s');
		global $text;
		$logdate = date('Y-m-d');
		$logtext = "** ".$ActionTime.PHP_EOL."\t ** ".$text.PHP_EOL;
		$filename = "../LogsAcceso//LogsAcceso_".$logdate.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	} // FIN FUNCION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		require '../Inclu_Menu/rutaadmin.php';
		require '../Inclu_Menu/Master_Index.php';
		
	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function desconex(){

		print("<table style=\"margin:8.0em auto 8.0em auto;\">
					<form name='salir' action='$_SERVER[PHP_SELF]' method='post'>
						<tr><td valign='bottom' align='center'>
				<input type='submit' value='CONFIRME CERRAR SESION' class='botonverde' />
						</td></tr>								
							<input type='hidden' name='salir' value=1 />
					</form>	
				</table>
		<embed src='../audi/sesion_close_confirm.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
		</embed>");
	
			} 
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function salir() {	

	print("<table align='center'>
				<tr>
					<th style='text-align:center'>
						HA CERRADO SESION.
					</th>
				</tr>
	<embed src='../audi/sesion_close.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
	</embed>
			</table>");
				
				global $redir;
				// 600000 microsegundos 10 minutos
				// 60000 microsegundos 1 minuto
				$redir = "<script type='text/javascript'>
								function redir(){
								window.location.href='../index.php?salir=1';
							}
							setTimeout('redir()',3000);
							</script>";
				print ($redir);
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>