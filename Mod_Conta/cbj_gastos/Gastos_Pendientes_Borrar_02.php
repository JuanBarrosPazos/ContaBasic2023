<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';
		
	require '../Inclu/sqld_query_fetch_assoc.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

 					print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
				
					master_index();

					if($_POST['oculto2']){	info_01();
											show_form();}
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
	
	global $vname;
	global $dyt1;
	
	if ($_POST['dy'] == ''){ $dy1 = '';
							 $dyt1 = date('Y');	} else {$dy1 = $_POST['dy'];
														$dy1 = $dy1;
														$dyt1 = "20".$_POST['dy'];
																		}
	if ($_POST['dm'] == ''){ $dm1 = '';} else {$dm1 = $_POST['dm'];
												$dm1 = "/".$dm1."/";}
	if ($_POST['dd'] == ''){ $dd1 = '';} else {$dd1 = $_POST['dd'];
												$dd1 = $dd1;}

	global $factdate;
	$factdate = $_POST['dy']."/".$_POST['dm']."/".$_POST['dd'];

	$factivae1 = $_POST['factivae1'];
	$factivae2 = $_POST['factivae2'];
	global $factivae;
	$factivae = $factivae1.".".$factivae2;

	$factrete1 = $_POST['factrete1'];
	$factrete2 = $_POST['factrete2'];
	global $factrete;
	$factrete = $factrete1.".".$factrete2;

	$factpvp1 = $_POST['factpvp1'];
	$factpvp2 = $_POST['factpvp2'];
	global $factpvp;
	$factpvp = $factpvp1.".".$factpvp2;

	$factpvptot1 = $_POST['factpvptot1'];
	$factpvptot2 = $_POST['factpvptot2'];
	global $factpvptot;
	$factpvptot = $factpvptot1.".".$factpvptot2;

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=4 class='BorderInf'>
						SE HA BORRADO EN ".strtoupper($vname)."
					</th>
				</tr>
												
				<tr>
					<td>
						NUMERO
					</td>
					<td>"
						.$_POST['factnum'].
					"</td>
					<td>	
						FECHA
					</td>
					<td>
						20".$factdate.
					"</td>
				</tr>
				
				<tr>
					<td>
						RAZON SOCIAL
					</td>
					<td>"
						.$_POST['factnom'].
					"</td>
					<td>
						NIF / CIF
					</td>
					<td>"
						.$_POST['factnif'].
					"</td>
				</tr>
								
				<tr>
					<td>
						IMP %
					</td>
					<td>"
						.$_POST['factiva'].
					"</td>
					<td>
						IMP €
					</td>
					<td width=250px>"
						.$factivae.
					"</td>
				</tr>
								
				<tr>
					<td>
						RET %
					</td>
					<td>"
						.$_POST['factret'].
					"</td>
					<td>
						RET €
					</td>
					<td width=250px>"
						.$factrete.
					"</td>
				</tr>
								
				<tr>
					<td>
						SUBTOTAL
					</td>
					<td>"
						.$factpvp.
					"</td>
					<td>
						TOTAL
					</td>
					<td>"
						.$factpvptot.
					"</td>
				</tr>
								
				<tr>
					<td>
						DESCRIPCION
					</td>
					<td colspan='3'>"
						.$_POST['coment'].
					"</td>
				</tr>

			</table>
				
		";	
		
		/////////////
		
	global $db; 		global $db_name;
	$idx = $_POST['id'];

	global $vname; 		$vname = "`".$_SESSION['clave']."gastos_pendientes`";

	$sqla = "DELETE FROM `$db_name`.$vname  WHERE $vname.`id` = '$idx'  ";
		
		if(mysqli_query($db, $sqla)){ print($tabla); 
		
		//$_POST['myimg1']
		
	$sesionref2 = "docgastos_pendientes";

	if( file_exists("../cbj_Docs/".$sesionref2."/".$_POST['myimg1']) ){
		$destination_file = "../cbj_Docs/".$sesionref2."/".$_POST['myimg1'];
		unlink($destination_file);
		}

	if( file_exists("../cbj_Docs/".$sesionref2."/".$_POST['myimg2']) ){
		$destination_file = "../cbj_Docs/".$sesionref2."/".$_POST['myimg2'];
		unlink($destination_file);
		}

	if( file_exists("../cbj_Docs/".$sesionref2."/".$_POST['myimg3']) ){
		$destination_file = "../cbj_Docs/".$sesionref2."/".$_POST['myimg3'];
		unlink($destination_file);
		}

	if( file_exists("../Ucbj_Docs/".$sesionref2."/".$_POST['myimg4']) ){
		$destination_file = "../cbj_Docs/".$sesionref2."/".$_POST['myimg4'];
		unlink($destination_file);
		}

					} else {
							print("* MODIFIQUE LA ENTRADA 199: ".mysqli_error($db));
									show_form ();
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
					}

	}
	
