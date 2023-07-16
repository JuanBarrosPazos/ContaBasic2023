<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';

	require '../Inclu/sqld_query_fetch_assoc.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

					master_index();

						if($_POST['oculto']){
								if($form_errors = validate_form()){
									show_form($form_errors);
									unset($_SESSION['dudas']);

										} else {
											process_form();
										 	info();
																	}
							} else {
										show_form();
										unset($_SESSION['dudas']);
									}
				} else { require '../Inclu/table_permisos.php'; } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
		global $db;
		global $db_name;
		global $sqld;
		global $qd;
		global $rowd;
	
		require '../Inclu/validate_provee.php';	
		
			return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $db_name;	
	
	/*	REFERENCIA DE CLIENTE	*/
	
	if (preg_match('/^(\w{1})/',$_POST['rsocial'],$ref1)){	$rf1 = $ref1[1];
															$rf1 = trim($rf1);
																			}
	if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['rsocial'],$ref2)){$rf2 = $ref2[2];
																	$rf2 = trim($rf2);
																			}
	
	global $rf;
	$rf = $rf1.$rf2.$_POST['dni'].$_POST['ldni'];
	$rf = trim($rf);
			
	/************* CREAMOS LAS IMAGENES EN LA IMG CLIENTE DIRECTORIO ***************/

	global $tabla1;
	$sesionref = $_SESSION['ref'];

	if($_FILES['myimg']['size'] == 0){
			$nombre = 'untitled.png';
			global $new_name;
			$new_name = $rf.".png";
			$rename_filename = "../cbj_Docs/img_clientes/".$new_name;							
			copy("../cbj_Docs/img_clientes/untitled.png", $rename_filename);
												}
												
	else{	$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
			$safe_filename = trim(str_replace('..', '', $safe_filename));

		 	$nombre = $_FILES['myimg']['name'];
		  	$nombre_tmp = $_FILES['myimg']['tmp_name'];
		  	$tipo = $_FILES['myimg']['type'];
		  	$tamano = $_FILES['myimg']['size'];
		  
			global $destination_file;
			$destination_file = "../cbj_Docs/img_clientes/".$safe_filename;

	 if( file_exists( "../cbj_Docs/img_clientes/".$nombre) ){
			unlink("../cbj_Docs/img_clientes/".$nombre);
		//	print("* El archivo ".$nombre." ya existe, seleccione otra imagen.</br>");
												}
			
	elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){
			
			// Renombrar el archivo:
			$extension = substr($_FILES['myimg']['name'],-3);
			// print($extension);
			// $extension = end(explode('.', $_FILES['myimg']['name']) );
			global $new_name;
			$new_name = $rf.".".$extension;
			$rename_filename = "../cbj_Docs/img_clientes/".$new_name;								
			rename($destination_file, $rename_filename);

			// print("El archivo se ha guardado en: ".$destination_file);
	
			}
			
	else {print("NO SE HA PODIDO GUARDAR EN ../cbj_Docs/img_clientes/".$new_name);}
		
		}
		
	global $vname;
	$vname = "cbj_clientes";
	$vname = "`".$vname."`";

	$sql = "INSERT INTO `$db_name`.$vname (`ref`, `rsocial`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Direccion`, `Tlf1`, `Tlf2`) VALUES ('$rf', '$_POST[rsocial]', '$new_name', '$_POST[doc]', '$_POST[dni]', '$_POST[ldni]', '$_POST[Email]', '$_POST[Direccion]', '$_POST[Tlf1]', '$_POST[Tlf2]')";
		
	if(mysqli_query($db, $sql)){
		
	//	$fil = "%".$rf."%";
		$pimg =  "SELECT * FROM `$db_name`.$vname WHERE `ref` = '$rf' ";
		$qpimg = mysqli_query($db, $pimg);
		$rowpimg = mysqli_fetch_assoc($qpimg);
		$_SESSION['dudas'] = $rowpimg['myimg'];
		global $dudas;
		$dudas = $_SESSION['dudas'];
		$dudas = trim($dudas);
	//	print("** ".$rowpimg['myimg']);

		print("<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=3 class='BorderInf'>
						HA REGISTRADO UN NUEVO CLIENTE INGRESOS.
					</th>
				</tr>
								
				<tr>
					<td width=150px>
						RAZON SOCIAL
					</td>
					<td width=200px>"
						.$_POST['rsocial'].
					"</td>
					<td rowspan='5' align='center' width='100px'>
	<img src='../cbj_Docs/img_clientes/".$dudas."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						DOCUMENTO
					</td>
					<td>"
						.$_POST['doc'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						NUMERO
					</td>
					<td>"
						.$_POST['dni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						CONTROL
					</td>
					<td>"
						.$_POST['ldni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						MAIL
					</td>
					<td colspan='2'>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
					<td>
						REFERENCIA
					</td>
					<td>"
						.$rf.
					"</td>
				</tr>
				
				<tr>
				
					<td>
						PAIS
					</td>
					<td colspan='2'>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						TELEFONO 1
					</td>
					<td colspan='2'>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				
				<tr>
					<td>
						TELEFONO 2
					</td>
					<td colspan='2'>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
								
			</table>" );
			
				} else {

				print("</br>
				<font color='#FF0000'>
			* MODIFIQUE LA ENTRADA 146: </font></br> ".mysqli_error($db))."
				</br>";
						show_form ();
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
					}
					
	
			}	/* Final process_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){
	
	if($_POST['oculto']){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'rsocial' => '',
									'myimg' => $_POST['myimg'],	
									'ref' => '',
									'doc' => '',
									'dni' => '',
									'ldni' => '',
									'Email' => 'Solo letras minúsculas',
									'Direccion' => '',
									'Tlf1' => '',
									'Tlf2' => '');
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
										);
if (preg_match('/^(\w{1})/',$_POST['rsocial'],$ref1)){	$rf1 = $ref1[1];
														$rf1 = trim($rf1);
																						}
if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['rsocial'],$ref2)){	$rf2 = $ref2[2];
																$rf2 = trim($rf2);
																						}

global $rf;
$rf = $rf1.$rf2.$_POST['dni'].$_POST['ldni'];
$rf = trim($rf);

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							DATOS DEL NUEVO CLIENTE INGRESOS
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
						
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>
						REFERENCIA
					</td>
					<td width=360px>
									SE GENERARÁ UNA REFERENCIA AUTOMÁTICA.
					</td>
				</tr>
					
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>
						RAZON SOCIAL
					</td>
					<td width=360px>
		<input type='text' name='rsocial' size=30 maxlength=30 value='".$defaults['rsocial']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						DOCUMENTO
					</td>
					<td>
					
			<select name='doc'>");

				foreach($doctype as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['doc']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
						
	print ("</select>
					</td>
				</tr>
					

				<tr>
					<td>
						<font color='#FF0000'>*</font>
							NÚMERO
					</td>
					<td>
		<input type='text' name='dni' size=12 maxlength=8 value='".$defaults['dni']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							CONTROL
					</td>
					<td>
		<input type='text' name='ldni' size=4 maxlength=1 value='".$defaults['ldni']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							MAIL
					</td>
					<td>
		<input type='text' name='Email' size=52 maxlength=50 value='".$defaults['Email']."' />
					</td>
				</tr>	
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							DIRECCIÓN
					</td>
					<td>
	<input type='text' name='Direccion' size=52 maxlength=60 value='".$defaults['Direccion']."' />
					</td>
				</tr>
				
				<tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
							TELÉFONO 1
					</td>
					<td>
		<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
					</td>
				</tr>
				
				<tr>
					<tr>
					<td>
						<font color='#FF0000'>&nbsp;</font>
							TELEÉFONO 2
					</td>
					<td>
		<input type='text' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>&nbsp;</font>
						FOTOGRAFIA
					</td>
					<td>
		<input type='file' name='myimg' value='".$defaults['myimg']."' />						
					</td>
				</tr>

				<tr>
					<td colspan='2'  align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='REGISTRAR ESTOS DATOS' />
						<input type='hidden' name='oculto' value=1 />
						<input type='hidden' name='v' value='i' />
						
					</td>
					
				</tr>
				
		</form>														
			
			</table>				
					"); /* Fin del print */
	
	}	/* Fin show_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
				require '../Inclu_MInd/Master_Index_clientes.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $db;
	global $rf;

	$ActionTime = date('H:i:s');
	
	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}

global $text;
$text = "\n- CLIENTES CREAR ".$ActionTime.".\n\tR. Social: ".$_POST['rsocial'].".\n\tDNI: ".$_POST['dni'].$_POST['ldni'].".\n\tReferencia: ".$rf.".\n\tEmail: ".$_POST['Email'].".\n\tDireccion: ".$_POST['Direccion'].".\n\tTlf 1: ".$_POST['Tlf1'].".\n\tTlf 2: ".$_POST['Tlf2'].".";

	global $texerror;
	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.$texerror."\n";
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>