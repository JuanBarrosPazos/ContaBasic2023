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

		global $vname; 		$vname = "`".$_SESSION['clave']."gastos_pendientes`";
		global $sqlc; 		$sqlc =  "SELECT * FROM $vname WHERE 1 ";

		// FACTURA Nº
		global $fnum;		global $or1;	global $or2;	
		if(strlen(trim($_POST['factnum'])) == 0){
			$fnum = '';
			$sqlc .= " AND (";
			$or1 = '';
		}else{
			$fnum = $_POST['factnum'];
			$or1 = 'OR';
			$sqlc .= " AND (`factnum` = '$fnum' ";
		}
		global $factnum; 	$factnum = $_POST['factnum'];
		
		// NIF
		global $fnif;		
		if(strlen(trim($_POST['factnif'])) == 0){
			$fnif = '';
			if($or1 == ''){ $or2 = ''; } else { $or2 = 'OR'; }
			$sqlc .= "";
		}else{
			$fnif = $_POST['factnif'];
			$or2 = 'OR';
			$sqlc .= " $or1 `factnif` = '$fnif' ";
		}
		global $factnif; 	$factnif = $_POST['factnif'];
		
		// RAZON SOCIAL
		global $fnom;
		if(strlen(trim($_POST['factnom'])) == 0){
			$fnom = '';
			$sqlc .= "";
		}else{
			$fnom = $_POST['factnom'];
			$sqlc .= " $or2 `refprovee` = '$fnom' ";
		}
		global $factnom; 	$factnom = $_POST['factnom'];
		
		if($fil == "%%"){
			$sqlc .= ")";
		}else{
			$sqlc .= ") AND  (`factdate` LIKE '$fil')";
		}
			//$sqlc .= "OR  `factdate` LIKE '$fil' ";

		global $orden;
		if((isset($_POST['Orden']))&&($_POST['Orden']!= '')){
			$orden = $_POST['Orden'];
		}else{ $orden = '`id` ASC'; }

			$sqlc .= " ORDER BY $orden ";

	/*	
	$sqlc =  "SELECT * FROM $vname WHERE (`factnum` = '$fnum' OR `factnif` = '$fnif' OR `refprovee` = '$fnom') AND  (`factdate` LIKE '$fil') ORDER BY $orden ";
	*/
	//echo $sqlc;
	$qc = mysqli_query($db, $sqlc);
	