//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){
	
	global $db; 		global $db_name;
	
	global $sesionref; 		$sesionref = "`".$_SESSION['clave']."clientes`";
	
	$sqlx =  "SELECT * FROM $sesionref WHERE `ref` = '$_POST[proveedores]'";
	$qx = mysqli_query($db, $sqlx);
	$rowprovee = mysqli_fetch_assoc($qx);
	$_rsocial = $rowprovee['rsocial'];
	$_ref = $rowprovee['ref'];
	$_dni = $rowprovee['dni'];
	$_ldni = $rowprovee['ldni'];
	global $_dnil;
	$_dnil = $_dni.$_ldni;
	

	$_SESSION['idx'] = $_POST['id'];

	if($_POST['oculto2']){
		
		$datex = $_POST['factdate'];
		$dyx = substr($_POST['factdate'],0,2);
		$dmx = substr($_POST['factdate'],3,2);
		$ddx = substr($_POST['factdate'],-2,2);

		$ivae = strlen(trim($_POST['factivae']));
		$ivae = $ivae - 3;
		$ivaex = $_POST['factivae'];
		$ivae1 = substr($_POST['factivae'],0,$ivae);
		$ivae2 = substr($_POST['factivae'],-2,2);

		$rete = strlen(trim($_POST['factrete']));
		$rete = $rete - 3;
		$retex = $_POST['factrete'];
		$rete1 = substr($_POST['factrete'],0,$ivae);
		$rete2 = substr($_POST['factrete'],-2,2);

		$factpvp = strlen(trim($_POST['factpvp']));
		$factpvp = $factpvp - 3;
		$factpvpx = $_POST['factpvp'];
		$factpvp1 = substr($_POST['factpvp'],0,$factpvp);
		$factpvp2 = substr($_POST['factpvp'],-2,2);
		
		$factpvptot = strlen(trim($_POST['factpvptot']));
		$factpvptot = $factpvptot - 3;
		$factpvptotx = $_POST['factpvptot'];
		$factpvptot1 = substr($_POST['factpvptot'],0,$factpvptot);
		$factpvptot2 = substr($_POST['factpvptot'],-2,2);
		
		$dnie = strlen(trim($_POST['factnif']));
		$dnie = $dnie - 1;
		$dnix = $_POST['factnif'];
		$dninx = substr($_POST['factnif'],0,$dnie);
		$dnilx = substr($_POST['factnif'],-1,1);
		$dninx = trim($dninx);
		$dnilx = trim($dnilx);
		$fil1 = "%".$dninx."%";
		$fil2 = "%".$dnilx."%";

		$sx =  "SELECT * FROM $sesionref WHERE `dni` LIKE '$fil1' LIMIT 1 ";
		$qx = mysqli_query($db, $sx);
		$rowpv = mysqli_fetch_assoc($qx);
		$_rsocial = $rowpv['rsocial'];
		$_ref = $rowpv['ref'];
		$_dni = $rowpv['dni'];
		$_ldni = $rowpv['ldni'];
		global $_dnil;
		$_dnil = $_dni.$_ldni;
		
				$defaults = array ( 'id' => $_POST['id'],
									'refprovee' => $_POST['refprovee'],
									'dy' => $dyx,
									'dm' => $dmx,
									'dd' => $ddx,
									'factnum' => $_POST['factnum'],
								//	'factdate' => $_POST['factdate'],
								   	'factnom' => $_POST['factnom'],
								   	'factnif' => $_POST['factnif'],
								   	'factiva' => $_POST['factiva'],
									'factivae1' => $ivae1,	
									'factivae2' => $ivae2,	
								   	'factret' => $_POST['factret'],
									'factrete1' => $rete1,	
									'factrete2' => $rete2,	
									'factpvp1' => $factpvp1,	
									'factpvp2' => $factpvp2,	
									'factpvptot1' => $factpvptot1,	
									'factpvptot2' => $factpvptot2,	
									'coment' => $_POST['coment'],	
									'myimg1' => $_POST['myimg1'],	
									'myimg2' => $_POST['myimg2'],	
									'myimg3' => $_POST['myimg3'],	
									'myimg4' => $_POST['myimg4'],	
																	);
								   											}
////////////////////

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>
								ELIMINAR GASTO					
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>

				<tr>
					<td>
						CLIENTE:
						<input type='hidden' name='oculto1' value=1 />
					</td>
					<td>
<input type='hidden' name='factnom' value='".$defaults['factnom']."' />".$defaults['factnom']."
					</td>
				</tr>

				<tr>
					<td>
						REF. CLIENTE:
						<input type='hidden' name='oculto1' value=1 />
					</td>
					<td>
