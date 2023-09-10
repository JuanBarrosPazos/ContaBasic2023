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

	function modifica_form_img(){

		global $db; 	global $db_name;	global $img; 	global $imgcamp;

		global $rutaRedir;	$rutaRedir = '';

		global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$_SESSION['midyt1']."`";

		global $ruta; 	$ruta = "../cbj_Docs/docgastos_".$_SESSION['midyt1']."/";
		$_SESSION['ruta'] = $ruta;

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

		global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$_SESSION['midyt1']."`";

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
					
			$_SESSION['miseccion'] = $_SESSION['ref'];
			$_SESSION['miid'] = $_POST['id'];
			$_SESSION['mivalor'] = $_POST['factnum'];
			$_SESSION['minombre'] = $_POST['factnom'];
			$_SESSION['miref'] = $_POST['refprovee'];
			$_SESSION['midyt1'] = $_POST['dyt1'];
		
			global $ruta; 		$ruta = "../cbj_Docs/docgastos_".$_SESSION['midyt1']."/";
			$_SESSION['ruta'] = $ruta;
				
		//	global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$_SESSION['midyt1']."`";

			global $sqlc;
		//	$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `factnum` = '$_POST[factnum]'";
			$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `id` = '$_SESSION[miid]'";
			$qc = mysqli_query($db, $sqlc);
			$rowsc = mysqli_fetch_assoc($qc);
		
			$ext_permitidas = array('pdf','PDF');
			
			$extension1 = substr($rowsc['myimg1'],-3);
			$ext_correcta1 = in_array($extension1, $ext_permitidas);
			if(!$ext_correcta1){ global $myimg1; 	$myimg1 = $rowsc['myimg1'];
								$_SESSION['myimg1'] = $rowsc['myimg1'];
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
	
			global $ruta; 		$ruta = "../cbj_Docs/docgastos_".$_SESSION['midyt1']."/";
			$_SESSION['ruta'] = $ruta;

		//	global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$_SESSION['midyt1']."`";

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
					require 'Gastos_Botones.php';
		
		print("</td>
				</tr>
			</table>");	 

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
					
	function show_form_img($errors=[]){
	
		global $rutPend;	$rutPend = '';
		global $pend;		$pend = "";
		require 'Gastos_Botonera.php';

		global $db; 	
			
		global $ruta;
		$ruta = "../cbj_Docs/docgastos_".$_SESSION['midyt1']."/";
		$_SESSION['ruta'] = $ruta;

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
		}elseif(isset($_POST['imagenmodif'])){
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
					</tr>
					<div style='clear:both'>");
		}
	
		$ext_permitidas = array('pdf','PDF');
		
		$extension = substr($defaults['myimg'],-3);
		$ext_correcta = in_array($extension, $ext_permitidas);
		if(!$ext_correcta){ 	global $myimg1;
								$myimg = $defaults['myimg'];
							}
		else{	global $myimg; 	$myimg = 'pdf.png'; }

	print("<tr>
				<th style='padding-top: 0.6em'>
					SELECCIONE UNA NUEVA IMAGEN
				</th>
			</tr>
			<tr>
				<th>
			LA IMAGEN ACTUAL </br>".strtoupper($defaults['seccion'])." / ".strtoupper($defaults['nombre'])." / ".strtoupper($_SESSION['ImgCbj']).".
						</br></br>
				<form name='cero' method='post' action='$_SERVER[PHP_SELF]' style='display:inline-block;' >
					<!--
					<input type='submit' value='ACTUALIZAR VISTAS' class='botonverde' />
					-->
					".$CachedWhite."".$closeButton."
					<input type='hidden' name='cero' value=1 />
				</form>	
				<div class='img1'>
					<img src='".$ruta.$myimg."' />
				</div>

				</th>
			</tr>
			<tr>
				<td>
					<div style='text-align:center;' >SELECCIONE IMAGEN</div>
					<div style='text-align:center;'>
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
			<input type='file' name='myimg' value='".$defaults['myimg']."' style='color:#fff;' />
				<!--
					<input type='submit' value='MODIFICAR IMAGEN' class='botonnaranja' />
				-->
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