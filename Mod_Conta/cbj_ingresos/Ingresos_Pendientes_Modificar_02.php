<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';
		
	require '../Inclu/sqld_query_fetch_assoc.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

				
					master_index();

						if($_POST['oculto2']){	info_01();
												show_form();}
						elseif($_POST['oculto']){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} 
								else{
									process_form_1();
									}
									
									
							} else {show_form();}
							
				}else { require '../Inclu/table_permisos.php'; } 

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
$errors [] = "FACTURA NUMERO <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
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
	
	elseif (strlen(trim($_POST['factnom'])) < 5){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['factnom'])){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-zA-Z,0-9\s]+$/',$_POST['factnom'])){
		$errors [] = "RAZON SOCIAL <font color='#FF0000'>Solo letras o números sin acentos.</font>";
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

	if (!preg_match('/^[a-z A-Z 0-9 \s ,.;:\'-() áéíóúñ €]+$/',$_POST['coment'])){
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
	
	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form_1(){
	
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

	global $idx; 		$idx = $_SESSION['idx'];
	global $vname; 		$vname = "`".$_SESSION['clave']."ingresos_pendientes`";
	$_SESSION['vname'] = $vname;

	global $sent;
	$sent = "UPDATE `$db_name`.$vname  SET `factnum` = '$_POST[factnum]', `factdate` = '$factdate', `refcliente` =  '$_POST[refprovee]', `factnom` =  '$_POST[factnom]', `factnif` = '$_POST[factnif]', `factiva` = '$_POST[factiva]', `factivae` = '$factivae', `factpvp` = '$factpvp', `factret` = '$_POST[factret]', `factrete` = '$factrete',  `factpvptot` = '$factpvptot', `coment` = '$_POST[coment]' WHERE $vname.`id` = '$idx'  ";

	global $iniy;
	$iniy = substr(date('Y'),0,2);
		
		if(mysqli_query($db, $sent)){ //	print("*");
									  print($tabla); 
					} else {	print("* MODIFIQUE LA ENTRADA 414: ".mysqli_error($db));
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
		$ruta = "../cbj_Docs/docingresos_pendientes/";
		
		if( file_exists($ruta.$_SESSION['myimg1b'])){
					rename($ruta.$_SESSION['myimg1b'], $ruta.$_SESSION['$nombre1n']);
			/*	print("	<br/>* CHANGE FACT NUM: ".$_SESSION['fnold']." X ".$_SESSION['fnnew']."
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

					
	$sqlfn = "UPDATE `$db_name`.$vname  SET `myimg1` = '$nombre1n', `myimg2` = '$nombre2n', `myimg3` =  '$nombre3n', `myimg4` =  '$nombre4n' WHERE $vname.`id` = '$idx'  ";
		
		if(mysqli_query($db, $sqlfn)){// print("<br/>* OK DB UPDATE."); 
					} else {
							print("* MODIFIQUE LA ENTRADA 479: ".mysqli_error($db));
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
							}
			}	// Fin if.
					
	}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){

	global $db; 		global $db_name;
	
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

								MODIFICAR INGRESO PENDIENTE					
 
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>

<input type='hidden' name='proveedores' value='".$defaults['proveedores']."' />
<input type='hidden' name='xl' value='".$defaults['xl']."' />
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

						<select name='proveedores'>");

	global $db;
	global $tabla1; 		$tabla1 = "`".$_SESSION['clave']."clientes`";

	$sqlb =  "SELECT * FROM $tabla1 ORDER BY `rsocial` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."<br/>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['ref']."' ");
					
					if($rows['ref'] == $defaults['proveedores']){
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
			
	if ($_POST['proveedores'] != '') {

	print("
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>

<input type='hidden' name='proveedores' value='".$defaults['proveedores']."' />
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
	global $vname; 		$vname = "`".$_SESSION['clave']."impuestos`";
	$sqli =  "SELECT * FROM $vname ORDER BY `iva` ASC ";
	$qi = mysqli_query($db, $sqli);

	if(!$qi){	print("* ".mysqli_error($db)."<br/>");
		} else { while($rowimp = mysqli_fetch_assoc($qi)){
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
	global $vnamer; 		$vnamer = "`".$_SESSION['clave']."retencion`";
	$sqlr =  "SELECT * FROM $vnamer ORDER BY `ret` ASC ";
	$qr = mysqli_query($db, $sqlr);

	if(!$qr){	print("* ".mysqli_error($db)."</br>");
		} else { while($rowret = mysqli_fetch_assoc($qr)){
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
						<input type='submit' value='GRABAR INGRESO PENDIENTE' />
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
$text = "\n- INGRESO PENDIENTE MODIFICAR SELECCIONADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$_POST['factdate'].".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$_POST['factivae'].".\n\tNETO €: ".$_POST['factpvp'].".\n\tTOTAL €: ".$_POST['factpvptot'];
	
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
$text = "\n- INGRESO PENDIENTE MODIFICADO ".$ActionTime.".\n\tNº FACTURA: ".$_POST['factnum'].".\n\tDATE FACTURA: ".$factdate.".\n\tRAZON SOCIAL: ".$_POST['factnom'].".\n\tNIF: ".$_POST['factnif'].".\n\tTIPO IVA %: ".$_POST['factiva'].".\n\tIMP €: ".$factivae.".\n\tNETO €: ".$factpvp.".\n\tTOTAL €: ".$factpvptot;

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
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaIngresos;	$rutaIngresos = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
				} /* Fin funcion master_index.*/

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Conta_Footer.php';

?>