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
	

	$iva1 = $_POST['iva1'];
	$iva2 = $_POST['iva2'];
	global $tiva;
	$tiva = $iva1.".".$iva2;
	$tiva = trim($tiva);
	global $name;
	$name = $tiva." %";

	global $vname;
	$vname = "cbj_impuestos";
	$vname = "`".$vname."`";

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=4 class='BorderInf'>
						BORRADO EN ".strtoupper($vname)."
					</th>
				</tr>
												
				<tr>
					<td>
						IMPUESTOS %
					</td>
					<td>"
						.$tiva.
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

function show_form($errors=[]){
	
	global $db;
	global $db_name;
	
	if($_POST['oculto2']){$_SESSION['idx'] = $_POST['id'];
	
							$iva = strlen(trim($_POST['iva']));
							$iva = $iva - 3;
							$ivax = $_POST['iva'];
							$iva1 = substr($_POST['iva'],0,$iva);
							$iva2 = substr($_POST['iva'],-2,2);

							$defaults = array (	'iva1' => $iva1,	
												'iva2' => $iva2,	
															);
						}
	elseif($_POST['oculto']){
		$defaults = $_POST;
		} else {
				$defaults = array (	'iva1' => $_POST['iva1'],	
									'iva2' => $_POST['iva2'],	
													);
							   		}
								
////////////////////

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>
								BORRAR % IMPUESTOS					
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>

				<tr>
					<td>						
						IMPUESTOS % TIPO
					</td>
					<td>
					".$defaults['iva1']."
<input style='text-align:right' type='hidden' name='iva1' size=4 maxlength=2 value='".$defaults['iva1']."' />
,".$defaults['iva2']."
<input  type='hidden' name='iva2' size=4 maxlength=2 value='".$defaults['iva2']."' />
%
					</td>
				</tr>
					
				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='BORRAR % IMPUESTOS' />
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
	
	global $tiva;
	global $name;

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
global $text;
$text = "\n- IMPUESTO BORRAR SELECCIONADO ".$ActionTime.".\n\t ID: ".$_POST['id'].".\n\t % TIPO IMPUESTO: ".$_POST['iva'].".\n\t NOMBRE: ".$_POST['name'].".";

		$logdocu = $_SESSION['ref'];
		$logdate = date('Y-m-d');
		$logtext = $text."\n";
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

function info_02(){

	global $db;
	
	global $tiva;
	global $name;

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
global $text;
$text = "\n- IMPUESTO BORRADO ".$ActionTime.".\n\t ID: ".$_SESSION['idx'].".\n\t % TIPO IMPUESTO: ".$tiva.".\n\t NOMBRE: ".$name.".";

		$logdocu = $_SESSION['ref'];
		$logdate = date('Y-m-d');
		$logtext = $text."\n";
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}

	
	function master_index(){
		
				require '../Inclu_MInd/Master_Index_Impuestos.php';
		
				} /* Fin funcion master_index.*/

/////////////////////////////////////////////////////////////////////////////////////////////////
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';

?>