<input type='hidden' name='refprovee' value='".$defaults['refprovee']."' />".$defaults['refprovee']."
					</td>
				</tr>

				<tr>
					<td>
						ID:
						<input type='hidden' name='oculto1' value=1 />
					</td>
					<td>
<input type='hidden' name='id' value='".$defaults['id']."' />".$defaults['id']."
					</td>
				</tr>

				<tr>
					<td>
						NUMERO
					</td>
					<td>
<input type='hidden' name='factnum' value='".$defaults['factnum']."' />".$defaults['factnum']."
					</td>
				</tr>
									
				<tr>
					<td>						
						FECHA
					</td>
					<td>
					20".$defaults['dy']."/".$defaults['dm']."/".$defaults['dd']."
<input type='hidden' name='dy' value='".$defaults['dy']."' />
<input type='hidden' name='dm' value='".$defaults['dm']."' />
<input type='hidden' name='dd' value='".$defaults['dd']."' />
					</td>
				</tr>
									
				<tr>
					<td>						
						RAZON SOCIAL
					</td>
					<td>
<input type='hidden' name='factnom' value='".$defaults['factnom']."' />".$defaults['factnom']."
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>						
						NIF/CIF
					</td>
					<td>
<input type='hidden' name='factnif'value='".$defaults['factnif']."' />".$defaults['factnif']."
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>						
						IMP %
					</td>
					<td>
<input type='hidden' name='factiva' value='".$defaults['factiva']."' />".$defaults['factiva']."
					</td>
				</tr>

				<tr>
					<td>						
						IMP €
					</td>
					<td>
					".$defaults['factivae1'].",".$defaults['factivae2']."
<input type='hidden' name='factivae1' value='".$defaults['factivae1']."' />
<input type='hidden' name='factivae2' value='".$defaults['factivae2']."' />
					</td>
				</tr>
					
				<tr>
					<td>						
						RET %
					</td>
					<td>
<input type='hidden' name='factret' value='".$defaults['factret']."' />".$defaults['factret']."
					</td>
				</tr>

				<tr>
					<td>						
						RET €
					</td>
					<td>
					".$defaults['factrete1'].",".$defaults['factrete2']."
<input type='hidden' name='factrete1' value='".$defaults['factrete1']."' />
<input type='hidden' name='factrete2' value='".$defaults['factrete2']."' />
					</td>
				</tr>
					
				<tr>
					<td>						
						SUBTOTAL €
					</td>
					<td>
					".$defaults['factpvp1'].",".$defaults['factpvp2']."
<input type='hidden' name='factpvp1' value='".$defaults['factpvp1']."' />
<input type='hidden' name='factpvp2' value='".$defaults['factpvp2']."' />
					
					</td>
				</tr>

				<tr>
					<td>						
						TOT €
					</td>
					<td>
					".$defaults['factpvptot1'].",".$defaults['factpvptot2']."
<input type='hidden' name='factpvptot1' value='".$defaults['factpvptot1']."' />
<input type='hidden' name='factpvptot2' value='".$defaults['factpvptot2']."' />
					</td>
				</tr>

				<tr>
					<td>
						DESCRIPCIÓN
					</td>
					<td>
<input type='hidden' name='coment' value='".$defaults['coment']."' />".$defaults['coment']."
					</td>
				</tr>

	<input name='myimg1' type='hidden' value='".$defaults['myimg1']."' />
	<input name='myimg2' type='hidden' value='".$defaults['myimg2']."' />
	<input name='myimg3' type='hidden' value='".$defaults['myimg3']."' />
	<input name='myimg4' type='hidden' value='".$defaults['myimg4']."' />

				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='BORRAR FACTURA PENDIENTE' />
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
	
	$filtro = "\n\tFiltro => \n\tDATE: ".$_POST['factdate'].".\n\tR. Social: ".$_POST['factnom'].".\n\tDNI: ".$_POST['factnif'].".\n\tNº FACTURA: ".$_POST['factnum'].".";

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	global $text;
	$text = "\n- GASTOS PENDIENTE SELECCIONADO BORRAR ".$ActionTime.$filtro;
	
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
	global $factivae;
	global $factpvp;
	global $factpvptot;
	global $factdate;

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
global $text;
$text = "\n- GASTO PENDIENTE BORRADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$factdate.".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$factivae.".\n\tNETO €: ".$factpvp.".\n\tTOTAL €: ".$factpvptot;

		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);	
		$logdocu = $_SESSION['ref'];
		$logdate = date('Y-m-d');
		$logtext = $text."\n";
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaGastos;	$rutaGastos = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
				} /* Fin funcion master_index.*/

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';

?>