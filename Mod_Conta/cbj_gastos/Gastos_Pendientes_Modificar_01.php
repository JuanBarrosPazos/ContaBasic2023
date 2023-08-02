<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

					master_index();

								if($_POST['todo']){
										show_form();							
										ver_todo();
										info();
										}
								
								elseif($_POST['show_formcl']){
									
										if($form_errors = validate_form()){
											show_form($form_errors);

												} else {
													process_form();
													info();
													}
									}
									
								else {
										show_form();
										}
								
				} else { require '../Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	$errors = array();
	
	if ( (strlen(trim($_POST['factnum'])) == '') && (strlen(trim($_POST['factnif'])) == '')  && (strlen(trim($_POST['factnom'])) == '')){
		$errors [] = " UNO DE LOS TRES CAMPOS ES OBLIGATORIO";
		}
	
	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	show_form();
	global $dyt1;
	
	if ($_POST['dy'] == ''){ $dy1 = '';
							 $dyt1 = date('Y');	} else {	$dy1 = $_POST['dy'];
															$dyt1 = "20".$_POST['dy'];
																	}
	if ($_POST['dm'] == ''){ $dm1 = '';} else {	$dm1 = "/".$_POST['dm']."/";
																	}
	if ($_POST['dd'] == ''){ $dd1 = '';} else {	$dd1 = $_POST['dd'];
																	}
	global $fil;
	$fil = $dy1."%".$dm1."%".$dd1."%";
	if (($_POST['dm'] == '')&&($_POST['dd'] != '')){$dm1 = '';
													$dd1 = $_POST['dd'];
													global $fil;
													$fil = "%".$dy1."/%".$dm1."%/".$dd1."%";
																					}
	$orden = $_POST['Orden'];
	
	global $fnum;
	global $fnif;
	global $fnom;

	// RAZON SOCIAL
	if ($_POST['factnom'] == ''){$fnom = 'ññ';}
	else{$fnom = $_POST['factnom'];}
	global $factnom;
	$factnom = $_POST['factnom'];
	
	// NIF
	if ($_POST['factnif'] == ''){$fnif = 'ññ';}
	else{$fnif = $_POST['factnif'];}
	global $factnif;
	$factnif = $_POST['factnif'];
	
	// FACTURA Nº
	if ($_POST['factnum'] == ''){$fnum = 'ññ';}
	else{$fnum = $_POST['factnum'];}
	global $factnum; 	$factnum = $_POST['factnum'];
	
	global $vname; 		$vname = "`".$_SESSION['clave']."gastos_pendientes`";

	$sqlc =  "SELECT * FROM $vname WHERE `factnum` = '$fnum' AND `factdate` LIKE '$fil' OR `factnif` = '$fnif' AND  `factdate` LIKE '$fil' OR `refprovee` = '$fnom' AND  `factdate` LIKE '$fil' ORDER BY $orden ";
 	
	$qc = mysqli_query($db, $sqlc);
	
/////////////////////	
/* PARA SUMAR PVPTOT */

if(!$qc){print(mysqli_error($db).".</br>");
}
else{
	$qpvptot = mysqli_query($db, $sqlc);
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

if(!$qc){print(mysqli_error($db).".</br>");
}
else{
	$qrete = mysqli_query($db, $sqlc);
	$rowrete = mysqli_num_rows($qrete);
	$sumarete = 0;
		  for($i=0; $i<$rowrete; $i++)
										{
											$verret = mysqli_fetch_array($qrete);

	$sumarete = $sumarete + $verret['factrete'];
											}
}
			
/* FIN PARA SUMAR RETENCIONES */
/////////////////////////

/////////////////////	
/* PARA SUMAR IVA */

if(!$qc){print(mysqli_error($db).".</br>");
}
else{
	$qivae = mysqli_query($db, $sqlc);
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

	if(!$qc){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."</br>");
		} else {
			
			if(mysqli_num_rows($qc) == 0){
							print ("<table align='center' style=\"border:0px\">
										<tr>
											<td align='center'>
												<font color='#FF0000'>
														NINGÚN DATO SE CIÑE A ESTOS CRITERIOS.
													</br>
														INTENTELO CON OTROS PARÁMETROS.
												</font>
											</td>
										</tr>
									</table>");

				} else { 	
							
							print ("<table align='center'>
									<tr>
										<th colspan=13 class='BorderInf'>
									".mysqli_num_rows($qc)." RESULTADOS.
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
												ID
										</th>																			
										
										<th class='BorderInfDch'>
												NUMERO
										</th>																			
										
										<th class='BorderInfDch'>
												Y/M/D
										</th>																			
										
										<th class='BorderInfDch'>
												RAZON SOCIAL
										</th>
										
										<th class='BorderInfDch'>
												NIF / CIF
										</th>
										
										<th class='BorderInfDch'>
												IMP %
										</th>																			
										
										<th class='BorderInfDch'>
												IMP €
										</th>																			
										
										<th class='BorderInfDch'>
												SUBTOT
										</th>										

										<th class='BorderInfDch'>
												RET %
										</th>																			
										
										<th class='BorderInfDch'>
												RET €
										</th>																			
										
										<th class='BorderInfDch'>
												TOTAL
										</th>
										
										<th class='BorderInfDch'>
												DESCRIPCION
										</th>
										
										<th class='BorderInf' width='180px'>
												REFRESCAR CONSULTA DESPUES DE MODIFICAR...
										</th>
										
									</tr>");
			
			while($rowc = mysqli_fetch_assoc($qc)){
 			
	global $vname;
	global $dyt1;
	
			print (	"<tr align='center'>
									
	<form name='modifica' action='Gastos_Pendientes_Modificar_02.php' method='POST'>
	
	<input name='dyt1' type='hidden' value='".$dyt1."' />
	<input name='vname' type='hidden' value='".$vname."' />
	<input name='refprovee' type='hidden' value='".$rowc['refprovee']."' />
	
						<td class='BorderInfDch' align='center'>
	<input name='id' type='hidden' value='".$rowc['id']."' />".$rowc['id']."
						</td>

						<td class='BorderInfDch' align='center'>
	<input name='factnum' type='hidden' value='".$rowc['factnum']."' />".$rowc['factnum']."
						</td>
	
						<td class='BorderInfDch' align='left'>
	<input name='factdate' type='hidden' value='".$rowc['factdate']."' />".$rowc['factdate']."
						</td>
						
						<td class='BorderInfDch' align='center'>
	<input name='factnom' type='hidden' value='".$rowc['factnom']."' />".$rowc['factnom']."
						</td>
						
						<td class='BorderInfDch' align='left'>
	<input name='factnif' type='hidden' value='".$rowc['factnif']."' />".$rowc['factnif']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='factiva' type='hidden' value='".$rowc['factiva']."' />".$rowc['factiva']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='factivae' type='hidden' value='".$rowc['factivae']."' />".$rowc['factivae']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='factpvp' type='hidden' value='".$rowc['factpvp']."' />".$rowc['factpvp']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='factret' type='hidden' value='".$rowc['factret']."' />".$rowc['factret']." %
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='factrete' type='hidden' value='".$rowc['factrete']."' />".$rowc['factrete']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='factpvptot' type='hidden' value='".$rowc['factpvptot']."' />".$rowc['factpvptot']."
						</td>

						<td class='BorderInfDch' align='left' width='180px'>
	<input name='coment' type='hidden' value='".$rowc['coment']."' />".$rowc['coment']."
						</td>
																			
					<input name='myimg1' type='hidden' value='".$rowc['myimg1']."' />
					<input name='myimg2' type='hidden' value='".$rowc['myimg2']."' />
					<input name='myimg3' type='hidden' value='".$rowc['myimg3']."' />
					<input name='myimg4' type='hidden' value='".$rowc['myimg4']."' />
					
				<td class='BorderInf' align='right'>
				<div align='center' style='float:left'>			
										<input type='submit' value='DATOS' />
										<input type='hidden' name='oculto2' value=1 />
		</form>
				</div>
						

					<div align='center' style='float:left'>			
<form name='modifica' action='Gastos_Pendientes_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=520px,height=682px')\">

					<input name='id' type='hidden' value='".$rowc['id']."' />
					<input name='dyt1' type='hidden' value='".$dyt1."' />
					<input name='refprovee' type='hidden' value='".$rowc['refprovee']."' />
					<input name='coment' type='hidden' value='".$rowc['coment']."' />
					<input name='factpvptot' type='hidden' value='".$rowc['factpvptot']."' />
					<input name='factpvp' type='hidden' value='".$rowc['factpvp']."' />
					<input name='factivae' type='hidden' value='".$rowc['factivae']."' />
					<input name='factiva' type='hidden' value='".$rowc['factiva']."' />
					<input name='factrete' type='hidden' value='".$rowc['factrete']."' />
					<input name='factret' type='hidden' value='".$rowc['factret']."' />
					<input name='factnif' type='hidden' value='".$rowc['factnif']."' />
					<input name='factnom' type='hidden' value='".$rowc['factnom']."' />
					<input name='factdate' type='hidden' value='".$rowc['factdate']."' />
					<input name='factnum' type='hidden' value='".$rowc['factnum']."' />
					<input name='myimg1' type='hidden' value='".$rowc['myimg1']."' />
					<input name='myimg2' type='hidden' value='".$rowc['myimg2']."' />
					<input name='myimg3' type='hidden' value='".$rowc['myimg3']."' />
					<input name='myimg4' type='hidden' value='".$rowc['myimg4']."' />
						
								<input type='submit' value='DOCS' />
								<input type='hidden' name='oculto2' value=1 />
		</form>						
					</div>

					<div align='center' style='float:left'>			
<form name='modifica' action='Gastos_Pendientes_Modificar_03.php' method='POST' >

					<input name='id' type='hidden' value='".$rowc['id']."' />
					<input name='dyt1' type='hidden' value='".$dyt1."' />
					<input name='refprovee' type='hidden' value='".$rowc['refprovee']."' />
					<input name='coment' type='hidden' value='".$rowc['coment']."' />
					<input name='factpvptot' type='hidden' value='".$rowc['factpvptot']."' />
					<input name='factpvp' type='hidden' value='".$rowc['factpvp']."' />
					<input name='factivae' type='hidden' value='".$rowc['factivae']."' />
					<input name='factiva' type='hidden' value='".$rowc['factiva']."' />
					<input name='factrete' type='hidden' value='".$rowc['factrete']."' />
					<input name='factret' type='hidden' value='".$rowc['factret']."' />
					<input name='factnif' type='hidden' value='".$rowc['factnif']."' />
					<input name='factnom' type='hidden' value='".$rowc['factnom']."' />
					<input name='factdate' type='hidden' value='".$rowc['factdate']."' />
					<input name='factnum' type='hidden' value='".$rowc['factnum']."' />
					<input name='myimg1' type='hidden' value='".$rowc['myimg1']."' />
					<input name='myimg2' type='hidden' value='".$rowc['myimg2']."' />
					<input name='myimg3' type='hidden' value='".$rowc['myimg3']."' />
					<input name='myimg4' type='hidden' value='".$rowc['myimg4']."' />
						
								<input type='submit' value='COBRADA' />
								<input type='hidden' name='oculto2' value=1 />
		</form>		
					</div>				
					</td>
					</tr>");
								}  

									print("		<tr>
										<td colspan='13' class='BorderInf'>
										</td>
									</tr>
						
									<tr>
										<td class='BorderInfDch' align='center'>
										</td>
										
										<td colspan='3' class='BorderInfDch' align='center'>
												IMPUESTOS REPERC €
										</td>
										
										<td colspan='3' class='BorderInfDch' align='center'>
												RETENCION REPERC €
										</td>
										
										<td colspan='4' class='BorderInfDch' align='center'>
												TOTAL €
										</td>
								
										<td colspan='2' class='BorderInf' align='right'>
										</td>

									</tr>

									<tr>
										
										<td class='BorderInfDch' align='center'>
										</td>

										<td colspan='3' class='BorderInfDch' align='right'>
												".$sumaivae." €
										</td>
										
										<td colspan='3' class='BorderInfDch' align='right'>
												".$sumarete." €
										</td>
										
										<td colspan='4' class='BorderInfDch' align='right'>
												".$sumapvptot." €
										</td>
										
										<td colspan='2' class='BorderInf' align='right'>
										</td>
																				
								</tr>
						</table>
								");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	unset ($_SESSION['myimg1b']);
	unset ($_SESSION['myimg2b']);
	unset ($_SESSION['myimg3b']);
	unset ($_SESSION['myimg4b']);
	unset ($_SESSION['fnnew']);
	unset ($_SESSION['idx']);
	unset ($_SESSION['yold']);
	unset ($_SESSION['mold']);
	unset ($_SESSION['dold']);
	unset ($_SESSION['ynew']);
	unset ($_SESSION['mnew']);
	unset ($_SESSION['dnew']);
	unset ($_SESSION['fnold']);
	unset ($_SESSION['vname']);
	unset ($_SESSION['$nombre1n']);
	unset ($_SESSION['$nombre2n']);
	unset ($_SESSION['$nombre3n']);
	unset ($_SESSION['$nombre4n']);

	if($_POST['show_formcl']){
		$defaults = $_POST;
		}
	elseif($_POST['todo']){
		$defaults = $_POST;
		} else {
				$defaults = array ('factnom' => '',
								   'factnif' => '',
								   'factnum' => '',
								   'Orden' => isset($ordenar),
								   						);
														}

	$dm = array (	'' => 'MES TODOS',
					'01' => 'ENERO',
					'02' => 'FEBRERO',
					'03' => 'MARZO',
					'04' => 'ABRIL',
					'05' => 'MAYO',
					'06' => 'JUNIO',
					'07' => 'JULIO',
					'08' => 'AGOSTO',
					'09' => 'SEPTIEMBRE',
					'10' => 'OCTUBRE',
					'11' => 'NOVIEMBRE',
					'12' => 'DICIEMBRE',
									);
	
	$dd = array (	'' => 'DÍA',
					'01' => '01',
					'02' => '02',
					'03' => '03',
					'04' => '04',
					'05' => '05',
					'06' => '06',
					'07' => '07',
					'08' => '08',
					'09' => '09',
					'10' => '10',
					'11' => '11',
					'12' => '12',
					'13' => '13',
					'14' => '14',
					'15' => '15',
					'16' => '16',
					'17' => '17',
					'18' => '18',
					'19' => '19',
					'20' => '20',
					'21' => '21',
					'22' => '22',
					'23' => '23',
					'24' => '24',
					'25' => '25',
					'26' => '26',
					'27' => '27',
					'28' => '28',
					'29' => '29',
					'30' => '30',
					'31' => '31',
									);
										
	if ($errors){
		print("	<div width='90%' style='float:left'>
					<table align='left' style='border:none'>
					<th style='text-align:left'>
					<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					</th>
					<tr>
					<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>
				</div>
				<div style='clear:both'></div>");
		}
	
	$ordenar = array (	
						'`factnum` ASC' => 'Nº Factura Asc',
						'`factnum` DESC' => 'Nº Factura Desc',
						'`factnif` ASC' => 'NIF Asc',
						'`factnif` DESC' => 'NIF Desc',
						'`factnom` ASC' => 'Razon Social Asc',
						'`factnom` DESC' => 'Razon Social Desc',
																);
	
	print("<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=2 class='BorderInf'>
						MODIFICAR GASTOS PENDIENTES
					</th>
				</tr>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td align='right' class='BorderSup'>
						<input type='submit' value='FILTRO GASTOS' />
						<input type='hidden' name='show_formcl' value=1 />
					</td>
					
					<td class='BorderSup'>

					<div style='float:left'>

						<select name='Orden'>");
						
				foreach($ordenar as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['Orden']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
						
	print ("	</select>
						</div>

					<div style='float:left'>
				");
								
		require '../Inclu/year_in_select_bbdd.php';
									
	print ("	</select>
					</div>

					<div style='float:left'>

						<select name='dm'>");

				foreach($dm as $optiondm => $labeldm){
					
					print ("<option value='".$optiondm."' ");
					
					if($optiondm == $defaults['dm']){
															print ("selected = 'selected'");
																								}
													print ("> $labeldm </option>");
												}	
																
	print ("	</select>
					</div>

					<div style='float:left'>

						<select name='dd'>");

				foreach($dd as $optiondd => $labeldd){
					
					print ("<option value='".$optiondd."' ");
					
					if($optiondd == $defaults['dd']){
															print ("selected = 'selected'");
																								}
													print ("> $labeldd </option>");
												}	
																
	print ("	</select>
					</div>

					</td>
				</tr>
					
				<tr>					
					<td colspan='2' class='BorderInf'>	
	<div style='float:left; margin-right:12px'>
	Nº FACTURA: &nbsp;
	<input type='text' name='factnum' size=22 maxlength=20 value='".$defaults['factnum']."' />
	</div>
	<div style='float:left; margin-right:12px'>
			NIF: &nbsp;
	<!--
	<input type='text' name='factnif' size=22 maxlength=10 value='".$defaults['factnif']."' />
	-->
	<select name='factnif'>
	<option value=''>Nº NIF</option>");
	global $db;
	global $tabla1; 		$tabla1 = "`".$_SESSION['clave']."clientes`";

	$sqlb =  "SELECT * FROM $tabla1 ORDER BY `rsocial` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."<br/>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['dni'].$rows['ldni']."' ");
					
					if($rows['dni'].$rows['ldni'] == $defaults['factnif']){
													print ("selected = 'selected'");
																								}
										print ("> ".$rows['dni'].$rows['ldni']." </option>");
		}

	}  

	print ("	</select>
	</div>
	<div style='float:left; margin-right:12px'>
			RAZON SOCIAL: &nbsp;
	<!--
	<input type='text' name='factnom' size=22 maxlength=22 value='".$defaults['factnom']."' />
	-->
	<select name='factnom'>
	<option value=''>RAZON SOCIAL</option>");
	global $db;
	global $tabla1; 		$tabla1 = "`".$_SESSION['clave']."clientes`";
	$sqlb =  "SELECT * FROM $tabla1 ORDER BY `rsocial` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."<br/>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					print ("<option value='".$rows['ref']."' ");
					if($rows['ref'] == $defaults['factnom']){
													print ("selected = 'selected'");
																						}
													print ("> ".$rows['rsocial']." </option>");
		}
	}  
	print ("	</select>
	</div>
					</td>
				</tr>
			</form>	
				
			<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
		
				<tr>
					<td align='center' class='BorderSup'>
						<input type='submit' value='TODOS LOS GASTOS' />
						<input type='hidden' name='todo' value=1 />
					</td>
					<td class='BorderSup'>	

					<div style='float:left'>

						<select name='Orden'>");
						
				foreach($ordenar as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['Orden']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
						
	print ("	</select>
	
						</div>

					<div style='float:left'>
				");
								
		require '../Inclu/year_in_select_bbdd.php';
									
	print ("	</select>
					</div>

					<div style='float:left'>

						<select name='dm'>");

				foreach($dm as $optiondm => $labeldm){
					
					print ("<option value='".$optiondm."' ");
					
					if($optiondm == $defaults['dm']){
															print ("selected = 'selected'");
																								}
													print ("> $labeldm </option>");
												}	
																
	print ("	</select>
					</div>

					<div style='float:left'>

						<select name='dd'>");

				foreach($dd as $optiondd => $labeldd){
					
					print ("<option value='".$optiondd."' ");
					
					if($optiondd == $defaults['dd']){
															print ("selected = 'selected'");
																								}
													print ("> $labeldd </option>");
												}	
																
	print ("	</select>
					</div>

					</td>
				</tr>
		
		</form>														
			
			</table>
							
				"); /* Fin del print */
	
	}	/* Fin show_form(); */

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	global $db_name;

	$orden = $_POST['Orden'];

	global $dyt1;
	
	if ($_POST['dy'] == ''){ $dy1 = '';
							 $dyt1 = date('Y');	} else {	$dy1 = $_POST['dy'];
															$dyt1 = "20".$_POST['dy'];
																	}
	if ($_POST['dm'] == ''){ $dm1 = '';} else {	$dm1 = "/".$_POST['dm']."/";
																	}
	if ($_POST['dd'] == ''){ $dd1 = '';} else {	$dd1 = $_POST['dd'];
																	}
	global $fil;
	$fil = $dy1."%".$dm1."%".$dd1."%";
	if (($_POST['dm'] == '')&&($_POST['dd'] != '')){$dm1 = '';
													$dd1 = $_POST['dd'];
													global $fil;
													$fil = "%".$dy1."/%".$dm1."%/".$dd1."%";
																					}
	global $vname; 		$vname = "`".$_SESSION['clave']."gastos_pendientes`";

	$sqlb =  "SELECT * FROM $vname WHERE `factdate` LIKE '$fil' ORDER BY $orden ";
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
}
else{
	$qrete = mysqli_query($db, $sqlb);
	$rowrete = mysqli_num_rows($qrete);
	$sumarete = 0;
		  for($i=0; $i<$rowrete; $i++)
										{
											$verret = mysqli_fetch_array($qrete);

	$sumarete = $sumarete + $verret['factrete'];
											}
}
			
/* FIN PARA SUMAR RETENCIONES */
/////////////////////////

/////////////////////	
/* PARA SUMAR IVA */

if(!$qb){print(mysqli_error($db).".</br>");
}
else{
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
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>");

				} else { 	print ("<table align='center'>
										<th colspan=13 class='BorderInf'>
									".mysqli_num_rows($qb)." RESULTADOS.
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
												ID
										</th>																			
										
										<th class='BorderInfDch'>
												NUMERO
										</th>																			
										
										<th class='BorderInfDch'>
												Y/M/D
										</th>																			
										
										<th class='BorderInfDch'>
												RAZON SOCIAL
										</th>
										
										<th class='BorderInfDch'>
												NIF / CIF
										</th>
										
										<th class='BorderInfDch'>
												IMP %
										</th>																			
										
										<th class='BorderInfDch'>
												IMP €
										</th>																			
										
										<th class='BorderInfDch'>
												SUBTOT
										</th>										

										<th class='BorderInfDch'>
												RET %
										</th>																			
										
										<th class='BorderInfDch'>
												RET €
										</th>																			
										
										<th class='BorderInfDch'>
												TOTAL
										</th>
										
										<th class='BorderInfDch'>
												DESCRIPCION
										</th>
										
										<th class='BorderInf' width='180px'>
											REFRESCAR CONSULTA DESPUES DE MODIFICAR...
										</th>
										
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){

	global $vname;
	global $dyt1;
	
			print (	"<tr align='center'>
									
	<form name='modifica' action='Gastos_Pendientes_Modificar_02.php' method='POST'>

	<input name='dyt1' type='hidden' value='".$dyt1."' />
	<input name='refprovee' type='hidden' value='".$rowb['refprovee']."' />

						<td class='BorderInfDch' align='center'>
	<input name='id' type='hidden' value='".$rowb['id']."' />".$rowb['id']."
						</td>

						<td class='BorderInfDch' align='center'>
	<input name='factnum' type='hidden' value='".$rowb['factnum']."' />".$rowb['factnum']."
						</td>
	
						<td class='BorderInfDch' align='left'>
	<input name='factdate' type='hidden' value='".$rowb['factdate']."' />".$rowb['factdate']."
						</td>
						
						<td class='BorderInfDch' align='center'>
	<input name='factnom' type='hidden' value='".$rowb['factnom']."' />".$rowb['factnom']."
						</td>
						
						<td class='BorderInfDch' align='left'>
	<input name='factnif' type='hidden' value='".$rowb['factnif']."' />".$rowb['factnif']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='factiva' type='hidden' value='".$rowb['factiva']."' />".$rowb['factiva']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='factivae' type='hidden' value='".$rowb['factivae']."' />".$rowb['factivae']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='factpvp' type='hidden' value='".$rowb['factpvp']."' />".$rowb['factpvp']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='factret' type='hidden' value='".$rowb['factret']."' />".$rowb['factret']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='factrete' type='hidden' value='".$rowb['factrete']."' />".$rowb['factrete']."
						</td>

						<td class='BorderInfDch' align='right'>
	<input name='factpvptot' type='hidden' value='".$rowb['factpvptot']."' />".$rowb['factpvptot']."
						</td>

						<td class='BorderInfDch' align='left' width='180px'>
	<input name='coment' type='hidden' value='".$rowb['coment']."' />".$rowb['coment']."
						</td>
										
					<input name='myimg1' type='hidden' value='".$rowb['myimg1']."' />
					<input name='myimg2' type='hidden' value='".$rowb['myimg2']."' />
					<input name='myimg3' type='hidden' value='".$rowb['myimg3']."' />
					<input name='myimg4' type='hidden' value='".$rowb['myimg4']."' />
					
						<td class='BorderInf' align='right'>
						
						<div align='center' style='float:left'>
								<input type='submit' value='DATOS' />
								<input type='hidden' name='oculto2' value=1 />
						</div>
																			
		</form>
						<div align='center' style='float:left'>			
<form name='modifica' action='Gastos_Pendientes_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=520px,height=682px')\">

					<input name='id' type='hidden' value='".$rowb['id']."' />
					<input name='dyt1' type='hidden' value='".$dyt1."' />
					<input name='refprovee' type='hidden' value='".$rowb['refprovee']."' />
					<input name='coment' type='hidden' value='".$rowb['coment']."' />
					<input name='factpvptot' type='hidden' value='".$rowb['factpvptot']."' />
					<input name='factpvp' type='hidden' value='".$rowb['factpvp']."' />
					<input name='factivae' type='hidden' value='".$rowb['factivae']."' />
					<input name='factiva' type='hidden' value='".$rowb['factiva']."' />
					<input name='factrete' type='hidden' value='".$rowb['factrete']."' />
					<input name='factret' type='hidden' value='".$rowb['factret']."' />
					<input name='factnif' type='hidden' value='".$rowb['factnif']."' />
					<input name='factnom' type='hidden' value='".$rowb['factnom']."' />
					<input name='factdate' type='hidden' value='".$rowb['factdate']."' />
					<input name='factnum' type='hidden' value='".$rowb['factnum']."' />
					<input name='myimg1' type='hidden' value='".$rowb['myimg1']."' />
					<input name='myimg2' type='hidden' value='".$rowb['myimg2']."' />
					<input name='myimg3' type='hidden' value='".$rowb['myimg3']."' />
					<input name='myimg4' type='hidden' value='".$rowb['myimg4']."' />
						
								<input type='submit' value='DOCS' />
								<input type='hidden' name='oculto2' value=1 />
		</form>						
					</div>
					<div align='center' style='float:left'>			
<form name='modifica' action='Gastos_Pendientes_Modificar_03.php' method='POST' >

					<input name='id' type='hidden' value='".$rowb['id']."' />
					<input name='dyt1' type='hidden' value='".$dyt1."' />
					<input name='refprovee' type='hidden' value='".$rowb['refprovee']."' />
					<input name='coment' type='hidden' value='".$rowb['coment']."' />
					<input name='factpvptot' type='hidden' value='".$rowb['factpvptot']."' />
					<input name='factpvp' type='hidden' value='".$rowb['factpvp']."' />
					<input name='factivae' type='hidden' value='".$rowb['factivae']."' />
					<input name='factiva' type='hidden' value='".$rowb['factiva']."' />
					<input name='factrete' type='hidden' value='".$rowb['factrete']."' />
					<input name='factret' type='hidden' value='".$rowb['factret']."' />
					<input name='factnif' type='hidden' value='".$rowb['factnif']."' />
					<input name='factnom' type='hidden' value='".$rowb['factnom']."' />
					<input name='factdate' type='hidden' value='".$rowb['factdate']."' />
					<input name='factnum' type='hidden' value='".$rowb['factnum']."' />
					<input name='myimg1' type='hidden' value='".$rowb['myimg1']."' />
					<input name='myimg2' type='hidden' value='".$rowb['myimg2']."' />
					<input name='myimg3' type='hidden' value='".$rowb['myimg3']."' />
					<input name='myimg4' type='hidden' value='".$rowb['myimg4']."' />
						
								<input type='submit' value='PAGADA' />
								<input type='hidden' name='oculto2' value=1 />
		</form>		
					</div>				
					</td>
				</tr>");
					
								} /* Fin del while.*/ 

									print("		<tr>
										<td colspan='13' class='BorderInf'>
										</td>
									</tr>
						
									<tr>
									
										<td class='BorderInfDch' align='right'>
										</td>
									
										<td colspan='3' class='BorderInfDch' align='center'>
												IMPUESTOS REPERC €
										</td>
										
										<td colspan='3' class='BorderInfDch' align='center'>
												RETENCION REPERC €
										</td>
										
										<td colspan='4' class='BorderInfDch' align='center'>
												TOTAL €
										</td>

										<td colspan='2' class='BorderInf' align='center'>
										</td>
										
									</tr>

									<tr>
										
										<td class='BorderInfDch' align='right'>
										</td>

										<td colspan='3' class='BorderInfDch' align='right'>
												".$sumaivae." €
										</td>
										
										<td colspan='3' class='BorderInfDch' align='right'>
												".$sumarete." €
										</td>
										
										<td colspan='4' class='BorderInfDch' align='right'>
												".$sumapvptot." €
										</td>
										
										<td colspan='2' class='BorderInf' align='right'>
										</td>
																				
								</tr>
						</table>
								");
			
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final ver_todo(); */

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaGastos;	$rutaGastos = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function info(){

	global $dd;
	if($_POST['dd'] == ''){$dd = "DIA TODOS";}else{$dd = $_POST['dd'];}
	global $dm;
	if($_POST['dm'] == ''){$dm = "MES TODOS";}else{$dm = $_POST['dm'];}
	global $dy;
	if($_POST['dy'] == ''){ $dy = date('Y');} else{$dy = "20".$_POST['dy'];}
	
	global $db;
	global $orden;
	
	$orden = $_POST['Orden'];
	
	if ($_POST['todo']){$filtro = "\n\tFiltro => TODOS LOS GASTOS. ".$orden."\n\tDATE: ".$dy."/".$dm."/".$dd.".";}
	else{$filtro = "\n\tFiltro => \n\tDATE: ".$dy."/".$dm."/".$dd.".\n\tR. Social: ".$_POST['factnom'].".\n\tDNI: ".$_POST['factnif'].".\n\tNº FACTURA: ".$_POST['factnum'].".";}

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	global $text;
	$text = "\n- GASTOS PENDIENTES MODIFICAR CONSULTAR ".$ActionTime.$filtro;
	
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