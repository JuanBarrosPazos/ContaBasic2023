<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_popup.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';

	require '../Inclu/sqld_query_fetch_assoc.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

		if ($_SESSION['Nivel'] == 'admin'){

 		print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".</br>");
				
							if ($_POST['oculto2']){
								show_form();
								}
							elseif($_POST['imagenmodif']){
								
									if($form_errors = validate_form()){
										show_form($form_errors);
											} else {
												process_form();
												info();
												}
								
								} else {
											show_form();
										}
		} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;
	

	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','bmp','BMP');
	
	$extension = substr($_FILES['myimg']['name'],-3);
	// print($extension);
	// $extension = end(explode('.', $_FILES['myimg']['name']) );
	$ext_correcta = in_array($extension, $ext_permitidas);

	// $tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg']['type']);

		if($_FILES['myimg']['size'] == 0){
			$errors [] = "Ha de seleccionar una fotograf&iacute;a.";
		}
		 
		elseif(!$ext_correcta){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg']['name'];
			}
	/*
		elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg']['name'];
			}
	*/
	elseif ($_FILES['myimg']['size'] > $limite){
	$tamanho = $_FILES['myimg']['size'] / 1024;
	$errors [] = "El archivo".$_FILES['myimg']['name']." es mayor de 500 KBytes. ".$tamanho." KB";
			}
		
			elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
					
	return $errors;

		} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;

	global $vname;
	$vname = "cbj_proveedores";
	$vname = "`".$vname."`";

	
	global $safe_filename;
		$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
		$safe_filename = trim(str_replace('..', '', $safe_filename));

		$nombre = $_FILES['myimg']['name'];
		$nombre_tmp = $_FILES['myimg']['tmp_name'];
		$tipo = $_FILES['myimg']['type'];
		$tamano = $_FILES['myimg']['size'];

	global $destination_file;
		$destination_file = "../cbj_Docs/img_proveedores/".$safe_filename;
		
	    if( file_exists("../cbj_Docs/img_proveedores/".$nombre) ){
			unlink("../cbj_Docs/img_proveedores/".$nombre);
			}
			
		elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){

		unlink("../cbj_Docs/img_proveedores/".$_SESSION['myimgx']);
									
		// Renombrar el archivo:
		$extension = substr($_FILES['myimg']['name'],-3);
		// print($extension);
		// $extension = end(explode('.', $_FILES['myimg']['name']) );
		date('H:i:s');
		date('Y-m-d');
		$dt = date('is');
		global $new_name;
		$nn = $_SESSION['refx'];
		$new_name = $nn."_".$dt.".".$extension;
		global $rename_filename;
		$rename_filename = "../cbj_Docs/img_proveedores/".$new_name;	
		rename($destination_file, $rename_filename);
		
		global $db;
		global $db_name;

		$id = $_SESSION['idx'];
		
		global $dniold;
		$dinold = $_SESSION['dniold'];
		$dinold = trim($dinold);
		
$sqla = "UPDATE `$db_name`.$vname SET `myimg` = '$new_name'  WHERE $vname.`dni` = '$dinold' LIMIT 1 ";
		
	if(mysqli_query($db, $sqla)){print("");}else {
				print("</br><font color='#FF0000'>* ERROR </font>".mysqli_error($db));}

	if(mysqli_query($db, $sqla)){
			
		print("<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=3  class='BorderInf'>
						NUEVOS DATOS
					</th>
				</tr>
				
				<tr>
					<td width=200px>
						RAZON SOCIAL
					</td>
					<td width=200px>"
						.$_POST['rsocial'].
					"</td>
					<td rowspan='4' align='center' width='100px'>
<img src='../cbj_Docs/img_proveedores/".$new_name."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						REFERENCIA
					</td>
					<td>"
						.$_POST['ref'].
					"</td>
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
						NÚMERO
					</td>
					<td>"
						.$_POST['dni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						CONTROL
					</td>
					<td colspan=2>"
						.$_POST['ldni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						MAIL
					</td>
					<td colspan=2>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
				
					<td>
						DIRECCIÓN
					</td>
					<td colspan=2>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						TELÉFONO 1
					</td>
					<td colspan=2>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>
						TELÉFONO 2
					</td>
					<td colspan=2>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
												
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
											<input type='submit' value='CERRAR VENTANA' />
											<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
			</table>	
						");
						
								unset($_SESSION['myimgx']);
								unset($_SESSION['refx']);
								unset($_SESSION['idx']);

					}
		
					 else {
							print("* ERROR ".mysqli_error($db));
									show_form ();
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
																			}
						}
						
		else {print("NO SE HA PODIDO GUARDAR EN ../imgpro/imgpro".$_SESSION['miseccion']."/");}



			}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
global $dt;
global $db; 	
	
	$_SESSION['myimgx'] = $_POST['myimg'];
	$_SESSION['refx'] = $_POST['ref'];
	$_SESSION['idx'] = $_POST['id'];
	$_SESSION['dniold'] = $_POST['dni'];

	global $sesionref;
	$sesionref = $_SESSION['ref'];

	if($_POST['oculto2']){
				$defaults = array ( 'rsocial' => $_POST['rsocial'],
									'myimg' => $_POST['myimg'],	
									'ref' => $_POST['ref'],
									'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2']);
								   								}
								   
		elseif($_POST['imagenmodif']){
				global $img2;
				$defaults = array ( 'rsocial' => $_POST['rsocial'],
									'myimg' => $_POST['myimg'],	
									'ref' => $_POST['ref'],
									'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2']);
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
		
	print("
			<table align='center' border=0 style='margin-top:90px;'>
			
				<tr>
					<th colspan=2 class='BorderInf'>
						SELECCIONE UNA NUEVA IMAGEN.
					</th>
				</tr>
				
				<tr>
					<th class='BorderInf'>
				LA IMAGEN ACTUAL DE : </br>".$defaults['rsocial']."
					</th>
					<th class='BorderInf'>
<img src='../cbj_Docs/img_proveedores/".$defaults['myimg']."' height='120px' width='90px' />
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
			
				<tr>
					<td>
							Seleccione una Fotografía:	
					</td>
					<td>
		<input type='file' name='myimg' value='".$defaults['myimg']."' />						
					</td>
				</tr>

			
	<input type='hidden' name='id' value='".$defaults['id']."' />					
	<input type='hidden' name='ref' value='".$defaults['ref']."' />					
	<input type='hidden' name='rsocial' value='".$defaults['rsocial']."' />
	<input type='hidden' name='doc' value='".$defaults['doc']."' />
	<input type='hidden' name='dni' value='".$defaults['dni']."' />
	<input type='hidden' name='ldni' value='".$defaults['ldni']."' />
	<input type='hidden' name='Email' value='".$defaults['Email']."' />
	<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
	<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
	<input type='hidden' name='Tlf2' value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				
				<tr align='center' height=60px>
					<td>
					</td>
					<td >
						<input type='submit' value='MODIFICAR LA IMAGEN' />
						<input type='hidden' name='imagenmodif' value=1 />
						
					</td>
					
					<td align='right'>
						
					</td>
				</tr>
				
		</form>														
			
				<tr>
					<td class='BorderSup'>
					</td>
					<td align='right' class='BorderSup'>
					</td>
				</tr>
				
				<tr>
					<td class='BorderSup'>
					</td>
					<td align='right' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
											<input type='submit' value='CERRAR VENTANA' />
											<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
			</table>				
			

				"); 

	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
				require '../Inclu_MInd/Master_Index_Proveedores.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $db;
	global $destination_file;	
	global $rename_filename;

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}

global $text;
$text = "\n- PROVEEDORES IMG MODIFICADA ".$ActionTime.".\n\tR. Social: ".$_POST['rsocial'].".\n\tDNI: ".$_POST['dni'].$_POST['ldni'].".\n\tReferencia: ".$_POST['ref'].".\n\t".$destination_file.".\n\t".$rename_filename;

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
	
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>