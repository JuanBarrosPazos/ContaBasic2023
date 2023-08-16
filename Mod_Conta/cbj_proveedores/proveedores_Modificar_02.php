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

		//print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
		master_index();

		if (isset($_POST['oculto2'])){
				show_form();
				info_01();
		} elseif(isset($_POST['modifica'])){
				if($form_errors = validate_form()){
						show_form($form_errors);
				} else { process_form();
						info_02();
								}
		} else { show_form();
				unset($_SESSION['dudas']);
				unset($_SESSION['dniold']);
					}
	} else { require '../Inclu/table_permisos.php'; } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function validate_form(){
	
		global $sqld; 		global $qd; 		global $rowd;
	
		require 'validate.php';	
		
		return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db; 		global $db_name;	
	global $rf1;		global $rf2;
	if (preg_match('/^(\w{1})/',$_POST['rsocial'],$ref1)){	$rf1 = $ref1[1];
															$rf1 = trim($rf1);
																			}
	if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['rsocial'],$ref2)){$rf2 = $ref2[2];
																	$rf2 = trim($rf2);
																			}

	global $rf; 		$rf = strtolower($rf1.$rf2.$_POST['dni'].$_POST['ldni']);
	$rf = trim($rf);
			
	global $vname; 			$vname = "`".$_SESSION['clave']."proveedores`";

	$sqldni =  "SELECT * FROM `$db_name`.$vname WHERE $vname.`dni` = '$_POST[dni]'";
	$qdni = mysqli_query($db, $sqldni);
	$rowdni = mysqli_fetch_assoc($qdni);

