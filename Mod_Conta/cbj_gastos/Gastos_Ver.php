<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

$_SESSION['usuarios'] = '';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if ($_SESSION['Nivel'] == 'admin'){

		master_index();
		global $limit;  $limit = '';

		if(isset($_POST['todo'])){	show_form();							
									ver_todo();
									info();
		} elseif(isset($_POST['show_formcl'])){
					if($form_errors = validate_form()){
							show_form($form_errors);
					} else { process_form();
							 info();
								}
		} else { show_form();
				 $limit = 'LIMIT 20';
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

		global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$dyt1."`";

		global $sqlb;
		require 'FormConsultaFiltroGt2.php';
		
	/*	
	$sqlb =  "SELECT * FROM $vname WHERE (`factnum` = '$fnum' OR `factnif` = '$fnif' OR `refprovee` = '$fnom') AND  (`factdate` LIKE '$fil') ORDER BY $orden ";
	*/
	echo $sqlb."<br>";
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

	global $AddBlackTit; 		$AddBlackTit = "CREAR NUEVO GASTO PENDIENTE";
	global $MoneypBlackTit; 	$MoneypBlackTit = "VER TODOS GASTOS PENDIENTES";

	global $DetalleBlackTit; 	$DetalleBlackTit = "VER DETALLES";
	global $FotoBlackTit;		$FotoBlackTit = "MODIFICAR DOCS ADJUNTOS";
	global $DatosBlackTit;		$DatosBlackTit = "MOFIFICAR DATOS FACTURA";
	global $DeleteWhiteTit;		$DeleteWhiteTit = "BORRAR DATOS";
	require '../Inclu/BotoneraVar.php';
	global $closeButton;

	if(!$qb){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."</br>");
	} else {
		if(mysqli_num_rows($qb) == 0){

				require 'Gastos_NoData.php';

		}else{ 

				require 'Gastos_rowb_Total_Tabla.php';
			
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
	
	global $ruta;
	$ruta = "../cbj_Docs/grafics/";

	/////////////

	$fh = fopen($ruta.'IMxT3.php','w+');
	while($registro = mysqli_fetch_array($qg)){
		$line = $registro['factpvptot'].",";
		fwrite($fh, $line);
		}
	fclose($fh);
	
	/////////////

	$sqlgd =  $sqlb;
	$qgd = mysqli_query($db, $sqlgd);

	$fhd = fopen($ruta.'IMxD3.php','w+');
	while($registrod = mysqli_fetch_array($qgd)){
		$lined = "M".substr($registrod['factdate'],3,2)."\nD".substr($registrod['factdate'],-2).",";
		fwrite($fhd, $lined);
		$_SESSION['rsoc'] = $registrod['factnom'];
		}
	fclose($fhd);
	
	require 'gdtvt2.php';

	}	/* Final process_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form($errors=[]){
	
		if(isset($_POST['show_formcl'])){
					$defaults = $_POST;
		} elseif(isset($_POST['todo'])){
				$defaults = $_POST;
		} else { $defaults = array ('factnom' => '',
									'factnif' => '',
									'factnum' => '',
									'Orden' => isset($ordenar));
								}


		global $titulo; $titulo = "CONSULTAR GASTOS";
		global $TitBut1;		$TitBut1 = "VER TODOS LOS GASTOS";		
		global $TitBut2;		$TitBut2 = "FILTRO BUSQUEDA GASTOS";
		require 'Inc_Show_Form_01.php';	

	}	/* Fin show_form(); */

	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function gt2(){

		global $db; 	global $dyt1;

		require 'Gastos_factdate.php';

		require 'Gastos_ConsultaLogica.php';
	
	global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$dyt1."`";

	global $sqlb;
	require 'FormConsultaFiltroGt2.php';
	
	$qc = mysqli_query($db, $sqlb);
	global $gt;
	$gt = mysqli_num_rows($qc);
	//print("* ".$gt);
	global $cnt;

	if(($gt>0)&&($_POST['dm'] == '')&&($_POST['dd'] == '')&&($cnt < 1)){
		print("	<tr>
		 			<td>
			<form name='grafico' action='grafico_gf.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\" style='display: inline-block !important;'>
		<input type='submit' value='GRAFIC LINEAL TOTAL' title='VER GRAFICA LINEAL TOTAL' class='botonnaranja' />
		<input type='hidden' name='grafico' value=1 />
			</form>	
			<form name='grafico' action='grafico_gfb.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\" style='display: inline-block !important;'>
		<input type='submit' value='GRAFIC BARRAS TOTAL' title='VER GRAFICA BARRAS TOTAL' class='botonnaranja' />
		<input type='hidden' name='grafico' value=1 />
			</form>	
			<form name='grafico2' action='grafico_gf2.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\" style='display: inline-block !important;'>
		<input type='submit' value='GRAFIC LINEAL DETALLE' title='VER GRAFICA LINEAL DETALLE' class='botonnaranja' />
		<input type='hidden' name='grafico2' value=1 />
			</form>	
			<form name='grafico2' action='grafico_gf2b.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\" style='display: inline-block !important;'>
		<input type='submit' value='GRAFIC BARRAS DETALLE' title='VER GRAFICA BARRAS DETALLE' class='botonnaranja' />
		<input type='hidden' name='grafico2' value=1 />
			</form>	
					</td>
				</tr>");
		}

	} // FIN function gt2()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function gt1(){

		global $db; 		global $db_name;

		require 'Gastos_factdate.php';

		global $vname; 	$vname = "`".$_SESSION['clave']."gastos_".$dyt1."`";

		global $sqlb;
		require 'FormConsultaFiltroGt1.php';
		//$sqlb =  "SELECT * FROM $vname WHERE `factdate` LIKE '$fil' ORDER BY $orden ";

		$qb = mysqli_query($db, $sqlb);
		if(mysqli_num_rows($qb) == 0){}
		global $gt;
		$gt = mysqli_num_rows($qb);
		//print("* ".$gt);
		
		if(($gt>0)&&($_POST['dm'] != '')&&($_POST['dd'] == '')){

		print("	<tr>
		 			<td>
			<form name='grafico' action='grafico_g.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\" style='display: inline-block !important;' >
		<input type='submit' value='GRAFIC LINEAL TOTAL DIA' title='VER GRAFICA LINEAL TOTAL POR DIA' class='botonnaranja' />
		<input type='hidden' name='grafico' value=1 />
			</form>	
			<form name='graficob' action='grafico_gb.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\" style='display: inline-block !important;'>
		<input type='submit' value='GRAFIC BARRAS TOTAL DIA' title='VER GRAFICA BARRAS TOTAL POR DIA' class='botonnaranja' />
		<input type='hidden' name='graficob' value=1 />
			</form>	
			<form name='grafico2' action='grafico_g2.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\" style='display: inline-block !important;'>
		<input type='submit' value='GRAFIC LINEAL DETALLE' title='VER GRAFICA LINEAL DETALLE' class='botonnaranja' />
		<input type='hidden' name='grafico2' value=1 />
			</form>	
			<form name='graficob2' action='grafico_gb2.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\" style='display: inline-block !important;'>
		<input type='submit' value='GRAFIC BARRAS DETALLE $$' title='VER GRAFICA BARRAS DETALLE' class='botonnaranja' />
		<input type='hidden' name='graficob2' value=1 />
			</form>	
					</td>
				</tr>");
		} // FIN if
	} // FIN function gt1()

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

		global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$dyt1."`";

		global $sqlb;
		require 'FormConsultaFiltroGt1.php';
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

		global $AddBlackTit; 		$AddBlackTit = "CREAR NUEVO GASTO PENDIENTE";
		global $MoneypWhiteTit; 	$MoneypWhiteTit = "VER TODOS GASTOS PENDIENTES";

		global $DetalleBlackTit; 	$DetalleBlackTit = "VER DETALLES";
		global $FotoBlackTit;		$FotoBlackTit = "MODIFICAR DOCS ADJUNTOS";
		global $DatosBlackTit;		$DatosBlackTit = "MOFIFICAR DATOS FACTURA";
		global $DeleteWhiteTit;		$DeleteWhiteTit = "BORRAR DATOS";
		require '../Inclu/BotoneraVar.php';
		global $closeButton;

		if(!$qb){
				print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
		} else {
			if(mysqli_num_rows($qb) == 0){

				require 'Gastos_NoData.php';

			} else { 

					require 'Gastos_rowb_Total_Tabla.php';
					
				} /* Fin segundo else anidado en if */
			} /* Fin de primer else . */
			
		global $fil;												
		global $sqlb;
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
		
		global $ruta;
		$ruta = "../cbj_Docs/grafics/";

		/////////////

		$fh = fopen($ruta.'IMxT.php','w+');
		while($registro = mysqli_fetch_array($qg)){
					$line = $registro['factpvptot'].",";
					fwrite($fh, $line);
				}
		fclose($fh);
		
		/////////////

		global $sqlb;
		require 'FormConsultaFiltroGt1.php';
		$sqlgd = $sqlb;
		//$sqlgd =  "SELECT * FROM $vname WHERE `factdate` LIKE '$fil' ORDER BY $orden ";
		$qgd = mysqli_query($db, $sqlgd);

		$fhd = fopen($ruta.'IMxD.php','w+');
		while($registrod = mysqli_fetch_array($qgd))
		{
		$lined = substr($registrod['factdate'],-2).",";
		fwrite($fhd, $lined);
		}
		fclose($fhd);
		
		require 'gdtvt.php';

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
	if($_POST['dy'] == ''){ $dy = date('Y');} else{$dy = "20".$_POST['dy'];}
	
	global $orden;
	if((isset($_POST['Orden']))&&($_POST['Orden']!= '')){
		$orden = $_POST['Orden'];
	}else{ $orden = '`id` ASC'; }

	if(isset($_POST['todo'])){$TitBut = "\n\tFiltro => TODOS LOS GASTOS. ".$orden."\n\tDATE: ".$dy."/".$dm."/".$dd.".";}
	else{$TitBut = "\n\tFiltro => \n\tDATE: ".$dy."/".$dm."/".$dd.".\n\tR. Social: ".$_POST['factnom'].".\n\tDNI: ".$_POST['factnif'].".\n\tNº FACTURA: ".$_POST['factnum'].".";}

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