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

	if(isset($_POST['oculto2'])){	info_01();
							show_form();
	} elseif(isset($_POST['oculto'])){							
			if($form_errors = validate_form()){
					show_form($form_errors);
			} else { process_form();
					 info_02();
					}
			} else { show_form(); }

	} else { require '../Inclu/table_permisos.php'; } 

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

	function process_form(){
	
		global $rutPend;	$rutPend = 'Pendientes_';
		global $pend;	$pend = "PENDIENTES";
		require 'Gastos_Botonera.php';

		global $db; 		global $db_name;	
		global $dyt1; 		global $texerror;
		
		require 'Gastos_factdate.php';

		require 'FormatNumber.php';
		
		//////////////
			//////////////
		//////////////

		global $dynew;		$dynew = $_POST['dy'];
		$_SESSION['ynew'] = $_POST['dy'];
		$_SESSION['mnew'] = $_POST['dm'];
	
		$idx = $_SESSION['idx'];
		global $vname; 		$vname = "`".$_SESSION['clave']."gastos_pendientes`";
		$_SESSION['vname'] = $vname;
	
		// echo "** ".$_SESSION['yold']." || ".$dynew."<br>";

		global $sent;								
		$sent = "UPDATE `$db_name`.$vname  SET `factnum` = '$_POST[factnum]', `factdate` = '$factdate', `refprovee` =  '$_POST[refprovee]', `factnom` =  '$_POST[factnom]', `factnif` = '$_POST[factnif]', `factiva` = '$_POST[factiva]', `factivae` = '$factivae', `factpvp` = '$factpvp', `factret` = '$_POST[factret]', `factrete` = '$factrete',  `factpvptot` = '$factpvptot', `coment` = '$_POST[coment]' WHERE $vname.`id` = '$idx'  ";
		

		/////////////
		
		global $db;		global $sent; 		$sqla = $sent;
		
		if(mysqli_query($db, $sqla)){

			global $iniy; 	$iniy = substr(date('Y'),0,2);
			global $title;	$title = 'SE HA MODIFICADO EN ';
			//global $Modif2;		$Modif2 = "style='display:none; visibility: hidden;'";
			global $ConteBotones;		$ConteBotones = "style='display:block;'";
			require 'TableFormResult.php'; 

		}else{ print("* MODIFIQUE LA ENTRADA: 116/130 ".mysqli_error($db));
				show_form ();
				$texerror .= "\n\t ".mysqli_error($db);
					}

		/////////////
		
		$_SESSION['fnnew'] = $_POST['factnum'];
		
		if($_SESSION['fnold'] != $_POST['factnum']){
			
			global $nombre1;	$nombre1 = $_SESSION['myimg1'];
			$extension1 = substr($_SESSION['myimg1'],-3);
			$nombre1n = $_SESSION['fnnew']."_1.".$extension1;
			$_SESSION['$nombre1n'] = $nombre1n;
					
			global $nombre2;	$nombre2 = $_SESSION['myimg2'];
			$extension2 = substr($_SESSION['myimg2'],-3);
			$nombre2n = $_SESSION['fnnew']."_2.".$extension2;
			$_SESSION['$nombre2n'] = $nombre2n;

			global $nombre3;	$nombre3 = $_SESSION['myimg3'];
			$extension3 = substr($_SESSION['myimg3'],-3);
			$nombre3n = $_SESSION['fnnew']."_3.".$extension3;
			$_SESSION['$nombre3n'] = $nombre3n;

			global $nombre4;	$nombre4 = $_SESSION['myimg4'];
			$extension4 = substr($_SESSION['myimg4'],-3);
			$nombre4n = $_SESSION['fnnew']."_4.".$extension4;
			$_SESSION['$nombre4n'] = $nombre4n;

			global $rutaDir; 	$rutaDir = "../cbj_Docs/docgastos_pendientes/";
			
			if(file_exists($rutaDir.$_SESSION['myimg1'])){
						rename($rutaDir.$_SESSION['myimg1'], $rutaDir.$_SESSION['$nombre1n']);
					/*	print("	<br/>* CHANGE FACT NUM: ".$_SESSION['fnold']." X ".$_SESSION['fnnew']."<br/>- Ok Rename Img Name 1.");
					*/
			}else{print("<br/>- No Ok Rename Img Name 1. ".$rutaDir.$_SESSION['$nombre1n']);}

			if(file_exists($rutaDir.$_SESSION['myimg2'])){
						rename($rutaDir.$_SESSION['myimg2'], $rutaDir.$_SESSION['$nombre2n']);
					/*	print("<br/>- Ok Rename Img Name 2.");	*/
			}else{print("<br/>- No Ok Rename Img Name 2. ".$rutaDir.$_SESSION['$nombre2n']);}
											
			if(file_exists($rutaDir.$_SESSION['myimg3'])){
						rename($rutaDir.$_SESSION['myimg3'], $rutaDir.$_SESSION['$nombre3n']);
					/*	print("<br/>- Ok Rename Img Name 3.");	*/
			}else{print("<br/>- No Ok Rename Img Name 3. ".$rutaDir.$_SESSION['$nombre3n']);}
											
			if(file_exists($rutaDir.$_SESSION['myimg4'])){
						rename($rutaDir.$_SESSION['myimg4'], $rutaDir.$_SESSION['$nombre4n']);
					/*	print("<br/>- Ok Rename Img Name 4.");	*/
			}else{print("<br/>- No Ok Rename Img Name 4. ".$rutaDir.$_SESSION['$nombre4n']);}

			mf1();
		}

		/*
		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='Gastos_Pendientes_Ver.php';
					}
					setTimeout('redir()',8000);
					</script>";
		print ($redir);
		*/

	} // FIN PROCESS_FORM()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function mf1(){
	
		global $db; 	global $db_name;
		$vn = $_SESSION['vname'];
		$img1 = $_SESSION['$nombre1n']; 		$img2 = $_SESSION['$nombre2n'];
		$img3 = $_SESSION['$nombre3n']; 		$img4 = $_SESSION['$nombre4n'];
		$fnnew = $_SESSION['fnnew'];

		$sqlfn = "UPDATE `$db_name`.$vn  SET `myimg1` = '$img1', `myimg2` = '$img2', `myimg3` =  '$img3', `myimg4` = '$img4' WHERE $vn.`factnum` = '$fnnew' ";
		
		if(mysqli_query($db, $sqlfn)){ 
				// print("<br/>* OK DB UPDATE."); 
		}else{  print("* MODIFIQUE LA ENTRADA 234: ".mysqli_error($db));
				global $texerror; 	$texerror .= "\n\t ".mysqli_error($db);
					}
							
	} // FIN function mf1()
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form($errors=[]){

		$_SESSION['idx'] = $_POST['id'];

		//echo '*** '.$_POST['id'].'<br>';
		//echo '*** '.$_SESSION['idx'].'<br>';

		global $rutPend;	$rutPend = 'Pendientes_';
		global $pend;	$pend = "PENDIENTES";
		require 'Gastos_Botonera.php';

		global $db; 	global $db_name;

		global $valIvaeEnt;		global $valIvaeDec;		
		global $valReteEnt;		global $valReteDec;
		global $valToteEnt;		global $valToteDec;	
						
		global $sesionref; 		$sesionref = "`".$_SESSION['clave']."clientes`";
		
		if((isset($_POST['proveegastos']))&&($_POST['proveegastos']!='')){
			global $sqlx;
			$sqlx = " SELECT * FROM $sesionref WHERE `ref` = '$_POST[proveegastos]'";
			$qx = mysqli_query($db, $sqlx);
			$rowprovee = mysqli_fetch_assoc($qx);
			$_rsocial = @$rowprovee['rsocial'];
			$_ref = @$rowprovee['ref'];
			$_dni = @$rowprovee['dni'];
			$_ldni = @$rowprovee['ldni'];
			global $_dnil;
			$_dnil = $_dni.$_ldni;
		}

		// DATOS DESDE GASTOS VER
		if(isset($_POST['oculto2'])){
			
			$datex = $_POST['factdate'];
			$dyx = substr($_POST['factdate'],0,2);
			$dmx = substr($_POST['factdate'],3,2);
			$ddx = substr($_POST['factdate'],-2,2);

			$_SESSION['mold'] = $dmx;
			$_SESSION['dold'] = $ddx;
			$_SESSION['yold'] = $dyx;
		
			$_SESSION['myimg1'] = $_POST['myimg1'];
			$_SESSION['myimg2'] = $_POST['myimg2'];
			$_SESSION['myimg3'] = $_POST['myimg3'];
			$_SESSION['myimg4'] = $_POST['myimg4'];

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
			global $_dnil; 	$_dnil = $_dni.$_ldni;
		
			$_POST['proveegastos'] = $_POST['refprovee'];
		
			$defaults = array ( 'id' => $_POST['id'],
								'proveegastos' => $_POST['refprovee'],
							   	'refprovee' => $_POST['refprovee'],
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

		// DATOS DESDE EL FORMULARIO =>
		}elseif(isset($_POST['oculto'])){

			// DATOS DEL FORMULARIO MODIFICAR

			$_POST['factivae1'] = $valIvaeEnt;		$_POST['factivae2'] = $valIvaeDec;
			$_POST['factrete1'] = $valReteEnt;		$_POST['factrete2'] = $valReteDec;
			$_POST['factpvptot1'] = $valToteEnt;	$_POST['factpvptot2'] = $valToteDec;
			$dyx = $_POST['dy'];
			$defaults = array ( 'id' => $_POST['id'],
								'proveegastos' => $_POST['proveegastos'],
								'dy' => $_POST['dy'],
								'dm' => $_POST['dm'],
								'dd' => $_POST['dd'],
								'factnum' => strtoupper($_POST['factnum']),
							// 	'factdate' => $_POST['factdate'],
							   	'refprovee' => $_POST['refprovee'],
							   	'factnom' => $_POST['factnom'],
							   	'factnif' => $_POST['factnif'],
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

		}else{ $defaults = $_POST; }

		// echo "* ".$_SESSION['yold']."<br>";

		require 'TablaIfErrors.php';

		require 'ArrayMesDia.php';

		////////////////////
	
		global $Titulo; 	$Titulo = "MODIFICAR GASTO PENDIENTE";
		global $TitValue;	$TitValue = "SELECCIONE NUEVO PROVEEDOR";

		print("<table class='tableForm' >
				<tr>
					<th colspan=2'>".$Titulo."</th>
				</tr>");

		if($_POST['proveegastos'] != ''){

			require 'FormDatos.php';

			print("<tr>
					<td colspan='2' align='right' >
						<!--
						<input type='submit' value='MODIFICAR DATOS FACTURA' class='botonverde' />
						-->
						".$SaveBlack.$closeButton."
						<input type='hidden' name='oculto' value=1 />
				</form>");
			
			global $Modif2;		$Modif2 = "style='display:none; visibility: hidden;'";
			require 'Gastos_Botones.php';

			print("</td>
				</tr>
			</table>");
		}

	} // FIN SHOW_FORM()

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
		$text = "\n- GASTO MODIFICAR SELECCIONADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$_POST['factdate'].".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$_POST['factivae'].".\n\tNETO €: ".$_POST['factpvp'].".\n\tTOTAL €: ".$_POST['factpvptot'];
	
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
		$text = "\n- GASTO MODIFICADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$factdate.".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$factivae.".\n\tNETO €: ".$factpvp.".\n\tTOTAL €: ".$factpvptot;

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
		global $rutaGastos;	$rutaGastos = "";
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