//	print($_SESSION['dniold']);
	global $dniold;
	$dniold = $_SESSION['dniold'];
	$dniold = trim($dniold);
	$dniold = "%".$dniold."%";
	
	global $ldniold;
	$ldniold = $_SESSION['ldniold'];
	$ldniold = trim($ldniold);
	$ldniold = "%".$ldniold."%";

	global $refold;
	$refold = $_SESSION['refold'];
	$refold = trim($refold);
	$refold = "%".$refold."%";
	
	global $dnif;
	$dnif = $_SESSION['dniold'].$_SESSION['ldniold'];
	$dnif = trim($dnif);
	$dnif = "%".$dnif."%";
	
	global $factnif;
	$factnif = $_POST['dni'].$_POST['ldni'];
	$factnif = trim($factnif);

	if (($rf == @$rowdni['ref'])||(@$_POST['ref'] == $rf)){

		global $tlf2;
		if(strlen(trim($_POST['Tlf2'])) == 0){
			$tlf2 = 0;
		} else { $tlf2 = $_POST['Tlf2']; }
		
		$sql = "UPDATE `$db_name`.$vname SET `rsocial` = '$_POST[rsocial]', `Email` = '$_POST[Email]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$tlf2' WHERE $vname.`id` = '$_POST[id]' LIMIT 1 ";
			
	}else{
		
		if( file_exists("../cbj_Docs/img_proveedores/".$_SESSION['myimgold']) ){
			$dt = date('is');
			$destination_file = "../cbj_Docs/img_proveedores/".$_SESSION['myimgold'];
			$extension = substr($_SESSION['myimgold'],-3);
			global $new_name;
			$new_name = $rf."_".$dt.".".$extension;
			$rename_filename = "../cbj_Docs/img_proveedores/".$new_name;	
			rename($destination_file, $rename_filename);
			}

		global $tlf2;
		if(strlen(trim($_POST['Tlf2'])) == 0){
			$tlf2 = 0;
		} else { $tlf2 = $_POST['Tlf2']; }

		$sql = "UPDATE `$db_name`.$vname SET  `ref`= '$rf', `rsocial` = '$_POST[rsocial]', `myimg` = '$new_name', `doc` = '$_POST[doc]', `dni` = '$_POST[dni]', `ldni` = '$_POST[ldni]', `Email` = '$_POST[Email]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$tlf2' WHERE $vname.`id` = '$_POST[id]' LIMIT 1 ";
	
			/* ACTUALIZA EN CASACADA LAS TABLAS GASTOS CON EL NUEVO NIF, RAZON SOCIAL */
			global $tableName; 			$tableName = "`".$_SESSION['clave']."status`";
			$a = "SELECT MIN(year) FROM `$db_name`.$tableName ";
			$ra = mysqli_query($db, $a);
			$ym = mysqli_fetch_row($ra);
			global $yearMin;	$yearMin = $ym[0];		//echo $yearMin;
			global $yearHoy; 	$yearHoy = date('Y'); 	//echo $yearHoy;
		
			while($yearMin<=$yearHoy){
		
				//echo "* AÑO: ".$yearMin.".<br>";
				global $tName; 	$tName =  "`".$_SESSION['clave']."gastos_".$yearMin."`";
				$sg6 = "UPDATE `$db_name`.$tName SET `refprovee` = '$rf', `factnif` = '$factnif', `factnom` = '$_POST[rsocial]' WHERE $tName.`factnif` LIKE '$dnif' ";
	
				if(mysqli_query($db, $sg6)){ //print("* OK");
				} else { //print("<font color='#FF0000'>* ".mysqli_error($db))."</br>";
						 global $texerror1;
						 $texerror1 = "\n\t ".mysqli_error($db);
							}

				$yearMin++;

			} // FIN WHILE

			global $tableGastPend; 		$tableGastPend = "`".$_SESSION['clave']."gastos_pendientes`";
			$sg6 = "UPDATE `$db_name`.$tableGastPend SET `refprovee` = '$rf', `factnif` = '$factnif', `factnom` = '$_POST[rsocial]' WHERE $tableGastPend.`factnif` LIKE '$dnif' ";
	
			if(mysqli_query($db, $sg6)){ //print("* OK");
			} else { //print("<font color='#FF0000'>* ".mysqli_error($db))."</br>";
					 global $texerror6;
					 $texerror6 = "\n\t ".mysqli_error($db);
						}

			/* FIN ACTUALIZA EN CASACADA LAS TABLAS GASTOS CON EL NUEVO NIF, RAZON SOCIAL */
	
		} // FIN ELSE

	if(mysqli_query($db, $sql)){
		
	//	$fil = "%".$rf."%";
		$pimg =  "SELECT * FROM `$db_name`.$vname WHERE `ref` = '$rf' ";
		$qpimg = mysqli_query($db, $pimg);
		$rowpimg = mysqli_fetch_assoc($qpimg);
		$_SESSION['dudas'] = $rowpimg['myimg'];
		global $dudas; 		$dudas = $_SESSION['dudas']; 	$dudas = trim($dudas);
	//	print("** ".$rowpimg['myimg']);

		print("<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=3 class='BorderInf'>HA MODIFICADO EL PROVEEDOR</th>
				</tr>
				<tr>
					<td style='width: 120px; text-align: right;'>RAZON SOCIAL</td>
					<td style='width: 120px;'>".$_POST['rsocial']."</td>
					<td rowspan='4' align='center' width='100px'>
			<img src='../cbj_Docs/img_proveedores/".$dudas."' height='120px' width='90px' />
					</td>
				</tr>
				<tr>
					<td style='text-align: right;'>DOCUMENTO</td><td>".$_POST['doc']."</td>
				</tr>				
				<tr>
					<td style='text-align: right;'>NUMERO</td><td>".$_POST['dni']."</td>
				</tr>				
				<tr>
					<td style='text-align: right;'>CONTROL</td><td>".$_POST['ldni']."</td>
				</tr>				
				<tr>
					<td style='text-align: right;'>MAIL</td><td colspan='2'>".$_POST['Email']."</td>
				</tr>
				<tr>
					<td style='text-align: right;'>REFERENCIA</td><td colspan='2'>".$rf."</td>
				</tr>
				<tr>
					<td style='text-align: right;'>PAIS</td><td colspan='2'>".$_POST['Direccion']."</td>
				</tr>
				<tr>
					<td style='text-align: right;'>TELEFONO 1</td><td colspan='2'>".$_POST['Tlf1']."</td>
				</tr>
				<tr>
					<td style='text-align: right;'>TELEFONO 2</td><td colspan='2'>".$_POST['Tlf2']."</td>
				</tr>
				<tr>
					<td colspan='3' align='center'>
						<a href='proveedores_Ver.php' class='botonverde'>INICIO PROVEEDORES</a>
					</td>
				</tr>
			</table>");
			global $redir;
			$redir = "<script type='text/javascript'>
							function redir(){
							window.location.href='proveedores_Ver.php';
						}
						setTimeout('redir()',4000);
						</script>";
			print ($redir);
	
		} else { print("</br><font color='#FF0000'>* ERROR L. 114/133: </font></br> ".mysqli_error($db))."</br>";
					show_form ();
					//global $texerror;
					//$texerror = $texerror1.$texerror2.$texerror3.$texerror4."\n";
				}
	
	} // FIN function process_form()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto2'])){
		
	$_SESSION['dniold'] = $_POST['dni'];
	$_SESSION['refold'] = $_POST['ref'];
	$_SESSION['ldniold'] = $_POST['ldni'];
	$_SESSION['myimgold'] = $_POST['myimg'];
	
	$defaults = array ( 'id' => $_POST['id'],
						'rsocial' => $_POST['rsocial'],
						'myimg' => $_POST['myimg'],	
						'ref' => $_POST['ref'],
						'doc' => $_POST['doc'],
						'dni' => $_POST['dni'],
						'ldni' => $_POST['ldni'],
						'Email' => $_POST['Email'],
						'Direccion' => $_POST['Direccion'],
						'Tlf1' => $_POST['Tlf1'],
						'Tlf2' => $_POST['Tlf2']);

	} elseif(isset($_POST['modifica'])){
			global $img2;
			$img2 = 'untitled.png';

		$defaults = array ( 'id' => $_POST['id'],
							'rsocial' => $_POST['rsocial'],
							'myimg' => $_POST['myimg'],	
							'ref' => @$_POST['ref'],
							'doc' => $_POST['doc'],
							'dni' => $_POST['dni'],
							'ldni' => $_POST['ldni'],
							'Email' => $_POST['Email'],
							'Direccion' => $_POST['Direccion'],
							'Tlf1' => $_POST['Tlf1'],
							'Tlf2' => $_POST['Tlf2']);

	} else { $defaults = $_POST; }
		
	if ($errors){
		print("	<div style='margin: auto; width: fit-content;'>
					<table align='left' style='border:none'>
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
				</table>
				</div>
				<div style='clear:both'></div>");
		}
	
	$doctype = array (	'DNI' => 'DNI/NIF Espa&ntilde;oles',
						'NIE' => 'NIE/NIF Extranjeros',
						'NIFespecial' => 'NIF Persona F&iacute;sica Especial',
						'NIFsa' => 'NIF Sociedad An&oacute;nima',
						'NIFsrl' => 'NIF Sociedad Responsabilidad Limitada',
						'NIFscol' => 'NIF Sociedad Colectiva',
						'NIFscom' => 'NIF Sociedad Comanditaria',
						'NIFcbhy' => 'NIF Comunidad Bienes y Herencias Yacentes',
						'NIFscoop' => 'NIF Sociedades Cooperativas',
						'NIFasoc' => 'NIF Asociaciones',
						'NIFcpph' => 'NIF Comunidad Propietarios Propiedad Horizontal',
						'NIFsccspj' => 'NIF Sociedad Civil, con o sin Personalidad Juridica',
						'NIFee' => 'NIF Entidad Extranjera',
						'NIFcl' => 'NIF Corporaciones Locales',
						'NIFop' => 'NIF Organismo Publico',
						'NIFcir' => 'NIF Congragaciones Instituciones Religiosas',
						'NIFoaeca' => 'NIF Organos Admin Estado y Comunidades Autonomas',
						'NIFute' => 'NIF Uniones Temporales de Empresas',
						'NIFotnd' => 'NIF Otros Tipos no Definidos',
						'NIFepenr' => 'NIF Establecimientos Permanentes Entidades no Residentes',
						'UNDEFINE' => 'Sin Validación Definida...',
										);
	
	global $rf1;	global $rf2;

	if (preg_match('/^(\w{1})/',$_POST['rsocial'],$ref1)){	$rf1 = $ref1[1];
															$rf1 = trim($rf1);
																							}
	if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['rsocial'],$ref2)){	$rf2 = $ref2[2];
																	$rf2 = trim($rf2);
																							}
	global $rf;
	$rf = strtolower($rf1.$rf2.$_POST['dni'].$_POST['ldni']);
	$rf = trim($rf);

	print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>NUEVOS DATOS DEL PROVEEDOR</th>
				</tr>
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
			<input type='hidden' name='id' value='".$defaults['id']."' />
			<input type='hidden' name='myimg' value='".$defaults['myimg']."' />
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>REFERENCIA
					</td>
					<td width=360px>".$rf."</td>
				</tr>
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>RAZON SOCIAL
					</td>
					<td width=360px>
		<input type='text' name='rsocial' size=30 maxlength=30 value='".$defaults['rsocial']."' />
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>DOCUMENTO
					</td>
					<td>
			<select name='doc'>");
				foreach($doctype as $option => $label){
					print ("<option value='".$option."' ");
					if($option == $defaults['doc']){ print ("selected = 'selected'"); }
													print ("> $label </option>");
												}	

		print ("</select>
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>NÚMERO
					</td>
					<td>
		<input type='text' name='dni' size=12 maxlength=8 value='".$defaults['dni']."' />
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>CONTROL
					</td>
					<td>
		<input type='text' name='ldni' size=4 maxlength=1 value='".$defaults['ldni']."' />
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>MAIL
					</td>
					<td>
		<input type='text' name='Email' size=52 maxlength=50 value='".$defaults['Email']."' />
					</td>
				</tr>	
				<tr>
					<td>
						<font color='#FF0000'>*</font>DIRECCIÓN
					</td>
					<td>
	<input type='text' name='Direccion' size=52 maxlength=60 value='".$defaults['Direccion']."' />
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>TELÉFONO 1
					</td>
					<td>
		<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
					</td>
				</tr>
				<tr>
					<tr>
					<td>
						<font color='#FF0000'>&nbsp;</font>TELÉFONO 2
					</td>
					<td>
		<input type='text' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				<tr>
					<td colspan='2'  align='right' valign='middle'>
						<input type='submit' value='MODIFICAR DATOS' class='botonazul' />
						<input type='hidden' name='modifica' value=1 />
						<input type='hidden' name='v' value='g' />
					</td>
				</tr>
		</form>														
				<tr>
					<td colspan='2' align='center'>
						<a href='proveedores_Ver.php' class='botonverde'>INICIO PROVEEDORES</a>
					</td>
				</tr>
			</table>"); /* Fin del print */

	}	/* Fin show_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaProveedores;	$rutaProveedores = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_01(){

	global $db; 	global $orden;
	
	$orden = @$_POST['Orden'];
		
	$_SESSION['xid'] = $_POST['id'];
	if (isset($_POST['todo'])){$filtro = "\n\tFiltro => TODOS LOS PROVEEDORES ".$orden;}
	else{$filtro = "\n\tID: ".$_SESSION['xid'].".\n\tR. Social: ".$_POST['rsocial'].".\n\tDNI: ".$_POST['dni'].$_POST['ldni'].".\n\tReferencia: ".$_POST['ref'].".\n\tEmail: ".$_POST['Email'].".\n\tDireccion: ".$_POST['Direccion'].".\n\tTlf 1: ".$_POST['Tlf1'].".\n\tTlf 2: ".$_POST['Tlf2'].".";}

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	global $text;
	$text = "\n- PROVEEDORES MODIFICAR SELECCIONADO ".$ActionTime.$filtro;

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

	global $db; 	global $rf;

	$ActionTime = date('H:i:s');
	
	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}

	global $texerror;
	global $text;
	$text = "\n- PROVEEDORES GASTO MODIFICADO ".$ActionTime.".\n\tID: ".$_SESSION['xid'].".\n\tR. Social: ".$_POST['rsocial'].".\n\tDNI: ".$_POST['dni'].$_POST['ldni'].".\n\tReferencia: ".$rf.".\n\tEmail: ".$_POST['Email'].".\n\tDireccion: ".$_POST['Direccion'].".\n\tTlf 1: ".$_POST['Tlf1'].".\n\tTlf 2: ".$_POST['Tlf2'].".";			

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y-m-d');
	$logtext = $text.$texerror."\n";
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	//require '../Inclu/Conta_Footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>