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
	
		global $db; 			global $db_name;
		global $vname; 			global $dyt1;		$dyt1 = $_SESSION['dyt1'];
		//echo "** ".$dyt1."<br>";


		
		global $vnamed; 		$vnamed = "`".$_SESSION['clave']."gastosfeed`";
		global $vnamei; 		//$vnamei = "`".$_SESSION['clave']."gastos_".$dyt1."`";
		//echo $_POST['delruta']."<br>";
		global $vnameRuta;
		$vnameRuta = str_replace("../cbj_Docs/doc", "", $_POST['delruta']);
		$vnameRuta = str_replace("/", "", $vnameRuta);
		$vnamei = "`".$_SESSION['clave'].$vnameRuta."`";
		//echo $vnamei."<br>";



		global $rutPend;	$rutPend = '';
		global $pend;	$pend = "";
		require 'Gastos_Botonera.php';
		global $title;			$title = 'SE HA INSERTADO LA FACTURA EN ';

		//require 'Modificar03process_form_2.php';

		require 'Gastos_factdate.php';

		require 'FormatNumber.php';

		$idx = $_SESSION['idx'];

		global $sent;
		$sent = "INSERT INTO `$db_name`.$vnamei (`factnum`, `factdate`, `refprovee`, `factnom`, `factnif`, `factiva`, `factivae`, `factpvp`, `factret`, `factrete`, `factpvptot`,`coment`, `myimg1`, `myimg2`, `myimg3`, `myimg4`) VALUES ('$_POST[factnum]', '$factdate', '$_POST[proveegastos]', '$_POST[factnom]', '$_POST[factnif]', '$_POST[factiva]', '$factivae', '$factpvp', '$_POST[factret]', '$factrete', '$factpvptot', '$_POST[coment]', '$_SESSION[myimg1]', '$_SESSION[myimg2]', '$_SESSION[myimg3]', '$_SESSION[myimg4]')";
		
		if(mysqli_query($db, $sent)){

			//global $title;			$title = 'SE INSERTADO LA FACTURA EN ';
			global $Borrar2;		$Borrar2= "style='display:none; visibility: hidden;'";
			global $Modif2;			$Modif2= "style='display:none; visibility: hidden;'";
			global $ModImg2;		$ModImg2= "style='display:none; visibility: hidden;'";
			global $PendienteG;		$PendienteG= "style='display:none; visibility: hidden;'";
			global $Recupera3;		$Recupera3 = "style='display:none; visibility: hidden;'";
			global $Ver2;			$Ver2= "style='display:none; visibility: hidden;'";
			global $ConteBotones;	$ConteBotones = "style='display:block;'";

			global $papelera;		$papelera = 1;

			require 'TableFormResult.php';	
				
		}else{
			print("* ERROR L.64: ".mysqli_error($db));
			global $texerror; 	$texerror = "\n\t ".mysqli_error($db);
				}

		$idx = $_SESSION['idx'];
		// global $vnamed; 		$vnamed = "`".$_SESSION['clave']."gastos_".$dyt1."`";
		$sqla = "DELETE FROM `$db_name`.$vnamed  WHERE $vnamed.`id` = '$idx'  ";

		if(mysqli_query($db, $sqla)){ //	print("<br/>* OK DELETE DATA."); 
		}else{
			print("* ERROR L.88: ".mysqli_error($db));
			global $texerror; 	$texerror = "\n\t ".mysqli_error($db);
				}

		/*
		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='Gastos_Ver.php';
					}
					setTimeout('redir()',8000);
					</script>";
		print ($redir);
		*/
		
	} // FIN process_form_2()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form($errors=[]){

		global $rutPend;	$rutPend = '';
		global $pend;	$pend = "";
		require 'Gastos_Botonera.php';
		global $titulo; 	$titulo = "RECUPERAR ESTA FACTURA A SU UBICACIÓN ORIGINAL";
		global $titInput;	$titInput = "RECUPERAR FACTURA";
		global $TituloCheck;	$TituloCheck = "SI DESEA RECUPERAR LA FACTURA MARQUE LA CASILLA";

		if(isset($_POST['oculto2'])){ $_SESSION['yold'] = substr($_POST['factdate'],0,2); }else{ }

		global $db; 	global $db_name;

		global $papelera;		$papelera = 1;
		global $papeleraRecup;	$papeleraRecup = 1;

		require 'Modifica03show_form.php';

	} // FIN function show_form($errors=[])

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
		$text = "\n- GASTO PENDIENTE MODIFICAR SELECCIONADO FACTURA PAGADA ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$_POST['factdate'].".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$_POST['factivae'].".\n\tNETO €: ".$_POST['factpvp'].".\n\tTOTAL €: ".$_POST['factpvptot'];
	
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
	$text = "\n- GASTO PENDIENTE MODIFICADO FACTURA PAGADA ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$factdate.".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$factivae.".\n\tNETO €: ".$factpvp.".\n\tTOTAL €: ".$factpvptot;

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