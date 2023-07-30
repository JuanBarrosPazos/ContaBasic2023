<?php

	require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01a.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if(isset($_POST['oculto'])){
		if($form_errors = validate_form()){
				show_form($form_errors);
						} else {process_form();
								modif();
								modif2();
										}
	} else {show_form();}
								
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function config_one(){
	
	if(file_exists('../index.php')){unlink("../index.php");
					$data1 = "\n \t UNLINK ../index.php";}
			else {print("ERROR UNLINK ../index.php </br>");
					$data1 = "\n \t ERROR UNLINK ../index.php";}

	if(!file_exists('../index.php')){
			if(file_exists('index_Play_System.php')){
				copy("index_Play_System.php", "../index_Play_System.php");
				$data2 = "\n \t COPY ../index_Play_System.php";
				} else {print("ERROR COPY index_Play_System.php </br>");
						$data2 = "\n \t ERROR COPY index_Play_System.php";}
			} 

	if(file_exists('../index_Play_System.php')){
				rename("../index_Play_System.php", "../index.php");
				$data3 = "\n \t RENAME ../index_Play_System.php TO ../index.php";
			} else {print("ERROR RENAME ../index_Play_System.php TO ../index.php </br>");
				$data3 = "\n \t ERROR RENAME ../index_Play_System.php TO ../index.php";}

	/*		****	*/

	if(!file_exists('../cbj_Docs/year.txt')){
			if(file_exists('year_Init_System.txt')){
				copy("year_Init_System.txt", "../cbj_Docs/year.txt");
				$data4 = "\n \t RENAME year_Init_System.txt TO ../cbj_Docs/year.txt";
			} else {print("DON'T RENAME config/year_Init_System.txt TO config/year.txt </br>");
				$data4 = "\n \t RENAME year_Init_System.txt TO ../cbj_Docs/year.txt";
				}
			}

	if(!file_exists('../cbj_Docs/ayear.php')){
			if(file_exists('ayear_Init_System.php')){
				copy("ayear_Init_System.php", "../cbj_Docs/ayear.php");
				$data5 = "\n \t RENAME ayear_Init_System.php TO ../cbj_Docs/ayear.php";
			} else {print("DON'T RENAME ayear_Init_System.php TO ../cbj_Docs/ayear.php </br>");
				$data5 = "\n \t RENAME ayear_Init_System.php TO ../cbj_Docs/ayear.php";
				}
			}

	global $cfone;
	$cfone ="\n SUSTITUCION DE ARCHIVOS:".$data1.$data2.$data3.$data4.$data5;
	
	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modif(){
									   							
	$filename = "../cbj_Docs/ayear.php";
	
	$contenido = "<?php\n \$dy = array ('' => 'YEAR',\n'".date('y')."' => '".date('Y')."',\n'".(date('y')-1)."' => '".(date('Y')-1)."',\n);\n?>";
	
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);
	global $dat1;
	$dat1 = "\tMODIFICADO Y ACTUALIZADO ".$filename.PHP_EOL;
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modif2(){

	$filename = "../cbj_Docs/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
	global $dat2;
	$dat2 = "\tMODIFICADO Y ACTUALIZADO ".$filename.".\n";
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	global $sqld; 	global $qd; 	global $rowd;
	
		require 'validate.php';	
		
		return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db; 	global $db_name;
	
	/*	REFERENCIA DE USUARIO	*/
	global $rf1;	global $rf2;	global $rf3;	global $rf4;

	if (preg_match('/^(\w{1})/',$_POST['Nombre'],$ref1)){	$rf1 = $ref1[1];
															$rf1 = trim($rf1);
															/*print($ref1[1]."</br>");*/
															}
	if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['Nombre'],$ref2)){	$rf2 = $ref2[2];
																	$rf2 = trim($rf2);
															/*print($ref2[2]."</br>");*/
															}
	if (preg_match('/^(\w{1})/',$_POST['Apellidos'],$ref3)){	$rf3 = $ref3[1];
																$rf3 = trim($rf3);
															/*print($ref3[1]."</br>");*/
															}
	if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['Apellidos'],$ref4)){	$rf4 = $ref4[2];
																		$rf4 = trim($rf4);
															/*print($ref4[2]."</br>");*/
															}

		global $rf;
		$rf = $rf1.$rf2.$rf3.$rf4.$_POST['dni'].$_POST['ldni'];
		$rf = trim($rf);
		$rf = strtolower($rf);

		$_SESSION['iniref'] = $rf;


			////////////////////		**********  		////////////////////
	
	global $vni;
	
	global $trf;
	$trf = $_SESSION['iniref'];
	
	global $vn1;
	$vn1 = "img_admin";
	global $carpetaimg;
	$carpetaimg = "../cbj_Docs/".$vn1;
	
	if($_FILES['myimg']['size'] == 0){
			global $new_name;
			$new_name = $rf.".png";
	} else{
		$extension = substr($_FILES['myimg']['name'],-3);
		// print($extension);
		// $extension = end(explode('.', $_FILES['myimg']['name']) );
		global $new_name;
		$new_name = $rf.".".$extension;
	}

			////////////////////		**********  		////////////////////

	global $nombre;		$nombre = $_POST['Nombre'];
	global $apellido;	$apellido = $_POST['Apellidos'];

	global $db_name;

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$sql = "INSERT INTO `$db_name`.$table_name_a (`ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `Tlf2`) VALUES ('$rf', '$_POST[Nivel]', '$_POST[Nombre]', '$_POST[Apellidos]', '$new_name', '$_POST[doc]', '$_POST[dni]', '$_POST[ldni]', '$_POST[Email]', '$_POST[Usuario]', '$_POST[Password]', '$_POST[Direccion]', '$_POST[Tlf1]', '$_POST[Tlf2]')";
		
	if(mysqli_query($db, $sql)){ // CREA EL ARCHIVO MYDNI.TXT $_SESSION['webmaster'].
									$filename = "../Inclu/webmaster.php";
									$fw2 = fopen($filename, 'w+');
									$mydni = '<?php $_SESSION[\'webmaster\'] = '.$_POST['dni'].'; ?>';
									fwrite($fw2, $mydni);
									fclose($fw2);

	print( "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=3 class='BorderInf'>
						SE HA REGISTRADO COMO ADMINISTRADOR.
					</th>
				</tr>");
								
				global $rutaimg;
				$rutaimg = "src='".$carpetaimg."/".$new_name."'";
				require '../Admin/table_data_resum.php';
				
	print("	<tr>
				<td colspan=3 align='right' class='BorderSup'>
					<a href=\"../index.php\">
						ADMINISTRADOR ACCESO A INICIO DEL SISTEMA 
					</a>
				</td>
			</tr>
		</table>");

$datein = date('Y-m-d H:i:s');
global $text;
$text = PHP_EOL."** CREADO MASTER ADMIN 1. ".$datein.PHP_EOL."\t USER REF: ".$rf.PHP_EOL."\t NAME: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t USER: ".$_POST['Usuario'].PHP_EOL."\t PASS: ".$_POST['Password'].PHP_EOL;

	crear_tablas();
	upImg();

	ini_log();
	config_one();
				
	} else { print("</br>
				<font color='#FF0000'>
		* DATOS NO VALIDOS, MODIFIQUE ENTRADA L187: </font></br> ".mysqli_error($db))."
				</br>";
				show_form();
				global $text;
				$text = "* ERROR BBDD, MODIFIQUE ENTRADA L187: ".mysqli_error($db);
				ini_log();
					}

		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function crear_tablas(){

	global $db;	 		global $db_name;
	global $db_host; 	global $db_user;
	global $db_pass; 	global $dbconecterror;
	
	global $trf; 		$trf = $_SESSION['iniref'];
	
	/************** CREAMOS LA TABLA GASTOS  ***************/

	global $vname1;
	$vname1 = "`".$_SESSION['clave']."gastos_".date('Y')."`";
	
	$tg = "CREATE TABLE `$db_name`.$vname1 (
  `id` int(4) NOT NULL auto_increment,
  `factnum` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factdate` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `refprovee` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factnom` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `factnif` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factiva` int(2) NOT NULL,
  `factivae` decimal(9,2) unsigned NOT NULL,
  `factpvp` decimal(9,2) unsigned NOT NULL,
  `factret` int(2) NOT NULL,
  `factrete` decimal(9,2) unsigned NOT NULL,
  `factpvptot` decimal(9,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $tg)){
			global $data1;
			$data1 = "\t* OK TABLA ".$vname1."\n";
		} else { print( "* NO OK TABLA ".$vname1.". ".mysqli_error($db)."\n");
				 global $data1;
				 $$data1 = "\t* NO OK TABLA ".$vname1.". ".mysqli_error($db)."\n";
			}

// CREA EL DIRECTORIO DE DOC GASTOS.

	$vn1 = "docgastos_".date('Y');
	$carpeta1 = "../cbj_Docs/".$vn1;
	if (!file_exists($carpeta1)) {
		mkdir($carpeta1, 0777, true);
		copy("../cbj_Images/untitled.png", $carpeta1."/untitled.png");
		copy("../cbj_Images/pdf.png", $carpeta1."/pdf.png");
		$data2 = "\t* OK DIRECTORIO ".$carpeta1."\n";
		}
		else{ //print("* NO OK EL DIRECTORIO ".$carpeta1."\n");
				$data2 = "\t* YA EXISTE EL DIRECTORIO ".$carpeta1."\n";
				}

	/************** CREAMOS LA TABLA GASTOS del año anterior  ***************/

	global $vname2;
	$vname2 = "`".$_SESSION['clave']."gastos_".(date('Y')-1)."`";
	
	$tg2 = "CREATE TABLE `$db_name`.$vname2 (
  `id` int(4) NOT NULL auto_increment,
  `factnum` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factdate` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `refprovee` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factnom` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `factnif` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factiva` int(2) NOT NULL,
  `factivae` decimal(9,2) unsigned NOT NULL,
  `factpvp` decimal(9,2) unsigned NOT NULL,
  `factret` int(2) NOT NULL,
  `factrete` decimal(9,2) unsigned NOT NULL,
  `factpvptot` decimal(9,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $tg2)){
			global $data3;
			$data3 = "\t* OK TABLA ".$vname2." \n";
		} else { print( "* NO OK TABLA ".$vname2.". ".mysqli_error($db)."\n");
				 global $data3;
				 $data3 = "\t* NO OK TABLA ".$vname2.". ".mysqli_error($db)."\n";
			}
				
// CREA EL DIRECTORIO DE GASTOS DE AÑO ANTERIOR.

	$vn2 = "docgastos_".(date('Y')-1);
	$carpeta2 = "../cbj_Docs/".$vn2;
	if (!file_exists($carpeta2)) {
			mkdir($carpeta2, 0777, true);
			copy("../cbj_Images/untitled.png", $carpeta2."/untitled.png");
			copy("../cbj_Images/pdf.png", $carpeta2."/pdf.png");
			$data4 = "\t* OK DIRECTORIO ".$carpeta2."\n";
		} else {//print("* YA EXISTE EL DIRECTORIO DIRECTORIO ".$carpeta2."\n");
				$data4 = "\t* YA EXISTE EL DIRECTORIO ".$carpeta2."\n";
					}
	
	/************** CREAMOS LA TABLA INGRESOS  ***************/

	global $vname3;
	$vname3 = "`".$_SESSION['clave']."ingresos_".date('Y')."`";
	
	$ti = "CREATE TABLE `$db_name`.$vname3 (
  `id` int(4) NOT NULL auto_increment,
  `factnum` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factdate` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `refprovee` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factnom` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `factnif` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factiva` int(2) NOT NULL,
  `factivae` decimal(9,2) unsigned NOT NULL,
  `factpvp` decimal(9,2) unsigned NOT NULL,
  `factret` int(2) NOT NULL,
  `factrete` decimal(9,2) unsigned NOT NULL,
  `factpvptot` decimal(9,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $ti)){
			global $data5;
			$data5 = "\t* OK TABLA ".$vname3."\n";
		} else { print( "* NO OK TABLA ".$vname3.". ".mysqli_error($db)."\n");
				 global $data5;
				 $data5 = "\t* NO OK TABLA ".$vname3.". ".mysqli_error($db)."\n";
					}
				
// CREA EL DIRECTORIO DE INGRESOS DEL AÑO.

	$vn3 = "docingresos_".date('Y');
	$carpeta3 = "../cbj_Docs/".$vn3;
	if (!file_exists($carpeta3)) {
			mkdir($carpeta3, 0777, true);
			copy("../cbj_Images/untitled.png", $carpeta3."/untitled.png");
			copy("../cbj_Images/pdf.png", $carpeta3."/pdf.png");
			$data6 = "\t* OK DIRECTORIO ".$carpeta3."\n";
		} else { //print("* NO OK EL DIRECTORIO ".$carpeta3."\n");
				 $data6 = "\t* YA EXISTE EL DIRECTORIO ".$carpeta3."\n";
		}
	
	/************** CREAMOS LA TABLA INGRESOS del año anterior  ***************/

	global $vname4;
	$vname4 = "`".$_SESSION['clave']."ingresos_".(date('Y')-1)."`";
	
	$ti2 = "CREATE TABLE `$db_name`.$vname4 (
  `id` int(4) NOT NULL auto_increment,
  `factnum` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factdate` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `refprovee` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factnom` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `factnif` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factiva` int(2) NOT NULL,
  `factivae` decimal(9,2) unsigned NOT NULL,
  `factpvp` decimal(9,2) unsigned NOT NULL,
  `factret` int(2) NOT NULL,
  `factrete` decimal(9,2) unsigned NOT NULL,
  `factpvptot` decimal(9,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $ti2)){
			global $data7;
			$data7 = "\t* OK TABLA ".$vname4."\n";
		} else { print( "* NO OK TABLA ".$vname4.". ".mysqli_error($db)."\n");
				 global $data7;
				 $data7 = "\t* NO OK TABLA ".$vname4.". ".mysqli_error($db)."\n";
					}
				
// CREA EL DIRECTORIO DE INGRESOS DEL AÑO ANTERIOR.

	$vn4 = "docingresos_".(date('Y')-1);
	$carpeta4 = "../cbj_Docs/".$vn4;
	if (!file_exists($carpeta4)) {
			mkdir($carpeta4, 0777, true);
			copy("../cbj_Images/untitled.png", $carpeta4."/untitled.png");
			copy("../cbj_Images/pdf.png", $carpeta4."/pdf.png");
			$data8 = "\t* OK DIRECTORIO ".$carpeta4."\n";
		} else { //print("* NO OK EL DIRECTORIO ".$carpeta4."\n");
				 $data8 = "\t* YA EXISTE EL DIRECTORIO ".$carpeta4."\n";
		}
	
		/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
		$datein = date('Y-m-d H:i:s');
		global $text;
		$logdate = date('Y-m-d');
		$text = $text.PHP_EOL."** CONFIG INIT ".$datein;
		$text = $text.PHP_EOL."** config/config2.php function crear_tablas()";
		$text = $text.PHP_EOL." * ".$db_name;
		$text = $text.PHP_EOL." * ".$db_host;
		$text = $text.PHP_EOL." * ".$db_user;
		$text = $text.PHP_EOL." * ".$db_pass;
		$text = $text.PHP_EOL.$dbconecterror;
		$text = $text.PHP_EOL.$data1.$data2.$data3.$data4.$data5.$data6.$data7.$data8."\n";

		ini_log();

	} // FIN function crear_tablas()

	function upImg(){
		global $carpetaimg;
		global $rf;
		if($_FILES['myimg']['size'] == 0){
			$nombre = $carpetaimg."/untitled.png";
			global $new_name;
			$new_name = $rf.".png";
			$rename_filename = $carpetaimg."/".$new_name;							
			copy("untitled.png", $rename_filename);
												}
												
		else{ $safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
			  $safe_filename = trim(str_replace('..', '', $safe_filename));

		 	$nombre = $_FILES['myimg']['name'];
		  	$nombre_tmp = $_FILES['myimg']['tmp_name'];
		  	$tipo = $_FILES['myimg']['type'];
		  	$tamano = $_FILES['myimg']['size'];
		  
			$destination_file = $carpetaimg.'/'.$safe_filename;

	 if( file_exists( $carpetaimg.'/'.$nombre) ){
			unlink($carpetaimg."/".$nombre);
		//	print("* El archivo ".$nombre." ya existe, seleccione otra imagen.</br>");
												}
			
	elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){
			
			// Renombrar el archivo:
			$extension = substr($_FILES['myimg']['name'],-3);
			// print($extension);
			// $extension = end(explode('.', $_FILES['myimg']['name']) );
			global $new_name;
			$new_name = $rf.".".$extension;
			$rename_filename = $carpetaimg."/".$new_name;								
			rename($destination_file, $rename_filename);

			// print("El archivo se ha guardado en: ".$destination_file);
	
			}
			
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file);}
		
		}

	} // FIN function upImg()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){ $defaults = $_POST; } 
	else {  global $array_cero;
			$array_cero = 1; 
			require '../Admin/admin_array_total.php';
				}
	
	if ($errors){
		print("<table align='center'>
					<tr>
						<th style='text-align:center'>
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</th>
					</tr>
					<tr>
					<td style='text-align:left !important'>");
		
		global $text;
		$text = "show_form(); ERRORES VALIDACION FORMULARIO ADMIN MASTER";
		ini_log();

		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");

				// ESCRIBE ERRORES EN INI_LOG
				global $text;
				$text = $errors[$a];
				$logdate = date('Y-m-d');
				$logtext = "\t ** ".$text.PHP_EOL;
				$filename = "logs/ini_log_".$logdate.".log";
				$log = fopen($filename, 'ab+');
				fwrite($log, $logtext);
				fclose($log);
			}
		print("</td>
				</tr>
				</table>");
			}
			
	/*******************************/

		global $config2;
		$config2 = 1;

	/*******************************/
	global $array_nive_doc;
			$array_nive_doc = 1;
			require '../Admin/admin_array_total.php';
	
	/*******************************/
			
		global $imgform;
		$imgform = "config2";
		require '../Admin/table_crea_admin.php';
	
	} // FIN function show_form($errors=[])

					   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function ini_log(){

		$ActionTime = date('H:i:s');

		global $text;

		$logdate = date('Y-m-d');

		$logtext = "** ".$ActionTime.PHP_EOL."\t ** ".$text.PHP_EOL;
		$filename = "logs/ini_log_".$logdate.".log";
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
	
	function master_index(){
		
				require '../Inclu_MInd/Master_Index_Admin.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	require '../Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>