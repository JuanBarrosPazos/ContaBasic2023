<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';
		
	require '../Inclu/sqld_query_fetch_assoc.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

					master_index();

			if ($_POST['oculto2']){	show_form();
									info_01();
					}
					elseif($_POST['oculto']){	process_form();
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
	global $dyt1;
	global $dm1;
	

	$ret1 = $_POST['ret1'];
	$ret2 = $_POST['ret2'];
	global $tret;
	$tret = $ret1.".".$ret2;
	$tret = trim($tret);
	global $name;
	$name = $tret." %";

	global $vname;
	$vname = "cbj_retencion";
	$vname = "`".$vname."`";

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=4 class='BorderInf'>
						BORRADO EN ".strtoupper($vname)."
					</th>
				</tr>
												
				<tr>
					<td>
						RETENCIONES %
					</td>
					<td>"
						.$tret.
					"</td>
					<td>	
						NAME
					</td>
					<td>"
						.$name.
					"</td>
				</tr>
				
			</table>
				
		";	
		
		global $db;
		global $db_name;
		global $idx;
		$idx = $_SESSION['idx'];

	$sqla = "DELETE FROM `$db_name`.$vname WHERE $vname.`id` = '$idx'";
		
		if(mysqli_query($db, $sqla)){ print($tabla); 
					} else {
							print("* MODIFIQUE LA ENTRADA 104: ".mysqli_error($db));
									show_form ();
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
					}
					
}	

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	global $db;
	global $db_name;
	
	if($_POST['oculto2']){$_SESSION['idx'] = $_POST['id'];
	
							$ret = strlen(trim($_POST['ret']));
							$ret = $ret - 3;
							$retx = $_POST['ret'];
							$ret1 = substr($_POST['ret'],0,$ret);
							$ret2 = substr($_POST['ret'],-2,2);

							$defaults = array (	'ret1' => $ret1,	
												'ret2' => $ret2,	
															);
						}
	elseif($_POST['oculto']){
		$defaults = $_POST;
		} else {
				$defaults = array (	'ret1' => $_POST['ret1'],	
									'ret2' => $_POST['ret2'],	
													);
							   		}
								
////////////////////

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>
								BORRAR % RETENCION					
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>

				<tr>
					<td>						
						RETENCION % TIPO
					</td>
					<td>
					".$defaults['ret1']."
<input style='text-align:right' type='hidden' name='ret1' size=4 maxlength=2 value='".$defaults['ret1']."' />
,".$defaults['ret2']."
<input  type='hidden' name='ret2' size=4 maxlength=2 value='".$defaults['ret2']."' />
%
					</td>
				</tr>
					
				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='BORRAR % RETENCION' />
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
	
	global $tret;
	global $name;

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
global $text;
$text = "\n- IMPUESTO BORRAR SELECCIONADO ".$ActionTime.".\n\t ID: ".$_POST['id'].".\n\t % TIPO IMPUESTO: ".$_POST['ret'].".\n\t NOMBRE: ".$_POST['name'].".";

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
	
	global $tret;
	global $name;

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
global $text;
$text = "\n- IMPUESTO BORRADO ".$ActionTime.".\n\t ID: ".$_SESSION['idx'].".\n\t % TIPO IMPUESTO: ".$tret.".\n\t NOMBRE: ".$name.".";

		$logdocu = $_SESSION['ref'];
		$logdate = date('Y_m_d');
		$logtext = $text."\n";
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}

	
	function master_index(){
		
				require '../Inclu_MInd/Master_Index_retencion.php';
		
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