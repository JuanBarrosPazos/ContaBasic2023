<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';
	require '../../Mod_Admin/Conections/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';
		
	require '../Inclu/sqld_query_fetch_assoc.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

				
					master_index();

						if($_POST['oculto2']){	info_01();
												show_form();}
						elseif($_POST['oculto']){
							
								// SI NO HA COBRADO LA FACTURA.
								if(strlen($_POST['xl']) == 0){
									print("* HA DE MARCAR LA CASILLA DE CONFIRMACIÓN.");
									show_form();
									}
								elseif(strlen($_POST['xl']) != 0){
									//print("* SI SELECCIONADO");
									process_form_2();
									difer1();
									}
									
							} else {show_form();}
							
				}else { require '../Inclu/table_permisos.php';} 

//////////////////////////////////////////////////////////////////////////////////////////////

	function difer1(){

	global $db;
	global $db_name;
	
	$_SESSION['diferyear'] = $_POST['dy'];
	
	global $dyx;
	$dyx = "20".$_POST['dy'];
	global $dmx;
	$dmx = "M".$_POST['dm'];
/*
	if(($dmx != 10)||($dmx != 11)||($dmx != 12)){
	$dmx = substr($_POST['dm'],-1);
		}
*/
	global $sesionref;

	global $vnamebali; 		$vnamebali = "`".$_SESSION['clave']."balancei`";
	global $vnamebalg; 		$vnamebalg = "`".$_SESSION['clave']."balanceg`";
	global $vnamebald; 		$vnamebald = "`".$_SESSION['clave']."balanced`";
	
	////////////////	DIFERENCIAL MES		////////////////

	$sqlbalg =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
	$qbalg = mysqli_query($db, $sqlbalg);
	$countbalg = mysqli_num_rows($qbalg);
	$rowbalg = mysqli_fetch_assoc($qbalg);
	
	$sqlbali =  "SELECT * FROM `$db_name`.$vnamebali WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
	$qbali = mysqli_query($db, $sqlbali);
	$countbali = mysqli_num_rows($qbali);
	$rowbali = mysqli_fetch_assoc($qbali);
	
	$sumamesiva = $rowbali['iva'] - $rowbalg['iva'];
	$sumamespvp = $rowbali['sub'] - $rowbalg['sub'];
	$sumamesret = $rowbali['ret'] - $rowbalg['ret'];
	$sumamestot = $rowbali['tot'] - $rowbalg['tot'];

	//	print("* ".$dyt1." ".$dm1.".<br/>");
	//	print("* ".$sumamesiva." ".$sumamespvp." ".$sumamestot.".<br/>");

	$sqlbg = "UPDATE `$db_name`.$vnamebald  SET `iva` = '$sumamesiva', `sub` = '$sumamespvp',`ret` = '$sumamesret', `tot` =  '$sumamestot' WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
		
		if(mysqli_query($db, $sqlbg)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 108: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}

	////////////////	DIFERENCIAL ANUAL		////////////////

	$sqlbalg2 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
	$qbalg2 = mysqli_query($db, $sqlbalg2);
	$countbalg2 = mysqli_num_rows($qbalg2);
	$rowbalg2 = mysqli_fetch_assoc($qbalg2);

	$sqlbali2 =  "SELECT * FROM `$db_name`.$vnamebali WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
	$qbali2 = mysqli_query($db, $sqlbali2);
	$countbali2 = mysqli_num_rows($qbali2);
	$rowbali2 = mysqli_fetch_assoc($qbali2);
	
	$sumayeariva2 = $rowbali2['iva'] - $rowbalg2['iva'];	
	$sumayearpvp2 = $rowbali2['sub'] - $rowbalg2['sub'];	
	$sumayearret2 = $rowbali2['ret'] - $rowbalg2['ret'];	
	$sumayeartot2 = $rowbali2['tot'] - $rowbalg2['tot'];	

	//	print("* ".$sumayeariva." ".$sumayearpvp." ".$sumayeartot.".<br/>");

	$sqlbg2 = "UPDATE `$db_name`.$vnamebald  SET `iva` = '$sumayeariva2', `sub` = '$sumayearpvp2',`ret` = '$sumayearret2', `tot` =  '$sumayeartot2' WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
		
		if(mysqli_query($db, $sqlbg2)){ // print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 135: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}

	////////////////	DIFERENCIAL TRIMESTRAL		////////////////

	global $mes;
	if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
	elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
	elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
	elseif(($dmx == "M10")||($dmx == "M11")||($dmx == "M12")){$mes = "TRI4";}
	
	$sqlbalg3 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$mes' ";
	$qbalg3 = mysqli_query($db, $sqlbalg3);
	$countbalg3 = mysqli_num_rows($qbalg3);
	$rowbalg3 = mysqli_fetch_assoc($qbalg3);

	$sqlbali3 =  "SELECT * FROM `$db_name`.$vnamebali WHERE `year` = '$dyx' AND `mes` = '$mes' ";
	$qbali3 = mysqli_query($db, $sqlbali3);
	$countbali3 = mysqli_num_rows($qbali3);
	$rowbali3 = mysqli_fetch_assoc($qbali3);
	
	$sumatriiva3 = $rowbali3['iva'] - $rowbalg3['iva'];
	$sumatripvp3 = $rowbali3['sub'] - $rowbalg3['sub'];
	$sumatriret3 = $rowbali3['ret'] - $rowbalg3['ret'];
	$sumatritot3 = $rowbali3['tot'] - $rowbalg3['tot'];

	//	print("* ".$sumatriiva." ".$sumatripvp." ".$sumatritot.".<br/>");

	$sqlbg3 = "UPDATE `$db_name`.$vnamebald  SET `iva` = '$sumatriiva3', `sub` = '$sumatripvp3',`ret` = '$sumatriret3', `tot` =  '$sumatritot3' WHERE `year` = '$dyx' AND `mes` = '$mes' ";
		
		if(mysqli_query($db, $sqlbg3)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 168: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
			
		}
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form_2(){
	
	global $db;
	global $db_name;
	
	global $vname;
	global $dyt1;
	global $dynew;
	
	if ($_POST['dy'] == ''){ $dy1 = '';
							 $dynew = date('y');
							 $dyt1 = date('Y');} else { $dy1 = $_POST['dy'];
														$dynew = $_POST['dy'];
														$dyt1 = "20".$_POST['dy'];
																		}
	if ($_POST['dm'] == ''){ $dm1 = '';} else { $dm1 = $_POST['dm'];
												$dm1 = "/".$dm1."/";}
	if ($_POST['dd'] == ''){ $dd1 = '';} else { $dd1 = $_POST['dd'];
												$dd1 = $dd1;}

	global $factdate;
	$factdate = $_POST['dy']."/".$_POST['dm']."/".$_POST['dd'];

	$factivae1 = $_POST['factivae1'];
	$factivae2 = $_POST['factivae2'];
	global $factivae;
	$factivae = $factivae1.".".$factivae2;
			
	$factrete1 = $_POST['factrete1'];
	$factrete2 = $_POST['factrete2'];
	global $factrete;
	$factrete = $factrete1.".".$factrete2;

	$factpvp1 = $_POST['factpvp1'];
	$factpvp2 = $_POST['factpvp2'];
	global $factpvp;
	$factpvp = $factpvp1.".".$factpvp2;
	
	$factpvptot1 = $_POST['factpvptot1'];
	$factpvptot2 = $_POST['factpvptot2'];
	global $factpvptot;
	$factpvptot = $factpvptot1.".".$factpvptot2;
	
	$tabla = "<table align='center' style='margin-top:10px' width='700px'>
				<tr>
					<th colspan=4 class='BorderInf'>
						SE HA MODIFICADO EN ".strtoupper($vname)."
					</th>
				</tr>
												
				<tr>
					<td>
						NUMERO
					</td>
					<td>"
						.$_POST['factnum'].
					"</td>
					<td>	
						FECHA
					</td>
					<td>20"
						/*.$iniy*/.$factdate.
					"</td>
				</tr>
				
				<tr>
					<td>
						RAZON SOCIAL
					</td>
					<td>"
						.$_POST['factnom'].
					"</td>
					<td>
						NIF / CIF
					</td>
					<td>"
						.$_POST['factnif'].
					"</td>
				</tr>
								
				<tr>
					<td>
						IMP %
					</td>
					<td>"
						.$_POST['factiva'].
					"</td>
					<td>
						IMP €
					</td>
					<td>"
						.$factivae.
					"</td>
				</tr>
								
				<tr>
					<td>
						RETENCIONES %
					</td>
					<td>"
						.$_POST['factret'].
					"</td>
					<td>
						RETENCIONES €
					</td>
					<td width=250px>"
						.$factrete.
					"</td>
				</tr>
								
				<tr>
					<td>
						SUBTOTAL
					</td>
					<td>"
						.$factpvp.
					"</td>
					<td>
						TOTAL
					</td>
					<td>"
						.$factpvptot.
					"</td>
				</tr>
								
				<tr>
					<td>
						DESCRIPCION
					</td>
					<td colspan='3'>"
						.$_POST['coment'].
					"</td>
				</tr>

			</table>";	

	global $rutaold;
	global $rutanew;
	$rutaold = "../cbj_Docs/docgastos_pendientes/";
	$rutanew = "../cbj_Docs/docgastos_20".$dynew."/";
		
		if(file_exists($rutaold.$_SESSION['myimg1b']) ){
					copy($rutaold.$_SESSION['myimg1b'], $rutanew.$_SESSION['myimg1b']);
					unlink($rutaold.$_SESSION['myimg1b']);
			/*		print(" <br/>* CHANGE YEAR FACT: 20".$_SESSION['yold']." X 20".$dynew."
							<br/>- Ok Copy & Unlink Img Name 1.");
			*/
										}else{print("<br/>- No Ok Copy & Unlink Img Name 1.");}
										
		if(file_exists($rutaold.$_SESSION['myimg2b']) ){
								copy($rutaold.$_SESSION['myimg2b'], $rutanew.$_SESSION['myimg2b']);
								unlink($rutaold.$_SESSION['myimg2b']);
						/*		print("<br/>- Ok Copy & Unlink Img Name 2.");	*/
										}else{print("<br/>- No Ok Copy & Unlink Img Name 2.");}
										
		if(file_exists($rutaold.$_SESSION['myimg3b']) ){
								copy($rutaold.$_SESSION['myimg3b'], $rutanew.$_SESSION['myimg3b']);
								unlink($rutaold.$_SESSION['myimg3b']);
						/*		print("<br/>- Ok Copy & Unlink Img Name 3.");	*/
										}else{print("<br/>- No Ok Copy & Unlink Img Name 3.");}
										
		if(file_exists($rutaold.$_SESSION['myimg4b']) ){
								copy($rutaold.$_SESSION['myimg4b'], $rutanew.$_SESSION['myimg4b']);
								unlink($rutaold.$_SESSION['myimg4b']);
						/*		print("<br/>- Ok Copy & Unlink Img Name 4.");	*/
										}else{print("<br/>- No Ok Copy & Unlink Img Name 4.");}
										
	$idx = $_SESSION['idx'];

	global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$dyt1."`";
	$_SESSION['vname'] = $vname;
	
	global $sent;								
	$sent = "INSERT INTO `$db_name`.$vname (`factnum`, `factdate`, `refprovee`, `factnom`, `factnif`, `factiva`, `factivae`, `factpvp`, `factret`, `factrete`, `factpvptot`,`coment`, `myimg1`, `myimg2`, `myimg3`, `myimg4`) VALUES ('$_POST[factnum]', '$factdate', '$_POST[proveedores]', '$_POST[factnom]', '$_POST[factnif]', '$_POST[factiva]', '$factivae', '$factpvp', '$_POST[factret]', '$factrete', '$factpvptot', '$_POST[coment]', '$_SESSION[myimg1b]', '$_SESSION[myimg2b]', '$_SESSION[myimg3b]', '$_SESSION[myimg4b]')";
		
		if(mysqli_query($db, $sent)){ //	print("<br/>* OK DELETE DATA."); 
										print($tabla); 
					} else {print("* MODIFIQUE LA ENTRADA 335: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
									}
	$idx = $_SESSION['idx'];
	global $vnamed; 		$vnamed = "`".$_SESSION['clave']."gastos_pendientes`";
	$sqla = "DELETE FROM `$db_name`.$vnamed  WHERE $vnamed.`id` = '$idx'  ";
		if(mysqli_query($db, $sqla)){ //	print("<br/>* OK DELETE DATA."); 
					} else {print("* MODIFIQUE LA ENTRADA 349: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
									}

	//////////////
				//////////////
	//////////////
	
	global $dyx; 		$dyx = "20".$_POST['dy'];
	global $dmx; 		$dmx = "M".$_POST['dm'];

	global $vnamebalg; 		$vnamebalg = "`".$_SESSION['clave']."balancei`";
	$sqlbalg =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
	$qbalg = mysqli_query($db, $sqlbalg);
	$countbalg = mysqli_num_rows($qbalg);
	$rowbalg = mysqli_fetch_assoc($qbalg);
	
	$sumamesiva = $rowbalg['iva'] + $factivae;	
	$sumamespvp = $rowbalg['sub'] + $factpvp;	
	$sumamesret = $rowbalg['ret'] + $factrete;	
	$sumamestot = $rowbalg['tot'] + $factpvptot;	

	//print("* ".$dyt1." ".$dm1.".</br>");
	//print("* ".$sumamesiva." ".$sumamespvp." ".$sumamestot.".</br>");

	$sqlbg = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumamesiva', `sub` = '$sumamespvp', `ret` = '$sumamesret', `tot` =  '$sumamestot' WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
		
		if(mysqli_query($db, $sqlbg)){ //print("**"); 
					} else {print("* MODIFIQUE LA ENTRADA 382: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
									}

		/////////////
	
	$sqlbalg2 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
	$qbalg2 = mysqli_query($db, $sqlbalg2);
	$countbalg2 = mysqli_num_rows($qbalg2);
	$rowbalg2 = mysqli_fetch_assoc($qbalg2);

	$sumayeariva = $rowbalg2['iva'] + $factivae;	
	$sumayearpvp = $rowbalg2['sub'] + $factpvp;	
	$sumayearret = $rowbalg2['ret'] + $factrete;	
	$sumayeartot = $rowbalg2['tot'] + $factpvptot;	

	//print("* ".$sumayeariva." ".$sumayearpvp." ".$sumayeartot.".</br>");

	$sqlbg2 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumayeariva', `sub` = '$sumayearpvp', `ret` = '$sumayearret', `tot` =  '$sumayeartot' WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
		
		if(mysqli_query($db, $sqlbg2)){ //print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 403: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}

		/////////////

	global $mes;
	if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
	elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
	elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
	elseif(($dmx == "10")||($dmx == "11")||($dmx == "12")){$mes = "TRI4";}
	
	$sqlbalg3 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$mes' ";
	$qbalg3 = mysqli_query($db, $sqlbalg3);
	$countbalg3 = mysqli_num_rows($qbalg3);
	$rowbalg3 = mysqli_fetch_assoc($qbalg3);

	$sumatriiva = $rowbalg3['iva'] + $factivae;	
	$sumatripvp = $rowbalg3['sub'] + $factpvp;	
	$sumatriret = $rowbalg3['ret'] + $factrete;	
	$sumatritot = $rowbalg3['tot'] + $factpvptot;	

	//print("* ".$sumatriiva." ".$sumatripvp." ".$sumatritot.".</br>");

	$sqlbg3 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumatriiva', `sub` = '$sumatripvp', `ret` = '$sumatriret', `tot` =  '$sumatritot' WHERE `year` = '$dyx' AND `mes` = '$mes' ";
		
		if(mysqli_query($db, $sqlbg3)){ //print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 431: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
							
	} 

///////////////////////////////////////////////////////////////

function show_form($errors=[]){
	global $db; 	global $db_name;
	
	global $sesionref; 		$sesionref = "`".$_SESSION['clave']."clientes`";
	
	$sqlx =  "SELECT * FROM $sesionref WHERE `ref` = '$_POST[proveedores]'";
	$qx = mysqli_query($db, $sqlx);
	$rowprovee = mysqli_fetch_assoc($qx);
	$_rsocial = $rowprovee['rsocial'];
	$_ref = $rowprovee['ref'];
	$_dni = $rowprovee['dni'];
	$_ldni = $rowprovee['ldni'];
	global $_dnil;
	$_dnil = $_dni.$_ldni;
	
	$_SESSION['idx'] = $_POST['id'];

	if($_POST['oculto2']){
		
		$datex = $_POST['factdate'];
		$dyx = substr($_POST['factdate'],0,2);
		$dmx = substr($_POST['factdate'],3,2);
		$ddx = substr($_POST['factdate'],-2,2);

		$_SESSION['yold'] = $dyx;
		$_SESSION['mold'] = $dmx;
		$_SESSION['dold'] = $ddx;
	
		$_SESSION['myimg1b'] = $_POST['myimg1'];
		$_SESSION['myimg2b'] = $_POST['myimg2'];
		$_SESSION['myimg3b'] = $_POST['myimg3'];
		$_SESSION['myimg4b'] = $_POST['myimg4'];

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
		$_rsocial = $rowpv['rsocial'];
		$_ref = $rowpv['ref'];
		$_dni = $rowpv['dni'];
		$_ldni = $rowpv['ldni'];
		global $_dnil;
		$_dnil = $_dni.$_ldni;
		
		$_POST['proveedores'] = $_POST['refprovee'];
		
				$defaults = array ( 'id' => $_POST['id'],
									'proveedores' => $_POST['refprovee'],
								   	'refprovee' => $_POST['refprovee'],
								   	'xl' => $_POST['xl'],
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
																	);
								   											}
	elseif($_POST['oculto']){
		$defaults = $_POST;
		} elseif($_POST['oculto1']) {
				$defaults = array (	'id' => $_SESSION['idx'],
									'proveedores' => $_POST['proveedores'],
								   	'refprovee' => $_POST['refprovee'],
									'xl' => $_POST['xl'],
									'dy' => $_POST['dy'],
									'dm' => $_POST['dm'],
									'dd' => $_POST['dd'],
									'factnum' => strtoupper($_POST['factnum']),
								//	'factdate' => $_POST['factdate'],
								   	'refprovee' => $rowprovee['ref'],
								   	'factnom' => $rowprovee['rsocial'],
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
									'coment' => $_POST['coment'],	
																	);
							   											}

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

	$dm = array (	'' => 'MONTH',
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
	
	$dd = array (	'' => 'DAY',
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
										

				
////////////////////

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

								MARCAR COMO COBRADO GASTO PENDIENTE					
 
					</th>
				</tr>
				<tr>
					<td>
						<div style='float:left'>
								REF. CLIENTE
						</div>
					</td>
					
					<td>
						<div style='float:left'>
								".$defaults['proveedores']."
						</div>
				</td>
			</tr>
				"); 
			
	if ($_POST['proveedores'] != '') {

	print("
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>

<input type='hidden' name='proveedores' value='".$defaults['proveedores']."' />
<input type='hidden' name='refprovee' value='".$defaults['refprovee']."' />
<input type='hidden' name='id' value='".$defaults['id']."' />


				<tr>
					<td colspan='2'>
						SI SE HA COBRADO LA FACTURA MARQUE LA CASILLA: &nbsp; 
		<input type='checkbox' name='xl' value='yes' ");
		if($defaults['xl'] == 'yes') {print(" checked=\"checked\"");}
		print(" />

					</td>
				</tr>
									
				<tr>
					<td>
						NUMERO
					</td>
					<td>

<input type='hidden' name='factnum' value='".$defaults['factnum']."' />".strtoupper($defaults['factnum'])."

					</td>
				</tr>
									
				<tr>
					<td>						
						FECHA
					</td>
					<td>
					
				<div style='float:left'>
<input type='hidden' name='dy' value='".$defaults['dy']."' />20".$defaults['dy']."
					</div>
					
					<div style='float:left'>
<input type='hidden' name='dm' value='".$defaults['dm']."' />/".$defaults['dm']."
					</div>

					<div style='float:left'>
<input type='hidden' name='dd' value='".$defaults['dd']."' />/".$defaults['dd']."
					</div>

					</td>
				</tr>
									
				<tr>
					<td>						
						RAZON SOCIAL
					</td>
					<td>
<input type='hidden' name='factnom' value='".$defaults['factnom']."' />".$defaults['factnom']."
					</td>
				</tr>
					
					</td>
				</tr>

				<tr>
					<td>						
						NIF/CIF
					</td>
					<td>
<input type='hidden' name='factnif'value='".$defaults['factnif']."' />".$defaults['factnif']."
					</td>
				</tr>
					
				<tr>
					<td>						
						IMPUESTOS %
					</td>
					<td>
					
			<div style='float:left'>
<input type='hidden' name='factiva' value='".$defaults['factiva']."' />".$defaults['factiva']." %
			</div>
					</td>
				</tr>

				<tr>
					<td>						
						IMPUESTOS €
					</td>
					<td>
<input type='hidden' name='factivae1' value='".$defaults['factivae1']."' />".$defaults['factivae1']."
,
<input type='hidden' name='factivae2' value='".$defaults['factivae2']."' />".$defaults['factivae2']."
€
					</td>
				</tr>
					
				<tr>
					<td>						
						RETENCIONES %
					</td>
					<td>
					
			<div style='float:left'>
<input type='hidden' name='factret' value='".$defaults['factret']."' />".$defaults['factret']." %
			</div>
					</td>
				</tr>

				<tr>
					<td>						
						RETENCIONES €
					</td>
					<td>
<input type='hidden' name='factrete1' value='".$defaults['factrete1']."' />".$defaults['factrete1']."
,
<input type='hidden' name='factrete2' value='".$defaults['factrete2']."' />".$defaults['factrete2']."
€
					</td>
				</tr>

				<tr>
					<td>						
						SUBTOTAL €
					</td>
					<td>
<input type='hidden' name='factpvp1' value='".$defaults['factpvp1']."' />".$defaults['factpvp1']."
,
<input type='hidden' name='factpvp2' value='".$defaults['factpvp2']."' />".$defaults['factpvp2']."
€
					</td>
				</tr>
					
				<tr>
					<td>						
						TOTAL €
					</td>
					<td>
<input type='hidden' name='factpvptot1' value='".$defaults['factpvptot1']."' />".$defaults['factpvptot1']."
,
<input type='hidden' name='factpvptot2' value='".$defaults['factpvptot2']."' />".$defaults['factpvptot2']."
€
					</td>
				</tr>

				<tr>
					<td>
						DESCRIPCIÓN
					</td>
					<td>
					
<input type='hidden' name='coment' id='coment' value='".$defaults['coment']."'>".$defaults['coment']."

					</td>
				</tr>

				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='COBRAR GASTO PENDIENTE' />
						<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
				
		</form>														
			
			</table>				
						"); 
			}
		}

/////////////////////////////////////////////////////////////////////////////////////////////////

function info_01(){

	global $db;
	
	$filtro = "\n\tFiltro => \n\tDATE: ".$_POST['factdate'].".\n\tR. Social: ".$_POST['factnom'].".\n\tDNI: ".$_POST['factnif'].".\n\tNº FACTURA: ".$_POST['factnum'].".";

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

/////////////////////////////////////////////////////////////////////////////////////////////////

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

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu_MInd/Master_Index_Gastos.php';
		
				} /* Fin funcion master_index.*/

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';

?>