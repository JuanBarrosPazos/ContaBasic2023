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

		if(isset($_POST['oculto2'])){ info_01();
									  show_form();
		} elseif(isset($_POST['oculto'])){	process_form();
											info_02();
		} else {show_form();}

	} else { require '../Inclu/table_permisos.php'; } 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form(){

		global $rutPend;	$rutPend = '';
		global $pend;		$pend = "";
		require 'Gastos_Botonera.php';

		global $dyt1;
		
		require 'Gastos_factdate.php';

		global $db; 		global $db_name;

		global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$dyt1."`";
 
		require 'FormatNumber.php';

		/////////////
			
		$sqla = "DELETE FROM `$db_name`.$vname  WHERE $vname.`id` = '$_POST[id]'  ";
			
		if(mysqli_query($db, $sqla)){ 
			
			global $title;			$title = 'SE HA BORRADO EN ';
			global $Modif2;			$Modif2= "style='display:none; visibility: hidden;'";
			global $Ver2;			$Ver2= "style='display:none; visibility: hidden;'";
			global $ModImg2;		$ModImg2= "style='display:none; visibility: hidden;'";
			global $Borrar2;		$Borrar2= "style='display:none; visibility: hidden;'";
			global $ConteBotones;	$ConteBotones = "style='display:block;'";
			require 'TableFormResult.php';			
				
			$sesionref2 = "docgastos_".$dyt1;

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

			if( file_exists("../cbj_Docs/".$sesionref2."/".$_POST['myimg4']) ){
				$destination_file = "../cbj_Docs/".$sesionref2."/".$_POST['myimg4'];
				unlink($destination_file);
				}

		} else { print("* MODIFIQUE LA ENTRADA 300: ".mysqli_error($db));
					show_form ();
					global $texerror; $texerror = "\n\t ".mysqli_error($db);
					}

		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='Gastos_Ver.php';
					}
					setTimeout('redir()',8000);
					</script>";
		print ($redir);

	} // FIN process_form()
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form(){
	
		global $rutPend;	$rutPend = '';
		global $pend;		$pend = "";
		require 'Gastos_Botonera.php';

		if(isset($_POST['oculto2'])){
				
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
				$rete1 = substr($_POST['factrete'],0,$rete);
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

				$_POST['proveegastos'] = $_POST['refprovee'];
	
				$defaults = array ( 'id' => $_POST['id'],
									'proveegastos' => $_POST['refprovee'],
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
									'myimg4' => $_POST['myimg4']);
								}
	
		////////////////////

		global $checked; 	$checked = "";
		global $Checkbox; 	$Checkbox = "";
		global $titulo; 	$titulo = "ELIMINAR GASTO";
		global $titInput;	$titInput = "BORRAR GASTO PENDIENTE";
		require 'TableBorrar2.php';
	
	} // FIN function show_form()

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
		$text = "\n- GASTO SELECCIONADO MODIFICAR ".$ActionTime.$TitBut;
		
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