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
		}elseif(isset($_POST['oculto'])){	
				// SI NO HA MARCADO PARA BORRAR.
				if(!isset($_POST['xl'])){
					print("<div style='text-align:center; margin:auto;'>
								* HA DE MARCAR LA CASILLA DE CONFIRMACIÓN
							</div>");
						show_form();
				}elseif(isset($_POST['xl'])){
							process_form();
							info_02();
							}
		} else {show_form();}

	} else { require '../Inclu/table_permisos.php'; } 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form(){

		global $rutPend;	$rutPend = 'Pendientes';
		global $pend;	$pend = "PENDIENTES";
		require 'Botonera.php';
		
		require 'FactDate.php';

		global $db; 		global $db_name; 		
		global $dyt1;		$dyt1 = $_POST['dy'];

		require 'FormatNumber.php';

		global $vnamepap; 		$vnamepap = "`".$_SESSION['clave']."gastosfeed`";
		global $sent;
		$sent = "INSERT INTO `$db_name`.$vnamepap (`factnum`, `factdate`, `factini`, `refprovee`, `factnom`, `factnif`, `factiva`, `factivae`, `factpvp`, `factret`, `factrete`, `factpvptot`,`coment`, `myimg1`, `myimg2`, `myimg3`, `myimg4`, `factcrea`, `ruta`) VALUES ('$_POST[factnum]', '$factdate', '$_POST[factini]', '$_POST[proveegastos]', '$_POST[factnom]', '$_POST[factnif]', '$_POST[factiva]', '$factivae', '$factpvp', '$_POST[factret]', '$factrete', '$factpvptot', '$_POST[coment]', '$_SESSION[myimg1]', '$_SESSION[myimg2]', '$_SESSION[myimg3]', '$_SESSION[myimg4]', '$_POST[factcrea]', '$_POST[delruta]' )";
		
		if(mysqli_query($db, $sent)){

			global $vname; 		$vname = "`".$_SESSION['clave']."gastos_pendientes`";
			$sqla = "DELETE FROM `$db_name`.$vname  WHERE $vname.`id` = '$_POST[id]'  ";
			if(mysqli_query($db, $sqla)){

				global $title;			$title = 'SE HA BORRADO EN ';
				global $Borrar2;		$Borrar2= "style='display:none; visibility: hidden;'";
				global $Modif2;			$Modif2= "style='display:none; visibility: hidden;'";
				global $ModImg2;		$ModImg2= "style='display:none; visibility: hidden;'";
				global $PendienteG;		$PendienteG = "style='display:none; visibility: hidden;'";
				global $Recupera3;		$Recupera3 = "style='display:none; visibility: hidden;'";
				global $Ver2;			$Ver2= "style='display:none; visibility: hidden;'";
				global $ConteBotones;	$ConteBotones = "style='display:block;'";
				require 'TableFormResult.php';

			}else{ print("* ERROR L.62: ".mysqli_error($db));
						show_form ();
						global $texerror; $texerror = "\n\t ".mysqli_error($db);
							}
		}else{
			print("* ERROR L.56: ".mysqli_error($db));
			show_form ();
			global $texerror; 	$texerror = "\n\t ".mysqli_error($db);
				}
		
		/*
		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='PendientesVer.php';
					}
					setTimeout('redir()',8000);
					</script>";
		print ($redir);
		*/

	} // FIN process_form()
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form(){
	
		global $db;		global $db_name;
		global $rutPend;	$rutPend = 'Pendientes';

		global $pend;	$pend = "PENDIENTES";
		require 'Botonera.php';
		global $TituloCheck;	$TituloCheck = "CONFIRME EL BORRADO CON EL CHECKBOX";

		global $dyt1;
		
		if(isset($_POST['oculto2'])){
				
				$datex = $_POST['factdate'];
				$dyx = substr($_POST['factdate'],0,4);
				$dmx = substr($_POST['factdate'],5,2);
				$ddx = substr($_POST['factdate'],-2,2);
				$dyt1 = $dyx;

				$_SESSION['myimg1'] = $_POST['myimg1'];
				$_SESSION['myimg2'] = $_POST['myimg2'];
				$_SESSION['myimg3'] = $_POST['myimg3'];
				$_SESSION['myimg4'] = $_POST['myimg4'];

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

				global $DelRuta;		$DelRuta ="../cbj_Docs/docgastos_pendientes/";
		
				$defaults = array ( 'id' => $_POST['id'],
									'proveegastos' => $_POST['refprovee'],
									'refprovee' => $_POST['refprovee'],
									'xl' => @$_POST['xl'],
									'dy' => $dyx,
									'dm' => $dmx,
									'dd' => $ddx,
									'factnum' => $_POST['factnum'],
									'factdate' => $_POST['factdate'],
									'factini' => $_POST['factini'],
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
									'vname'  => $_POST['vname'],
									'delruta' => $DelRuta,
									'factcrea' => $_POST['factcrea']);

		}elseif(isset($_POST['oculto'])){
						$defaults = $_POST;
		}

		// SOLO LAS DECLARO PARA REUTILIZAR EL SCRIPT 
		global $nY;		$nY = date('Y');
		$_SESSION['newDy'] = date('Y');

		////////////////////

		global $titulo; 	$titulo = "ELIMINAR GASTO PENDIENTE";
		global $titInput;	$titInput = "BORRAR GASTO PENDIENTE";
		global $Borrar2;	$Borrar2= "style='display:none; visibility: hidden;'";

		global $checked;
		
		if(@$defaults['xl'] == 'yes') { $checked = "checked='checked'";}else{ $checked = ""; }

		global $Checkbox;
		$Checkbox = "<tr>
						<td colspan='2' style='text-align:center;' >
							".$TituloCheck." : &nbsp; 
							<input type='checkbox' name='xl' value='yes' ".$checked."/>
						</td>
					</tr>";

		global $rutaDirTr;
		$rutaDirTr ="<tr>
						<td style='text-align: right !important;' >RUTA DIR</td>
						<td>".@$defaults['delruta']."</td>			
					</tr>";

		global $a;
		if(isset($_POST['factdate'])){
			$a= (substr($_POST['factdate'],0,4));
		}else{
			$a= (substr($_POST['dy'],0,4));
		}
		global $vnameStatus; 		$vnameStatus = "`".$_SESSION['clave']."status`";
		$sqlSTatus =  "SELECT * FROM $vnameStatus WHERE `year`='$a' LIMIT 1 ";
		$qStauts = mysqli_query($db, $sqlSTatus);
		$rowStatus = mysqli_fetch_assoc($qStauts);
		global $style;
		//if($rowStatus['stat']==''){
		if($rowStatus['stat']=='close'){
			if($rutPend == 'Pendientes'){
				global $Modif2;			$Modif2 = "style='display:none; visibility: hidden;'";
				global $ModImg2;		$ModImg2 = "style='display:none; visibility: hidden;'";
			}else{
				global $Modif2;			$Modif2 = "style='display:inline-block;'";
				global $ModImg2;		$ModImg2 = "style='display:inline-block;'";
			}
			//global $Borrar2;		$Borrar2= "style='display:none; visibility: hidden;'";
			//global $PendienteG;		$PendienteG = "style='display:none; visibility: hidden;'";
			//global $Recupera3;		$Recupera3 = "style='display:none; visibility: hidden;'";
		}else{ }

		require 'TableBorrar.php';
	
	} // FIN function show_form()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info_01(){

	global $db;
	
		$TitBut = "\n\tFiltro => \n\tDATE: ".$_POST['factdate'].".\n\tR. Social: ".$_POST['factnom'].".\n\tDNI: ".$_POST['factnif'].".\n\tNº FACTURA: ".$_POST['factnum'].".";

		$ActionTime = date('H:i:s');

		global $text;
		$text = "\n- GASTO SELECCIONADO MODIFICAR ".$ActionTime.$TitBut;
		
		require 'WriteLog.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info_02(){

		global $db; 		global $factivae;
		global $factpvp; 	global $factpvptot; 	global $factdate;
		
		$ActionTime = date('H:i:s');

		global $text;
		$text = "\n- GASTO MODIFICADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$factdate.".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$factivae.".\n\tNETO €: ".$factpvp.".\n\tTOTAL €: ".$factpvptot;

		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);

		require 'WriteLog.php';

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