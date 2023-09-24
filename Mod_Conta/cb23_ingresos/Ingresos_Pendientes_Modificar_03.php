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
				// SI NO HA COBRADO LA FACTURA.
				if(!isset($_POST['xl'])){
						print("<div style='text-align:center; margin:auto;'>
									* HA DE MARCAR LA CASILLA DE CONFIRMACIÓN
								</div>");
							show_form();
				}elseif(isset($_POST['xl'])){
							//print("* SI SELECCIONADO");
							process_form_2();
									}
		}else{show_form();}
							
	}else{ require '../Inclu/table_permisos.php'; } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form_2(){
	
		global $db; 		global $db_name;
		global $vname; 		global $dyt1; 		global $dynew;
		
		require 'Ingresos_factdate.php';

		require 'FormatNumber.php';

		global $title;	$title = 'SE HA BORRADO EL INGRESO PENDIENTE EN ';
		global $link1; 	
		$link1 = "<a href='Ingresos_Pendientes_Ver.php' class='botonazul' style='color:#343434 !important' >INICIO INGRESOS PENDIENTES</a>";
		global $link2;
		$link2 = "<a href='Ingresos_Pendiente_Crear.php' class='botonazul' style='color:#343434 !important' >CREAR NUEVO INGRESO PENDIENTE</a>";

		require 'TableFormResult.php';

		global $rutaold;
		global $rutanew;
		$rutaold = "../cb23_Docs/docingresos_pendientes/";
		$rutanew = "../cb23_Docs/docingresos_20".$dynew."/";
		
		if(file_exists($rutaold.$_SESSION['myimg1']) ){
					copy($rutaold.$_SESSION['myimg1'], $rutanew.$_SESSION['myimg1']);
					unlink($rutaold.$_SESSION['myimg1']);
			/*		print(" <br/>* CHANGE YEAR FACT: 20".$_SESSION['yold']." X 20".$dynew."
							<br/>- Ok Copy & Unlink Img Name 1.");
			*/
										}else{print("<br/>- No Ok Copy & Unlink Img Name 1.");}
										
		if(file_exists($rutaold.$_SESSION['myimg2']) ){
								copy($rutaold.$_SESSION['myimg2'], $rutanew.$_SESSION['myimg2']);
								unlink($rutaold.$_SESSION['myimg2']);
						/*		print("<br/>- Ok Copy & Unlink Img Name 2.");	*/
										}else{print("<br/>- No Ok Copy & Unlink Img Name 2.");}
										
		if(file_exists($rutaold.$_SESSION['myimg3']) ){
								copy($rutaold.$_SESSION['myimg3'], $rutanew.$_SESSION['myimg3']);
								unlink($rutaold.$_SESSION['myimg3']);
						/*		print("<br/>- Ok Copy & Unlink Img Name 3.");	*/
										}else{print("<br/>- No Ok Copy & Unlink Img Name 3.");}
										
		if(file_exists($rutaold.$_SESSION['myimg4']) ){
								copy($rutaold.$_SESSION['myimg4'], $rutanew.$_SESSION['myimg4']);
								unlink($rutaold.$_SESSION['myimg4']);
						/*		print("<br/>- Ok Copy & Unlink Img Name 4.");	*/
										}else{print("<br/>- No Ok Copy & Unlink Img Name 4.");}
										
	$idx = $_SESSION['idx'];

	global $vname; 		$vname = "`".$_SESSION['clave']."ingresos_".$dyt1."`";
	$_SESSION['vname'] = $vname;
	
	global $sent;								
	$sent = "INSERT INTO `$db_name`.$vname (`factnum`, `factdate`, `refcliente`, `factnom`, `factnif`, `factiva`, `factivae`, `factpvp`, `factret`, `factrete`, `factpvptot`,`coment`, `myimg1`, `myimg2`, `myimg3`, `myimg4`) VALUES ('$_POST[factnum]', '$factdate', '$_POST[clienteingresos]', '$_POST[factnom]', '$_POST[factnif]', '$_POST[factiva]', '$factivae', '$factpvp', '$_POST[factret]', '$factrete', '$factpvptot', '$_POST[coment]', '$_SESSION[myimg1]', '$_SESSION[myimg2]', '$_SESSION[myimg3]', '$_SESSION[myimg4]')";
		
		if(mysqli_query($db, $sent)){ //	print("<br/>* OK DELETE DATA."); 
										print($tabla); 
		} else {
			print("* MODIFIQUE LA ENTRADA 335: ".mysqli_error($db));
			global $texerror; 	$texerror = "\n\t ".mysqli_error($db);
				}
	$idx = $_SESSION['idx'];
	global $vnamed; 		$vnamed = "`".$_SESSION['clave']."ingresos_pendientes`";
	$sqla = "DELETE FROM `$db_name`.$vnamed  WHERE $vnamed.`id` = '$idx'  ";
		if(mysqli_query($db, $sqla)){ //	print("<br/>* OK DELETE DATA."); 
		} else {
			print("* MODIFIQUE LA ENTRADA 349: ".mysqli_error($db));
			global $texerror; 	$texerror = "\n\t ".mysqli_error($db);
				}

	//////////////
				//////////////
	//////////////
	
	global $dyx; 		$dyx = "20".$_POST['dy'];
	global $dmx; 		$dmx = "M".$_POST['dm'];

	global $mes;
	if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
	elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
	elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
	elseif(($dmx == "10")||($dmx == "11")||($dmx == "12")){$mes = "TRI4";}
	
		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form($errors=[]){

		global $db; 	global $db_name;
		
		global $sesionref; 		$sesionref = "`".$_SESSION['clave']."clientes`";
		
		if(isset($_POST['clienteingresos'])){

			$sqlx =  "SELECT * FROM $sesionref WHERE `ref` = '$_POST[clientes]'";
			$qx = mysqli_query($db, $sqlx);
			$rowcliente = mysqli_fetch_assoc($qx);
			$_rsocial = $rowcliente['rsocial'];
			$_ref = $rowcliente['ref'];
			$_dni = $rowcliente['dni'];
			$_ldni = $rowcliente['ldni'];
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
								'coment' => $_POST['coment'],
								'myimg1' => $_POST['myimg1'],	
								'myimg2' => $_POST['myimg2'],	
								'myimg3' => $_POST['myimg3'],	
								'myimg4' => $_POST['myimg4']);
						}

		elseif(isset($_POST['oculto'])){
					$defaults = $_POST;
		}elseif(isset($_POST['oculto1'])) {
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

		if($_POST['clienteingresos'] != '') {

		global $checked;
		if(@$defaults['xl'] == 'yes') { $checked = "checked='checked'";}else{ $checked = ""; }
		global $Checkbox;
		$Checkbox = "<tr>
						<td colspan='2' style='text-align:center;' >
							SI SE HA PAGADO LA FACTURA MARQUE LA CASILLA: &nbsp; 
							<input type='checkbox' name='xl' value='yes' ".$checked."/>
						</td>
					</tr>";

		global $titulo; $titulo = "MARCAR COMO COBRADO ESTE INGRESO PENDIENTE";

		require 'TableBorrar2.php';

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
					$dir = "../cb23_Docs/log";
					}
		
		global $text;
		$text = "\n- INGRESO PENDIENTE MODIFICAR SELECCIONADO FACTURA PAGADA ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$_POST['factdate'].".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$_POST['factivae'].".\n\tNETO €: ".$_POST['factpvp'].".\n\tTOTAL €: ".$_POST['factpvptot'];
	
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
				$dir = "../cb23_Docs/log";
				}
	
	global $text;
	$text = "\n- INGRESO PENDIENTE MODIFICADO FACTURA PAGADA ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$factdate.".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$factivae.".\n\tNETO €: ".$factpvp.".\n\tTOTAL €: ".$factpvptot;

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