/////////////////////	
/* PARA SUMAR PVPTOT */

	if(!$qc){print(mysqli_error($db).".</br>");
	}else{
		$qpvptot = mysqli_query($db, $sqlc);
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

	if(!$qc){print(mysqli_error($db).".</br>");
	}else{
		$qrete = mysqli_query($db, $sqlc);
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

	if(!$qc){print(mysqli_error($db).".</br>");
	}else{
		$qivae = mysqli_query($db, $sqlc);
		$rowivae = mysqli_num_rows($qivae);
		$sumaivae = 0;
			for($i=0; $i<$rowivae; $i++){
							$ver = mysqli_fetch_array($qivae);
							$sumaivae = $sumaivae + $ver['factivae'];
												}
					}
			
/* FIN PARA SUMAR IVA */
/////////////////////////

	if(!$qc){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."</br>");
	} else {
		if(mysqli_num_rows($qc) == 0){

			require 'Gastos_NoData.php';

		}else{ 
			print ("<table align='center'>
					<tr>
						<th colspan=16 class='BorderInf'>".mysqli_num_rows($qc)." RESULTADOS</th>
					</tr>
					<tr>
						<th class='BorderInfDch'>ID</th>
						<th class='BorderInfDch'>NUMERO</th>
						<th class='BorderInfDch'>Y/M/D</th>
						<th class='BorderInfDch'>RAZON SOCIAL</th>
						<th class='BorderInfDch'>NIF/CIF</th>
						<th class='BorderInfDch'>IMP %</th>
						<th class='BorderInfDch'>IMP €</th>
						<th class='BorderInfDch'>SUBTOT</th>										
						<th class='BorderInfDch'>RET %</th>
						<th class='BorderInfDch'>RET €</th>
						<th class='BorderInfDch'>TOTAL</th>
						<th colspan=5 class='BorderInf'>
			<a href='Gastos_Pendientes_Crear.php' class='botonverde' style='color:#343434 !important;'>
				CREAR NUEVO GASTO PENDIENTE
			</a>
			<a href='Gastos_Ver.php' class='botonverde' style='color:#343434 !important;'>
				VER GASTOS
			</a>
						</th>
					</tr>");
			
		while($rowb = mysqli_fetch_assoc($qc)){
 			
			global $vname; 		global $dyt1;
		
			require 'Gastos_Pendientes_rowb_Total.php';

		} // FIN WHILE  

		print("<tr>
					<td colspan='16' class='BorderInf'></td>
				</tr>
				<tr>
					<td class='BorderInf' align='center'></td>
					<td colspan='3' class='BorderInfDch' align='center'>IMPUESTOS REPERC €</td>
					<td colspan='3' class='BorderInfDch' align='center'>RETENCION REPERC €</td>
					<td colspan='4' class='BorderInfDch' align='center'>TOTAL €</td>
					<td colspan='5' align='right'></td>
				</tr>
				<tr>
					<td class='BorderInf' align='center'></td>
					<td colspan='3' class='BorderInfDch' align='right'>".$sumaivae." €</td>
					<td colspan='3' class='BorderInfDch' align='right'>".$sumarete." €</td>
					<td colspan='4' class='BorderInfDch' align='right'>".$sumapvptot." €</td>
					<td colspan='5' class='BorderInf' align='right'></td>
				</tr>
			</table>");
			
			} /* Fin segundo else anidado en if */

		} /* Fin de primer else . */
		
	global $fil; 		global $orden; 		global $factnom;
	global $factnif; 	global $factnum; 	global $vname;

	$sqlg = "SELECT * FROM $vname WHERE `factnum` = '$fnum' AND `factdate` LIKE '$fil' OR `factnif` = '$fnif' AND  `factdate` LIKE '$fil' OR `refprovee` = '$fnom' AND  `factdate` LIKE '$fil' ORDER BY $orden ";
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

	$sqlgd =  "SELECT * FROM $vname WHERE `factnum` = '$fnum' AND `factdate` LIKE '$fil' OR `factnif` = '$fnif' AND  `factdate` LIKE '$fil' OR `refprovee` = '$fnom' AND  `factdate` LIKE '$fil' ORDER BY $orden ";
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
								
		global $titulo; $titulo = "CONSULTAR GASTOS PENDIENTES";

		require 'Inc_Show_Form_01.php';	

	}	/* Fin show_form(); */

	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function gt2(){

	global $db; 	global $dyt1;

	require 'Gastos_factdate.php';

	require 'Gastos_ConsultaLogica.php';
	
	global $vname; 		$vname = "`".$_SESSION['clave']."gastos_pendientes`";

	$sqlc =  "SELECT * FROM $vname WHERE `factnum` = '$fnum' AND `factdate` LIKE '$fil' OR `factnif` = '$fnif' AND  `factdate` LIKE '$fil' OR `refprovee` = '$fnom' AND  `factdate` LIKE '$fil' ORDER BY $orden ";
 	
	$qc = mysqli_query($db, $sqlc);
	global $gt;
	$gt = mysqli_num_rows($qc);
	//print("* ".$gt);
	global $cnt;

	if(($gt>0)&&($_POST['dm'] == '')&&($_POST['dd'] == '')&&($cnt < 1)){
		print("	<tr>
		 			<td colspan='2' align='right' class='BorderInf'>
				<div style='float:left; margin-right:3px;  margin-left:3px;'>
			<form name='grafico' action='grafico_gf.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\">
		<input type='submit' value='GRAFIC LINEAL TOTAL' title='VER GRAFICA LINEAL TOTAL' class='botonnaranja' />
		<input type='hidden' name='grafico' value=1 />
			</form>	
				</div>	 				
				<div style='float:left; margin-right:3px;  margin-left:3px;'>
			<form name='grafico' action='grafico_gfb.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\">
		<input type='submit' value='GRAFIC BARRAS TOTAL' title='VER GRAFICA BARRAS TOTAL' class='botonnaranja' />
		<input type='hidden' name='grafico' value=1 />
			</form>	
				</div>					
				<div style='float:left; margin-right:3px;  margin-left:3px;'>
			<form name='grafico2' action='grafico_gf2.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\">
		<input type='submit' value='GRAFIC LINEAL DETALLE' title='VER GRAFICA LINEAL DETALLE' class='botonnaranja' />
		<input type='hidden' name='grafico2' value=1 />
			</form>	
				</div>					
				<div style='float:left; margin-right:3px;  margin-left:3px;'>
			<form name='grafico2' action='grafico_gf2b.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\">
		<input type='submit' value='GRAFIC BARRAS DETALLE' title='VER GRAFICA BARRAS DETALLE' class='botonnaranja' />
		<input type='hidden' name='grafico2' value=1 />
			</form>	
				</div>					
					</td>
				</tr>");
		}

	} // FIN function gt2()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function gt1(){

	global $db; 		global $db_name;

	global $orden;
	if((isset($_POST['Orden']))&&($_POST['Orden']!= '')){
		$orden = $_POST['Orden'];
	}else{ $orden = '`id` ASC'; }

	require 'Gastos_factdate.php';

	global $vname; 	$vname = "`".$_SESSION['clave']."gastos_pendientes`";
	$sqlb =  "SELECT * FROM $vname WHERE `factdate` LIKE '$fil' ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);
	if(mysqli_num_rows($qb) == 0){}
	global $gt;
	$gt = mysqli_num_rows($qb);
	//print("* ".$gt);
	
	if(($gt>0)&&($_POST['dm'] != '')&&($_POST['dd'] == '')){

		print("	<tr>
		 			<td align='right' class='BorderInf' colspan='2'>
				<div style='float:left; margin-right:3px;  margin-left:3px;'>
			<form name='grafico' action='grafico_g.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\">
	<input type='submit' value='GRAFIC LINEAL TOTAL DIA' title='VER GRAFICA LINEAL TOTAL POR DIA' class='botonnaranja' />
	<input type='hidden' name='grafico' value=1 />
			</form>	
				</div>
				<div style='float:left; margin-right:3px;  margin-left:3px;'>
			<form name='graficob' action='grafico_gb.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\">
	<input type='submit' value='GRAFIC BARRAS TOTAL DIA' title='VER GRAFICA BARRAS TOTAL POR DIA' class='botonnaranja' />
	<input type='hidden' name='graficob' value=1 />
			</form>	
				</div>
				<div style='float:left' margin-right:3px;  margin-left:3px;>
			<form name='grafico2' action='grafico_g2.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\">
	<input type='submit' value='GRAFIC LINEAL DETALLE' title='VER GRAFICA LINEAL DETALLE' class='botonnaranja' />
	<input type='hidden' name='grafico2' value=1 />
			</form>	
				</div>					
			</div>
				<div style='float:left' margin-right:3px;  margin-left:3px;>
			<form name='graficob2' action='grafico_gb2.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\">
	<input type='submit' value='GRAFIC BARRAS DETALLE' title='VER GRAFICA BARRAS DETALLE' class='botonnaranja' />
	<input type='hidden' name='graficob2' value=1 />
			</form>	
				</div>					
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

		global $vname; 		$vname = "`".$_SESSION['clave']."gastos_pendientes`";

		$sqlb =  "SELECT * FROM $vname WHERE `factdate` LIKE '$fil' ORDER BY $orden $limit ";
		$qb = mysqli_query($db, $sqlb);
	
/////////////////////	
/* PARA SUMAR PVPTOT */

	if(!$qb){print(mysqli_error($db).".</br>");
	}
	else{
		$qpvptot = mysqli_query($db, $sqlb);
		$rowpvptot = mysqli_num_rows($qpvptot);
		$sumapvptot = 0;
			for($i=0; $i<$rowpvptot; $i++)
											{
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
				for($i=0; $i<$rowivae; $i++)
						{
					$ver = mysqli_fetch_array($qivae);
					$sumaivae = $sumaivae + $ver['factivae'];
							}
		}
				
	/* FIN PARA SUMAR IVA */
	/////////////////////////

		if(!$qb){
				print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
		} else {
			if(mysqli_num_rows($qb) == 0){

				require 'Gastos_NoData.php';

			} else { print ("<table align='center'>
							<th colspan=16 class='BorderInf'>".mysqli_num_rows($qb)." RESULTADOS</th>
						</tr>
						<tr>
							<th class='BorderInfDch'>ID</th>			
							<th class='BorderInfDch'>NUMERO</th>			
							<th class='BorderInfDch'>Y/M/D</th>				
							<th class='BorderInfDch'>RAZON SOCIAL</th>
							<th class='BorderInfDch'>NIF / CIF</th>
							<th class='BorderInfDch'>IMP %</th>
							<th class='BorderInfDch'>IMP €</th>
							<th class='BorderInfDch'>SUBTOT</th>										
							<th class='BorderInfDch'>RET %</th>
							<th class='BorderInfDch'>RET €</th>
							<th class='BorderInfDch'>TOTAL</th>
							<th colspan=5 class='BorderInf'>
			<a href='Gastos_Pendientes_Crear.php' class='botonverde' style='color:#343434 !important;'>
				CREAR NUEVO GASTO PENDIENTE
			</a>
			<a href='Gastos_Ver.php' class='botonverde' style='color:#343434 !important;'>
				VER GASTOS
			</a>
							</th>
						</tr>");
				
			while($rowb = mysqli_fetch_assoc($qb)){

				global $vname; 		global $dyt1;
				
				require 'Gastos_Pendientes_rowb_Total.php';
						
			} // FIN WHILE

				print("<tr>
							<td colspan='16' class='BorderInf'></td>
						</tr>
						<tr>
							<td class='BorderInf' align='right'></td>
							<td colspan='3' class='BorderInfDch' align='center'>IMPUESTOS REPERC €</td>
							<td colspan='3' class='BorderInfDch' align='center'>RETENCION REPERC €</td>
							<td colspan='4' class='BorderInfDch' align='center'>TOTAL €</td>
							<td colspan='5' align='center'></td>
						</tr>
						<tr>
							<td class='BorderInf' align='right'></td>
							<td colspan='3' class='BorderInfDch' align='right'>".$sumaivae." €</td>
							<td colspan='3' class='BorderInfDch' align='right'>".$sumarete." €</td>
							<td colspan='4' class='BorderInfDch' align='right'>".$sumapvptot." €</td>
							<td colspan='5' class='BorderInf' align='right'></td>
						</tr>
					</table>");
				} /* Fin segundo else anidado en if */
			} /* Fin de primer else . */
			
		global $fil;												
		$sqlg =  "SELECT * FROM $vname WHERE `factdate` LIKE '$fil' ORDER BY $orden ";
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

		$sqlgd =  "SELECT * FROM $vname WHERE `factdate` LIKE '$fil' ORDER BY $orden ";
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