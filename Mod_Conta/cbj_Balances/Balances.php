<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';
		
$_SESSION['usuarios'] = '';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

	master_index();

	if($_POST['todo']){ show_form();							
						ver_todo();
						info();
						}
	else {show_form();}
								
} else { require '../Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){

	if(isset($_POST['show_formcl'])){
		$defaults = $_POST;
		}
	elseif($_POST['todo']){
		$defaults = $_POST;
		} else {
				$defaults = array ('id' => '',
								   'year' => '',
								   'mes' => '',
								   'tot' => '',
								   'Orden' => isset($ordenar),
								   						);
				}

	$dm = array (	'' => 'MES TODOS',
					'M01' => 'ENERO',
					'M02' => 'FEBRERO',
					'M03' => 'MARZO',
					'M04' => 'ABRIL',
					'M05' => 'MAYO',
					'M06' => 'JUNIO',
					'M07' => 'JULIO',
					'M08' => 'AGOSTO',
					'M09' => 'SEPTIEMBRE',
					'M10' => 'OCTUBRE',
					'M11' => 'NOVIEMBRE',
					'M12' => 'DICIEMBRE',
					'TRI0' => 'TRIMESTRAL',
					'TRI1' => 'TRIMESTRE 1',
					'TRI2' => 'TRIMESTRE 2',
					'TRI3' => 'TRIMESTRE 3',
					'TRI4' => 'TRIMESTRE 4',
					'ANU' => 'ANUAL',
									);
	
	$ordenar = array (	'`id` ASC' => 'id Asc',
						'`id` DESC' => 'id Desc',
						'`year` ASC' => 'YEAR Asc',
						'`year` DESC' => 'YEAR Desc',
						'`mes` ASC' => 'MES Asc',
						'`mes` DESC' => 'MES Desc',
						'`tot` ASC' => 'TOTAL Asc',
						'`tot` DESC' => 'TOTAL Desc',
						);
	
	if ($errors){
		print("<table align='left' style='border:none'>
				<tr>
					<th style='text-align:left'>
						<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					</th>
				</tr>
				<tr>
					<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>");
		}
	
	print("<table align='center' style=\"border:0px; margin-top:-24px\">
				<tr>
					<th colspan=3>
						BALANCE CONTABLE
					</th>
				</tr>
				
				<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
		
				<tr>
					<td align='center' class='BorderSup'>
						<input type='submit' value='FILTRO BALANCES' />
						<input type='hidden' name='todo' value=1 />
					</td>
					
					<td class='BorderSup'>	

					<div style='float:left'>

						<select name='Orden'>");
						
	foreach($ordenar as $option => $label){
			print ("<option value='".$option."' ");
			if($option == $defaults['Orden']){print ("selected = 'selected'");}
											  print ("> $label </option>");
											}	
	print ("</select>
				</div>
					<div style='float:left'>
				");
								
		require '../Inclu/year_select_bbdd.php';
									
	print ("</select>
				</div>
				<div style='float:left'>

				<select name='dm'>");

	foreach($dm as $optiondm => $labeldm){
			print ("<option value='".$optiondm."' ");
			if($optiondm == $defaults['dm']){print ("selected = 'selected'");}
									print ("> $labeldm </option>");
							}	
																
	print ("</select>
				</div>
			</form>											
			</td>
		</tr>");

	////////
				
if($_POST['todo']){
		

	if(($_POST['dy'] == '')||($_POST['dm'] == '')||($_POST['dm'] == "TRI0")){

		print(" <tr>
		 			<td align='right' class='BorderInf' colspan='2'>

<div style='float:left; margin-right:16px;  margin-left:155px;'>
<form name='grafico' action='grafico_01.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\">
	
	<input name='time' type='hidden' value='".@$_SESSION['time']."' />

			<input type='submit' value='GRAFICA LINEAL' />
			<input type='hidden' name='grafico' value=1 />
</form>	
</div>					
<div style='float:left'>
<form name='grafico2' action='grafico_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=1000px,height=600px')\">
	
	<input name='time' type='hidden' value='".@$_SESSION['time']."' />

			<input type='submit' value='GRAFICA BARRAS' />
			<input type='hidden' name='grafico2' value=1 />
</form>	
</div>					
					</td>
				</tr>
			");
		}
	}
					
print("</table>"); /* Fin del print */
	
	}	/* Fin show_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){

	/*
	unset ($_SESSION['data_i']);
	unset ($_SESSION['data_g']);
	unset ($_SESSION['data_d']);
	unset ($_SESSION['coor_x']);
	*/

	if(file_exists('grafico_01.php')){
			//global $filename;
			//$filename = 'grafico_01.php';
			//clearstatcache ($clear_realpath_cache = true, $filename );
			clearstatcache ();
		}
/*
	unset ($_SESSION['G_ANHOS']);
	unset ($_SESSION['G_MESES']);
	unset ($_SESSION['G_M_I']);
	unset ($_SESSION['G_M_G']);
	unset ($_SESSION['G_M_D']);
*/

	global $db;
	global $db_name;
	$orden = $_POST['Orden'];
	global $dyt1;
	
	if (($_POST['dy'] == '') && ($_POST['dm'] == '')){$dy1 = date('Y');
													  $dyt1 = date('Y');
													  $_SESSION['gyear'] = 'XXX';
	}else{
		if ($_POST['dy'] == ''){ $dy1 = '';
								 $dyt1 = '';
								 $_SESSION['gyear'] = 'XXX';
								} else {$dy1 = $_POST['dy'];
										$dyt1 = "20".$_POST['dy'];
										$_SESSION['gyear'] = $_POST['dy'];
											}
		if ($_POST['dm'] == ''){ $dmx = '';} else {	$dmx = "/".$_POST['dm']."/";
														}
	
}
		
	global $vname;
	global $dmx;
	$dmx = $_POST['dm'];
	
	if($_POST['dm'] == "TRI0"){ $dmx = 'TRI';
								global $sent;
								$sent = "LIKE '%".$dmx."%'";
								}
	elseif($_POST['dm'] == "ANU"){	$dmx = 'ANU';
									global $sent;
									$sent = "LIKE '%".$dmx."%'";
									}
	elseif($_POST['dm'] == ''){	$dmx = 'M';
								global $sent;
								$sent = "LIKE '%".$dmx."%'";
								}
	elseif(($_POST['dm'] == '')&&($_POST['dm'] == "TRI0")&&($_POST['dm'] == "ANU")){
							$dmx = 'M';
							global $sent;
							$sent = "LIKE '%".$dmx."%'";
								}
									
	if($_POST['dm'] == ''){	$_SESSION['gtime'] = 'M';}
	elseif($_POST['dm'] == "TRI0"){$_SESSION['gtime'] = 'TRI0';}
	elseif($_POST['dm'] == "TRI1"){$_SESSION['gtime'] = 'TRI1';}
	elseif($_POST['dm'] == "TRI2"){$_SESSION['gtime'] = 'TRI2';}
	elseif($_POST['dm'] == "TRI3"){$_SESSION['gtime'] = 'TRI3';}
	elseif($_POST['dm'] == "TRI4"){$_SESSION['gtime'] = 'TRI4';}
	elseif($_POST['dm'] == "ANU"){$_SESSION['gtime'] = 'ANU';}
	else{$_SESSION['gtime'] = $_POST['dm'];}
	
///////////////////////////////////////

	/////////////
			/////////////
	/////////////

	global $vname;
	global $dmx;
	$dmx = $_POST['dm'];

if($_POST['dm'] == "TRI0"){ $dmx = 'TRI';
							global $sent;
							$sent = "LIKE '%".$dmx."%'";
							}
if($_POST['dm'] == ''){	$dmx = 'M';
						global $sent;
						$sent = "LIKE '%".$dmx."%'";
							}
elseif($_POST['dm'] != "TRI0"){	global $sent;
								$sent = "= '".$dmx."'";
								}

	global $vnamei;
	$vnamei = "`".$_SESSION['clave']."balancei`";

	global $vname2;
	$vname2 = "`".$_SESSION['clave']."status`";

	$sqli = "SELECT * FROM $vnamei INNER JOIN $vname2 ON $vnamei.`year` = $vname2.`year` WHERE $vname2.`hidden` = 'no' AND $vnamei.`year` LIKE '%$dyt1%' AND $vnamei.`mes` $sent ORDER BY $vnamei.$orden ";

	//$sqli =  "SELECT * FROM $vname WHERE `year` LIKE '%$dyt1%' AND `mes` $sent ORDER BY $orden ";
	$qbi = mysqli_query($db, $sqli);
	
/////////////////////	
/* PARA SUMAR PVPTOT */

if(!$qbi){print(mysqli_error($db).".</br>");
}
else{
	$qpvptot = mysqli_query($db, $sqli);
	$rowpvptot = mysqli_num_rows($qpvptot);
	$sumapvptoti = 0;
		  for($i=0; $i<$rowpvptot; $i++)
										{
											$veri = mysqli_fetch_array($qpvptot);

	$sumapvptoti = $sumapvptoti + $veri['tot'];
											}
}
			
/* FIN PARA SUMAR PVPTOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR RETENCION TOT */

if(!$qbi){print(mysqli_error($db).".</br>");
}
else{
	$qrete = mysqli_query($db, $sqli);
	$rowrete = mysqli_num_rows($qrete);
	$sumaretei = 0;
		  for($i=0; $i<$rowrete; $i++)
										{
											$verrt = mysqli_fetch_array($qrete);

	$sumaretei = $sumaretei + $verrt['ret'];
											}
}
			
/* FIN PARA SUMAR RETENCION TOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR IVA */

if(!$qbi){print(mysqli_error($db).".</br>");
}
else{
	$qivae = mysqli_query($db, $sqli);
	$rowivae = mysqli_num_rows($qivae);
	$sumaivaei = 0;
		  for($i=0; $i<$rowivae; $i++)
										{
											$veri = mysqli_fetch_array($qivae);

	$sumaivaei = $sumaivaei + $veri['iva'];
											}
}
			
/* FIN PARA SUMAR IVA */
/////////////////////////

print("<table align='center' width='auto' style=\"border-color:#FFFFFF\"><tr><td>");

		if(!$qbi){
	print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			
			if(mysqli_num_rows($qbi) == 0){
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>");

				} else { 	print ("<div style='float:left;margin-left:0%;margin-right:auto'>

								<table align='center'>
										<th colspan=6 class='BorderInf'>
								BALANCE INGRESOS ".mysqli_num_rows($qbi)."R.
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
												AÑO
										</th>																			
										
										<th class='BorderInfDch'>
												MES
										</th>																			
										
										<th class='BorderInfDch'>
												IVA REPER
										</th>
										
										<th class='BorderInfDch'>
												SUB TOT
										</th>
										
										<th class='BorderInfDch'>
												RET REPER
										</th>																			

										<th class='BorderInf'>
												TOTAL €
										</th>																			
										
									</tr>");
			
			while($rowi = mysqli_fetch_assoc($qbi)){

	global $vname;
	global $dyt1;
	//if($rowi['tot']!= 0.00){
			print (	"<tr align='center'>
									
<form name='ver' action='Gastos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">


	<input name='dyt1' type='hidden' value='".$dyt1."' />
	<input name='vname' type='hidden' value='".$vname."' />
	<input name='id' type='hidden' value='".$rowi['id']."' />

						<td class='BorderInfDch' align='right'>
	<input name='year' type='hidden' value='".$rowi['year']."' />".$rowi['year']."
						</td>
	
						<td class='BorderInfDch' align='right'>
	<input name='mes' type='hidden' value='".$rowi['mes']."' />".$rowi['mes']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='iva' type='hidden' value='".$rowi['iva']."' />".$rowi['iva']." €
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='sub' type='hidden' value='".$rowi['sub']."' />".$rowi['sub']." €
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='tot' type='hidden' value='".$rowi['ret']."' />".$rowi['ret']." €
						</td>
																			
						<td class='BorderInf' align='right'>
	<input name='tot' type='hidden' value='".$rowi['tot']."' />".$rowi['tot']." €
						</td>
																			
		</form>
					</tr>");
					
							//}
					} /* Fin del while.*/ 

									print("		
									<tr>
										<td colspan='6' class='BorderInf'>
										</td>
									</tr>
						
									<tr>
										<td colspan='2' class='BorderInfDch' align='center'>
												IMP REPER
										</td>
										<td colspan='2' class='BorderInfDch' align='center'>
												RETEN REPER
										</td>
										<td colspan='2' class='BorderInf' align='center'>
												TOT INGRESOS
										</td>
									</tr>
										
									<tr>
										<td colspan='2' class='BorderInfDch' align='right'>
												".$sumaivaei." €
										</td>
										
										<td colspan='2' class='BorderInfDch' align='right'>
												".$sumaretei." €
										</td>

										<td colspan='2' class='BorderInf' align='right'>
												".$sumapvptoti." €
										</td>
																				
									</tr>
								
						</table>
								</div>");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	global $vnameg;
	$vnameg = "`".$_SESSION['clave']."balanceg`";

	$sqlb = "SELECT * FROM $vnameg INNER JOIN $vname2 ON $vnameg.`year` = $vname2.`year` WHERE $vname2.`hidden` = 'no' AND $vnameg.`year` LIKE '%$dyt1%' AND $vnameg.`mes` $sent ORDER BY $vnameg.$orden ";

//$sqlb =  "SELECT * FROM $vname WHERE `year` LIKE '%$dyt1%' AND `mes` $sent ORDER BY $orden ";
$qb = mysqli_query($db, $sqlb);

/////////////////////	
/* PARA SUMAR PVPTOT */

if(!$qb){print(mysqli_error($db).".</br>");
}
else{
	$qpvptot = mysqli_query($db, $sqlb);
	$rowpvptot = mysqli_num_rows($qpvptot);
	$sumapvptotg = 0;
		  for($i=0; $i<$rowpvptot; $i++)
										{
											$verg = mysqli_fetch_array($qpvptot);

	$sumapvptotg = $sumapvptotg + $verg['tot'];
											}
}
			
/* FIN PARA SUMAR PVPTOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR RETENCION TOT */

if(!$qb){print(mysqli_error($db).".</br>");
}
else{
	$qreteg = mysqli_query($db, $sqlb);
	$rowreteg = mysqli_num_rows($qreteg);
	$sumareteg = 0;
		  for($i=0; $i<$rowreteg; $i++)
										{
											$verrtg = mysqli_fetch_array($qreteg);

	$sumareteg = $sumareteg + $verrtg['ret'];
											}
}
			
/* FIN PARA SUMAR RETENCION TOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR IVA */

if(!$qb){print(mysqli_error($db).".</br>");
}
else{
	$qivae = mysqli_query($db, $sqlb);
	$rowivae = mysqli_num_rows($qivae);
	$sumaivaeg = 0;
		  for($i=0; $i<$rowivae; $i++)
										{
											$verg = mysqli_fetch_array($qivae);

	$sumaivaeg = $sumaivaeg + $verg['iva'];
											}
}
			
/* FIN PARA SUMAR IVA */
/////////////////////////

	if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			
			if(mysqli_num_rows($qb) == 0){
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>");

				} else { 	print ("<div style='float:left;margin-left:6px;margin-right:auto'>

								<table align='center'>
										<th colspan='6' class='BorderInf'>
								BALANCE GASTOS ".mysqli_num_rows($qb)."R.
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
												AÑO
										</th>																			
										
										<th class='BorderInfDch'>
												MES
										</th>																			
										
										<th class='BorderInfDch'>
												IVA SOPOR
										</th>
										
										<th class='BorderInfDch'>
												SUBTOT
										</th>
										
										<th class='BorderInfDch'>
												RET SOPOR
										</th>																			

										<th class='BorderInf'>
												TOTAL €
										</th>																			
										
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){

	global $vname;
	global $dyt1;
	//if($rowb['tot']!= 0.00){
			print (	"<tr align='center'>
									
<form name='ver' action='Gastos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">


	<input name='dyt1' type='hidden' value='".$dyt1."' />
	<input name='vname' type='hidden' value='".$vname."' />
	<input name='id' type='hidden' value='".$rowb['id']."' />

						<td class='BorderInfDch' align='right'>
	<input name='year' type='hidden' value='".$rowb['year']."' />".$rowb['year']."
						</td>
	
						<td class='BorderInfDch' align='right'>
	<input name='mes' type='hidden' value='".$rowb['mes']."' />".$rowb['mes']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='iva' type='hidden' value='".$rowb['iva']."' />".$rowb['iva']." €
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='sub' type='hidden' value='".$rowb['sub']."' />".$rowb['sub']." €
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='sub' type='hidden' value='".$rowb['ret']."' />".$rowb['ret']." €
						</td>
						
						<td class='BorderInf' align='right'>
	<input name='tot' type='hidden' value='".$rowb['tot']."' />".$rowb['tot']." €
						</td>
																			
		</form>
					</tr>");
					
							//}
					} /* Fin del while.*/ 

									print("		
									<tr>
										<td colspan='6' class='BorderInf'>
										</td>
									</tr>
						
									<tr>
										<td colspan='2' class='BorderInfDch' align='center'>
												IMP SOPOR
										</td>
										<td colspan='2' class='BorderInfDch' align='center'>
												RETEN SOPORT
										</td>
										<td colspan='2' class='BorderInf' align='center'>
												TOTAL GASTOS
										</td>
									</tr>
										
									<tr>
										
										<td colspan='2' class='BorderInfDch' align='right'>
												".$sumaivaeg." €
										</td>

										<td colspan='2' class='BorderInfDch' align='right'>
												".$sumareteg." €
										</td>
										
										<td colspan='2' class='BorderInf' align='right'>
												".$sumapvptotg." €
										</td>
																				
									</tr>
								
						</table>
								</div>");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	/////////////
			/////////////
	/////////////

	global $vnamed;
	$vnamed = "`".$_SESSION['clave']."balanced`";

	$sqld =  "SELECT * FROM $vnamed INNER JOIN $vname2 ON $vnamed.`year` = $vname2.`year` WHERE $vname2.`hidden` = 'no' AND $vnamed.`year` LIKE '%$dyt1%' AND $vnamed.`mes` $sent ORDER BY $vnamed.$orden ";

//$sqld =  "SELECT * FROM $vnamed WHERE `year` LIKE '%$dyt1%' AND `mes` $sent ORDER BY $orden ";
$qbd = mysqli_query($db, $sqld);
	
/////////////////////	
/* PARA SUMAR PVPTOT */

if(!$qbd){print(mysqli_error($db).".</br>");
}
else{
	$qpvptotd = mysqli_query($db, $sqld);
	$rowpvptotd = mysqli_num_rows($qpvptotd);
	$sumapvptotd = 0;
		  for($i=0; $i<$rowpvptotd; $i++)
										{
											$verd = mysqli_fetch_array($qpvptotd);

	$sumapvptotd = $sumapvptotd + $verd['tot'];
											}
}
			
/* FIN PARA SUMAR PVPTOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR RETENCION TOT */

if(!$qbd){print(mysqli_error($db).".</br>");
}
else{
	$qreted = mysqli_query($db, $sqld);
	$rowreted = mysqli_num_rows($qreted);
	$sumareted = 0;
		  for($i=0; $i<$rowreted; $i++)
										{
											$verrtd = mysqli_fetch_array($qreted);

	$sumareted = $sumareted + $verrtd['ret'];
											}
}
			
/* FIN PARA SUMAR RETENCION TOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR IVA */

if(!$qbd){print(mysqli_error($db).".</br>");
}
else{
	$qivaed = mysqli_query($db, $sqld);
	$rowivaed = mysqli_num_rows($qivaed);
	$sumaivaed = 0;
		  for($i=0; $i<$rowivaed; $i++)
										{
											$verd = mysqli_fetch_array($qivaed);

	$sumaivaed = $sumaivaed + $verd['iva'];
											}
}
			
/* FIN PARA SUMAR IVA */
/////////////////////////

		if(!$qbd){
	print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			
			if(mysqli_num_rows($qbd) == 0){
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>");

				} else { 	print ("<div style='float:left;margin-left:6px;margin-right:auto'>

								<table align='center'>
										<th colspan=6 class='BorderInf'>
								BALANCE DIFERENCIAL ".mysqli_num_rows($qbd)."R.
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
												AÑO
										</th>																			
										
										<th class='BorderInfDch'>
												MES
										</th>																			
										
										<th class='BorderInfDch'>
												IVA DIFER
										</th>
										
										<th class='BorderInfDch'>
												SUBTOT
										</th>
										
										<th class='BorderInfDch'>
												RET DIFER
										</th>																			

										<th class='BorderInf'>
												TOTAL €
										</th>																			
										
									</tr>");
			
			while($rowd = mysqli_fetch_assoc($qbd)){

	global $vnamed;
	global $dyt1;
	//if($rowi['tot']!= 0.00){
			print (	"<tr align='center'>
									
<form name='ver' action='Gastos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">


	<input name='dyt1' type='hidden' value='".$dyt1."' />
	<input name='vname' type='hidden' value='".$vnamed."' />
	<input name='id' type='hidden' value='".$rowd['id']."' />
	
						<td class='BorderInfDch' align='right'>
	<input name='year' type='hidden' value='".$rowd['year']."' />".$rowd['year']."
						</td>
	
						<td class='BorderInfDch' align='right'>
	<input name='mes' type='hidden' value='".$rowd['mes']."' />".$rowd['mes']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='iva' type='hidden' value='".$rowd['iva']."' />".$rowd['iva']." €
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='sub' type='hidden' value='".$rowd['sub']."' />".$rowd['sub']." €
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='sub' type='hidden' value='".$rowd['ret']."' />".$rowd['ret']." €
						</td>

						<td class='BorderInf' align='right'>
	<input name='tot' type='hidden' value='".$rowd['tot']."' />".$rowd['tot']." €
						</td>
																			
		</form>
					</tr>");
					
							//}
					} /* Fin del while.*/ 

									print("		
									<tr>
										<td colspan='6' class='BorderInf'>
										</td>
									</tr>
						
									<tr>
										<td colspan='2' class='BorderInfDch' align='center'>
												IMP DIFER
										</td>
										<td colspan='2' class='BorderInfDch' align='center'>
												RETEN DIFER
										</td>
										<td colspan='2' class='BorderInf' align='center'>
												TOT DIFER
										</td>
									</tr>
										
									<tr>
										
										<td colspan='2' class='BorderInfDch' align='right'>
												".$sumaivaed." €
										</td>
										
										<td colspan='2' class='BorderInfDch' align='right'>
												".$sumareted." €
										</td>
										
										<td colspan='2' class='BorderInf' align='right'>
												".$sumapvptotd." €
										</td>
																				
									</tr>
								
						</table>
								</div>");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */

print("</td></tr></table>");

		///////////////////////////////////////
					///////////////////////////////////////
		///////////////////////////////////////

/*
	if ($_POST['dy'] == ''){$_SESSION['gyear'] = 'XXX';}
	else $_SESSION['gyear'] = $_POST['dy'];
		
	if($_POST['dm'] == ''){	$_SESSION['gtime'] = 'M';}
	elseif($_POST['dm'] == "TRI0"){$_SESSION['gtime'] = 'TRI0';}
	elseif($_POST['dm'] == "TRI1"){$_SESSION['gtime'] = 'TRI1';}
	elseif($_POST['dm'] == "TRI2"){$_SESSION['gtime'] = 'TRI2';}
	elseif($_POST['dm'] == "TRI3"){$_SESSION['gtime'] = 'TRI3';}
	elseif($_POST['dm'] == "TRI4"){$_SESSION['gtime'] = 'TRI4';}
	elseif($_POST['dm'] == "ANU"){$_SESSION['gtime'] = 'ANU';}
	else{$_SESSION['gtime'] = $_POST['dm'];}

	global $ruta1;
	$ruta1 = "../cbj_Docs/grafics/";
	global $G_ANHOS;
	$G_ANHOS = $ruta1."G_ANHOS.php";
	global $file_G_ANHOS;
	$file_G_ANHOS = file_get_contents($G_ANHOS);
	$G_ANHOS_a = explode(',',$file_G_ANHOS);
	$count = count($G_ANHOS_a);
	global $rest;
	$rest = $count-1;
	if($rest > 3){}

*/

////////////

	global $nombre; 	$nombre = $_SESSION['gtime'];
	global $ruta; 		$ruta = "../cbj_Docs/grafics/";
	
	global $vnameii;
	$vnameii = "`".$_SESSION['clave']."balancei`";

	$sqli =  "SELECT * FROM $vnameii INNER JOIN $vname2 ON $vnameii.`year` = $vname2.`year` WHERE $vname2.`hidden` = 'no' AND $vnameii.`year` LIKE '%$dyt1%' AND $vnameii.`mes` $sent ORDER BY $vnameii.$orden ";

	//$sqli =  "SELECT * FROM $vnamei WHERE `year` LIKE '%$dyt1%' AND `mes` $sent ORDER BY $orden ";
	$qi = mysqli_query($db, $sqli);
	
	$fh3 = fopen($ruta.'G_'.$nombre.'_I.php','w+');
	$i=0;
	while($registro3 = mysqli_fetch_array($qi))
	{
	$line3 = $registro3['tot'].",";
	fwrite($fh3, $line3);
	$tot3[$i] = $registro3['tot'];
	$i++;
	}
	fclose($fh3);

///////////////////////////////////////

	global $vnamegg;
	$vnamegg = "`".$_SESSION['clave']."balanceg`";

	$sqlg = "SELECT * FROM $vnamegg INNER JOIN $vname2 ON $vnamegg.`year` = $vname2.`year`
			WHERE $vname2.`hidden` = 'no' AND $vnamegg.`year` LIKE '%$dyt1%' AND $vnamegg.`mes` $sent ORDER BY $vnamegg.$orden ";

	//$sqlg =  "SELECT * FROM $vnameg WHERE `year` LIKE '%$dyt1%' AND `mes` $sent ORDER BY $orden ";
	$qg = mysqli_query($db, $sqlg);
	
	$fh = fopen($ruta.'G_'.$nombre.'_G.php','w+');
	$i=0;
	while($registro = mysqli_fetch_array($qg))
	{
	$line = $registro['tot'].",";
	fwrite($fh, $line);
	$tot[$i] = $registro['tot'];
	$i++;
	}
	fclose($fh);

///////////////////////////////////////

	global $vnamedd;
	$vnamedd = "`".$_SESSION['clave']."balanced`";

	$sqld = "SELECT * FROM $vnamedd INNER JOIN $vname2 ON $vnamedd.`year` = $vname2.`year`WHERE $vname2.`hidden` = 'no' AND $vnamedd.`year` LIKE '%$dyt1%' AND $vnamedd.`mes` $sent ORDER BY $vnamedd.$orden ";

	//$sqld =  "SELECT * FROM $vnamed WHERE `year` LIKE '%$dyt1%' AND `mes` $sent ORDER BY $orden ";
	$qd = mysqli_query($db, $sqld);
	
	$fh = fopen($ruta.'G_'.$nombre.'_D.php','w+');
	$i=0;
	while($registro = mysqli_fetch_array($qd))
	{
	$line = $registro['tot'].",";
	fwrite($fh, $line);
	$tot[$i] = $registro['tot'];
	$i++;
	}
	fclose($fh);

///////////////////////////////////////

	$sqlm = "SELECT * FROM $vnamegg INNER JOIN $vname2 ON $vnamegg.`year` = $vname2.`year`WHERE $vname2.`hidden` = 'no' AND $vnamegg.`year` LIKE '%$dyt1%' AND $vnamegg.`mes` $sent ORDER BY $vnamegg.$orden ";

	//$sqlm =  "SELECT * FROM $vnameg WHERE `year` LIKE '%$dyt1%' AND `mes` $sent ORDER BY $orden ";
	$qm = mysqli_query($db, $sqlm);
	
	$fh2 = fopen($ruta.'G_MESES.php','w+');
	$fh2b = fopen($ruta.'G_MESESb.php','w+');
	$i=0;
	while($registro2 = mysqli_fetch_array($qm))
	{
	if($registro2['mes']== 'M01'){$registro2['mes']= '01';}
	if($registro2['mes']== 'M02'){$registro2['mes']= '02';}
	if($registro2['mes']== 'M03'){$registro2['mes']= '03';}
	if($registro2['mes']== 'M04'){$registro2['mes']= '04';}
	if($registro2['mes']== 'M05'){$registro2['mes']= '05';}
	if($registro2['mes']== 'M06'){$registro2['mes']= '06';}
	if($registro2['mes']== 'M07'){$registro2['mes']= '07';}
	if($registro2['mes']== 'M08'){$registro2['mes']= '08';}
	if($registro2['mes']== 'M09'){$registro2['mes']= '09';}
	if($registro2['mes']== 'M10'){$registro2['mes']= '10';}
	if($registro2['mes']== 'M11'){$registro2['mes']= '11';}
	if($registro2['mes']== 'M12'){$registro2['mes']= '12';}
	if($registro2['mes']== 'TRI1'){$registro2['mes']= 'TR1';}
	if($registro2['mes']== 'TRI2'){$registro2['mes']= 'TR2';}
	if($registro2['mes']== 'TRI3'){$registro2['mes']= 'TR3';}
	if($registro2['mes']== 'TRI4'){$registro2['mes']= 'TR4';}
	$line2 = substr($registro2['year'],-2,2)."\n".$registro2['mes'].",";
	$line2b = substr($registro2['year'],-2,2)."/".$registro2['mes'].",";
	fwrite($fh2, $line2);
	fwrite($fh2b, $line2b);
	$tot2[$i] = $registro2['mes'];
	$i++;
	}
	fclose($fh2);
	fclose($fh2b);

/**/
	$sqly = "SELECT * FROM $vnamegg INNER JOIN $vname2 ON $vnamegg.`year` = $vname2.`year` WHERE $vname2.`hidden` = 'no' AND $vnamegg.`mes` = 'ANU' ORDER BY $vnamegg.$orden ";

//	$sqly =  "SELECT * FROM $vnameg WHERE `mes` = 'ANU' ORDER BY $orden ";
	
/*
			global $vname;
			$vname = "`".$_SESSION['clave']."status`";
	$sqly =  "SELECT * FROM `$db_name`.$vname ORDER BY `year` ASC";
*/
	$qy = mysqli_query($db, $sqly);
	
	$fh4 = fopen($ruta.'G_ANHOS.php','w+');
	
	$i=0;
	while($registro4 = mysqli_fetch_array($qy))
	{
	$line4 = $registro4['year'].",";
	fwrite($fh4,$line4);
	$tot4[$i] = $registro4['year'];
	$i++;
	}
	fclose($fh4);
	
	$sqly2 = "SELECT * FROM $vnamegg INNER JOIN $vname2 ON $vnamegg.`year` = $vname2.`year` WHERE $vname2.`hidden` = 'no' AND $vnamegg.`year` LIKE '%$dyt1%' AND $vnamegg.`mes` $sent ORDER BY $vnamegg.$orden ";

	//$sqly2 =  "SELECT * FROM $vnameg WHERE `year` LIKE '%$dyt1%' AND `mes` $sent ORDER BY $orden ";
	$qy2 = mysqli_query($db, $sqly2);
	
	$fhy2 = fopen($ruta.'G_'.$nombre.'_Y.php','w+');
	$i=0;
	while($registroy2 = mysqli_fetch_array($qy2))
	{
	$liney2 = $registroy2['year'].",";
	fwrite($fhy2, $liney2);
	$toty2[$i] = $registroy2['year'];
	$i++;
	}
	fclose($fhy2);
	

	}	/* Final ver_todo(); */

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaBalaces;	$rutaBalaces = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function info(){

	global $dm;
	if($_POST['dm'] == ''){$dm = "MES TODOS";}else{$dm = $_POST['dm'];}
	global $dy;
	if($_POST['dy'] == ''){ $dy = "TODOS LOS AÑOS";} else{$dy = "20".$_POST['dy'];}
	
	global $db;
	global $orden;
	$orden = $_POST['Orden'];
	
	require 'gr_01.php';
	
	global $titulo1;
	global $datai;
	global $datag;
	global $datad;
	global $coordenadax;
	$coordenadax = $_SESSION['coor_xb'];


	$filtro = "\n\tORDEN ".$orden.".\n\tDATE: ".$dy."/".$dm.".";
	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	global $text;
	//$text = "\n- BALACE GENERAL CONSULTA ".$ActionTime.$filtro;
	$text = "\n- BALANCE CONSULTA ".$ActionTime.$filtro."\n\t* ".$titulo1.".\n\tORDENADA X\n\t".implode(", ",$coordenadax)."\n\tDATOS INGRESOS\n\t".implode(", ",$datai)."\n\tDATOS GASTOS\n\t".implode(", ",$datag)."\n\tDATOS DIFERENCIALES\n\t".implode(", ",$datad);

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y-m-d');
	$logtext = $text."\n";
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';
		
?>