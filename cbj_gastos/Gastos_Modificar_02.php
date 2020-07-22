<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';
		
	require '../Inclu/sqld_query_fetch_assoc.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

				
					master_index();

						if($_POST['oculto2']){	info_01();
												show_form();}
						elseif($_POST['oculto']){							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
											info_02();
											difer1();
	if(($_SESSION['yold'] != $_SESSION['ynew'])||($_SESSION['mold'] != $_SESSION['mnew'])){
																	difer2();
																				}
											}
							
							} else {show_form();}
				} else { require '../Inclu/table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;

	$errors = array();
	

		///////////////////////////////////////////////////////////////////////////////////
	
	if(strlen(trim($_POST['factnum'])) == 0){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factnum'])) < 5){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factnum'])){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-zA-Z,0-9_\s]+$/',$_POST['factnum'])){
		$errors [] = "FACTURA NUMERO <font color='#FF0000'>Solo letras o números sin acentos.</font>";
		}

	elseif (!preg_match('/^[A-Z,0-9_\s]+$/',$_POST['factnum'])){
$errors [] = "FACTURA NUMERO <font color='#FF0000'>Solo mayusculas, números sin acentos o _.</font>";
		}

/*
	
	if(strlen(trim($_POST['factdate'])) == 0){
		$errors [] = "FECHA <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factdate'])) < 5){
		$errors [] = "FECHA <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factdate'])){
		$errors [] = "FECHA <font color='#FF0000'>Caracteres no válidos.</font>";
		}
	elseif (!preg_match('/^[a-zA-Z,0-9\s]+$/',$_POST['factdate'])){
		$errors [] = "FECHA <font color='#FF0000'>Solo letras o números sin acentos.</font>";
		}
*/

	 /*VALIDAMOS EL CAMPO factnom */
	
	if(strlen(trim($_POST['factnom'])) == 0){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factnom'])) < 4){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factnom'])){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-zA-Z,0-9_\s]+$/',$_POST['factnom'])){
	$errors [] = "RAZON SOCIAL <font color='#FF0000'>Solo letras, números sin acentos 0 _.</font>";
		}

	 /*VALIDAMOS EL CAMPO factnif */
	
	if(strlen(trim($_POST['factnif'])) == 0){
		$errors [] = "NIF/CIF <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['factnif'])) < 5){
		$errors [] = "NIF/CIF <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factnif'])){
		$errors [] = "NIF/CIF <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[A-Z,0-9\s]+$/',$_POST['factnif'])){
		$errors [] = "NIF/CIF <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}

	/* Validamos el campo iva. */
	
	if($_POST['factiva'] == ''){
		$errors [] = "IMPUESTOS: <font color='#FF0000'>SELECCIONE EL TIPO DE IVA</font>";
		}
					
	/* VALIDAMOS EL CAMPO factivae */
	
		if(strlen(trim($_POST['factivae1'])) == 0){
			$errors [] = "IMPUESTOS € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factivae1'])){
			$errors [] = "IMPUESTOS € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factivae1'])){
			$errors [] = "IMPUESTOS € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factivae2'])) == 0){
			$errors [] = "IMPUESTOS € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factivae2'])){
			$errors [] = "IMPUESTOS € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factivae2'])){
			$errors [] = "IMPUESTOS € <font color='#FF0000'>SOLO NUMEROS</font>";
			}
	/* Validamos el campo factret.*/ 
	
	if($_POST['factret'] == ''){
		$errors [] = "RETENCIONES: <font color='#FF0000'>SELECCIONE EL TIPO DE IVA</font>";
		}
					
	/* VALIDAMOS EL CAMPO factrete */
	
		if(strlen(trim($_POST['factrete1'])) == 0){
			$errors [] = "RETENCIONES € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factrete1'])){
			$errors [] = "RETENCIONES € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factrete1'])){
			$errors [] = "RETENCIONES € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factrete2'])) == 0){
			$errors [] = "RETENCIONES € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factrete2'])){
			$errors [] = "RETENCIONES € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factrete2'])){
			$errors [] = "IMPUESTOS € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	/* VALIDAMOS EL CAMPO factpvp */
	
		if(strlen(trim($_POST['factpvp1'])) == 0){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvp1'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvp1'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factpvp2'])) == 0){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvp2'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvp2'])){
			$errors [] = "SUBTOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	/* VALIDAMOS EL CAMPO factpvptot */
	
		if(strlen(trim($_POST['factpvptot1'])) == 0){
			$errors [] = "TOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvptot1'])){
			$errors [] = "TOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvptot1'])){
			$errors [] = "TOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		if(strlen(trim($_POST['factpvptot2'])) == 0){
			$errors [] = "TOTAL € <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['factpvptot2'])){
			$errors [] = "TOTAL € <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['factpvptot2'])){
			$errors [] = "TOTAL € <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	 /*VALIDAMOS EL CAMPO coment. */
		
	if(strlen(trim($_POST['coment'])) == 0){
		$errors [] = "DESCRIPCION <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['coment'])) < 10){
		$errors [] = "DESCRIPCION <font color='#FF0000'>Más de 10 carácteres.</font>";
		}
		
	elseif (strlen(trim($_POST['coment'])) > 19){

	if (!preg_match('/^[a-z A-Z 0-9 \s ,.;:\'-() áéíóúñ € \/]+$/',$_POST['coment'])){
		$errors [] = "DESCRIPCION  <font color='#FF0000'>A escrito caracteres no permitidos. { } [ ] ¿ ? < > ¡ ! @ # ...</font>";
		}
	}

	 /*VALIDAMOS EL CAMPO dy & dm & dd */
		
	if(trim($_POST['dy']) == ''){
		$errors [] = "YEAR <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	if(trim($_POST['dm']) == ''){
		$errors [] = "MONTH <font color='#FF0000'>Campo obligatorio.</font>";
		}
	
	if(trim($_POST['dd']) == ''){
		$errors [] = "DAY <font color='#FF0000'>Campo obligatorio.</font>";
		}

////////////////

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

	$fiva = $_POST['factiva'];
	
	$civae = $factpvp * ($fiva / 100);
	$civae = number_format($civae,2,".","");
	
	if(trim($factivae) != trim($civae)){
		$errors [] = "IMPUESTOS € <font color='#FF0000'>Cantidad no correcta</font> ".$civae." OK";
	}
	
	$fret = $_POST['factret'];

	$crete = $factpvp * ($fret / 100);
	$crete = number_format($crete,2,".","");
	if(trim($factrete) != trim($crete)){
		$errors [] = "RETENCIONES € <font color='#FF0000'>Cantidad no correcta</font> ".$crete." OK";
	}
	
	$cftot = ($factpvp + $civae) - $factrete;
	$cftot = number_format($cftot,2,".","");
	if(trim($factpvptot) != trim($cftot)){
			$errors [] = "TOTAL € <font color='#FF0000'>Cantidad no correcta</font> ".$cftot." OK";
	}

		$factpvptot = strlen(trim($_POST['factpvptot']));
		$factpvptot = $factpvptot - 3;
		$factpvptotx = $_POST['factpvptot'];
		$factpvptot1 = substr($_POST['factpvptot'],0,$factpvptot);
		$factpvptot2 = substr($_POST['factpvptot'],-2,2);
	
////////////////////
	
	return $errors;

		} 
		
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
	global $vnamebali;
	global $sesionref;
	$vnamebali = "cbj_balancei";
	$vnamebali = "`".$vnamebali."`";
	
	global $vnamebalg;
	$vnamebalg = "cbj_balanceg";
	$vnamebalg = "`".$vnamebalg."`";
	
	global $vnamebald;
	$vnamebald = "cbj_balanced";
	$vnamebald = "`".$vnamebald."`";
	
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

	$sqlbg = "UPDATE `$db_name`.$vnamebald  SET `iva` = '$sumamesiva', `sub` = '$sumamespvp', `ret` = '$sumamesret', `tot` =  '$sumamestot' WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
		
		if(mysqli_query($db, $sqlbg)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 352: ".mysqli_error($db));
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

	$sqlbg2 = "UPDATE `$db_name`.$vnamebald  SET `iva` = '$sumayeariva2', `sub` = '$sumayearpvp2', `ret` = '$sumayearret2', `tot` =  '$sumayeartot2' WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
		
		if(mysqli_query($db, $sqlbg2)){ // print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 379: ".mysqli_error($db));
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

	$sqlbg3 = "UPDATE `$db_name`.$vnamebald  SET `iva` = '$sumatriiva3', `sub` = '$sumatripvp3', `ret` = '$sumatriret3', `tot` =  '$sumatritot3' WHERE `year` = '$dyx' AND `mes` = '$mes' ";
		
		if(mysqli_query($db, $sqlbg3)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 412: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
			
		}
		
//////////////////////////////////////////////////////////////////////////////////////////////

	function difer2(){

	global $db;
	global $db_name;
	
	global $dyx;
	$dyx = "20".$_SESSION['yold'];
	global $dmx;
	$dmx = "M".$_SESSION['mold'];
/*
	if(($dmx != 10)||($dmx != 11)||($dmx != 12)){
	$dmx = substr($_POST['dm'],-1);
		}
*/
	global $vnamebali;
	global $sesionref;
	$vnamebali = "cbj_balancei";
	$vnamebali = "`".$vnamebali."`";
	
	global $vnamebalg;
	$vnamebalg = "cbj_balanceg";
	$vnamebalg = "`".$vnamebalg."`";
	
	global $vnamebald;
	$vnamebald = "cbj_balanced";
	$vnamebald = "`".$vnamebald."`";
	
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

	$sqlbg = "UPDATE `$db_name`.$vnamebald  SET `iva` = '$sumamesiva', `sub` = '$sumamespvp', `ret` = '$sumamesret', `tot` =  '$sumamestot' WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
		
		if(mysqli_query($db, $sqlbg)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 473: ".mysqli_error($db));
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

	$sqlbg2 = "UPDATE `$db_name`.$vnamebald  SET `iva` = '$sumayeariva2', `sub` = '$sumayearpvp2', `ret` = '$sumayearret2', `tot` =  '$sumayeartot2' WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
		
		if(mysqli_query($db, $sqlbg2)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 500: ".mysqli_error($db));
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

	$sqlbg3 = "UPDATE `$db_name`.$vnamebald  SET `iva` = '$sumatriiva3', `sub` = '$sumatripvp3', `ret` = '$sumatriret3', `tot` =  '$sumatritot3' WHERE `year` = '$dyx' AND `mes` = '$mes' ";
		
		if(mysqli_query($db, $sqlbg3)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 533: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
			
		}
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;	
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

	//////////////
		//////////////
	//////////////
	
		global $ivaold;
		$ivaold = $_SESSION['ivae1'].".".$_SESSION['ivae2'];
	
		if($_SESSION['ivae1'] == $factivae1) {
				global $diferiva;
				if($_SESSION['ivae2'] == $factivae2) {}
				elseif($_SESSION['ivae2'] > $factivae2) {
									$diferiva = $ivaold - $factivae;
									$diferiva = "-".$diferiva;
							}
				elseif($_SESSION['ivae2'] < $factivae2) {
									$diferiva = $factivae - $ivaold;
							}
		}
		elseif($_SESSION['ivae1'] > $factivae1) {
									global $diferiva;
									$diferiva = $ivaold - $factivae;
									$diferiva = "-".$diferiva;
		}
		elseif($_SESSION['ivae1'] < $factivae1) {
									global $diferiva;
									$diferiva = $factivae - $ivaold;
			}

		//	printf('%.2f', $diferiva);
		//	print("<br/>* Difer iva tot: ".$diferiva."<br/>");
		
	//////////////
	
		global $retold;
		$retold = $_SESSION['rete1'].".".$_SESSION['rete2'];
	
		if($_SESSION['rete1'] == $factrete1) {
				global $diferret;
				if($_SESSION['rete2'] == $factrete2) {}
				elseif($_SESSION['rete2'] > $factrete2) {
									$diferret = $retold - $factrete;
									$diferret = "-".$diferret;
							}
				elseif($_SESSION['rete2'] < $factrete2) {
									$diferret = $factrete - $retold;
							}
		}
		elseif($_SESSION['rete1'] > $factrete1) {
									global $diferret;
									$diferret = $retold - $factrete;
									$diferret = "-".$diferret;
		}
		elseif($_SESSION['rete1'] < $factrete1) {
									global $diferret;
									$diferret = $factrete - $retold;
			}

		//	printf('%.2f', $diferret);
		//	print("<br/>* Difer ret tot: ".$diferret."<br/>");
		
	//////////////

		global $pvpold;
		$pvpold = $_SESSION['factpvp1'].".".$_SESSION['factpvp2'];
		
		if($_SESSION['factpvp1'] == $factpvp1) {
				global $diferpvp;
				if($_SESSION['factpvp2'] == $factpvp2) {}
				elseif($_SESSION['factpvp2'] > $factpvp2) {
									$diferpvp = $pvpold - $factpvp;
									$diferpvp = "-".$diferpvp;
							}
				elseif($_SESSION['factpvp2'] < $factpvp2) {
									$diferpvp = $factpvp - $pvpold;
							}
		}
		elseif($_SESSION['factpvp1'] > $factpvp1) {
									global $diferpvp;
									$diferpvp = $pvpold - $factpvp;
									$diferpvp = "-".$diferpvp;
		}
		elseif($_SESSION['factpvp1'] < $factpvp1) {
									global $diferpvp;
									$diferpvp = $factpvp - $pvpold;
			}
		//	printf('%.2f', $diferpvp);
		//	print("<br/>* Difer pvp : ".$diferpvp."<br/>");
		
	//////////////
			
		global $pvptold;
		$pvptold = $_SESSION['factpvptot1'].".".$_SESSION['factpvptot2'];

		if($_SESSION['factpvptot1'] == $factpvptot1) {
				global $diferpvptot;
				if($_SESSION['factpvptot2'] == $factpvptot2) {}
				elseif($_SESSION['factpvptot2'] > $factpvptot2) {
									$diferpvptot = $pvptold - $factpvptot;
									$diferpvptot = "-".$diferpvptot;
							}
				elseif($_SESSION['factpvptot2'] < $factpvptot2) {
									$diferpvptot = $factpvptot - $pvptold;
							}
		}
		elseif($_SESSION['factpvp1'] > $factpvptot1) {
									global $diferpvptot;
									$diferpvptot = $pvptold - $factpvptot;
									$diferpvptot = "-".$diferpvptot;
		}
		elseif($_SESSION['factpvp1'] < $factpvptot1) {
									global $diferpvptot;
									$diferpvptot = $factpvptot - $pvptold;
			}
			
		//	printf('%.2f', $diferpvptot);
		//	print("<br/>* Difer pvp tot: ".$diferpvptot."<br/>");
		
	//////////////
		//////////////
	//////////////

	$_SESSION['ynew'] = $dynew;
	$_SESSION['mnew'] = $_POST['dm'];
	
if(($_SESSION['yold'] == $dynew) && ($_SESSION['mold'] == $_POST['dm'])){
	
	global $dyx;
	$dyx = "20".$_POST['dy'];
	global $dmx;
	$dmx = "M".$_POST['dm'];
				
	global $vnamebalg;
	$vnamebalg = "cbj_balancei";
	$vnamebalg = "`".$vnamebalg."`";
					
	//////////////
	
	$sqlbalg =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
	$qbalg = mysqli_query($db, $sqlbalg);
	$countbalg = mysqli_num_rows($qbalg);
	$rowbalg = mysqli_fetch_assoc($qbalg);
	
	$sumamesiva = $rowbalg['iva'] + $diferiva;	
	$sumamespvp = $rowbalg['sub'] + $diferpvp;	
	$sumamesret = $rowbalg['ret'] + $diferret;	
	$sumamestot = $rowbalg['tot'] + $diferpvptot;	

	//print("* ".$dyt1." ".$dm1.".<br/>");
	//print("* ".$sumamesiva." ".$sumamespvp." ".$sumamestot.".<br/>");

	$sqlbg = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumamesiva', `sub` = '$sumamespvp', `ret` = '$sumamesret', `tot` =  '$sumamestot' WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
		
		if(mysqli_query($db, $sqlbg)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 704: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
							
	//////////////
	
	$sqlbalg2 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
	$qbalg2 = mysqli_query($db, $sqlbalg2);
	$countbalg2 = mysqli_num_rows($qbalg2);
	$rowbalg2 = mysqli_fetch_assoc($qbalg2);

	$sumayeariva = $rowbalg2['iva'] + $diferiva;	
	$sumayearpvp = $rowbalg2['sub'] + $diferpvp;	
	$sumayearret = $rowbalg2['ret'] + $diferret;	
	$sumayeartot = $rowbalg2['tot'] + $diferpvptot;	

	//	print("* ".$sumayeariva." ".$sumayearpvp." ".$sumayeartot.".<br/>");

	$sqlbg2 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumayeariva', `sub` = '$sumayearpvp', `ret` = '$sumayearret', `tot` =  '$sumayeartot' WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
		
		if(mysqli_query($db, $sqlbg2)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 726: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}

	//////////////
	
	global $mes;
	if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
	elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
	elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
	elseif(($dmx == "M10")||($dmx == "M11")||($dmx == "M12")){$mes = "TRI4";}
	
	$sqlbalg3 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$mes' ";
	$qbalg3 = mysqli_query($db, $sqlbalg3);
	$countbalg3 = mysqli_num_rows($qbalg3);
	$rowbalg3 = mysqli_fetch_assoc($qbalg3);

	$sumatriiva = $rowbalg3['iva'] + $diferiva;	
	$sumatripvp = $rowbalg3['sub'] + $diferpvp;	
	$sumatriret = $rowbalg3['ret'] + $diferret;	
	$sumatritot = $rowbalg3['tot'] + $diferpvptot;	

	//	print("* ".$sumatriiva." ".$sumatripvp." ".$sumatritot.".<br/>");

	$sqlbg3 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumatriiva', `sub` = '$sumatripvp', `ret` = '$sumatriret', `tot` =  '$sumatritot' WHERE `year` = '$dyx' AND `mes` = '$mes' ";
		
		if(mysqli_query($db, $sqlbg3)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 754: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
}
	 
	//////////////
		
elseif(($_SESSION['yold'] == $dynew)&&($_SESSION['mold'] != $_POST['dm'])){
		
	global $factpvp;
	global $factivae;
	global $factrete;
	global $factpvptot;

		global $ivaold;
		$ivaold = $_SESSION['ivae1'].".".$_SESSION['ivae2'];
		global $retold;
		$retold = $_SESSION['rete1'].".".$_SESSION['rete2'];
		global $pvpold;
		$pvpold = $_SESSION['factpvp1'].".".$_SESSION['factpvp2'];
		global $pvptold;
		$pvptold = $_SESSION['factpvptot1'].".".$_SESSION['factpvptot2'];

	global $dyx;
	$dyx = "20".$_POST['dy'];
	global $dmx;
	$dmx = "M".$_POST['dm'];

	global $vnamebalg;
	$vnamebalg = "cbj_balancei";
	$vnamebalg = "`".$vnamebalg."`";
	
	//////////////
	
	$sqlbalg =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
	$qbalg = mysqli_query($db, $sqlbalg);
	$countbalg = mysqli_num_rows($qbalg);
	$rowbalg = mysqli_fetch_assoc($qbalg);
	
	$sumamesiva = $rowbalg['iva'] + $factivae;	
	$sumamespvp = $rowbalg['sub'] + $factpvp;	
	$sumamesret = $rowbalg['ret'] + $factrete;	
	$sumamestot = $rowbalg['tot'] + $factpvptot;	

	//	print("* ".$dyt1." ".$dm1.".<br/>");
	//	print("* ".$sumamesiva." ".$sumamespvp." ".$sumamestot.".<br/>");

	$sqlbg = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumamesiva', `sub` = '$sumamespvp', `ret` = '$sumamesret', `tot` =  '$sumamestot' WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
		
		if(mysqli_query($db, $sqlbg)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 804: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}

	//////////////

	$dmxd = "M".$_SESSION['mold'];
	$sqlbalg =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$dmxd' ";
	$qbalg = mysqli_query($db, $sqlbalg);
	$countbalg = mysqli_num_rows($qbalg);
	$rowbalg = mysqli_fetch_assoc($qbalg);
	
	$sumamesiva = $rowbalg['iva'] - $ivaold;	
	$sumamespvp = $rowbalg['sub'] - $pvpold;	
	$sumamesret = $rowbalg['ret'] - $retold;	
	$sumamestot = $rowbalg['tot'] - $pvptold;	

	//	print("* ".$dyt1." ".$dm1.".<br/>");
	//	print("* ".$sumamesiva." ".$sumamespvp." ".$sumamestot.".<br/>");

	$sqlbg = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumamesiva', `sub` = '$sumamespvp', `ret` = '$sumamesret', `tot` =  '$sumamestot' WHERE `year` = '$dyx' AND `mes` = '$dmxd' ";
		
		if(mysqli_query($db, $sqlbg)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 828: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
					
	//////////////
					
	$sqlbalg2 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
	$qbalg2 = mysqli_query($db, $sqlbalg2);
	$countbalg2 = mysqli_num_rows($qbalg2);
	$rowbalg2 = mysqli_fetch_assoc($qbalg2);

	$sumayeariva = $rowbalg2['iva'] + $diferiva;	
	$sumayearpvp = $rowbalg2['sub'] + $diferpvp;	
	$sumayearret = $rowbalg2['ret'] + $diferret;	
	$sumayeartot = $rowbalg2['tot'] + $diferpvptot;	

	//	print("* ".$sumayeariva." ".$sumayearpvp." ".$sumayeartot.".<br/>");

	$sqlbg2 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumayeariva', `sub` = '$sumayearpvp', `ret` = '$sumayearret', `tot` =  '$sumayeartot' WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
		
		if(mysqli_query($db, $sqlbg2)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 850: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
							
	//////////////
					
	$dmxo = "M".$_SESSION['mold'];
	global $meso;
	if(($dmxo == "M01")||($dmxo == "M02")||($dmxo == "M03")){$meso = "TRI1";}
	elseif(($dmxo == "M04")||($dmxo == "M05")||($dmxo == "M06")){$meso = "TRI2";}
	elseif(($dmxo == "M07")||($dmxo == "M08")||($dmxo == "M09")){$meso = "TRI3";}
	elseif(($dmxo == "M10")||($dmxo == "M11")||($dmxo == "M12")){$meso = "TRI4";}
	global $mes;
	if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
	elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
	elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
	elseif(($dmx == "M10")||($dmx == "M11")||($dmx == "M12")){$mes = "TRI4";}
	
	if($meso == $mes){
	global $mes;
	if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
	elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
	elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
	elseif(($dmx == "M10")||($dmx == "M11")||($dmx == "M12")){$mes = "TRI4";}
	
	$sqlbalg3 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$mes' ";
	$qbalg3 = mysqli_query($db, $sqlbalg3);
	$countbalg3 = mysqli_num_rows($qbalg3);
	$rowbalg3 = mysqli_fetch_assoc($qbalg3);

	$sumatriiva = $rowbalg3['iva'] + $diferiva;	
	$sumatripvp = $rowbalg3['sub'] + $diferpvp;	
	$sumatriret = $rowbalg3['ret'] + $diferret;	
	$sumatritot = $rowbalg3['tot'] + $diferpvptot;	

	//	print("* ".$sumatriiva." ".$sumatripvp." ".$sumatritot.".<br/>");

	$sqlbg3 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumatriiva', `sub` = '$sumatripvp', `ret` = '$sumatriret', `tot` =  '$sumatritot' WHERE `year` = '$dyx' AND `mes` = '$mes' ";
		
		if(mysqli_query($db, $sqlbg3)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 891: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
							
		} elseif($meso != $mes) {
			
	global $mes;
	if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
	elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
	elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
	elseif(($dmx == "M10")||($dmx == "M11")||($dmx == "M12")){$mes = "TRI4";}

	$sqlbalg3 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$mes' ";
	$qbalg3 = mysqli_query($db, $sqlbalg3);
	$countbalg3 = mysqli_num_rows($qbalg3);
	$rowbalg3 = mysqli_fetch_assoc($qbalg3);

	$sumatriiva = $rowbalg3['iva'] + $factivae;	
	$sumatripvp = $rowbalg3['sub'] + $factpvp;	
	$sumatriret = $rowbalg3['ret'] + $factrete;	
	$sumatritot = $rowbalg3['tot'] + $factpvptot;	

	//	print("* ".$sumatriiva." ".$sumatripvp." ".$sumatritot.".<br/>");

	$sqlbg3 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumatriiva', `sub` = '$sumatripvp', `ret` = '$sumatriret', `tot` =  '$sumatritot' WHERE `year` = '$dyx' AND `mes` = '$mes' ";
		
		if(mysqli_query($db, $sqlbg3)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 919: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
							
	$dmxo = "M".$_SESSION['mold'];
	global $meso;
	if(($dmxo == "M01")||($dmxo == "M02")||($dmxo == "M03")){$meso = "TRI1";}
	elseif(($dmxo == "M04")||($dmxo == "M05")||($dmxo == "M06")){$meso = "TRI2";}
	elseif(($dmxo == "M07")||($dmxo == "M08")||($dmxo == "M09")){$meso = "TRI3";}
	elseif(($dmxo == "M10")||($dmxo == "M11")||($dmxo == "M12")){$meso = "TRI4";}

	$sqlbalg3 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$meso' ";
	$qbalg3 = mysqli_query($db, $sqlbalg3);
	$countbalg3 = mysqli_num_rows($qbalg3);
	$rowbalg3 = mysqli_fetch_assoc($qbalg3);

	$sumatriiva = $rowbalg3['iva'] - $ivaold;	
	$sumatripvp = $rowbalg3['sub'] - $pvpold;	
	$sumatriret = $rowbalg3['ret'] - $retold;	
	$sumatritot = $rowbalg3['tot'] - $pvptold;	

	//	print("* ".$sumatriiva." ".$sumatripvp." ".$sumatritot.".<br/>");

	$sqlbg3 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumatriiva', `sub` = '$sumatripvp', `ret` = '$sumatriret', `tot` =  '$sumatritot' WHERE `year` = '$dyx' AND `mes` = '$meso' ";
		
		if(mysqli_query($db, $sqlbg3)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 946: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
			}
			
}
	
	//////////////

elseif($_SESSION['yold'] != $dynew){
	
		global $ivaold;
		$ivaold = $_SESSION['ivae1'].".".$_SESSION['ivae2'];
		global $retold;
		$retold = $_SESSION['rete1'].".".$_SESSION['rete2'];
		global $pvpold;
		$pvpold = $_SESSION['factpvp1'].".".$_SESSION['factpvp2'];
		global $pvptold;
		$pvptold = $_SESSION['factpvptot1'].".".$_SESSION['factpvptot2'];

	global $dyx;
	$dyx = "20".$_POST['dy'];
	global $dmx;
	$dmx = "M".$_POST['dm'];

	global $vnamebalg;
	$vnamebalg = "cbj_balancei";
	$vnamebalg = "`".$vnamebalg."`";
	
	$sqlbalg =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
	$qbalg = mysqli_query($db, $sqlbalg);
	$countbalg = mysqli_num_rows($qbalg);
	$rowbalg = mysqli_fetch_assoc($qbalg);
	
	$sumamesiva = $rowbalg['iva'] + $factivae;	
	$sumamespvp = $rowbalg['sub'] + $factpvp;	
	$sumamesret = $rowbalg['ret'] + $factrete;
	$sumamestot = $rowbalg['tot'] + $factpvptot;	

	//	print("* ".$dyt1." ".$dm1.".<br/>");
	//	print("* ".$sumamesiva." ".$sumamespvp." ".$sumamestot.".<br/>");

	$sqlbg = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumamesiva', `sub` = '$sumamespvp', `ret` = '$sumamesret', `tot` =  '$sumamestot' WHERE `year` = '$dyx' AND `mes` = '$dmx' ";
		
		if(mysqli_query($db, $sqlbg)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 992: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}

		/////////////

	global $dyxo;
	global $dmxo;
	$dyxo = "20".$_SESSION['yold'];
	$dmxo = "M".$_SESSION['mold'];
	$sqlbalg =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyxo' AND `mes` = '$dmxo' ";
	$qbalg = mysqli_query($db, $sqlbalg);
	$countbalg = mysqli_num_rows($qbalg);
	$rowbalg = mysqli_fetch_assoc($qbalg);
	
	$sumamesiva = $rowbalg['iva'] - $ivaold;	
	$sumamespvp = $rowbalg['sub'] - $pvpold;	
	$sumamesret = $rowbalg['ret'] - $retold;	
	$sumamestot = $rowbalg['tot'] - $pvptold;	

	//	print("* ".$dyt1." ".$dm1.".<br/>");
	//	print("* ".$sumamesiva." ".$sumamespvp." ".$sumamestot.".<br/>");

	$sqlbg = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumamesiva', `sub` = '$sumamespvp', `ret` = '$sumamesret', `tot` =  '$sumamestot' WHERE `year` = '$dyxo' AND `mes` = '$dmxo' ";
		
		if(mysqli_query($db, $sqlbg)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 1019: ".mysqli_error($db));
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

	//	print("* ".$sumayeariva." ".$sumayearpvp." ".$sumayeartot.".<br/>");

	$sqlbg2 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumayeariva', `sub` = '$sumayearpvp', `ret` = '$sumayearret', `tot` =  '$sumayeartot' WHERE `year` = '$dyx' AND `mes` = 'ANU' ";
		
		if(mysqli_query($db, $sqlbg2)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 1041: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}

		/////////////
		
	$sqlbalg2 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyxo' AND `mes` = 'ANU' ";
	$qbalg2 = mysqli_query($db, $sqlbalg2);
	$countbalg2 = mysqli_num_rows($qbalg2);
	$rowbalg2 = mysqli_fetch_assoc($qbalg2);

	$sumayeariva = $rowbalg2['iva'] - $ivaold;	
	$sumayearpvp = $rowbalg2['sub'] - $pvpold;	
	$sumayearret = $rowbalg2['ret'] - $retold;	
	$sumayeartot = $rowbalg2['tot'] - $pvptold;	

	//	print("* ".$sumayeariva." ".$sumayearpvp." ".$sumayeartot.".<br/>");

	$sqlbg2 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumayeariva', `sub` = '$sumayearpvp', `ret` = '$sumayearret', `tot` =  '$sumayeartot' WHERE `year` = '$dyxo' AND `mes` = 'ANU' ";
		
		if(mysqli_query($db, $sqlbg2)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 1063: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}

		/////////////

	global $mes;
	if(($dmx == "M01")||($dmx == "M02")||($dmx == "M03")){$mes = "TRI1";}
	elseif(($dmx == "M04")||($dmx == "M05")||($dmx == "M06")){$mes = "TRI2";}
	elseif(($dmx == "M07")||($dmx == "M08")||($dmx == "M09")){$mes = "TRI3";}
	elseif(($dmx == "M10")||($dmx == "M11")||($dmx == "M12")){$mes = "TRI4";}
	
	$sqlbalg3 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyx' AND `mes` = '$mes' ";
	$qbalg3 = mysqli_query($db, $sqlbalg3);
	$countbalg3 = mysqli_num_rows($qbalg3);
	$rowbalg3 = mysqli_fetch_assoc($qbalg3);

	$sumatriiva = $rowbalg3['iva'] + $factivae;	
	$sumatripvp = $rowbalg3['sub'] + $factpvp;	
	$sumatriret = $rowbalg3['ret'] + $factrete;	
	$sumatritot = $rowbalg3['tot'] + $factpvptot;	

	//print("* ".$sumatriiva." ".$sumatripvp." ".$sumatritot.".<br/>");

	$sqlbg3 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumatriiva', `sub` = '$sumatripvp', `ret` = '$sumatriret', `tot` =  '$sumatritot' WHERE `year` = '$dyx' AND `mes` = '$mes' ";
		
		if(mysqli_query($db, $sqlbg3)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 1091: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
	//////////////
	
	$dmxo = "M".$_SESSION['mold'];
	global $meso;
	if(($dmxo == "M01")||($dmxo == "M02")||($dmxo == "M03")){$meso = "TRI1";}
	elseif(($dmxo == "M04")||($dmxo == "M05")||($dmxo == "M06")){$meso = "TRI2";}
	elseif(($dmxo == "M07")||($dmxo == "M08")||($dmxo == "M09")){$meso = "TRI3";}
	elseif(($dmxo == "M10")||($dmxo == "M11")||($dmxo == "M12")){$meso = "TRI4";}

	$sqlbalg3 =  "SELECT * FROM `$db_name`.$vnamebalg WHERE `year` = '$dyxo' AND `mes` = '$meso' ";
	$qbalg3 = mysqli_query($db, $sqlbalg3);
	$countbalg3 = mysqli_num_rows($qbalg3);
	$rowbalg3 = mysqli_fetch_assoc($qbalg3);

	$sumatriiva = $rowbalg3['iva'] - $ivaold;	
	$sumatripvp = $rowbalg3['sub'] - $pvpold;	
	$sumatriret = $rowbalg3['ret'] - $retold;	
	$sumatritot = $rowbalg3['tot'] - $pvptold;	

	//	print("* ".$sumatriiva." ".$sumatripvp." ".$sumatritot.".<br/>");

	$sqlbg3 = "UPDATE `$db_name`.$vnamebalg  SET `iva` = '$sumatriiva', `sub` = '$sumatripvp', `ret` = '$sumatriret', `tot` =  '$sumatritot' WHERE `year` = '$dyxo' AND `mes` = '$meso' ";
		
		if(mysqli_query($db, $sqlbg3)){ //	print("**"); 
					} else {
							print("* MODIFIQUE LA ENTRADA 1119: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
		
}

	//////////////
		//////////////
	//////////////

	$idx = $_SESSION['idx'];
	global $vname;
	$vname = "cbj_gastos_".$dyt1;
	$vname = "`".$vname."`";
	$_SESSION['vname'] = $vname;
	
	if($_SESSION['yold'] != $dynew){
		
		global $rutaold;
		global $rutanew;
		$rutaold = "../cbj_Docs/docgastos_20".$_SESSION['yold']."/";
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
										
	global $sent;								
		$sent = "INSERT INTO `$db_name`.$vname (`factnum`, `factdate`, `refprovee`, `factnom`, `factnif`, `factiva`, `factivae`, `factpvp`, `factret`, `factrete`, `factpvptot`,`coment`, `myimg1`, `myimg2`, `myimg3`, `myimg4`) VALUES ('$_POST[factnum]', '$factdate', '$_POST[proveegastos]', '$_POST[factnom]', '$_POST[factnif]', '$_POST[factiva]', '$factivae', '$factpvp', '$_POST[factret]', '$factrete', '$factpvptot', '$_POST[coment]', '$_SESSION[myimg1b]', '$_SESSION[myimg2b]', '$_SESSION[myimg3b]', '$_SESSION[myimg4b]')";
		
	$idx = $_SESSION['idx'];
	global $vnamed;
	$vnamed = "cbj_gastos_20".$_SESSION['yold'];
	$vnamed = "`".$vnamed."`";
		$sqla = "DELETE FROM `$db_name`.$vnamed  WHERE $vnamed.`id` = '$idx'  ";
		if(mysqli_query($db, $sqla)){ //	print("<br/>* OK DELETE DATA."); 
					} else {
							print("* MODIFIQUE LA ENTRADA 1187: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
					}
		
	}	elseif($_SESSION['yold'] == $dynew){
				
		global $sent;								
		$sent = "UPDATE `$db_name`.$vname  SET `factnum` = '$_POST[factnum]', `factdate` = '$factdate', `refprovee` =  '$_POST[refprovee]', `factnom` =  '$_POST[factnom]', `factnif` = '$_POST[factnif]', `factiva` = '$_POST[factiva]', `factivae` = '$factivae', `factpvp` = '$factpvp', `factret` = '$_POST[factret]', `factrete` = '$factrete',  `factpvptot` = '$factpvptot', `coment` = '$_POST[coment]' WHERE $vname.`id` = '$idx'  ";

	}

	global $iniy;
	$iniy = substr(date('Y'),0,2);
	
	$tabla = "<table align='center' style='margin-top:10px' width=450px >
				<tr>
					<th colspan=4 class='BorderInf'>
						SE HA GRABADO EN ".strtoupper($vname)."
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
					<td>
						20"/*.$iniy*/.$factdate.
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

			</table>
				
		";	
		
		/////////////
		
		global $db;
		global $db_name;
		global $sent;
		
		$sqla = $sent;
		
		if(mysqli_query($db, $sqla)){ //	print("<br/>* INSERT / UPDATE DB DATA.");
									  print($tabla); 
					} else {
							print("* MODIFIQUE LA ENTRADA: 1189/1195 ".mysqli_error($db));
									show_form ();
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
					}

		/////////////
		
		$_SESSION['fnnew'] = $_POST['factnum'];
		
	if($_SESSION['fnold'] != $_POST['factnum']){
		
		$nombre1 = $_SESSION['myimg1b'];
		$extension1 = substr($_SESSION['myimg1b'],-3);
		$nombre1n = $_SESSION['fnnew']."_1.".$extension1;
		$_SESSION['$nombre1n'] = $nombre1n;
				
		$nombre2 = $_SESSION['myimg2b'];
		$extension2 = substr($_SESSION['myimg2b'],-3);
		$nombre2n = $_SESSION['fnnew']."_2.".$extension2;
		$_SESSION['$nombre2n'] = $nombre2n;

		$nombre3 = $_SESSION['myimg3b'];
		$extension3 = substr($_SESSION['myimg3b'],-3);
		$nombre3n = $_SESSION['fnnew']."_3.".$extension3;
		$_SESSION['$nombre3n'] = $nombre3n;

		$nombre4 = $_SESSION['myimg4b'];
		$extension4 = substr($_SESSION['myimg4b'],-3);
		$nombre4n = $_SESSION['fnnew']."_4.".$extension4;
		$_SESSION['$nombre4n'] = $nombre4n;

		global $ruta;
		$ruta = "../cbj_Docs/docgastos_20".$dynew."/";
		
		if( file_exists($ruta.$_SESSION['myimg1b'])){
					rename($ruta.$_SESSION['myimg1b'], $ruta.$_SESSION['$nombre1n']);
			/*		print("	<br/>* CHANGE FACT NUM: ".$_SESSION['fnold']." X ".$_SESSION['fnnew']."
							<br/>- Ok Rename Img Name 1.");
			*/
					}else{print("<br/>- No Ok Rename Img Name 1.");}

		if( file_exists($ruta.$_SESSION['myimg2b'])){
					rename($ruta.$_SESSION['myimg2b'], $ruta.$_SESSION['$nombre2n']);
			/*		print("<br/>- Ok Rename Img Name 2.");	*/
					}else{print("<br/>- No Ok Rename Img Name 2.");}
										
		if( file_exists($ruta.$_SESSION['myimg3b'])){
					rename($ruta.$_SESSION['myimg3b'], $ruta.$_SESSION['$nombre3n']);
			/*		print("<br/>- Ok Rename Img Name 3.");	*/
					}else{print("<br/>- No Ok Rename Img Name 3.");}
										
		if( file_exists($ruta.$_SESSION['myimg4b'])){
					rename($ruta.$_SESSION['myimg4b'], $ruta.$_SESSION['$nombre4n']);
			/*		print("<br/>- Ok Rename Img Name 4.");	*/
					}else{print("<br/>- No Ok Rename Img Name 4.");}

					mf1();
					
			}

	} ////

function mf1(){
	
		global $db;
		global $db_name;
		$vn = $_SESSION['vname'];
		$img1 = $_SESSION['$nombre1n'];
		$img2 = $_SESSION['$nombre2n'];
		$img3 = $_SESSION['$nombre3n'];
		$img4 = $_SESSION['$nombre4n'];
		$fnnew = $_SESSION['fnnew'];

	$sqlfn = "UPDATE `$db_name`.$vn  SET `myimg1` = '$img1', `myimg2` = '$img2', `myimg3` =  '$img3', `myimg4` =  '$img4' WHERE $vn.`factnum` = '$fnnew'  ";
		
		if(mysqli_query($db, $sqlfn)){ //	print("<br/>* OK DB UPDATE."); 
					} else {
							print("* MODIFIQUE LA ENTRADA 1367: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
							
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){

	global $db;
	global $db_name;
	
	global $sesionref;
	$sesionref = "cbj_clientes";
	$sesionref = "`".$sesionref."`";
	
	$sqlx =  "SELECT * FROM $sesionref WHERE `ref` = '$_POST[proveegastos]'";
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

		$_SESSION['mold'] = $dmx;
		$_SESSION['dold'] = $ddx;
		$_SESSION['yold'] = $dyx;
	
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
		
		$_POST['proveegastos'] = $_POST['refprovee'];
		
				$defaults = array ( 'id' => $_POST['id'],
									'proveegastos' => $_POST['refprovee'],
								   	'refprovee' => $_POST['refprovee'],
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
									'proveegastos' => $_POST['proveegastos'],
								   	'refprovee' => $_POST['refprovee'],
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

								MODIFICAR GASTO					
 
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>

<input type='hidden' name='proveegastos' value='".$defaults['proveegastos']."' />
<input type='hidden' name='id' value='".$defaults['id']."' />
<input type='hidden' name='dy' value='".$defaults['dy']."' />
<input type='hidden' name='dm' value='".$defaults['dm']."' />
<input type='hidden' name='dd' value='".$defaults['dd']."' />
<input type='hidden' name='factnum' value='".strtoupper($defaults['factnum'])."' />
<input type='hidden' name='refprovee' value='".$defaults['refprovee']."' />
<input type='hidden' name='factnom' value='".$defaults['factnom']."' />
<input type='hidden' name='factnif' value='".$defaults['factnif']."' />
<input type='hidden' name='factiva' value='".$defaults['factiva']."' />
<input type='hidden' name='factivae1' value='".$defaults['factivae1']."' />
<input type='hidden' name='factivae2' value='".$defaults['factivae2']."' />
<input type='hidden' name='factret' value='".$defaults['factret']."' />
<input type='hidden' name='factrete1' value='".$defaults['factrete1']."' />
<input type='hidden' name='factrete2' value='".$defaults['factrete2']."' />
<input type='hidden' name='factpvp1' value='".$defaults['factpvp1']."' />
<input type='hidden' name='factpvp2' value='".$defaults['factpvp2']."' />
<input type='hidden' name='factpvptot1' value='".$defaults['factpvptot1']."' />
<input type='hidden' name='factpvptot2' value='".$defaults['factpvptot2']."' />
<input type='hidden' name='coment' value='".$defaults['coment']."' />

				<tr>
					<td>
					<div style='float:left'>
						<input type='submit' value='SELECCIONE NUEVO CLIENTE' />
						<input type='hidden' name='oculto1' value=1 />
					</div>
					</td>
					
					<td>
					<div style='float:left'>

						<select name='proveegastos'>");

	global $db;
	global $tabla1;
	$tabla1 = "cbj_clientes";
	$tabla1 = "`".$tabla1."`";

	$sqlb =  "SELECT * FROM $tabla1 ORDER BY `rsocial` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."<br/>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['ref']."' ");
					
					if($rows['ref'] == $defaults['proveegastos']){
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
				"); 
			
	if ($_POST['proveegastos'] != ''){

	print("
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>

<input type='hidden' name='proveegastos' value='".$defaults['proveegastos']."' />
<input type='hidden' name='refprovee' value='".$defaults['refprovee']."' />
<input type='hidden' name='id' value='".$defaults['id']."' />

				<tr>
					<td>
						NUMERO
					</td>
					<td>

<input type='text' name='factnum' size=22 maxlength=20 value='".strtoupper($defaults['factnum'])."' />

					</td>
				</tr>
									
				<tr>
					<td>						
						FECHA
					</td>
					<td>
					
				<div style='float:left'>
				");
								
		require '../Inclu/year_in_select_bbdd.php';
									
	print ("	</select>
					</div>
					
					<div style='float:left'>

						<select style='margin-left:12px' name='dm'>");

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

						<select style='margin-left:12px' name='dd'>");

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
					<td>						
						RAZON SOCIAL
					</td>
					<td>
<input type='hidden' name='factnom' value='".$defaults['factnom']."' />".$defaults['factnom']."
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
				<select name='factiva'>");

			global $db;
			global $vname;
			$vname = "cbj_impuestos";
			$vname = "`".$vname."`";
			$sqli =  "SELECT * FROM $vname ORDER BY `iva` ASC ";
			$qi = mysqli_query($db, $sqli);

			if(!$qi){	print("* ".mysqli_error($db)."<br/>");
				} else {
					while($rowimp = mysqli_fetch_assoc($qi)){
							print ("<option value='".$rowimp['iva']."' ");
							if($rowimp['iva'] == $defaults['factiva']){
							print ("selected = 'selected'");																																													
															}
							print ("> ".$rowimp['name']." </option>");
							}
						} 
						 
		print ("</select>
						</div>
					</td>
				</tr>

				<tr>
					<td>						
						IMPUESTOS €
					</td>
					<td>
<input style='text-align:right' type='text' name='factivae1' size=5 maxlength=5 value='".$defaults['factivae1']."' />
,
<input type='text' name='factivae2' size=2 maxlength=2 value='".$defaults['factivae2']."' />
€
					</td>
				</tr>
					
				<tr>
					<td>						
						RETENCIONES %
				</td>
					<td>
					
			<div style='float:left'>
				<select name='factret'>");

			global $db;
			global $vnamer;
			$vnamer = "cbj_retencion";
			$vnamer = "`".$vnamer."`";
			$sqlr =  "SELECT * FROM $vnamer ORDER BY `ret` ASC ";
			$qr = mysqli_query($db, $sqlr);

			if(!$qr){	print("* ".mysqli_error($db)."</br>");
				} else {
					while($rowret = mysqli_fetch_assoc($qr)){
							print ("<option value='".$rowret['ret']."' ");
							if($rowret['ret'] == $defaults['factret']){
							print ("selected = 'selected'");																																													
															}
							print ("> ".$rowret['name']." </option>");
							}
						} 
						 
		print ("</select>
						</div>
					</td>
				</tr>

				<tr>
					<td>						
						RETENCIONES €
					</td>
					<td>
<input style='text-align:right' type='text' name='factrete1' size=5 maxlength=5 value='".$defaults['factrete1']."' />
,
<input type='text' name='factrete2' size=2 maxlength=2 value='".$defaults['factrete2']."' />
€
					</td>
				</tr>
					
				<tr>
					<td>						
						SUBTOTAL €
					</td>
					<td>
<input style='text-align:right' type='text' name='factpvp1' size=5 maxlength=5 value='".$defaults['factpvp1']."' />
,
<input type='text' name='factpvp2' size=2 maxlength=2 value='".$defaults['factpvp2']."' />
€
					</td>
				</tr>
					
				<tr>
					<td>						
						TOTAL €
					</td>
					<td>
<input style='text-align:right' type='text' name='factpvptot1' size=5 maxlength=5 value='".$defaults['factpvptot1']."' />
,
<input type='text' name='factpvptot2' size=2 maxlength=2 value='".$defaults['factpvptot2']."' />
€
					</td>
				</tr>

				<tr>
					<td>
						DESCRIPCIÓN
					</td>
					<td>
					
<textarea cols='35' rows='7' onkeypress='return limitac(event, 200);' onkeyup='actualizaInfoc(200)' name='coment' id='coment'>".$defaults['coment']."</textarea>
	
			<br/>
	            <div id='infoc' align='center' style='color:#0080C0;'>
        					Maximum 200 characters            
				</div>

					</td>
				</tr>

				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='GRABAR GASTO' />
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
$text = "\n- GASTO MODIFICAR SELECCIONADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$_POST['factdate'].".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$_POST['factivae'].".\n\tNETO €: ".$_POST['factpvp'].".\n\tTOTAL €: ".$_POST['factpvptot'];
	
	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
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
$text = "\n- GASTO MODIFICADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$factdate.".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$factivae.".\n\tNETO €: ".$factpvp.".\n\tTOTAL €: ".$factpvptot;

		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);	
		$logdocu = $_SESSION['ref'];
		$logdate = date('Y_m_d');
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
	
	function desconexion(){

			print("<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';

?>