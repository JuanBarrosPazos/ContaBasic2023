<?php
	//session_start();

	//require '../../Mod_Admin/Inclu/error_hidden.php';
	//require '../Inclu/Conta_Head.php';
	//require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	//require '../../Mod_Admin/Conections/conection.php';
	//require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/*
	if ($_SESSION['Nivel'] == 'admin'){
					
		global $nombre;			$nombre = @$_POST['Nombre'];
		global $apellido;		$apellido = @$_POST['Apellidos'];
								
		if(isset($_POST['oculto2'])){ 
								process_form_img();
		}elseif((isset($_POST['mimg1']))||(isset($_POST['mimg2']))||(isset($_POST['mimg3']))||(isset($_POST['mimg4']))){ process_form_img();

		}elseif(isset($_POST['imagenmodif'])){
								process_form_img();

		}elseif(isset($_POST['cero'])){
								process_form_img();
								}

	} else { require '../Inclu/table_permisos.php'; }
	*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function validate_form_img(){

		global $sqld; 		global $qd; 	global $rowd;

		require 'ValidateImgMod.php';
		
		return $errors;

	}  // FIN VALIDATE_FOMR()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function borra_img(){

		global $db; 	global $db_name; 	global $vname;	global $imgcamp;


		global $rutaRedir;	$rutaRedir = '';

		global $rutaDir; 	$rutaDir = "../cbj_Docs/docgastos_".$_SESSION['midyt1']."/";
		$_SESSION['ruta'] = $rutaDir;
		
		global $safe_filename;
		$safe_filename = trim(str_replace('/', '', $_POST['myimg']));
		$safe_filename = trim(str_replace('..', '', $safe_filename));
		//echo "LA IMAGEN ES ".$safe_filename."<br>";

		global $nombre;	$nombre = $_POST['myimg'];

		global $destination_file;
		$destination_file = $rutaDir.$safe_filename;
		
	    if(file_exists($rutaDir.$nombre)){
						unlink($rutaDir.$nombre);
		}else{ }
		
		
		if(!file_exists($rutaDir.$nombre)){

			//copy($rutaDir."untitled.png", $rutaDir.$nombre);

			if(copy($rutaDir."untitled.png", $destination_file)){

				// Eliminar el archivo antiguo untitled.png
				if($_SESSION['ImgCbj'] != 'untitled.png' ){
							//@unlink($rutaDir.$_SESSION['ImgCbj']);
											}
				// Renombrar el archivo:
				$extension = substr($nombre,-3);
				// print($extension);
				// $extension = end(explode('.', $_FILES['myimg']['name']) );
				//global $new_name;
				//	$new_name = $_SESSION['ImgCbj'];
				date('H:i:s');
				date('Y-m-d');
				$dt = date('is');
				global $new_name;
				$new_name = $_SESSION['mivalor']."_".$dt.".".$extension;
				$rename_filename = $rutaDir.$new_name;								
				rename($destination_file, $rename_filename);

				global $db; 		global $db_name;

				global $mivalor; 	$imgcamp = "`".$_SESSION['imgcamp']."`";
				$mivalor = $_SESSION['mivalor'];
				
				$sqla = "UPDATE `$db_name`.$vname SET $imgcamp = '$new_name' WHERE $vname.`id` = '$_SESSION[miid]' AND $vname.`factnum` = '$mivalor' LIMIT 1 ";
				
				if(mysqli_query($db, $sqla)){
					
					global $redir;
					$redir = "<script type='text/javascript'>
									function redir(){
									window.location.href='Gastos_".$rutaRedir."Ver.php?imagen=1';
								}
								setTimeout('redir()',2);
								</script>";
					print ($redir);

				}else { print("* ERROR ".mysqli_error($db));
						show_form ();
						global $texerror;		$texerror = "\n\t ".mysqli_error($db);
							}
							
			}else{print("NO SE HA PODIDO GUARDAR EN ../imgpro/imgpro".$_SESSION['miseccion']."/");}

		} // FIN LA FILE NO EXISTE


	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function modifica_form_img(){

		//global $db; 	global $db_name;	global $img; 	global $imgcamp; 	global $vname;

		global $rutaRedir;	$rutaRedir = '';

		global $rutaDir; 	$rutaDir = "../cbj_Docs/docgastos_".$_SESSION['midyt1']."/";
		$_SESSION['ruta'] = $rutaDir;

		require 'FormImgMod.php';
		
	} // FIN MODIFICA_FORM_IMG()
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form_img(){
	
		global $rutPend;	$rutPend = '';
		global $pend;		$pend = "";
		require 'Gastos_Botonera.php';
	
		global $db; 	global $db_name;

		if(isset($_POST['oculto2'])){
		
			/*
				unset($_SESSION['ImgCbj']);	
				unset($_SESSION['myimg1']);
				unset($_SESSION['myimg2']);
				unset($_SESSION['myimg3']);
				unset($_SESSION['myimg4']);	
				unset($_SESSION['miseccion']);	
				unset($_SESSION['miid']);	
				unset($_SESSION['mivalor']);	
				unset($_SESSION['minombre']);	
				unset($_SESSION['miref']);	
				unset($_SESSION['midyt1']);	
			*/

			$_SESSION['factdate'] = $_POST['factdate'];
			$_SESSION['miseccion'] = $_SESSION['ref'];
			$_SESSION['miid'] = $_POST['id'];
			$_SESSION['mivalor'] = $_POST['factnum'];
			$_SESSION['minombre'] = $_POST['factnom'];
			$_SESSION['miref'] = $_POST['refprovee'];

			$_SESSION['midyt1'] = substr($_POST['vname'],-5,-1);
			// $_SESSION['midyt1'] = $_POST['dyt1'];
			//$_SESSION['midyt1'] = $_POST['dyt1'];
		//echo $_SESSION['midyt1'];
			global $rutaDir; 		$rutaDir = "../cbj_Docs/docgastos_".$_SESSION['midyt1']."/";
			$_SESSION['ruta'] = $rutaDir;
				
			global $vname;	
			$vname = $_POST['vname'];	//$vname = "`".$_SESSION['clave']."gastos_".$_SESSION['midyt1']."`";

			global $sqlc;
		//	$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `factnum` = '$_POST[factnum]'";
			$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `id` = '$_SESSION[miid]'";
			$qc = mysqli_query($db, $sqlc);
			$rowsc = mysqli_fetch_assoc($qc);
		// echo "<br>** ".$sqlc."<br";
			$ext_permitidas = array('pdf','PDF');
			
			@$extension1 = substr($rowsc['myimg1'],-3);
			$ext_correcta1 = in_array($extension1, $ext_permitidas);
			if(!$ext_correcta1){ global $myimg1; 	$myimg1 = $rowsc['myimg1'];
								@$_SESSION['myimg1'] = $rowsc['myimg1'];
			}else{	global $myimg1; 	$myimg1 = 'pdf.png';
					$_SESSION['myimg1'] = $myimg1;
						}

			$extension2 = substr($rowsc['myimg2'],-3);
			$ext_correcta2 = in_array($extension2, $ext_permitidas);
			if(!$ext_correcta2){ global $myimg2; 	$myimg2 = $rowsc['myimg2'];
								$_SESSION['myimg2'] = $rowsc['myimg2'];
			}else{	global $myimg2; 	$myimg2 = 'pdf.png';
					$_SESSION['myimg2'] = $myimg2;
						}

			$extension3 = substr($rowsc['myimg3'],-3);
			$ext_correcta3 = in_array($extension3, $ext_permitidas);
			if(!$ext_correcta3){ global $myimg3; 	$myimg3 = $rowsc['myimg3'];
								$_SESSION['myimg3'] = $rowsc['myimg3'];
			}else{	global $myimg3; 	$myimg3 = 'pdf.png';
					$_SESSION['myimg3'] = $myimg3;
						}

			$extension4 = substr($rowsc['myimg4'],-3);
			$ext_correcta4 = in_array($extension4, $ext_permitidas);
			if(!$ext_correcta4){ global $myimg4; 	$myimg4 = $rowsc['myimg4'];
								$_SESSION['myimg4'] = $rowsc['myimg4'];
			}else{	global $myimg4; 	$myimg4 = 'pdf.png';
					$_SESSION['myimg4'] = $myimg4;
						}
	
		}else{		
	
			global $rutaDir; 		$rutaDir = "../cbj_Docs/docgastos_".$_SESSION['midyt1']."/";
			$_SESSION['ruta'] = $rutaDir;

			global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$_SESSION['midyt1']."`";

			global $sqlc;
		//	$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `factnum` = '$_SESSION[mivalor]'";
			$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `id` = '$_SESSION[miid]'";
			$qc = mysqli_query($db, $sqlc);
			$rowsc = mysqli_fetch_assoc($qc);
										
			$ext_permitidas = array('pdf','PDF');
			
			$extension1 = substr($rowsc['myimg1'],-3);
			$ext_correcta1 = in_array($extension1, $ext_permitidas);
			if(!$ext_correcta1){ global $myimg1; 	 $myimg1 = $rowsc['myimg1'];
								 $_SESSION['myimg1'] = $rowsc['myimg1'];
			}else{	global $myimg1; 	$myimg1 = 'pdf.png';
					$_SESSION['myimg1'] = $rowsc['myimg1'];
						}

			$extension2 = substr($rowsc['myimg2'],-3);
			$ext_correcta2 = in_array($extension2, $ext_permitidas);
			if(!$ext_correcta2){ global $myimg2;
								 $myimg2 = $rowsc['myimg2'];
								 $_SESSION['myimg2'] = $rowsc['myimg2'];
			}else{	global $myimg2; 	$myimg2 = 'pdf.png';
					$_SESSION['myimg2'] = $rowsc['myimg2'];
						}

			$extension3 = substr($rowsc['myimg3'],-3);
			$ext_correcta3 = in_array($extension3, $ext_permitidas);
			if(!$ext_correcta3){ 	global $myimg3; 	$myimg3 = $rowsc['myimg3'];
									$_SESSION['myimg3'] = $rowsc['myimg3'];
			}else{	global $myimg3; 	$myimg3 = 'pdf.png';
					$_SESSION['myimg3'] = $rowsc['myimg3'];
						}

			$extension4 = substr($rowsc['myimg4'],-3);
			$ext_correcta4 = in_array($extension4, $ext_permitidas);
			if(!$ext_correcta4){ global $myimg4; 	 $myimg4 = $rowsc['myimg4'];
								 $_SESSION['myimg4'] = $rowsc['myimg4'];
			}else{	global $myimg4; 	$myimg4 = 'pdf.png';
					$_SESSION['myimg4'] = $rowsc['myimg4'];
						}
		}

		require 'TableImgModif.php';

		if((isset($_POST['mimg1']))||(isset($_POST['mimg2']))||(isset($_POST['mimg3']))||(isset($_POST['mimg4']))){
							show_form_img();
		}elseif(isset($_POST['borraimg'])){
			if(!isset($_POST['xl'])){
							print("<div style='text-align:center; margin:auto;'>
										* HA DE MARCAR LA CASILLA DE CONFIRMACIÓN
									</div>");
							show_form_img();
			}elseif(isset($_POST['xl'])){
							echo "0 HE PASADO LA VALIDACIÓN<br>";
							borra_img();
							//modifica_form_img();
							show_form_img();
							//info_img();
						}
		}elseif(isset($_POST['imagenmodif'])){
			if($form_errors = validate_form_img()){
						show_form_img($form_errors);
			}else{  modifica_form_img();
					show_form_img();
					info_img();
						}
		}elseif(isset($_POST['cero'])){ print($printimg);
									
		}else{ print($printimg); }

		print(" <tr>
					<td style='text-align: center;' >");

		global $ModImg2;		$ModImg2 = "style='display:none; visibility: hidden;'";
		global $ConteBotones;	$ConteBotones = "style='display:block;'";

		global $a;	$a= (substr($_SESSION['factdate'],0,4));
		global $vnameStatus; 		$vnameStatus = "`".$_SESSION['clave']."status`";
		$sqlSTatus =  "SELECT * FROM $vnameStatus WHERE `year`='$a' LIMIT 1 ";
		$qStauts = mysqli_query($db, $sqlSTatus);
		$rowStatus = mysqli_fetch_assoc($qStauts);

		global $style;
		if($rowStatus['stat']==''){
		//if($rowStatus['stat']=='close'){
			global $Borrar2;		$Borrar2= "style='display:none; visibility: hidden;'";
			global $Modif2;			$Modif2= "style='display:none; visibility: hidden;'";
			global $PendienteG;		$PendienteG = "style='display:none; visibility: hidden;'";
			global $Recupera3;		$Recupera3 = "style='display:none; visibility: hidden;'";
		}else{ }

		require 'Gastos_Botones.php';
		
		print("</td>
				</tr>
			</table>");	 

		echo "<br>** ".$sqlc."<br";

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
					
	function show_form_img($errors=[]){
	
		global $rutPend;	$rutPend = '';
		global $pend;		$pend = "";
		require 'Gastos_Botonera.php';

		global $db; 	
			
		global $rutaDir;
		$rutaDir = "../cbj_Docs/docgastos_".$_SESSION['midyt1']."/";
		$_SESSION['ruta'] = $rutaDir;

		if(isset($_POST['mimg1'])){	$_SESSION['ImgCbj'] = $_SESSION['myimg1'];
									$_SESSION['imgcamp'] = "myimg1";}
		if(isset($_POST['mimg2'])){	$_SESSION['ImgCbj'] = $_SESSION['myimg2'];
									$_SESSION['imgcamp'] = "myimg2";}
		if(isset($_POST['mimg3'])){	$_SESSION['ImgCbj'] = $_SESSION['myimg3'];
									$_SESSION['imgcamp'] = "myimg3";}
		if(isset($_POST['mimg4'])){	$_SESSION['ImgCbj'] = $_SESSION['myimg4'];
									$_SESSION['imgcamp'] = "myimg4";}

		if(isset($_POST['oculto2'])){
					$defaults = array ( 'seccion' => '',
										'id' => '',
										'valor' => '',
										'nombre' => '',
										'ref' => '',										
										'myimg' => '');
									}
								   
		elseif((isset($_POST['mimg1']))||(isset($_POST['mimg2']))||(isset($_POST['mimg3']))||(isset($_POST['mimg4']))){
				$defaults = array ( 'seccion' => $_SESSION['miseccion'],
									'id' => $_SESSION['miid'],
									'valor' => $_SESSION['mivalor'],
									'nombre' => $_SESSION['minombre'],
									'ref' => $_SESSION['miref'],									
									'myimg' => $_SESSION['ImgCbj']);
		}elseif((isset($_POST['imagenmodif']))||(isset($_POST['borraimg']))){
				$defaults = array ( 'seccion' => $_SESSION['miseccion'],
									'id' => $_SESSION['miid'],
									'valor' => $_SESSION['mivalor'],
									'nombre' => $_SESSION['minombre'],
									'ref' => $_SESSION['miref'],									
									'myimg' => $_SESSION['ImgCbj']);
			}

		if ($errors){
			print("<tr>
						<th style='text-align:center'>
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</th>
					</tr>
					<tr>
						<td style='text-align:center' >");
			for($a=0; $c=count($errors), $a<$c; $a++){
				print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
				}
			print("</td>
					</tr>");
		}
	
		$ext_permitidas = array('pdf','PDF');
		
		$extension = substr($defaults['myimg'],-3);
		$ext_correcta = in_array($extension, $ext_permitidas);
		if(!$ext_correcta){ 	global $myimg1;
								$myimg = $defaults['myimg'];
							}
		else{	global $myimg; 	$myimg = 'pdf.png'; }

		global $DeleteWhiteTit;		$DeleteWhiteTit = "BORRAR ESTA IMAGEN";

		global $TituloCheck;	$TituloCheck = "CONFIRME EL BORRADO CON EL CHECKBOX";
		global $checked;
		if(@$defaults['xl'] == 'yes') { $checked = "checked='checked'";}else{ $checked = ""; }
		
		global $Checkbox;
		$Checkbox = "<input type='checkbox' name='xl' value='yes' ".$checked." style='text-align:center; display:inline-block; vertical-align:middle; margin: 0.7em 0.2em 0.1em 0.8em;'/>";

	print("<tr>
				<th style='padding-top: 0.6em'>SELECCIONE UNA NUEVA IMAGEN</th>
			</tr>
			<tr>
				<th>
			LA IMAGEN ACTUAL </br>".strtoupper($defaults['seccion'])." / ".strtoupper($defaults['nombre'])." / ".strtoupper($_SESSION['ImgCbj']).".
						</br></br>
				<form name='cero' method='post' action='$_SERVER[PHP_SELF]' style='display:inline-block;' >
					".$CachedWhite."".$closeButton."
					<input type='hidden' name='cero' value=1 />
				</form>	
				
				<div class='img1'>
					<img src='".$rutaDir.$myimg."' />
				</div>

				<form name='borraimg' method='post' action='$_SERVER[PHP_SELF]' style='display:inline-block;' >
				
					<input type='hidden' name='myimg' value='".$defaults['myimg']."' style='color:#fff;' />
						<div style='display:inline-block;'>".$defaults['myimg']."
						".$DeleteWhite.$closeButton.$Checkbox."
						<input type='hidden' name='borraimg' value=1 />
				</form>

				</th>
			</tr>
			<tr>
				<td>
					<div style='text-align:center;' >SELECCIONE IMAGEN</div>
					<div style='text-align:center;'>
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
			<input type='file' name='myimg' value='".$defaults['myimg']."' style='color:#fff;' />
					".$SaveBlack.$closeButton."
					<input type='hidden' name='imagenmodif' value=1 />
		</form>														
					</div>
				</td>
			</tr>");

		}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info_img(){

		global $db; 		global $destination_file;
		global $new_name; 	global $mivalor;

		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cbj_Docs/log";
					}
		
		global $text;
		$text = "- IMAGEN GASTOS MODIFICADA ".$ActionTime."\n\tNº FACT. ".$mivalor."\n\tCAMPO: ".$_SESSION['imgcamp'].".\n\tNOMBRE: ".$destination_file."\n\tNUEVO NOMBRE: ".$new_name;

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

	//require '../Inclu/Conta_Footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

		
?>