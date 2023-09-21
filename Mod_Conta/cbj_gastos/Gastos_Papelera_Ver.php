<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';
	require 'Gastos_Papelera_Ver_02.php';

	$_SESSION['usuarios'] = '';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if ($_SESSION['Nivel'] == 'admin'){

		master_index();
		global $limit;  $limit = '';
		global $iniVerTodo;		$iniVerTodo = '';

		if(isset($_POST['todo'])){	show_form();							
									ver_todo();
									info();
		}elseif(isset($_POST['show_formcl'])){
					if($form_errors = validate_form()){
							show_form($form_errors);
					}else{ 	process_form();
							info();
								}
		}elseif(isset($_POST['ocultoDetalle'])){ 
						process_form_Detalle();
						info_Detalle();
		}else{  show_form();
				global $limit;			$limit = 'LIMIT 20';
				global $iniVerTodo;		$iniVerTodo = 1;
				ver_todo(); 
						}
								
	} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function validate_form(){
	
		require 'Inc_Show_Form_01_Val.php';

		return $errors;

	} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form(){
		
		global $db;
 
		show_form();

		global $dyt1;
		
		require 'Gastos_factdate.php';

		global $vname; 		$vname = "`".$_SESSION['clave']."gastosfeed`";

		global $sqlb;
		require 'FormConsultaFiltroGt2.php';
		
		//echo $sqlb."<br>";
		$qb = mysqli_query($db, $sqlb);
	
		/////////////////////	
		/* PARA SUMAR PVPTOT */

			if(!$qb){print(mysqli_error($db).".</br>");
			}else{
				$qpvptot = mysqli_query($db, $sqlb);
				$rowpvptot = mysqli_num_rows($qpvptot);
				$sumapvptot = 0;
					for($i=0; $i<$rowpvptot; $i++){
									$ver = mysqli_fetch_array($qpvptot);
								$sumapvptot = $sumapvptot + $ver['factpvptot'];
												}
							}
					
		/* FIN PARA SUMAR PVPTOT */
		/////////////////////////

		/////////////////////	
		/* PARA SUMAR RETENCIONES */

			if(!$qb){print(mysqli_error($db).".</br>");
			}else{
				$qrete = mysqli_query($db, $sqlb);
				$rowrete = mysqli_num_rows($qrete);
				$sumarete = 0;
					for($i=0; $i<$rowrete; $i++){
									$verret = mysqli_fetch_array($qrete);
									$sumarete = $sumarete + $verret['factrete'];
											}
							}
					
		/* FIN PARA SUMAR RETENCIONES */
		/////////////////////////

		/////////////////////	
		/* PARA SUMAR IVA */

			if(!$qb){print(mysqli_error($db).".</br>");
			}else{
				$qivae = mysqli_query($db, $sqlb);
				$rowivae = mysqli_num_rows($qivae);
				$sumaivae = 0;
					for($i=0; $i<$rowivae; $i++){
									$ver = mysqli_fetch_array($qivae);
									$sumaivae = $sumaivae + $ver['factivae'];
														}
							}
					
		/* FIN PARA SUMAR IVA */
		/////////////////////////

		global $rutPend;	$rutPend = '';
		global $pend;	$pend = "";
		require 'Gastos_Botonera.php';

		if(!$qb){
				print("<font color='#FF0000'>
						Se ha producido un error: </font>".mysqli_error($db)."</br>");
		}else{
			if(mysqli_num_rows($qb) == 0){
					global $titNoData;		$titNoData = "PAPELERA GASTOS ".$dyt1."<br>";
					require 'Gastos_NoData.php';
			}else{ 
					require 'Gastos_rowb_Papelera_Tabla.php';
						} /* Fin segundo else anidado en if */

		} /* Fin de primer else . */
				
		global $fil; 		global $orden; 		global $factnom;
		global $factnif; 	global $factnum; 	global $vname;

		$sqlg = $sqlb;
		$qg = mysqli_query($db, $sqlg);

		if($_SESSION['gtime']==''){$_SESSION['gtime']='';}
		elseif($_SESSION['gtime']=='01'){$_SESSION['gtime']='ENERO';}
		elseif($_SESSION['gtime']=='02'){$_SESSION['gtime']='FEBRERO';}
		elseif($_SESSION['gtime']=='03'){$_SESSION['gtime']='MARZO';}
		elseif($_SESSION['gtime']=='04'){$_SESSION['gtime']='ABRIL';}
		elseif($_SESSION['gtime']=='05'){$_SESSION['gtime']='MAYO';}
		elseif($_SESSION['gtime']=='06'){$_SESSION['gtime']='JUNIO';}
		elseif($_SESSION['gtime']=='07'){$_SESSION['gtime']='JULIO';}
		elseif($_SESSION['gtime']=='08'){$_SESSION['gtime']='AGOSTO';}
		elseif($_SESSION['gtime']=='09'){$_SESSION['gtime']='SEPTIEMBRE';}
		elseif($_SESSION['gtime']=='10'){$_SESSION['gtime']='OCTUBRE';}
		elseif($_SESSION['gtime']=='11'){$_SESSION['gtime']='NOVIEMBRE';}
		elseif($_SESSION['gtime']=='12'){$_SESSION['gtime']='DICIEMBRE';}
	
		//print ("* ".$_SESSION['gtime']);
		
		global $rutaDir;
		$rutaDir = "../cbj_Docs/grafics/";

		/////////////

		$sqlgd =  $sqlb;
		$qgd = mysqli_query($db, $sqlgd);

		$fhd = fopen($rutaDir.'IMxD3.php','w+');
		while($registrod = mysqli_fetch_array($qgd)){
			$lined = "M".substr($registrod['factdate'],3,2)."\nD".substr($registrod['factdate'],-2).",";
			fwrite($fhd, $lined);
			$_SESSION['rsoc'] = $registrod['factnom'];
			}
		fclose($fhd);
		

	}	/* Final process_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form($errors=[]){
	
		if(isset($_POST['show_formcl'])){
					$defaults = $_POST;
		}elseif(isset($_POST['todo'])){
				$defaults = $_POST;
		}else{ $defaults = array ( 'factnom' => '',
									'factnif' => '',
									'factnum' => '',
									'Orden' => isset($ordenar));
								}

		global $titulo; 		$titulo = "CONSULTAR PAPELERA GASTOS";
		global $TitBut1;		$TitBut1 = "VER TODOS PAPELERA GASTOS";		
		global $TitBut2;		$TitBut2 = "FILTRO BUSQUEDA PAPELERA GASTOS";
		global $papelera;		$papelera = 1;
		require 'Inc_Show_Form_01.php';	

	}	/* Fin show_form(); */


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function ver_todo(){
		
		global $db; 		global $db_name;		global $limit;

		global $dyt1;
		require 'Gastos_factdate.php';

		global $orden;
		if((isset($_POST['Orden']))&&($_POST['Orden']!= '')){
			$orden = $_POST['Orden'];
		}else{ $orden = '`id` ASC'; }

		global $vname; 		$vname = "`".$_SESSION['clave']."gastosfeed`";

		global $iniVerTodo;		global $sqlb;
		if($iniVerTodo == 1){
				global $limit;
				$sqlb =  "SELECT * FROM $vname  ORDER BY '`factdate` DESC' $limit";
		}else{
			require 'FormConsultaFiltroGt1.php';
		}


		//$sqlb =  "SELECT * FROM $vname WHERE `factdate` LIKE '$fil' ORDER BY $orden $limit ";
		$qb = mysqli_query($db, $sqlb);
	
	/////////////////////	
	/* PARA SUMAR PVPTOT */

		if(!$qb){print(mysqli_error($db).".</br>");
		}else{
			$qpvptot = mysqli_query($db, $sqlb);
			$rowpvptot = mysqli_num_rows($qpvptot);
			$sumapvptot = 0;
				for($i=0; $i<$rowpvptot; $i++){
						$ver = mysqli_fetch_array($qpvptot);
						$sumapvptot = $sumapvptot + $ver['factpvptot'];
									}
		}
					
		/* FIN PARA SUMAR PVPTOT */
		/////////////////////////

		/////////////////////	
		/* PARA SUMAR RETENCIONES */

			if(!$qb){print(mysqli_error($db).".</br>");
			}else{
				$qrete = mysqli_query($db, $sqlb);
				$rowrete = mysqli_num_rows($qrete);
				$sumarete = 0;
					for($i=0; $i<$rowrete; $i++){
							$verret = mysqli_fetch_array($qrete);
							$sumarete = $sumarete + $verret['factrete'];
									}
			}
					
		/* FIN PARA SUMAR RETENCIONES */
		/////////////////////////

		/////////////////////	
		/* PARA SUMAR IVA */

			if(!$qb){print(mysqli_error($db).".</br>");
			}else{
				$qivae = mysqli_query($db, $sqlb);
				$rowivae = mysqli_num_rows($qivae);
				$sumaivae = 0;
					for($i=0; $i<$rowivae; $i++){
							$ver = mysqli_fetch_array($qivae);
							$sumaivae = $sumaivae + $ver['factivae'];
									}
			}
					
		/* FIN PARA SUMAR IVA */
		/////////////////////////

		global $rutPend;	$rutPend = '';
		global $pend;	$pend = "";
		require 'Gastos_Botonera.php';

		if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
		}else{
			if(mysqli_num_rows($qb) == 0){
				global $titNoData;		$titNoData = "PAPELERA GASTOS ".$dyt1."<br>";
				require 'Gastos_NoData.php';
			}else{ 
					require 'Gastos_rowb_Papelera_Tabla.php';
				} /* Fin segundo else anidado en if */
		} /* Fin de primer else . */
				
			global $fil; 	global $sqlb;

			require 'FormConsultaFiltroGt1.php';

			$sqlg = $sqlb;
			//$sqlg =  "SELECT * FROM $vname WHERE `factdate` LIKE '$fil' ORDER BY $orden ";
			$qg = mysqli_query($db, $sqlg);

			if($_SESSION['gtime']==''){$_SESSION['gtime']='';}
			elseif($_SESSION['gtime']=='01'){$_SESSION['gtime']='ENERO';}
			elseif($_SESSION['gtime']=='02'){$_SESSION['gtime']='FEBRERO';}
			elseif($_SESSION['gtime']=='03'){$_SESSION['gtime']='MARZO';}
			elseif($_SESSION['gtime']=='04'){$_SESSION['gtime']='ABRIL';}
			elseif($_SESSION['gtime']=='05'){$_SESSION['gtime']='MAYO';}
			elseif($_SESSION['gtime']=='06'){$_SESSION['gtime']='JUNIO';}
			elseif($_SESSION['gtime']=='07'){$_SESSION['gtime']='JULIO';}
			elseif($_SESSION['gtime']=='08'){$_SESSION['gtime']='AGOSTO';}
			elseif($_SESSION['gtime']=='09'){$_SESSION['gtime']='SEPTIEMBRE';}
			elseif($_SESSION['gtime']=='10'){$_SESSION['gtime']='OCTUBRE';}
			elseif($_SESSION['gtime']=='11'){$_SESSION['gtime']='NOVIEMBRE';}
			elseif($_SESSION['gtime']=='12'){$_SESSION['gtime']='DICIEMBRE';}
			
			//print ("* ".$_SESSION['gtime']);
			
			global $rutaDir;
			$rutaDir = "../cbj_Docs/grafics/";

			/////////////

	}	/* FIN ver_todo(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaGastos;	$rutaGastos = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $dd;
	if($_POST['dd'] == ''){$dd = "DIA TODOS";}else{$dd = $_POST['dd'];}
	global $dm;
	if($_POST['dm'] == ''){$dm = "MES TODOS";}else{$dm = $_POST['dm'];}
	global $dy;
	if($_POST['dy'] == ''){ $dy = date('Y');} else{$dy = $_POST['dy'];}
	
	global $orden;
	if((isset($_POST['Orden']))&&($_POST['Orden']!= '')){
		$orden = $_POST['Orden'];
	}else{ $orden = '`id` ASC'; }

	if(isset($_POST['todo'])){$TitBut = "\n\tFiltro => TODOS LOS GASTOS. ".$orden."\n\tDATE: ".$dy."-".$dm."-".$dd.".";}
	else{$TitBut = "\n\tFiltro => \n\tDATE: ".$dy."-".$dm."-".$dd.".\n\tR. Social: ".$_POST['factnom'].".\n\tDNI: ".$_POST['factnif'].".\n\tNº FACTURA: ".$_POST['factnum'].".";}

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	global $text; 		$text = "\n- GASTOS CONSULTAR ".$ActionTime.$TitBut;
	
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

	require '../Inclu/Conta_Footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>