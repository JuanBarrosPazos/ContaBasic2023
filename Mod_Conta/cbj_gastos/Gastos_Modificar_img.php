<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if ($_SESSION['Nivel'] == 'admin'){
					
		global $nombre;			$nombre = @$_POST['Nombre'];
		global $apellido;		$apellido = @$_POST['Apellidos'];
								
			if(isset($_POST['oculto2'])){ 
									process_form();

			} elseif((isset($_POST['mimg1']))||(isset($_POST['mimg2']))||(isset($_POST['mimg3']))||(isset($_POST['mimg4']))){ process_form();

			} elseif(isset($_POST['imagenmodif'])){
									process_form();

			} elseif(isset($_POST['cero'])){
									process_form();
								}

	} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;

	$errors = array();


	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','pdf','PDF','bmp','BMP');
	
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

	/*	elseif(!$tipo_correcto){
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

	function modifica_form(){
	
		global $db; 	global $db_name;
		global $img; 	global $imgcamp;

		global $ruta;
		$ruta = "../cbj_Docs/docgastos_".$_SESSION['midyt1']."/";
		$_SESSION['ruta'] = $ruta;

		$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
		$safe_filename = trim(str_replace('..', '', $safe_filename));

		$nombre = $_FILES['myimg']['name'];
		$nombre_tmp = $_FILES['myimg']['tmp_name'];
		$tipo = $_FILES['myimg']['type'];
		$tamano = $_FILES['myimg']['size'];

		global $destination_file;
		$destination_file = $ruta.$safe_filename;
		
	    if( file_exists($ruta.$nombre) ){
			unlink($ruta.$nombre);
			}
			
		elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){

		// Eliminar el archivo antiguo untitled.png
		if($_SESSION['myimg'] != 'untitled.png' ){
		unlink($ruta.$_SESSION['myimg']);
									}
		// Renombrar el archivo:
		$extension = substr($_FILES['myimg']['name'],-3);
		// print($extension);
		// $extension = end(explode('.', $_FILES['myimg']['name']) );
		//global $new_name;
		//	$new_name = $_SESSION['myimg'];
		date('H:i:s');
		date('Y-m-d');
		$dt = date('is');
		global $new_name;
		$new_name = $_SESSION['mivalor']."_".$dt.".".$extension;
		$rename_filename = $ruta.$new_name;								
		rename($destination_file, $rename_filename);
		
	global $db; 		global $db_name;

	global $mivalor; 	$imgcamp = "`".$_SESSION['imgcamp']."`";
	$mivalor = $_SESSION['mivalor'];
		
	global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$_SESSION['midyt1']."`";
		
$sqla = "UPDATE `$db_name`.$vname SET $imgcamp = '$new_name'  WHERE $vname.`factnum` = '$mivalor' LIMIT 1 ";
		
		if(mysqli_query($db, $sqla)){}
		
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

function process_form(){
	
	global $db; 		global $db_name;

	if(isset($_POST['oculto2'])){
		
		/*
			unset($_SESSION['myimg']);	
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
		
	global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$_SESSION['midyt1']."`";

		$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `factnum` = '$_POST[factnum]'";
		$qc = mysqli_query($db, $sqlc);
		$rowsc = mysqli_fetch_assoc($qc);
	
		$ext_permitidas = array('pdf','PDF');
		
		$extension1 = substr($rowsc['myimg1'],-3);
		$ext_correcta1 = in_array($extension1, $ext_permitidas);
		if(!$ext_correcta1){ 	global $myimg1;
								$myimg1 = $rowsc['myimg1'];
								$_SESSION['myimg1'] = $myimg1;
							}
		else{	global $myimg1;
				$myimg1 = 'pdf.png';
				$_SESSION['myimg1'] = $myimg1;
			}

		$extension2 = substr($rowsc['myimg2'],-3);
		$ext_correcta2 = in_array($extension2, $ext_permitidas);
		if(!$ext_correcta2){ 	global $myimg2;
								$myimg2 = $rowsc['myimg2'];
								$_SESSION['myimg2'] = $myimg2;
							}
		else{	global $myimg2;
				$myimg2 = 'pdf.png';
				$_SESSION['myimg2'] = $myimg2;
			}

		$extension3 = substr($rowsc['myimg3'],-3);
		$ext_correcta3 = in_array($extension3, $ext_permitidas);
		if(!$ext_correcta3){ 	global $myimg3;
								$myimg3 = $rowsc['myimg3'];
								$_SESSION['myimg3'] = $myimg3;
							}
		else{	global $myimg3;
				$myimg3 = 'pdf.png';
				$_SESSION['myimg3'] = $myimg3;
			}

		$extension4 = substr($rowsc['myimg4'],-3);
		$ext_correcta4 = in_array($extension4, $ext_permitidas);
		if(!$ext_correcta4){ 	global $myimg4;
								$myimg4 = $rowsc['myimg4'];
								$_SESSION['myimg4'] = $myimg4;
							}
		else{	global $myimg4;
				$myimg4 = 'pdf.png';
				$_SESSION['myimg4'] = $myimg4;
			}

	
	} else {		
	
		global $ruta; 		$ruta = "../cbj_Docs/docgastos_".$_SESSION['midyt1']."/";
		$_SESSION['ruta'] = $ruta;

		global $vname; 		$vname = "`".$_SESSION['clave']."gastos_".$_SESSION['midyt1']."`";

		$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `factnum` = '$_SESSION[mivalor]'";
		$qc = mysqli_query($db, $sqlc);
		$rowsc = mysqli_fetch_assoc($qc);
									
		$ext_permitidas = array('pdf','PDF');
		
		$extension1 = substr($rowsc['myimg1'],-3);
		$ext_correcta1 = in_array($extension1, $ext_permitidas);
		if(!$ext_correcta1){ 	global $myimg1;
								$myimg1 = $rowsc['myimg1'];
								$_SESSION['myimg1'] = $myimg1;
							}
		else{	global $myimg1;
				$myimg1 = 'pdf.png';
				$_SESSION['myimg1'] = $rowsc['myimg1'];
			}

		$extension2 = substr($rowsc['myimg2'],-3);
		$ext_correcta2 = in_array($extension2, $ext_permitidas);
		if(!$ext_correcta2){ 	global $myimg2;
								$myimg2 = $rowsc['myimg2'];
								$_SESSION['myimg2'] = $myimg2;
							}
		else{	global $myimg2;
				$myimg2 = 'pdf.png';
				$_SESSION['myimg2'] = $rowsc['myimg2'];
			}

		$extension3 = substr($rowsc['myimg3'],-3);
		$ext_correcta3 = in_array($extension3, $ext_permitidas);
		if(!$ext_correcta3){ 	global $myimg3;
								$myimg3 = $rowsc['myimg3'];
								$_SESSION['myimg3'] = $myimg3;
							}
		else{	global $myimg3;
				$myimg3 = 'pdf.png';
				$_SESSION['myimg3'] = $rowsc['myimg3'];
			}

		$extension4 = substr($rowsc['myimg4'],-3);
		$ext_correcta4 = in_array($extension4, $ext_permitidas);
		if(!$ext_correcta4){ 	global $myimg4;
								$myimg4 = $rowsc['myimg4'];
								$_SESSION['myimg4'] = $myimg4;
							}
		else{	global $myimg4;
				$myimg4 = 'pdf.png';
				$_SESSION['myimg4'] = $rowsc['myimg4'];
			}

		}

		print(" <table class='detalle' align='center' >
				<tr>
					<th colspan=4 class='BorderInf'>
		SECCION: ".strtoupper($_SESSION['clave']."gastos_".$_SESSION['midyt1']).".
							</br> 
FACTURA Nº: ".$_SESSION['mivalor'].". R. Social: ".$_SESSION['minombre'].". ID: ".$_SESSION['miid']."
					</th>
				</tr>
				
        <tr>
          <td class='img1'>
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		  <img src='".$ruta.$myimg1."'  onclick=\"MM_showHideLayers('contenedor','','show','foto1A','','show','foto2A','','hide','foto3A','','hide','foto4A','','hide')\" onload=\"MM_showHideLayers('foto1A','','show','foto2A','','hide','foto3A','','hide','foto4A','','hide')\" /> 
			<input name='mimg1' type='hidden' value='".$_SESSION['myimg1']."' />
			<input type='submit' value='MODIF IMG 1' class='botonnaranja' />
			<input type='hidden' name='mimg1' value=1 />
</form>		  
		  </td>
		  
          <td class='img1'>
 <form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		  <img src='".$ruta.$myimg2."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','show','foto3A','','hide','foto4A','','hide')\" /> 
			<input name='mimg2' type='hidden' value='".$_SESSION['myimg2']."' />
			<input type='submit' value='MODIF IMG 2' class='botonnaranja' />
			<input type='hidden' name='mimg2' value=1 />
</form>		  
		  </td>
		  
          <td class='img1'>
 <form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		  <img src='".$ruta.$myimg3."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','hide','foto3A','','show','foto4A','','hide')\" /> 
			<input name='mimg3' type='hidden' value='".$_SESSION['myimg3']."' />
			<input type='submit' value='MODIF IMG 3' class='botonnaranja' />
			<input type='hidden' name='mimg3' value=1 />
</form>		  
		  </td>
		  
          <td class='img1'>
 <form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		  <img src='".$ruta.$myimg4."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','hide','foto3A','','hide','foto4A','','show')\" /> 
			<input name='mimg4' type='hidden' value='".$_SESSION['myimg4']."' />
			<input type='submit' value='MODIF IMG 4' class='botonnaranja' />
			<input type='hidden' name='mimg4' value=1 />
</form>		  
		  </td>
       </tr>");
       
	$printimg =	"<tr>
					<td  colspan=4>
						<div id='foto1A' class='img2'><img src='".$ruta.$myimg1."' /></div>
						<div id='foto2A' class='img2'><img src='".$ruta.$myimg2."' /></div>
						<div id='foto3A' class='img2'><img src='".$ruta.$myimg3."' /></div>
						<div id='foto4A' class='img2'><img src='".$ruta.$myimg4."' /></div>
					</td>
				</tr>";
			
	if((isset($_POST['mimg1']))||(isset($_POST['mimg2']))||(isset($_POST['mimg3']))||(isset($_POST['mimg4']))){
			show_form();
	} elseif(isset($_POST['imagenmodif'])){
				if($form_errors = validate_form()){
						show_form($form_errors);
				} else { modifica_form();
						 show_form();
						 info();
							}
	} elseif(isset($_POST['cero'])){ print($printimg);
							
	} else { print($printimg); }
	print(" <tr>
				<td colspan=4 style='text-align: right;' >
					<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
						<input type='submit' value='CERRAR VENTANA' class='botonverde' />
						<input type='hidden' name='oculto2' value=1 />
					</form>
				</td>
			</tr>
			</table>");	 

		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
					
function show_form($errors=[]){
	
	global $db; 	
		
	global $ruta;
	$ruta = "../cbj_Docs/docgastos_".$_SESSION['midyt1']."/";
	$_SESSION['ruta'] = $ruta;

	if(isset($_POST['mimg1'])){	$_SESSION['myimg'] = $_SESSION['myimg1'];
								$_SESSION['imgcamp'] = "myimg1";}
	if(isset($_POST['mimg2'])){	$_SESSION['myimg'] = $_SESSION['myimg2'];
								$_SESSION['imgcamp'] = "myimg2";}
	if(isset($_POST['mimg3'])){	$_SESSION['myimg'] = $_SESSION['myimg3'];
								$_SESSION['imgcamp'] = "myimg3";}
	if(isset($_POST['mimg4'])){	$_SESSION['myimg'] = $_SESSION['myimg4'];
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
									'myimg' => $_SESSION['myimg']);
								}

	elseif(isset($_POST['imagenmodif'])){
				$defaults = array ( 'seccion' => $_SESSION['miseccion'],
									'id' => $_SESSION['miid'],
									'valor' => $_SESSION['mivalor'],
									'nombre' => $_SESSION['minombre'],
									'ref' => $_SESSION['miref'],									
									'myimg' => $_SESSION['myimg']);
								}

	if ($errors){
		print("<tr>
					<th colspan=4 style='text-align:center'>
						<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					</th>
				</tr>
				<tr>
					<td colspan=4 style='text-align:center' >");
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
		else{	global $myimg;
				$myimg = 'pdf.png';
			}

	print("<tr>
				<th colspan=4 style='padding-top: 0.6em'>
					SELECCIONE UNA NUEVA IMAGEN
				</th>
			</tr>
			<tr>
				<th colspan=2>
					LA IMAGEN ACTUAL </br>".strtoupper($defaults['seccion'])." / ".strtoupper($defaults['nombre'])." / ".strtoupper($_SESSION['myimg']).".
						</br></br>
				<form name='cero' method='post' action='$_SERVER[PHP_SELF]'>
					<input type='submit' value='ACTUALIZAR VISTAS' class='botonverde' />
					<input type='hidden' name='cero' value=1 />
				</form>														
					</th>
			
				<th colspan=2>
					<img src='".$ruta.$myimg."' height='120px' width='90px' />
				</th>
			</tr>
			<tr>
				<td colspan=2 style='text-align:center;' >SELECCIONE IMAGEN</td>
				<td colspan=2>
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
			<input size=14 type='file' name='myimg' value='".$defaults['myimg']."' style='color:#fff;' />
				</td>
			</tr>
			<tr>
				<td colspan=4 align='center'>
					<input type='submit' value='MODIFICAR IMAGEN' class='botonnaranja' />
					<input type='hidden' name='imagenmodif' value=1 />
			</form>														
				</td>
			</tr>");

		}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info(){

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

	require '../Inclu/Conta_Footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

		
?>