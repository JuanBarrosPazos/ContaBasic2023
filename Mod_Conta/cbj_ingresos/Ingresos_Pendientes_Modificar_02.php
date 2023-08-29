<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';
		
	require '../Inclu/sqld_query_fetch_assoc.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if ($_SESSION['Nivel'] == 'admin'){

		master_index();

		if(isset($_POST['oculto2'])){ 	info_01();
										show_form();
		} elseif(isset($_POST['oculto'])){
					if($form_errors = validate_form()){
							show_form($form_errors);
					} else{ process_form_1();
								}
		} else { show_form(); }
							
	}else { require '../Inclu/table_permisos.php'; } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function validate_form(){
		
		global $sqld; 		global $qd; 		global $rowd;

		$errors = array();
		
		require 'ValidateFormPendientes.php';

		return $errors;

	} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form_1(){
	
		global $db; 		global $db_name;
		global $dyt1; 		global $dynew;
		
		require 'Ingresos_factdate.php';

		require 'FormatNumber.php';

		global $title;	$title = 'SE HA MODIFICADO EN ';
		global $link1; 	
		$link1 = "<a href='Ingresos_Pendientes_Ver.php' class='botonazul' style='color:#343434 !important' >INICIO INGRESOS PENDIENTES</a>";
		global $link2;
		$link2 = "<a href='Ingresos_Pendiente_Crear.php' class='botonazul' style='color:#343434 !important' >CREAR NUEVO INGRESO PENDIENTE</a>";
		
		require 'TableFormResult.php';

		global $idx; 		$idx = $_SESSION['idx'];
		global $vname; 		$vname = "`".$_SESSION['clave']."ingresos_pendientes`";
		$_SESSION['vname'] = $vname;

		global $sent;
		$sent = "UPDATE `$db_name`.$vname  SET `factnum` = '$_POST[factnum]', `factdate` = '$factdate', `refcliente` =  '$_POST[refcliente]', `factnom` =  '$_POST[factnom]', `factnif` = '$_POST[factnif]', `factiva` = '$_POST[factiva]', `factivae` = '$factivae', `factpvp` = '$factpvp', `factret` = '$_POST[factret]', `factrete` = '$factrete',  `factpvptot` = '$factpvptot', `coment` = '$_POST[coment]' WHERE $vname.`id` = '$idx'  ";

		global $iniy;
		$iniy = substr(date('Y'),0,2);
		
		if(mysqli_query($db, $sent)){ //	print("*");
						 print($tabla); 
		}else{	print("* MODIFIQUE LA ENTRADA 414: ".mysqli_error($db));
					show_form ();
					global $texerror; 	$texerror = "\n\t ".mysqli_error($db);
						}
	
		/////////////
		
		$_SESSION['fnnew'] = $_POST['factnum'];
		
		if($_SESSION['fnold'] != $_POST['factnum']){
		
			$nombre1 = $_SESSION['myimg1b'];
			$extension1 = substr($_SESSION['myimg1b'],-3);
			$nombre1n = $_SESSION['fnnew']."_1.".$extension1;
			$_SESSION['$nombre1n'] = $nombre1n;
					
			$nombre2 = $_SESSION['myimg2b'];
			$extension2 = substr($_SESSION['myimg2b'],-3);
			$nombre2n = $_SESSION['fnnew']."_2.".$extension2;
			$_SESSION['$nombre2n'] = $nombre2n;

			$nombre3 = $_SESSION['myimg3b'];
			$extension3 = substr($_SESSION['myimg3b'],-3);
			$nombre3n = $_SESSION['fnnew']."_3.".$extension3;
			$_SESSION['$nombre3n'] = $nombre3n;

			$nombre4 = $_SESSION['myimg4b'];
			$extension4 = substr($_SESSION['myimg4b'],-3);
			$nombre4n = $_SESSION['fnnew']."_4.".$extension4;
			$_SESSION['$nombre4n'] = $nombre4n;

			global $ruta;
			$ruta = "../cbj_Docs/docingresos_pendientes/";
		
			if( file_exists($ruta.$_SESSION['myimg1b'])){
						rename($ruta.$_SESSION['myimg1b'], $ruta.$_SESSION['$nombre1n']);
				/*	print("	<br/>* CHANGE FACT NUM: ".$_SESSION['fnold']." X ".$_SESSION['fnnew']."
								<br/>- Ok Rename Img Name 1.");
				*/
						}else{print("<br/>- No Ok Rename Img Name 1.");}

			if( file_exists($ruta.$_SESSION['myimg2b'])){
						rename($ruta.$_SESSION['myimg2b'], $ruta.$_SESSION['$nombre2n']);
				/*		print("<br/>- Ok Rename Img Name 2.");	*/
						}else{print("<br/>- No Ok Rename Img Name 2.");}
											
			if( file_exists($ruta.$_SESSION['myimg3b'])){
						rename($ruta.$_SESSION['myimg3b'], $ruta.$_SESSION['$nombre3n']);
				/*		print("<br/>- Ok Rename Img Name 3.");	*/
						}else{print("<br/>- No Ok Rename Img Name 3.");}
											
			if( file_exists($ruta.$_SESSION['myimg4b'])){
						rename($ruta.$_SESSION['myimg4b'], $ruta.$_SESSION['$nombre4n']);
				/*		print("<br/>- Ok Rename Img Name 4.");	*/
						}else{print("<br/>- No Ok Rename Img Name 4.");}

		$sqlfn = "UPDATE `$db_name`.$vname  SET `myimg1` = '$nombre1n', `myimg2` = '$nombre2n', `myimg3` =  '$nombre3n', `myimg4` =  '$nombre4n' WHERE $vname.`id` = '$idx'  ";
		
		if(mysqli_query($db, $sqlfn)){// print("<br/>* OK DB UPDATE."); 
					} else {
							print("* MODIFIQUE LA ENTRADA 479: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
			}	// Fin if.
					
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form($errors=[]){

	global $db; 		global $db_name;
	
	global $sesionref; 	$sesionref = "`".$_SESSION['clave']."clientes`";
	
	if(isset($_POST['clienteingresos'])){
		$sqlx =  "SELECT * FROM $sesionref WHERE `ref` = '$_POST[clienteingresos]'";
		$qx = mysqli_query($db, $sqlx);
		$rowcliente = mysqli_fetch_assoc($qx);
		$_rsocial = @$rowcliente['rsocial'];
		$_ref = @$rowcliente['ref'];
		$_dni = @$rowcliente['dni'];
		$_ldni = @$rowcliente['ldni'];
		global $_dnil;
		$_dnil = $_dni.$_ldni;
	}

	$_SESSION['idx'] = $_POST['id'];

	if(isset($_POST['oculto2'])){
		
		$datex = $_POST['factdate'];
		$dyx = substr($_POST['factdate'],0,2);
		$dmx = substr($_POST['factdate'],3,2);
		$ddx = substr($_POST['factdate'],-2,2);

		$_SESSION['yold'] = $dyx;
		$_SESSION['mold'] = $dmx;
		$_SESSION['dold'] = $ddx;
	
		$_SESSION['myimg1b'] = $_POST['myimg1'];
		$_SESSION['myimg2b'] = $_POST['myimg2'];
		$_SESSION['myimg3b'] = $_POST['myimg3'];
		$_SESSION['myimg4b'] = $_POST['myimg4'];

		$ivae = strlen(trim($_POST['factivae']));
		$ivae = $ivae - 3;
		$ivaex = $_POST['factivae'];
		$ivae1 = substr($_POST['factivae'],0,$ivae);
		$ivae2 = substr($_POST['factivae'],-2,2);
		$_SESSION['ivae1'] = $ivae1;
		$_SESSION['ivae2'] = $ivae2;

		$rete = strlen(trim($_POST['factrete']));
		$rete = $rete - 3;
		$retex = $_POST['factrete'];
		$rete1 = substr($_POST['factrete'],0,$rete);
		$rete2 = substr($_POST['factrete'],-2,2);
		$_SESSION['rete1'] = $rete1;
		$_SESSION['rete2'] = $rete2;

		$factpvp = strlen(trim($_POST['factpvp']));
		$factpvp = $factpvp - 3;
		$factpvpx = $_POST['factpvp'];
		$factpvp1 = substr($_POST['factpvp'],0,$factpvp);
		$factpvp2 = substr($_POST['factpvp'],-2,2);
		$_SESSION['factpvp1'] = $factpvp1;
		$_SESSION['factpvp2'] = $factpvp2;
		
		$factpvptot = strlen(trim($_POST['factpvptot']));
		$factpvptot = $factpvptot - 3;
		$factpvptotx = $_POST['factpvptot'];
		$factpvptot1 = substr($_POST['factpvptot'],0,$factpvptot);
		$factpvptot2 = substr($_POST['factpvptot'],-2,2);
		$_SESSION['factpvptot1'] = $factpvptot1;
		$_SESSION['factpvptot2'] = $factpvptot2;
		
		$dnie = strlen(trim($_POST['factnif']));
		$dnie = $dnie - 1;
		$dnix = $_POST['factnif'];
		$dninx = substr($_POST['factnif'],0,$dnie);
		$dnilx = substr($_POST['factnif'],-1,1);
		$dninx = trim($dninx);
		$dnilx = trim($dnilx);
		$fil1 = "%".$dninx."%";
		$fil2 = "%".$dnilx."%";

		$_SESSION['fnold'] = $_POST['factnum'];

		$sx =  "SELECT * FROM $sesionref WHERE `dni` LIKE '$fil1' LIMIT 1 ";
		$qx = mysqli_query($db, $sx);
		$rowpv = mysqli_fetch_assoc($qx);
		$_rsocial = @$rowpv['rsocial'];
		$_ref = @$rowpv['ref'];
		$_dni = @$rowpv['dni'];
		$_ldni = @$rowpv['ldni'];
		global $_dnil;
		$_dnil = $_dni.$_ldni;
		
		$_POST['clienteingresos'] = $_POST['refcliente'];
		
			$defaults = array ( 'id' => $_POST['id'],
								'clienteingresos' => $_POST['refcliente'],
							   	'refcliente' => $_POST['refcliente'],
							   	'xl' => @$_POST['xl'],
								'dy' => $dyx,
								'dm' => $dmx,
								'dd' => $ddx,
								'factnum' => strtoupper($_POST['factnum']),
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
								'coment' => $_POST['coment']);

	}elseif(isset($_POST['oculto'])){
				$defaults = $_POST;
	} elseif(isset($_POST['oculto1'])) {
			$defaults = array (	'id' => $_SESSION['idx'],
								'clienteingresos' => $_POST['clienteingresos'],
							   	'refcliente' => $_POST['refcliente'],
								'xl' => $_POST['xl'],
								'dy' => $_POST['dy'],
								'dm' => $_POST['dm'],
								'dd' => $_POST['dd'],
								'factnum' => strtoupper($_POST['factnum']),
							//	'factdate' => $_POST['factdate'],
							   	'refcliente' => $rowcliente['ref'],
							   	'factnom' => $rowcliente['rsocial'],
							   	'factnif' => $_dnil,
							   	'factiva' => $_POST['factiva'],
								'factivae1' => $_POST['factivae1'],
								'factivae2' => $_POST['factivae2'],
							   	'factret' => $_POST['factret'],
								'factrete1' => $_POST['factrete1'],
								'factrete2' => $_POST['factrete2'],
								'factpvp1' => $_POST['factpvp1'],	
								'factpvp2' => $_POST['factpvp2'],	
								'factpvptot1' => $_POST['factpvptot1'],	
								'factpvptot2' => $_POST['factpvptot2'],	
								'coment' => $_POST['coment']);
					}

		require 'TablaIfErrors.php';
		
		require 'ArrayMesDia.php';
				
	////////////////////

	global $Titulo; 	$Titulo = "MODIFICAR INGRESO PENDIENTE";
	global $TitValue;	$TitValue = "SELECCIONE NUEVO CLIENTE";

	print("<table align='center' style=\"margin-top:10px\">
	<tr>
		<th colspan=2'>MODIFICAR INGRESO</th>
	</tr>");

	require 'FormSelectCliente.php'; 

		if($_POST['clienteingresos'] != ''){
 
			require 'FormDatos.php';

			print("<tr>
						<td colspan='2' align='right' >
							<input type='submit' value='GRABAR INGRESO' class='botonverde' />
							<input type='hidden' name='oculto' value=1 />
					</form>														
						</td>
					</tr>
					<tr>
						<td colspan='4' align='center'>
			<a href='Ingresos_Pendientes_Ver.php' class='botonazul' style='color:#343434 !important' >INICIO INGRESOS PENDIENTES</a>
			<a href='Ingresos_Pendiente_Crear.php' class='botonazul' style='color:#343434 !important' >CREAR INGRESO PENDIENTE</a>
						</td>
					</tr>
				</table>");
		}

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info_01(){

		global $db;
		
		$TitBut = "\n\tFiltro => \n\tDATE: ".$_POST['factdate'].".\n\tR. Social: ".$_POST['factnom'].".\n\tDNI: ".$_POST['factnif'].".\n\tNº FACTURA: ".$_POST['factnum'].".";

		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cbj_Docs/log";
					}
	
		global $text;
		$text = "\n- INGRESO PENDIENTE MODIFICAR SELECCIONADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$_POST['factdate'].".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$_POST['factivae'].".\n\tNETO €: ".$_POST['factpvp'].".\n\tTOTAL €: ".$_POST['factpvptot'];
	
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

	function info_02(){

		global $db; 		global $factivae;
		global $factpvp; 	global $factpvptot; 	global $factdate;

		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cbj_Docs/log";
					}
	
		global $text;
		$text = "\n- INGRESO PENDIENTE MODIFICADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$factdate.".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$factivae.".\n\tNETO €: ".$factpvp.".\n\tTOTAL €: ".$factpvptot;

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

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaIngresos;	$rutaIngresos = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
				} /* Fin funcion master_index.*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Conta_Footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>